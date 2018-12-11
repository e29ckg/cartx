<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Product;
use app\models\Order;
use app\models\OrderList;
use app\models\ProductCatalog;
use app\models\ReceiptList;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use kartik\mpdf\Pdf;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class CartController extends Controller
{
    /**
     * {@inheritdoc}
     */
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','create1'],
                'rules' => [
                    [
                        'actions' => ['index','create','create1'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'cart_shop';
        // $this->layout = 'cart';
        // $model = Product::find()->all();
        
        $countAll = Product::getCountAll();

        $modelCatalogs = ProductCatalog::find()->all();

        // $query = Product::find();
        $query = Product::find();
        $pagination = new Pagination([
            'defaultPageSize' => 100,
            'totalCount' => $query->count(),
        ]);
    
        $models = $query->orderBy(['id' => SORT_ASC])
               ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        
        return $this->render('index',[
            'models' => $models,
            'countAll' => $countAll,
            'modelCatalogs' => $modelCatalogs,
            'pagination' => $pagination,
        ]);
    }

    public function actionCart()
    {
        // $this->layout = 'bg';
        $this->layout = 'cart_shop';        
        
        return $this->render('cart');
    }

    public function actionLogin()
    {
        $this->layout = 'cart_shop';
        // $this->layout = 'cart';
        $query = Product::find();

        
        $countAll = Product::getCountAll();

        $modelCatalogs = ProductCatalog::find()->all();

        $pagination = new Pagination([
            'defaultPageSize' => 100,
            'totalCount' => $query->count(),
        ]);
    
        $models = $query->orderBy(['id' => SORT_DESC])
               ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        
        return $this->render('login',[
            'models' => $models,
            'countAll' => $countAll,
            'modelCatalogs' => $modelCatalogs,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view',[
                    'model' => $this->findModel($id),                   
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() // md5(rand().time("now")
    {      
        $model = new Co();

        //Add This For Ajax Email Exist Validation 
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          } 
     
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $f = UploadedFile::getInstance($model, 'photo');
            if(!empty($f)){
                $dir = Url::to('@webroot/uploads/contact/');
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
                $fileName = md5($f->baseName . time()) . '.' . $f->extension;
                if($f->saveAs($dir . $fileName)){
                    $model->photo = $fileName;
                }               
            } 
            //$model->tel = implode (",",$model->tel);
            // $model->tel = $model->tel[1];
            $model->name = $_POST['Co']['name'];
            $model->created_at = time("now");
            $model->updated_at = time("now");
            if($model->save()){
               return $this->redirect(['index']);
            }   
        }

        // $model->tel = explode(',', $model->tel);
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('create',[
                    'model' => $model,                    
            ]);
        }else{
            return $this->render('create',[
                'model' => $model,                    
            ]); 
        }
    }    
    
    public function actionSearch($q = null,$m = null) {

        $this->layout = 'cart_shop'; 

        if (!empty($q)) {
                $query = Product::find()->where(['LIKE', 'product_name', $q]);
            } else if(!empty($m)){
                    $query = Product::find()->where(['LIKE', 'category', $m]);
                } else {
                        $query = Product::find();
                    }
        
        $pagination = new Pagination([
                'defaultPageSize' => 20,
                'totalCount' => $query->count(),
        ]);
        
        $models = $query->orderBy(['id' => SORT_ASC])
                   ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
                
        if(Yii::$app->request->isAjax){
                return $this->renderAjax('cart_search',[
                    'models' => $models,  
                    'pagination' => $pagination, 
                ]);
        } else {
                $modelCatalogs = ProductCatalog::find()->all();
                return $this->render('index',[
                    'models' => $models,   
                    'pagination' => $pagination, 
                    'modelCatalogs' => $modelCatalogs,
                ]);
        }
    }

    public function actionAdd_to_cart($code = null) {
        //$this->layout = 'cart_shop'; 
        $models = Product::find()->where(['code', $code]);

        if (!isset($_SESSION['inLine'])){
            $_SESSION['inLine'] = 0;
            $_SESSION['strProductCode'][0] = $code; 
            $_SESSION['strQty'][0] = 1;
            
        } else {
            $key = array_search($code, $_SESSION['strProductCode']);
            if((string)$key != ""){
                $_SESSION['strQty'][$key] = $_SESSION['strQty'][$key] + 1;

                $strQty = $_SESSION['strQty'][$key];
                $codeProduct = $_SESSION['strProductCode'][$key];
                $model = Product::find()->where(['code'=> $codeProduct])->one();
                if ($model->instoke > $strQty){
                    $_SESSION['strQty'][$key] = $_SESSION['strQty'][$key] + 1 ;
                }else{
                    $_SESSION['strQty'][$key] = $model->instoke ;
                }   
            }else{
                $_SESSION['inLine'] = $_SESSION['inLine'] + 1;
                $inNewLine =  $_SESSION['inLine'];
                $_SESSION['strProductCode'][$inNewLine ] = $code; 
                $_SESSION['strQty'][$inNewLine ] = 1;
            }
            
            
        } 
        
        return $this->renderAjax('cart');
    }

    public function actionDelete($id = null) {
        $this->layout = 'cart_shop'; 
        $_SESSION['strProductCode'][$id] = ""; 
        $_SESSION['strQty'][$id] = "";
        return $this->render('cart'); 
        // return $this->renderAjax('cart');
    }

    public function actionQty_up($id = null) {
        $this->layout = 'cart_shop'; 
        $strQty = $_SESSION['strQty'][$id];
        $codeProduct=$_SESSION['strProductCode'][$id];
        $model = Product::find()->where(['code'=> $codeProduct])->one();
        if ($model->instoke > $strQty){
            $_SESSION['strQty'][$id] = $_SESSION['strQty'][$id] + 1 ;
        }else{
            $_SESSION['strQty'][$id] ;
        }
        
        // return $this->render('cart'); 
        return $this->renderAjax('cart');
    }

    public function actionQty_down($id = null) {
        $this->layout = 'cart_shop';         
        if($_SESSION['strQty'][$id] > 1){
            $_SESSION['strQty'][$id] = $_SESSION['strQty'][$id] - 1 ;
        }        
        // return $this->render('cart'); 
        return $this->renderAjax('cart');
    }

    public function actionQty_change($id = null,$val = null) {
        $this->layout = 'cart_shop'; 
        $codeProduct = $_SESSION['strProductCode'][$id];
        $model = Product::find()->where(['code'=> $codeProduct])->one();
                
        if($model->instoke >= $val){
                $_SESSION['strQty'][$id] = $val ;
        }else{
            $_SESSION['strQty'][$id] = $model->instoke;
        }

        if($_SESSION['strQty'][$id] <= 0){
            $_SESSION['strQty'][$id] = 1 ;
        }        
               
        // return $this->render('cart'); 
        return $this->renderAjax('cart');
    }

    public function actionCheckout() {
        $this->layout = 'cart_shop';       
               
        return $this->render('checkout'); 
        // return $this->renderAjax('checkout');
    }


    public function actionSave_order() {
        $code = 'A'.date("YmdHis");
        $create_at = date("Y-m-d H:i:s");
        
        try {
            
            $Total = 0 ;
            $sumTotal = 0;
		// 					//  $model = Product::find()->all();
			if(isset($_SESSION['inLine'])){
                
				for($i=0;$i<=(int)$_SESSION['inLine'];$i++){
					if($_SESSION['strProductCode'][$i] != ""){
						$codeProduct = $_SESSION['strProductCode'][$i];
               					// $ss['strProductCode'][$i] =  $_SESSION['inLine'][$i];
						$Total = $_SESSION['strQty'][$i];
                        $sumTotal = $sumTotal + $Total;
                        $strQty = $_SESSION['strQty'][$i];
//  $strQty = 20;
//  $codeProduct = 'P1234567890';

                        $modelP = Product::find()->where(['code'=> $codeProduct])->one();
                            $Qty =  $modelP->instoke - $strQty;
                            $modelP->instoke = $Qty;
                            $modelP->save();
        
                        $modelP = ReceiptList::find()
                                    ->where(['product_code'=> $codeProduct])
                                    ->andWhere('quantity > 0')
                                    ->orderBy('id')
                                    ->all();
                        
                        foreach ($modelP as $model): 
                            $QLP = 0;
                            
                            if($strQty <> 0){                                
                                $QLP = $model->quantity - $strQty;

                                if($QLP >= 0){
                                    $model->quantity = $model->quantity - $strQty;
                                    $QLP = $strQty;
                                    $model->save();
                                    $strQty = 0;                                    

                                }elseif($QLP < 0){
                                    $strQty = $strQty - $model->quantity ;
                                    $QLP = $model->quantity;
                                    
                                    $model->quantity = 0;
                                    $model->save();
                                }

                                $modelOL = new OrderList();
                                    $modelOL->order_code = $code;
                                    $modelOL->product_code = $codeProduct;
                                    $modelOL->product_unit_id = $model->product_unit_id; 
                                    $modelOL->unit_price = $model->unit_price; 
                                    $modelOL->quantity = $QLP;
                                    $modelOL->create_at = $create_at;
                                    $modelOL->save();
                                
                                $Total = $model->unit_price * $QLP;
                                $sumTotal = $sumTotal + $Total;
                            }
                        endforeach; 
                        
                
                        $modelO = new Order();
                            $modelO->order_code = $code;
                            $modelO->id_user = Yii::$app->user->identity->id;
                            $modelO->status = 1;
                            $modelO->sumtotal = $sumTotal;
                            $modelO->create_at = $create_at;
                            if($modelO->save()){
                                echo '<script type="text/javascript">alert("ok!");</script>';
                            }else{
                                echo '<script type="text/javascript">alert("no save");</script>';
                            }
                    }
                }
            }      

            unset($_SESSION['inLine']);	
            unset($_SESSION['strProductCode']);	
            unset($_SESSION['strQty']);

		} catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }			

        return $this->redirect(['account']); 
    //     return $this->redirect(['checkout']);
    }

    public function actionAccount() {
        $this->layout = 'cart_shop';   
        $user_id = Yii::$app->user->id;
        $model = Order::find()->where(['id_user'=> $user_id])->orderBy(['create_at' => SORT_DESC])->all();
        return $this->render('account',[
            'models' => $model,
    ]); 
    }

    public function actionPrint() {
        $this->layout = 'blank';   
        $user_id = Yii::$app->user->id;
        $model = Order::find()->where(['id_user'=> $user_id])->orderBy(['create_at' => SORT_DESC])->all();
        return $this->render('print',[
            'models' => $model,
    ]); 
    }

    public function actionPdf($id = null)
    {
        $this->layout = 'cart_shop';   
        $user_id = Yii::$app->user->id;
        $model = $this->findModel($id);
        $user_id = Yii::$app->user->id;
        $model_lists = OrderList::find()->where(['order_code'=> $model->order_code])->all();
    
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
    $pdf = new Pdf([
        'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
        'content' => $this->renderPartial('print',['model' => $model,'model_lists' =>$model_lists]),
        'cssFile' => 'css/pdf.css',
        'options' => [
            // any mpdf options you wish to set
        ],
        'methods' => [
            // 'SetTitle' => 'Privacy Policy - Krajee.com',
            // 'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
            // 'SetHeader' => ['Krajee Privacy Policy||Generated On: ' . date("r")],
            // 'SetFooter' => ['|Page {PAGENO}|'],
            // 'SetAuthor' => 'Kartik Visweswaran',
            // 'SetCreator' => 'Kartik Visweswaran',
            // 'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
        ]
    ]);
    return $pdf->render();
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModellist($id)
    {
        if (($model = OrderList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    

}


        