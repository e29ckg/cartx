<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ProductUnit;
use app\models\ProductCatalog;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

$model_unit = ProductUnit::find()->select('id, name_unit')->all();        
        $unitList=ArrayHelper::map($model_unit,'id','name_unit');

        $model_Catalog = ProductCatalog::find()->select('id, name_catalog')->orderBy('id')->all();
        $catalogList=ArrayHelper::map($model_Catalog,'id','name_catalog');

//var_dump($catalogList);
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList(
			$catalogList,
			['prompt'=>'Select']
			);
?>
<?= $form->field($model, 'unit')->dropDownList(
			$unitList,
			['prompt'=>'Select']
			);
?>

    <?= $form->field($model, 'Description')->textarea(array('rows'=>3,'cols'=>5)); ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList(
			['1'=>'1',2=>'2',3=>3,4=>4,5=>5],
			['prompt'=>'Select']
			);
?>

    <?= $form->field($model, 'lower')->textInput() ?>

    <?= $form->field($model, 'instoke')->textInput() ?>

    <?= $form->field($model, 'create_at')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
