<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptList;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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

    public function actionAdd()
    {
        // $model = ReceiptList::find()->orderBy([
        //     'create_at'=>SORT_ASC,
        //     'id' => SORT_DESC,
        //     ])->limit(200)->all();
        
        //     $countAll = Receipt::getCountAll();
        
        return $this->render('add',[
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

        if (!isset($_SESSION['inLineR'])){
            $_SESSION['inLineR'] = 0;
            $_SESSION['strProductCodeR'][0] = $model->product_code; 
            $_SESSION['strProductUnitPriceR'][0] = $model->unit_price; 
            $_SESSION['strQtyR'][0] = $model->quantity;
            
        } else {
            
                $_SESSION['inLineR'] = $_SESSION['inLineR'] + 1;
                $inNewLine =  $_SESSION['inLineR'];
                $_SESSION['strProductCodeR'][$inNewLine ] = $model->product_code; 
                $_SESSION['strProductUnitPriceR'][$inNewLine] = $model->unit_price; 
                $_SESSION['strQtyR'][$inNewLine ] = $model->quantity;
            }
        
            return $this->redirect(['add', 'id' => $model->id]);
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

    public function actionDelete_list($id = null) {
            $_SESSION['strProductCodeR'][$id] = ""; 
            $_SESSION['strProductUnitPriceR'][$id] = ""; 
            $_SESSION['strQtyR'][$id] = "";
        // return $this->render('add'); 
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('add');
        }else{
            return $this->render('add'); 
        }
    }

    public function actionAdd_conform() {

        // $code = date("YmdHis").Yii::$app->security->generateRandomString(4);
        $code = 'R'.date("YmdHis");
        $create_at = date("Y-m-d H:i:s");
        try {            

            $Total = 0 ;
            $sumTotal = 0;
							
			if(isset($_SESSION['inLineR'])){
				for($i=0;$i<=(int)$_SESSION['inLineR'];$i++){
					if($_SESSION['strProductCodeR'][$i] != ""){
                        $codeProduct = $_SESSION['strProductCodeR'][$i];
                        $UnitPrice = $_SESSION['strProductUnitPriceR'][$i];            			 
               					// $ss['strProductCodeR'][$i] =  $_SESSION['iRnLine'][$i];
						$Total = $_SESSION['strQtyR'][$i] * $UnitPrice;
                        $sumTotal = $sumTotal + $Total;
                        $strQtyR = $_SESSION['strQtyR'][$i];                        

                        Yii::$app->db->createCommand()->insert('receipt_list', [
                            'receipt_code' => $code,
                            'product_code' => $codeProduct,
                            'unit_price' => $UnitPrice,
                            'quantity' => $strQtyR,
                            'create_at' => $create_at,
                        ])->execute();

                        Yii::$app->db->createCommand()->insert('log_st', [
                            'code' => $code,
                            'product_code' => $codeProduct,
                            'unit_price' => $UnitPrice,
                            'quantity' => $strQtyR,
                            'create_at' => $create_at,
                        ])->execute();

                        $model = Product::find()->where(['code'=> $codeProduct])->one();
                        $model->instoke =  $model->instoke + $strQtyR;
                        $model->save();
                        
                    }
                }

                Yii::$app->db->createCommand()->insert('receipt', [
                    'receipt_code' => $code,
                    'user_id' => Yii::$app->user->identity->id,
                    'sumtotal' => $sumTotal,
                    'status' => 1,
                    'create_at' => $create_at,
                ])->execute();

            }            

            unset($_SESSION['inLineR']);	
            unset($_SESSION['strProductCodeR']);	            
            unset($_SESSION['strProductUnitPriceR']);	
            unset($_SESSION['strQtyR']);

            

		} catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }			
        return $this->redirect(['index']);
        // return $this->renderAjax('checkout');
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
