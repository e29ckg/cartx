<?php

namespace app\controllers;

use Yii;
use app\models\LogSt;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Order_listController implements the CRUD actions for OrderList model.
 */
class Log_stController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OrderList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $models = LogSt::find()->all();
        
        return $this->render('index', [
            'models' => $models,
        ]);
    }

        protected function findModel($id)
    {
        if (($model = OrderList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
