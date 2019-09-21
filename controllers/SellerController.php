<?php

namespace app\controllers;
use Yii;
use app\models\Seller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class SellerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Seller::find()->all();
        return $this->render('index',[
            'models' => $models
        ]);
    }

    public function actionCreate()
    {
        $model = new Seller();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                $model->save();

                return $this->redirect(['index']);
            }
        }  
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form',[
                    'model' => $model,                    
            ]);
        }
        
        return $this->render('_form',[
               'model' => $model,                    
        ]);  

    }
    public function actionUpdate($id)
    {
        $model = Seller::findOne($id);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                $model->save();

                return $this->redirect(['index']);
            }
        }  
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form',[
                    'model' => $model,                    
            ]);
        }
        
        return $this->render('_form',[
               'model' => $model,                    
        ]);  
    }
    public function actionDelete($id)
    {
        $model = Seller::findOne($id);
        $model->delete();        
        
        return $this->redirect(['index']);  
    }
}
