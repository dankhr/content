<?php

namespace app\controllers;

use yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

use app\models\News;
use yii\data\ActiveDataProvider;


class EditorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'add-news', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'add-news', 'update'],
                        'roles' => ['editorRole'],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->where(['id_author' => Yii::$app->user->id])->orderBy('start_date'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        Url::remember(); //remember current page (see Url::previous() below)

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddNews()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');    // картинка
            if (!is_null($image)) {                                 // если выбрана картинка
                // сохраняем новую картинку
                $model->ext_image = end(explode(".", $image->name));
            }

            $model->id_author = Yii::$app->user->identity->getId();

            if ($model->save()) {
                // Если запись обновилась в БД
                if (!is_null($image)) {
                    $image->saveAs(Yii::$app->basePath . Yii::$app->params['fullUploadPath'] . 'news' . $model->id . '.' . $model->ext_image);
                }

                return $this->render('aftercreate');
            } else
                return $this->render('add_news', [
                    'model' => $model,
                ]);
        }
        else
            return $this->render('add_news', [
                'model' => $model,
            ]);

    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');    // картинка
            if (!is_null($image)) {                                 // если выбрана картинка
                // удаляем старую картинку
                @unlink(Yii::$app->basePath . Yii::$app->params['fullUploadPath'] . 'news' . $id . '.' . $model->ext_image); // @ – значит без exceptiona в случае ошибки

                // сохраняем новую картинку
                $model->ext_image = end(explode(".", $image->name));
                $image->saveAs(Yii::$app->basePath . Yii::$app->params['fullUploadPath'] . 'news' . $id . '.' . $model->ext_image);
            }
            // меняем статус новости на "Ожидает модерации"
            $model->state = News::STATUS_NEW;
            if ($model->save()) {
                // Если запись обновилась в БД

                // Направляем пользователя на предыдущую страницу
                return $this->redirect(Url::previous());
            } else
                return $this->render('update', [
                    'model' => $model,
                ]);
        }
        else
            return $this->render('update', [
                'model' => $model,
            ]);
    }


    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрошенная страница не найдена.');
        }
    }

  
}
