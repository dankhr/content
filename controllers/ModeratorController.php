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


class ModeratorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update'],
                        'roles' => ['moderatorRole'],
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
            'query' => News::find()->orderBy('start_date'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        Url::remember(); //remember current page (see Url::previous() below)

        return $this->render('index', [
            'dataProvider' => $dataProvider,
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
