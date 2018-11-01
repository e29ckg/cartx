<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Product;
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
                    'delete' => ['POST'],
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
            'defaultPageSize' => 10,
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
        $this->layout = 'cart_shop';
        // $this->layout = 'cart';
        
        
        return $this->render('cart',[
            
        ]);
    }

    public function actionLogin()
    {
        $this->layout = 'cart_shop';
        // $this->layout = 'cart';
        $query = Product::find();

        
        $countAll = Product::getCountAll();

        $modelCatalogs = ProductCatalog::find()->all();

        $pagination = new Pagination([
            'defaultPageSize' => 1,
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

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $filename = $model->photo;

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
                if($filename && is_file($dir.$filename)){
                    unlink($dir.$filename);// ลบ รูปเดิม;                    
                    
                }
                $fileName = md5($f->baseName . time()) . '.' . $f->extension;
                if($f->saveAs($dir . $fileName)){
                    $model->photo = $fileName;
                }
                $model->save();   
                return $this->redirect(['index', 'id' => $filename]);                            
            }
            $model->photo = $filename;
            $model->save();          
            return $this->redirect(['index', 'id' => $filename]);
        }
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update',[
                    'model' => $model,                    
            ]);
        }
        
        return $this->render('update',[
               'model' => $model,                    
        ]); 
        
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = $model->photo;
        $dir = Url::to('@webroot/uploads/contact/');
        
        if($filename && is_file($dir.$filename)){
            unlink($dir.$filename);// ลบ รูปเดิม;                    
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Co::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
}


        