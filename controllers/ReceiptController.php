<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptList;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class ReceiptController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Receipt::find()->orderBy([
            'create_at'=>SORT_ASC,
            'id' => SORT_DESC,
            ])->limit(200)->all();
        
            $countAll = Receipt::getCountAll();
        
        return $this->render('index',[
            'models' => $model,
            'countAll' => $countAll,
            //'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex_add()
    {
        // $model = ReceiptList::find()->orderBy([
        //     'create_at'=>SORT_ASC,
        //     'id' => SORT_DESC,
        //     ])->limit(200)->all();
        
        //     $countAll = Receipt::getCountAll();
        
        return $this->render('index_add',[
            // 'models' => $model,
            // 'countAll' => $countAll,
            //'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd_list()
    {
        $model = new ReceiptList();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->create_at = date("Y-m-d H:i:s");

            // $model->save();
            //$this->layout = 'cart_shop'; 

        if (!isset($_SESSION['inLineR'])){
            $_SESSION['inLineR'] = 0;
            $_SESSION['strProductCode'][0] = $model->product_code; 
            $_SESSION['strProductUnitPrice'][0] = $model->unit_price; 
            $_SESSION['strQty'][0] = $model->quantity;
            
        } else {
            
                $_SESSION['inLineR'] = $_SESSION['inLineR'] + 1;
                $inNewLine =  $_SESSION['inLineR'];
                $_SESSION['strProductCode'][$inNewLine ] = $model->product_code; 
                $_SESSION['strProductUnitPrice'][$inNewLine] = $model->unit_price; 
                $_SESSION['strQty'][$inNewLine ] = 1;
            }
        
            return $this->redirect(['index_add', 'id' => $model->id]);
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form_list',[
                    'model' => $model,                    
            ]);
        }else{
            return $this->render('_form_list',[
                'model' => $model,                    
            ]); 
        }
    }
    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model_lists = ReceiptList::find()->where(['receipt_code'=> $model->receipt_code])->all();
        
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view',[
                'model' => $model,
                'model_lists' => $model_lists,                  
            ]);
        }
        return $this->render('view', [
            'model' => $model,
            'model_lists' => $model_lists,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->create_at = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Receipt::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
