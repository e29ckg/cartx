<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ProductCatalog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-catalog-form">

    <?php 
    $form = ActiveForm::begin([
		'id' => 'product-form',
		
        // 'enableAjaxValidation' => true,
    ]);  ?>
    
    <?= $form->field($model, 'name_catalog')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput(['maxlength' => true]) ?>

    

        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  

    <?php ActiveForm::end(); ?>

</div>
