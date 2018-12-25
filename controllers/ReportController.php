<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptList;
use app\models\OrderList;
use app\models\Product;
use app\models\LogSt;
use app\models\ReportML;
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
        $ReportRMLs = ReportML::find()->all();
        foreach ($ReportRMLs as $ReportRML):
            $ReportRML->delete();
        endforeach;
        
        $start = "2018-11-01";
        $end = "2018-12-31";        
        $month = "201810";
        $create_at = date("Y-m-d H:i:s");

        $modelPs = Product::find()->orderBy([
            'id' => SORT_ASC,
            ])->all();

        // $modelLSts = LogSt::find()->where(['between','create_at',"2018-10-01" ,$end])->all();
        foreach ($modelPs as $modelP):
            // $product_code = "P20181217225643";

            $product_code = $modelP->code;

            $modelRLs = ReceiptList::find()
                ->where(['between','create_at',$start,$end])
                ->andWhere(['product_code'=> $product_code])
                ->orderBy(['unit_price' => SORT_ASC])
                ->all();

            $Receipt_Qty = 0 ;
            $Receipt_Qty_sum = 0;
            $unit_price = 0;

            foreach ($modelRLs as $modelRL):
                                
                $modelOLs = OrderList::find()
                ->where(['between','create_at',$start,$end])
                ->andWhere(['product_code'=> $product_code])
                ->all();

                $Order_Qty = 0 ;
                $Order_Qty_sum = 0;

                foreach ($modelOLs as $modelOL):
                    $Order_Qty = $modelOL->quantity;	      
                    $Order_Qty_sum = $Order_Qty_sum + $Order_Qty;		           
                endforeach;  


            // $modelLSts = LogSt::find()
            //     ->where(['between','create_at',$start,$end])
            //     ->andWhere(['product_code'=> $product_code])
            //     ->all();
            //         $Log_All_Qty = 0 ;
            //         $Log_All_Qty_sum = 0;
            //     foreach ($modelLSts as $modelLSt):
            //         $Log_All_Qty = $modelLSt->quantity;	      
			//         $Log_All_Qty_sum = $Log_All_Qty_sum + $Log_All_Qty;		           
            //     endforeach;

                
            

                  
            endforeach;
            $modelML = new ReportML();
                            $modelML->month = $month;
                            // $modelML->product_name = $modelRL->getProductName();
                            $modelML->product_name = $modelP->product_name;
                            // $modelML->product_unit = $modelP->getUnitName();
                            // $modelML->kb = $Log_KB_Qty_sum;
                            // $modelML->r = $Log_R_Qty_sum;
                            // $modelML->o = $Order_Qty_sum;
                            // $modelML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                            // $modelML->unit_price = $modelRL->unit_price;
                            // $modelML->total_price = $modelRL->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                            $modelML->create_at = $create_at;
                            $modelML->save();  
        endforeach;

            $ReportRMLs = ReportML::find()->all();
        
        return $this->render('view',[
            // 'models' => $model,
            'ReportRMLs' => $ReportRMLs,
            // 'modelLSts' => $modelLSts,
            // 'modelOLs' => $modelOLs,
            // 'modelRLs' => $modelRLs,
            // 'modelLSt_Rs' => $modelLSt_Rs,
            // 'modelLSt_Os' => $modelLSt_Os,
            // 'modelLSt_KBs' => $modelLSt_KBs,
            // 'Order_Qty_sum' => $Order_Qty_sum,
            // 'Receipt_Qty_sum' => $Receipt_Qty_sum,
            // 'Log_R_Qty_sum' => $Log_R_Qty_sum,
            // 'Log_O_Qty_sum' => $Log_O_Qty_sum,
            // 'Log_KB_Qty_sum' => $Log_KB_Qty_sum,
            // 'Log_K_Qty_sum' => $Log_K_Qty_sum,          
            //'dataProvider' => $dataProvider,
        ]);
    }

    

    
}
