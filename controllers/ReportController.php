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
        ->orderBy(['month' => SORT_DESC])
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

    public function actionDel($id)
    {
        $model = ReportM::findOne($id);
        $model->delete();
        return $this->redirect(['index']);         
    }

    public function actionReport_add()
    {
        $this->actionView2(date('Y-m', strtotime(date('Y-m'))));
        
        return $this->redirect(['index']); 
        
    }

    
    


    public function actionView2($m = null)
    {
        if(empty($m)){
            $m = date("Y-m-d H:i:s");
        }
              
        $month = date('Y-m', strtotime($m));

        $create_at = date("Y-m-d H:i:s");

        $ModelRPM = ReportM::findOne(['month'=>$month]);        
        if(empty($ModelRPM->month)){
            $ModelRPM = new ReportM();
            $ModelRPM->month = $month;
            $ModelRPM->save();
        }

        ReportML::DeleteAll(['month' => $month]);
        
        $MP = Product::find()->where(['status'=>'1'])->all();
        foreach ($MP as $modelP):

            $RL = LogSt::find()
                // ->select(['unit_price','product_code','unit_price',])
                ->where(['product_code' => $modelP->code])
                // ->andWhere(['<','quantity',0])
                // ->andWhere(['<','ym',$month])
                ->groupBy(['unit_price']) 
                ->all();
            
            foreach ($RL as $model):
                $ModelRPM = new ReportML();
                $ModelRPM->month = $month;
                $ModelRPM->product_code = $modelP->code;
                $ModelRPM->product_unit = $modelP->unit;

                $kb = null;
                $o= null;
                $r= null;
                $modelKB = LogSt::find()
                    ->where(['<=','ym',$month])
                    ->andWhere([
                        'unit_price'=>$model->unit_price,
                        'product_code'=> $model->product_code
                        ])
                    ->all();

                foreach ($modelKB as $modelK):
                    if($modelK->ym < $month){
                        $kb = $kb + $modelK->quantity;
                    }
                    if($modelK->ym == $month && $modelK->quantity > 0 ){
                        $r = $r + $modelK->quantity;
                    }
                    if($modelK->ym == $month  && $modelK->quantity < 0){
                        $o = $o + $modelK->quantity;
                    }
                endforeach;

                $ModelRPM->kb = $kb; 
                $ModelRPM->r = $r;
                $ModelRPM->o = $o;
                $ModelRPM->k = $ModelRPM->kb + $ModelRPM->r + $ModelRPM->o;               
                $ModelRPM->unit_price = $model->unit_price;
                $ModelRPM->save();   
    
            endforeach;
        // }
        
    endforeach;

    $rRMLs = ReportML::find()->where(['month' => $month])->all(); 
        return $this->render('view',[
            'month' => ReportML::DateThai_full($month),
            'start' => 1,
            'end' => 1,
            'rRMLs' => $rRMLs, 
            'RL' => $RL,
        ]);
    }
}
