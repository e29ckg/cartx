<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

//var_dump($catalogList);
?>

<div class="product-form">

    <?php 
    $form = ActiveForm::begin([
		'id' => 'product-form',
		'options' => [
            // 'class' => 'smart-form',
            'novalidate'=>'novalidate',
            'enctype' => 'multipart/form-data'
        ],
        //'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}{input}{error}",
            // 'labelOptions' => ['class' => 'label'],
        ],
        // 'enableAjaxValidation' => true,
	]);  ?>

<fieldset>     

<?= $form->field($model, 'product_name')->textInput()->hint('ass')->label();?>

<?= $form->field($model, 'category')->dropDownList($model->getCatalogList(),['prompt'=> $model->getAttributeLabel('category')])->label();?>

<?= $form->field($model, 'unit')->dropDownList($model->getUnitList(),['prompt'=> $model->getAttributeLabel('unit')])->label();?>

<?= $form->field($model, 'Description')->label();?>

<?= $form->field($model, 'location')->label();?>

<?= $form->field($model, 'status')->dropDownList(['1' => '1'],['prompt'=> $model->getAttributeLabel('status')])->label();?>

<?= $form->field($model, 'lower')->label();?>
    
<?= $form->field($model, 'create_at')->hiddenInput()->label(false); ?>
    
<div>
<?= $form->field($model, 'img')->fileInput() ?>
</div>
<?php 
if (!empty($model->img)){
    $filename = Url::to('@webroot/uploads/product/img/').$model->img;
    if (file_exists($filename)) {
        //echo Url::to('@web/uploads/contact/').$model->img;
        echo Html::img('@web/uploads/product/img/'.$model->img, ['alt' => 'My pic','class'=>'img-thumbnail']);
        // unlink($filename);
    }
    
}
?>
</fieldset> 
    <footer>
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </footer>

    <?php ActiveForm::end(); ?>

</div>
