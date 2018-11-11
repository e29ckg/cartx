<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Product;
use app\models\Order;
use app\models\OrderList;
use app\models\ProductCatalog;
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

    public function actionAdd_to_cart($id = null) {
        //$this->layout = 'cart_shop'; 
        if (!isset($_SESSION['inLine'])){
            $_SESSION['inLine'] = 0;
            $_SESSION['strProductId'][0] = $id; 
            $_SESSION['strQty'][0] = 1;
            
        } else {
            $key = array_search($id, $_SESSION['strProductId']);
            if((string)$key != ""){
                $_SESSION['strQty'][$key] = $_SESSION['strQty'][$key] + 1;

                $strQty = $_SESSION['strQty'][$key];
                $idProduct = $_SESSION['strProductId'][$key];
                $model = Product::find()->where(['id'=> $idProduct])->one();
                if ($model->instoke > $strQty){
                    $_SESSION['strQty'][$key] = $_SESSION['strQty'][$key] + 1 ;
                }else{
                    $_SESSION['strQty'][$key] = $model->instoke ;
                }   
            }else{
                $_SESSION['inLine'] = $_SESSION['inLine'] + 1;
                $inNewLine =  $_SESSION['inLine'];
                $_SESSION['strProductId'][$inNewLine ] = $id; 
                $_SESSION['strQty'][$inNewLine ] = 1;
            }
            
            
        } 
        
        return $this->renderAjax('cart');
    }

    public function actionDelete($id = null) {
        $this->layout = 'cart_shop'; 
        $_SESSION['strProductId'][$id] = ""; 
        $_SESSION['strQty'][$id] = "";
        return $this->render('cart'); 
        // return $this->renderAjax('cart');
    }

    public function actionQty_up($id = null) {
        $this->layout = 'cart_shop'; 
        $strQty = $_SESSION['strQty'][$id];
        $idProduct=$_SESSION['strProductId'][$id];
        $model = Product::find()->where(['id'=> $idProduct])->one();
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
        $idProduct = $_SESSION['strProductId'][$id];
        $model = Product::find()->where(['id'=> $idProduct])->one();
                
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
        $this->layout = 'cart_shop';    

        $code = date("YmdHis").Yii::$app->security->generateRandomString(4);
        $create_at = date("Y-m-d H:i:s");
        try {
            Yii::$app->db->createCommand()->insert('order', [
                'code' => $code,
                'id_user' => Yii::$app->user->identity->id,
                'status' => 1,
                'create_at' => $create_at,
            ])->execute();

            $Total = 0 ;
            $sumTotal = 0;
							//  $model = Product::find()->all();
			if(isset($_SESSION['inLine'])){
				for($i=0;$i<=(int)$_SESSION['inLine'];$i++){
					if($_SESSION['strProductId'][$i] != ""){
						$idProduct = $_SESSION['strProductId'][$i];
            			$model = Product::find()->where(['id'=> $idProduct])->one();
               					// $ss['strProductId'][$i] =  $_SESSION['inLine'][$i];
						$Total = $_SESSION['strQty'][$i] * $model->price;
                        $sumTotal = $sumTotal + $Total;
                        $strQty = $_SESSION['strQty'][$i];
                        

                        Yii::$app->db->createCommand()->insert('order_list', [
                            'id_order' => $code,
                            'id_product' => $model->id,
                            'quantity' => $strQty,
                            'create_at' => $create_at,
                        ])->execute();

                        $Qty =  $model->instoke - $strQty;
                        Yii::$app->db->createCommand()->update('product', [
                            'instoke' => $Qty 
                        ], 'id = '.$idProduct)->execute();
                        
                    }
                }
            }

            unset($_SESSION['inLine']);	
            unset($_SESSION['strProductId']);	
            unset($_SESSION['strQty']);

		} catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }			

        return $this->redirect(['account']); 
        // return $this->renderAjax('checkout');
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

    public function actionPdf()
    {
        $this->layout = 'cart_shop';   
        $user_id = Yii::$app->user->id;
        $model = Order::find()->where(['id_user'=> $user_id])->orderBy(['create_at' => SORT_DESC])->all();
         
    
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
    $pdf = new Pdf([
        'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
        'content' => $this->renderPartial('account',['models' => $model]),
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

    

}


        