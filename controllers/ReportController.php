<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptList;
use app\models\OrderList;
use app\models\Product;
use app\models\LogSt;
use app\models\ReportM;
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
        $ReportM = ReportM::find()
        ->orderBy(['month' => SORT_ASC])
        // ->groupBy('product_code')
        // ->count();
        ->all();
        
        return $this->render('index',[
            'ReportM' => $ReportM,
            'start' => date('Y-m-d'),
            'end' => date('Y-m-d'),      
            'month' => date('Y-m-d', strtotime('last month', strtotime(date('Y-m-d')))),
            'monthB' => "2019-03",
        ]);
    }

    public function actionView()
    {

        $start = "2019-04-01";
        $end = "2019-04-30";        
        $month = "2019-04";
        $monthB = "2019-03";
        $create_at = date("Y-m-d H:i:s");

        $rRMLs = ReportML::find()->where(['month' => $month])->all();
        foreach ($rRMLs as $rRML):
            $rRML->delete();
        endforeach;

        $mPs = Product::find()->where(['status' => 1])
            ->orderBy([
                'category' => SORT_ASC
                // 'product_name' => SORT_ASC
                ])
            ->all();

        // $modelLSts = LogSt::find()->where(['between','create_at',"2018-10-01" ,$end])->all();
        foreach ($mPs as $mP):
            if($mP->create_at <= $end){
            // $product_code = "P20181217225643";
            $product_code = $mP->code;

            $mRLs = ReceiptList::find()
                // ->where(['between','create_at',$start,$end])
                ->where(['<=','create_at',$end])
                ->andWhere(['product_code'=> $product_code])
                // ->orderBy(['unit_price' => SORT_ASC])
                ->all();

            foreach ($mRLs as $mRL):    

                $mRML = ReportML::find()
                    ->where(['month' => $month,'product_code'=>$mP->code,'unit_price'=> $mRL->unit_price])
                    ->one();
                    if($mRML){
                        $mML->create_at = $create_at;
                        $mML->unit_price = $mRL->unit_price;
                        $mML->save();
                    }else{
                        $mML = new ReportML();
                            $mML->month = $month;
                            // $mML->product_name ->getProductName();
                            $mML->product_code = $mP->code;
                            $mML->product_unit = $mP->getUnitName();
                            // $mML->kb = $Log_KB_Qty_sum;
                            // $mML->r = $Log_R_Qty_sum;
                            // $mML->o = $Order_Qty_sum;
                            // $mML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                            $mML->unit_price = $mRL->unit_price;
                            // $mML->total_price ->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                            $mML->create_at = $create_at;
                            $mML->save();  
                    }

                $mOLs = OrderList::find()
                        ->where(['between','create_at',$start,$end])
                        ->andWhere(['product_code'=> $product_code])
                        ->all();

                $Order_Qty = 0 ;
                $Order_Qty_sum = 0;

                foreach ($mOLs as $mOL):
                    // $Order_Qty = $mOL->quantity;	      
                    // $Order_Qty_sum = $Order_Qty_sum + $Order_Qty;	
                    
                    $mRML = ReportML::find()->where(['month' => $month,'product_code'=>$mP->code,'unit_price' => $mRL->unit_price])->one();
                    if($mRML){
                        $mML->o = $mOL->quantity;
                        $mML->create_at = $create_at;
                        $mML->save();
                    }else{
                        $mML = new ReportML();
                        $mML->month = $month;
                        // $mML->product_name ->getProductName();
                        $mML->product_code = $mP->code;
                        $mML->product_unit = $mP->getUnitName();
                        // $mML->kb = $Log_KB_Qty_sum;
                        // $mML->r = $Log_R_Qty_sum;
                        $mML->o = $mOL->quantity;
                        // $mML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                        $mML->unit_price ->unit_price;
                        // $mML->total_price ->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                        $mML->create_at = $create_at;
                        $mML->save();  
                    }
                endforeach;  
                

                $modelLSt_KB_RML = ReportML::find()
                    ->where(['month' => $monthB,'product_code'=> $product_code,'unit_price'=>$mRL->unit_price])
                    // ->andWhere(['product_code'=> $product_code])
                    ->one();
                    if($modelLSt_KB_RML['month'] == $monthB){
                        $mML->kb = $modelLSt_KB_RML->kb;
                        $mML->save();
                    }else{            

                $modelLSt_KBs = LogSt::find()
                    ->where(['<','create_at',$start])
                    ->andWhere(['product_code'=> $product_code,'unit_price' => $mRL->unit_price])
                    ->all();
                        $Log_KB_Qty = 0 ;
                        $Log_KB_Qty_sum = 0;
                    foreach ($modelLSt_KBs as $modelLSt_KB):
                        $Log_KB_Qty = $modelLSt_KB->quantity;	      
                        $Log_KB_Qty_sum = $Log_KB_Qty_sum + $Log_KB_Qty;

                        $mRML = ReportML::find()
                        ->where(['month' => $month,'product_code'=>$mP->code,'unit_price' => $mRL->unit_price])
                        ->one();
                        
                    if($mRML){
                        $mML->kb = $Log_KB_Qty_sum;
                        $mML->save();
                    }else{
                        $mML = new ReportML();
                                $mML->month = $month;
                                // $mML->product_name ->getProductName();
                                $mML->product_code = $mP->code;
                                $mML->product_unit = $mP->getUnitName();
                                $mML->kb = $Log_KB_Qty_sum;
                                // $mML->r = $Log_R_Qty_sum;
                                // $mML->o = $Order_Qty_sum;
                                // $mML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                                // $mML->k = $Log_All_Qty_sum;
                                // $mML->unit_price ->unit_price;
                                // $mML->total_price ->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                                $mML->create_at = $create_at;
                                $mML->save();  
                    } 
                    endforeach;
                } 

                $modelLSts = LogSt::find()
                    // ->where(['between','create_at',$start,$end])
                    ->where(['ym' => $month])
                    ->andWhere(['product_code'=> $product_code,'unit_price'=>$mRL->unit_price])
                    ->all();
                        $Log_R_Qty = 0 ;
                        $Log_R_Qty_sum = 0;
                    foreach ($modelLSts as $modelLSt):
                        $Log_R_Qty = $modelLSt->quantity;	      
                        $Log_R_Qty_sum = $Log_R_Qty_sum + $Log_R_Qty;	
                        
                        if($modelLSt->quantity > 0){
                        
                        $mRML = ReportML::find()
                            ->where(['month' => $month,'product_code'=>$mP->code,'unit_price'=>$mRL->unit_price])
                            ->one();
                            
                        if($mRML){
                            $mML->r = $mML->k + $Log_R_Qty_sum;
                            $mML->save();
                        }else{
                            $mML = new ReportML();
                                    $mML->month = $month;
                                    // $mML->product_name ->getProductName();
                                    $mML->product_code = $mP->code;
                                    $mML->product_unit = $mP->getUnitName();
                                    // $mML->kb = $Log_KB_Qty_sum;
                                    $mML->r = $Log_R_Qty_sum;
                                    // $mML->o = $Order_Qty_sum;
                                    // $mML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                                    // $mML->k = $Log_All_Qty_sum;
                                    // $mML->unit_price ->unit_price;
                                    // $mML->total_price ->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                                    $mML->create_at = $create_at;
                                    $mML->save(); 
                        }
                    }   

                    endforeach;

            endforeach;

        }

        endforeach;

            $rRMLs = ReportML::find()->where(['month' => $month])->all();
            foreach ($rRMLs as $rRML):
                $rRML->k = $rRML->kb + $rRML->r -$rRML->o;
                $rRML->save();
            endforeach;

        return $this->render('view',[
            'month' => $month,
            'start' => $start,
            'end' => $end,
            'rRMLs' => $rRMLs, 
        ]);
    }




    public function actionReport_add()
    {
        $this->actionView2(date('Y-m', strtotime(date('Y-m'))));
        
        
            return $this->redirect(['index']); 
        
    }


    public function actionView2($m)
    {

        // $start = "2019-04-01";
        // $end = "2019-04-30";        
        $month = date('Y-m', strtotime($m));
        // $monthB = "2019-03";
        $monthB = date('Y-m', strtotime('last month', strtotime( $month)));

        $create_at = date("Y-m-d H:i:s");

        $ModelRPM = ReportM::findOne(['month'=>$month]);        
        if(empty($ModelRPM->month)){
            $ModelRPM = new ReportM();
            $ModelRPM->month = $month;
            $ModelRPM->save();
        }

        $rRMLs = ReportML::find()->where(['month' => $month])->all(); 
        foreach ($rRMLs as $rRML):
            $rRML->delete();
        endforeach;


        $mPs = Product::find()->where(['status' => 1])
            ->orderBy([
                'category' => SORT_ASC,
                'product_name' => SORT_ASC
                ])
            ->all();

        // $modelLSts = LogSt::find()->where(['between','create_at',"2018-10-01" ,$end])->all();
        foreach ($mPs as $mP):

            /*----------------หายอดยกมา-------------------*/
            $modelRLS = ReceiptList::find()
                // ->where(['ym' => $month])
                ->where(['product_code' => $mP->code])
                ->andWhere(['<','ym',$month])
                ->all();
            foreach ($modelRLS as $model):  

                // $mRML = ReportML::find()
                //     ->where(['month' => $month,'product_code'=>$mP->code,'unit_price'=> $mRL->unit_price])
                //     ->one();
                //     if(isset($mRML)){
                //         $mML->create_at = $create_at;
                //         $mML->unit_price = $mRL->unit_price ;
                //         $mRML->kb = $mRML->kb + $model->quantity;
                //         $mML->save();
                //     }else{
                //         $mML = new ReportML();
                //             $mML->month = $month;
                //             $mML->product_code = $mP->code;
                //             $mML->product_unit = $mP->getUnitName();
                //             $mML->unit_price = $mRL->unit_price;
                //             $mML->create_at = $create_at;
                //             $mML->save();  
                //     }

            endforeach;


        endforeach;

            $rRMLs = ReportML::find()
            // ->where(['month' => $month])
            ->all();
            // foreach ($rRMLs as $rRML):
            //     $rRML->k = $rRML->kb + $rRML->r - $rRML->o;
            //     $rRML->save();
            // endforeach;

            $product_code = 'P20181217225643';

        /*-------------------------------------------------------------------*/
            // $RL = LogSt::find()
            // ->where(['product_code' => $product_code,])
            // ->andWhere(['>','quantity',0])
            // ->andWhere(['<','ym',$month])
            // ->all();                                    //รับที่ผ่านมา

            // $AAA = null;
            // foreach ($RL as $model):
            //     $AAA = $AAA + $model->quantity;                
            // endforeach;
        /*---------------------------------------------------------------------*/

            // $RL = LogSt::find()
            // ->where(['product_code' => $product_code])
            // ->andWhere(['<','quantity',0])
            // ->andWhere(['<','ym',$month])
            // ->all();                                    //จ่ายที่ผ่านมาทั้งหมด

            // $BBB = null;
            // foreach ($RL as $model):
            //     $BBB = $BBB + $model->quantity;                
            // endforeach;

        /*---------------------------------------------------------------------*/    

        $RL = LogSt::find()
        ->where(['product_code' => $product_code,])
        ->andWhere(['>','quantity',0])
        ->andWhere(['ym'=> $month])
        ->all();                                    //รับเดือนนี้

        $AAA = null;
        foreach ($RL as $model):
            $AAA = $AAA + $model->quantity;                
        endforeach;
    /*---------------------------------------------------------------------*/

        $RL = LogSt::find()
            ->where(['product_code' => $product_code])
            ->andWhere(['<','quantity',0])
            ->andWhere(['ym' => $month])
            ->all();                                    //จ่ายที่เดือนนี้ 

            $BBB = null;
            foreach ($RL as $model):
                $BBB = $BBB + $model->quantity;                
            endforeach;

    /*---------------------------------------------------------------------*/    

        return $this->render('view',[
            'month' => $month,
            'start' => $AAA,
            'end' => $BBB,
            'rRMLs' => $rRMLs, 
        ]);
    }
}
