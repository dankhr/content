<?php

namespace app\controllers;

use yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\News;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'register'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['register'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    // Новости
    public function actionNews() {
        // выполняем запрос (нужны только опубликованные новости с сортировкой от самой новой даты публикации к самой старой
        $allNews = News::find()->where(['state' => News::STATUS_AGREE])
                                ->andWhere('start_date <= CURDATE()')
                                ->andWhere('finish_date >= CURDATE()')
                                ->orderBy(['count_views' => SORT_DESC, 'id' => SORT_DESC]);
        $countQuery = clone $allNews;					 // делаем копию выборки

        // подключаем класс Pagination
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]); // 5 - количество новостей на странице
        $pages->pageSizeParam = false;					  // приводим параметры в ссылке к ЧПУ
        $news = $allNews->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        // Передаем данные в представление
        return $this->render('news', [
            'news' => $news,
            'pages' => $pages,
        ]);
    }

    // Выбранная новость
    public function actionOneNews($id) {
        $one_news = News::find()->AsArray()->where(['id' => $id, 'state' => News::STATUS_AGREE])->limit(1)->one();
        if (empty($one_news))
            $this->redirect('/');	// Если новость не найдена, то редирект на главную

        // Добавляем +1 к количеству просмотров
        $model = News::findOne($id);

        $model->count_views = $model->count_views + 1;
        $model->save();

        return $this->render('onenews', compact('one_news'));
    }
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Если не гость
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('adminRole')) { // Если админ, то перенаправляем на его контроллер
                return $this->redirect('/admin/');
            } else if (Yii::$app->user->can('editorRole')) { // Если редактор, то перенаправляем на его контроллер
                return $this->redirect('/editor/');
            } else if (Yii::$app->user->can('moderatorRole')) { // Если модератор, то перенаправляем на его контроллер
                return $this->redirect('/moderator/');
            } else { // Иначе - перенаправляем на контроллер автора
                    return $this->redirect('/author/');
                }
        } else {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        // Если есть POST-данные
        if ($model->load(Yii::$app->request->post())) {
            // Если успешно зарегистрировались
            if ($user = $model->register()) {
                // Добавляем роль "Автор" по умолчанию
                $sql = 'INSERT INTO auth_assignment(item_name, user_id) VALUES("author", ' . $user->id . ')';
                \Yii::$app->db->createCommand($sql)->execute();

                // flash-сообщением уведомляем пользователя, что регистрация прошла успешно
                Yii::$app->session->setFlash('reg-success', 'Регистрация с ролью "Автор" прошла успешно.');
                return $this->redirect('/site/');
            }
        }

        // Отрисовываем страницу регистрации, если не было POST-данных или если регистрация прошла неуспешно
        return $this->render('register', [
            'model' => $model,
        ]);
    }

}
