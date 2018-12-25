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
        // $start = strtotime('2018-10-02');
        // $end = strtotime('2018-12-31');
        $end = "2018-12-31";
        $start = "2018-10-01";
        $product_code = "P20181217221146";

        // $modelLSts = LogSt::find()->where(['between','create_at',"2018-10-01" ,$end])->all();
        $modelLSts = LogSt::find()
                ->where(['between','create_at',$start,$end])
                ->andWhere(['product_code'=> $product_code])
                ->all();
                    $Log_All_Qty = 0 ;
                    $Log_All_Qty_sum = 0;
                foreach ($modelLSts as $modelLSt):
                    $Log_All_Qty = $modelLSt->quantity;	      
			        $Log_All_Qty_sum = $Log_All_Qty_sum + $Log_All_Qty;		           
                endforeach;

        $modelLSt_Rs = LogSt::find()
                ->where(['between','create_at',$start,$end])
                ->andWhere(['>','quantity','0'])
                ->andWhere(['product_code'=> $product_code])
                ->all();
                $Log_R_Qty = 0 ;
                $Log_R_Qty_sum = 0;
                foreach ($modelLSt_Rs as $modelLSt_R):
                    $Log_R_Qty = $modelLSt_R->quantity;	      
			        $Log_R_Qty_sum = $Log_R_Qty_sum + $Log_R_Qty;		           
                endforeach;

        $modelLSt_Os = LogSt::find()
                ->where(['between','create_at',$start,$end])
                ->andWhere(['<','quantity','0'])
                ->andWhere(['product_code'=> $product_code])
                ->all();
                $Log_O_Qty = 0 ;
                $Log_O_Qty_sum = 0;
                foreach ($modelLSt_Os as $modelLSt_O):
                    $Log_O_Qty = $modelLSt_O->quantity;	      
			        $Log_O_Qty_sum = $Log_O_Qty_sum + $Log_O_Qty;		           
                endforeach;
        
        $modelLSt_KBs = LogSt::find()
                // ->where(['between','create_at',$start,$end])
                ->where(['<','create_at',$start])
                ->andWhere(['product_code'=> $product_code])
                ->all();
                $Log_KB_Qty = 0 ;
                $Log_KB_Qty_sum = 0;
                foreach ($modelLSt_KBs as $modelLSt_KB):
                    $Log_KB_Qty = $modelLSt_KB->quantity;	      
			        $Log_KB_Qty_sum = $Log_KB_Qty_sum + $Log_KB_Qty;		           
                endforeach;

        $modelLSt_Ks = LogSt::find()
                // ->where(['between','create_at',$start,$end])
                ->where(['<','create_at',$end])
                ->andWhere(['product_code'=> $product_code])
                ->all();
                $Log_K_Qty = 0 ;
                $Log_K_Qty_sum = 0;
                foreach ($modelLSt_Ks as $modelLSt_K):
                    $Log_K_Qty = $modelLSt_K->quantity;	      
			        $Log_K_Qty_sum = $Log_K_Qty_sum + $Log_K_Qty;		           
                endforeach;

        $modelRLs = ReceiptList::find()
            ->where(['between','create_at',$start,$end])
            ->andWhere(['product_code'=> $product_code])
            ->orderBy(['unit_price' => SORT_ASC])
            ->all();

            $Receipt_Qty = 0 ;
            $Receipt_Qty_sum = 0;
            $unit_price = 0;
            foreach ($modelRLs as $modelRL):

                $modelLSt_Rs = LogSt::find()
                ->where(['between','create_at',$start,$end])
                // ->andWhere(['>','quantity','0'])
                ->andWhere(['product_code'=> $product_code])
                ->all();
                $Log_R_Qty = 0 ;
                $Log_R_Qty_sum = 0;
                $Log_O_Qty = 0 ;
                $Log_O_Qty_sum = 0;
                foreach ($modelLSt_Rs as $modelLSt_R):
                    if($modelLSt_R->quantity > 0){
                        $Log_R_Qty = $modelLSt_R->quantity;	      
                        $Log_R_Qty_sum = $Log_R_Qty_sum + $Log_R_Qty;
                    }elseif($modelLSt_R->quantity < 0){
                        $Log_O_Qty = $modelLSt_O->quantity;	      
                        $Log_O_Qty_sum = $Log_O_Qty_sum + $Log_O_Qty;
                    }		           
                endforeach;
                
                $modelLSt_KBs = LogSt::find()
                // ->where(['between','create_at',$start,$end])
                ->where(['<','create_at',$start])
                ->andWhere(['product_code'=> $product_code])
                ->all();
                $Log_KB_Qty = 0 ;
                $Log_KB_Qty_sum = 0;
                foreach ($modelLSt_KBs as $modelLSt_KB):
                    $Log_KB_Qty = $modelLSt_KB->quantity;	      
			        $Log_KB_Qty_sum = $Log_KB_Qty_sum + $Log_KB_Qty;		           
                endforeach;

                $Log_R_Qty_sum;
                $Log_KB_Qty_sum;
                $Log_O_Qty_sum;
                $K = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                $modelRL->unit_price;
                $Money = $K * $modelRL->unit_price;
                
            endforeach;

            
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
        
        
        
        return $this->render('view',[
            'models' => $model,
            // 'modelLSts' => $modelLSts,
            'modelLSts' => $modelLSts,
            'modelOLs' => $modelOLs,
            'modelRLs' => $modelRLs,
            'modelLSt_Rs' => $modelLSt_Rs,
            'modelLSt_Os' => $modelLSt_Os,
            'modelLSt_KBs' => $modelLSt_KBs,
            'Order_Qty_sum' => $Order_Qty_sum,
            'Receipt_Qty_sum' => $Receipt_Qty_sum,
            'Log_R_Qty_sum' => $Log_R_Qty_sum,
            'Log_O_Qty_sum' => $Log_O_Qty_sum,
            'Log_KB_Qty_sum' => $Log_KB_Qty_sum,
            'Log_K_Qty_sum' => $Log_K_Qty_sum,          
            //'dataProvider' => $dataProvider,
        ]);
    }

    

    
}
