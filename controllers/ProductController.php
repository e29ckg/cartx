<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductUnit;
use app\models\ProductCatalog;
use app\models\ReceiptList;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Product::find()->orderBy([
            'create_at'=>SORT_ASC,
            'id' => SORT_DESC,
            ])->limit(200)->all();
        
            $countAll = Product::getCountAll();
        
        return $this->render('index',[
            'models' => $model,
            'countAll' => $countAll,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();    
        
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          } 

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $f = UploadedFile::getInstance($model, 'img');
            if(!empty($f)){
                $dir = Url::to('@webroot/uploads/product/img/');
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
                $fileName = md5($f->baseName . time()) . '.' . $f->extension;
                if($f->saveAs($dir . $fileName)){
                    $model->img = $fileName;
                }               
            } 
            if($model->status == ''){
                $model->status = 1;
            }
            if($model->lower == ''){
                $model->lower = 1;
            }
            $model->create_at = date("Y-m-d H:i:s"); 
            $model->code = 'P'.date("YmdHis");
            if($model->save()){
               return $this->redirect(['index']);
            }   
        }

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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $filename = $model->img;

        //Add This For Ajax Email Exist Validation 
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $f = UploadedFile::getInstance($model, 'img');

            if(!empty($f)){
                
                $dir = Url::to('@webroot/uploads/product/img/');
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }                
                if($filename && is_file($dir.$filename)){
                    unlink($dir.$filename);// ลบ รูปเดิม;                    
                    
                }
                $fileName = md5($f->baseName . time()) . '.' . $f->extension;
                if($f->saveAs($dir . $fileName)){
                    $model->img = $fileName;
                }
                $model->save();   
                return $this->redirect(['index', 'id' => $filename]);                            
            }
            $model->img = $filename;
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
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = $model->img;
        $dir = Url::to('@webroot/uploads/product/img/');
        
        if($filename && is_file($dir.$filename)){
            unlink($dir.$filename);// ลบ รูปเดิม;                    
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdatestroke()
    {
        $modelsProduct = Product::find()->All();
        $modelsRL = ReceiptList::find()->All();
        // $a = var_dump($models);
        foreach ($modelsProduct as $modelProduct):
            $totalSum = 0 ;
            $modelsRL = ReceiptList::find()->where('quantity >= 1')
                        ->andWhere(['product_code' => $modelProduct->code])
                        ->All();
            foreach ($modelsRL as $modelRL):
                
                $totalSum = $totalSum + $modelRL->quantity ;

            endforeach; 
            $modelProduct->instoke =  $totalSum ;
            $modelProduct->save() ;
            // echo $modelProduct->code." ".$totalSum."<br>";
            
        endforeach; 
    }

    public function actionAdd_to_stroke()
    {
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
}

 