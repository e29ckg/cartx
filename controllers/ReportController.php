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
        $start = "2018-09-01";
        $end = "2018-10-01";        
        $month = "201809";
        $monthB = "201808";
        $create_at = date("Y-m-d H:i:s");

        $ReportRMLs = ReportML::find()->where(['month' => $month])->all();
        foreach ($ReportRMLs as $ReportRML):
            $ReportRML->delete();
        endforeach;

        $modelPs = Product::find()->orderBy([
            'id' => SORT_ASC,
            ])->all();

        // $modelLSts = LogSt::find()->where(['between','create_at',"2018-10-01" ,$end])->all();
        foreach ($modelPs as $modelP):
            if($modelP->create_at < $end){
            // $product_code = "P20181217225643";
            $product_code = $modelP->code;

            $modelRLs = ReceiptList::find()
                // ->where(['between','create_at',$start,$end])
                ->andWhere(['product_code'=> $product_code])
                // ->orderBy(['unit_price' => SORT_ASC])
                ->all();

            foreach ($modelRLs as $modelRL):    

                $modelRML = ReportML::find()
                    ->where(['month' => $month,'product_code'=>$modelP->code,'unit_price'=>$modelRL->unit_price])
                    ->one();
                    if($modelRML){
                        $modelML->create_at = $create_at;
                        $modelML->save();
                    }else{
                        $modelML = new ReportML();
                            $modelML->month = $month;
                            // $modelML->product_name = $modelRL->getProductName();
                            $modelML->product_code = $modelP->code;
                            $modelML->product_unit = $modelP->getUnitName();
                            // $modelML->kb = $Log_KB_Qty_sum;
                            // $modelML->r = $Log_R_Qty_sum;
                            // $modelML->o = $Order_Qty_sum;
                            // $modelML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                            $modelML->unit_price = $modelRL->unit_price;
                            // $modelML->total_price = $modelRL->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                            $modelML->create_at = $create_at;
                            $modelML->save();  
                    }

                $modelOLs = OrderList::find()
                        ->where(['between','create_at',$start,$end])
                        ->andWhere(['product_code'=> $product_code])
                        ->all();

                $Order_Qty = 0 ;
                $Order_Qty_sum = 0;

                foreach ($modelOLs as $modelOL):
                    $Order_Qty = $modelOL->quantity;	      
                    $Order_Qty_sum = $Order_Qty_sum + $Order_Qty;	
                    
                    $modelRML = ReportML::find()->where(['month' => $month,'product_code'=>$modelP->code,'unit_price'=>$modelRL->unit_price])->one();
                    if($modelRML){
                        $modelML->o = $Order_Qty_sum;
                        $modelML->create_at = $create_at;
                        $modelML->save();
                    }else{
                        $modelML = new ReportML();
                                    $modelML->month = $month;
                                    // $modelML->product_name = $modelRL->getProductName();
                                    $modelML->product_code = $modelP->code;
                                    $modelML->product_unit = $modelP->getUnitName();
                                    // $modelML->kb = $Log_KB_Qty_sum;
                                    // $modelML->r = $Log_R_Qty_sum;
                                    $modelML->o = $Order_Qty_sum;
                                    // $modelML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                                    // $modelML->unit_price = $modelRL->unit_price;
                                    // $modelML->total_price = $modelRL->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                                    $modelML->create_at = $create_at;
                                    $modelML->save();  
                    }
                endforeach;  
                

                // $modelLSt_KB_RML = ReportML::find()
                //     ->where(['month' => $monthB,'product_code'=> $product_code,'unit_price'=>$modelRL->unit_price])
                //     // ->andWhere(['product_code'=> $product_code])
                //     ->one();
                //     if($modelLSt_KB_RML['month'] == $monthB){
                //         $modelML->kb = $modelLSt_KB_RML->kb;
                //         $modelML->save();
                //     }else{            

                $modelLSt_KBs = LogSt::find()
                    ->where(['<','create_at',$start])
                    ->andWhere(['product_code'=> $product_code,'unit_price'=>$modelRL->unit_price])
                    ->all();
                        $Log_KB_Qty = 0 ;
                        $Log_KB_Qty_sum = 0;
                    foreach ($modelLSt_KBs as $modelLSt_KB):
                        $Log_KB_Qty = $modelLSt_KB->quantity;	      
                        $Log_KB_Qty_sum = $Log_KB_Qty_sum + $Log_KB_Qty;

                        $modelRML = ReportML::find()
                        ->where(['month' => $month,'product_code'=>$modelP->code,'unit_price'=>$modelRL->unit_price])
                        ->one();
                        
                    if($modelRML){
                        $modelML->kb = $Log_KB_Qty_sum;
                        $modelML->save();
                    }else{
                        $modelML = new ReportML();
                                $modelML->month = $month;
                                // $modelML->product_name = $modelRL->getProductName();
                                $modelML->product_code = $modelP->code;
                                $modelML->product_unit = $modelP->getUnitName();
                                $modelML->kb = $Log_KB_Qty_sum;
                                // $modelML->r = $Log_R_Qty_sum;
                                // $modelML->o = $Order_Qty_sum;
                                // $modelML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                                // $modelML->k = $Log_All_Qty_sum;
                                $modelML->unit_price = $modelRL->unit_price;
                                // $modelML->total_price = $modelRL->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                                $modelML->create_at = $create_at;
                                $modelML->save();  
                    } 
                    endforeach;
                // } 
                $modelLSts = LogSt::find()
                    ->where(['between','create_at',$start,$end])
                    ->andWhere(['product_code'=> $product_code,'unit_price'=>$modelRL->unit_price])
                    ->all();
                        $Log_R_Qty = 0 ;
                        $Log_R_Qty_sum = 0;
                    foreach ($modelLSts as $modelLSt):
                        $Log_R_Qty = $modelLSt->quantity;	      
                        $Log_R_Qty_sum = $Log_R_Qty_sum + $Log_R_Qty;	
                        
                        if($modelLSt->quantity > 0){
                        
                        $modelRML = ReportML::find()
                            ->where(['month' => $month,'product_code'=>$modelP->code,'unit_price'=>$modelRL->unit_price])
                            ->one();
                            
                        if($modelRML){
                            $modelML->r = $modelML->k + $Log_R_Qty_sum;
                            $modelML->save();
                        }else{
                            $modelML = new ReportML();
                                    $modelML->month = $month;
                                    // $modelML->product_name = $modelRL->getProductName();
                                    $modelML->product_code = $modelP->code;
                                    $modelML->product_unit = $modelP->getUnitName();
                                    // $modelML->kb = $Log_KB_Qty_sum;
                                    $modelML->r = $Log_R_Qty_sum;
                                    // $modelML->o = $Order_Qty_sum;
                                    // $modelML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                                    // $modelML->k = $Log_All_Qty_sum;
                                    $modelML->unit_price = $modelRL->unit_price;
                                    // $modelML->total_price = $modelRL->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                                    $modelML->create_at = $create_at;
                                    $modelML->save();  
                        }
                    }   

                    endforeach;

            endforeach;

        }

        endforeach;

            $ReportRMLs = ReportML::find()->where(['month' => $month])->all();
        
        return $this->render('view',[
            'month' => $month,
            'start' => $start,
            'end' => $end,
            'ReportRMLs' => $ReportRMLs, 
        ]);
    }
 
}
