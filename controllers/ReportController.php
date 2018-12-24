<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptList;
use app\models\OrderList;
use app\models\Product;
use app\models\LogSt;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class ReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','Add_list','add'],
                'rules' => [
                    [
                        'actions' => ['index','Add_list','add'],
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Receipt::find()->orderBy([
            //  'create_at'=>SORT_DESC, //SORT_ASC,
            'id' => SORT_DESC,
            ])->limit(200)->all();
        
            $countAll = Receipt::getCountAll();
        
        return $this->render('index',[
            'models' => $model,
            'countAll' => $countAll,
            //'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView()
    {
        $model = Product::find()->orderBy([
            //  'create_at'=>SORT_DESC, //SORT_ASC,
            'id' => SORT_ASC,
            ])->all();
        
        // $modelRLs = ReceiptList::find()->where(['<','create_at','2018-10-02 14:51:22'])->all();
        $start = strtotime(2018-10-02);
        $end = strtotime(2018-11-02);
        $modelLSts = LogSt::find()->where(['between','create_at',"2018-10-01" ,"2018-12-31"])->all();
        
            // $countAll = Receipt::getCountAll();
        
        return $this->render('view',[
            'models' => $model,
            'modelLSts' => $modelLSts,
            //'dataProvider' => $dataProvider,
        ]);
    }

    

    
}
