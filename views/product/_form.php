<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ProductUnit;
use app\models\ProductCatalog;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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

    <?php 
    $form = ActiveForm::begin([
		'id' => 'product-form',
		'options' => [
            'class' => 'smart-form',
            'novalidate'=>'novalidate',
            'enctype' => 'multipart/form-data'
        ],
        //'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}{input}{error}",
            'labelOptions' => ['class' => 'label'],
        ],
        'enableAjaxValidation' => true,
	]);  ?>

<fieldset>     
<div class="row">
    <?= $form->field($model, 'product_name', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('product_name')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">กรอกชื่อ</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>
</div>

<div class="row">

    

    
<div>

<?= $form->field($model, 'category',[
    'template' => '<section><label class="select">{label}{input}</label><i class="icon-append fa fa-user"></i></label><em for="dep" class="invalid">{error}{hint}</em></section>'
    ])->dropDownList($catalogList,['prompt'=> $model->getAttributeLabel('category')])->label(false);?>




<div>
<?= $form->field($model, 'unit',[
    'template' => '<section><label class="select">{label}{input}</label><i class="icon-append fa fa-user"></i></label><em for="dep" class="invalid">{error}{hint}</em></section>'
    ])->dropDownList($unitList,['prompt'=> $model->getAttributeLabel('unit')])->label(false);?>
</div>

<div class="row">
    <?= $form->field($model, 'Description', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('Description')
    ],
    'template' => '<section><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">กรอกที่อยู่</b></label><em for="email" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>
</div>
    <div class="row">
    <?= $form->field($model, 'location', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('location')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">กรอกชื่อ</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>
</div>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(
			['1'=>'1',2=>'2',3=>3,4=>4,5=>5],
			['prompt'=>'Select']
			);
?>

    <?= $form->field($model, 'lower')->textInput() ?>

    <?= $form->field($model, 'instoke')->textInput() ?>

    <?= $form->field($model, 'create_at')->hiddenInput()->label(false); ?>
    
<div>
<?= $form->field($model, 'img',[
   'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('img'),
        'onchange'=>'this.parentNode.nextSibling.value = this.value'
    ],
    'template' => '<section><label class="label">{label}</label><div class="input input-file"><span class="button">{input}Browse</span><input type="text" placeholder="Include some files" readonly=""><div class="invalid">{error}{hint}</div></div></section>'
])->fileInput() ?>
</div>
<?php 
if (!empty($model->img)){
    $filename = Url::to('@webroot/uploads/contact/').$model->img;
    if (file_exists($filename)) {
        //echo Url::to('@web/uploads/contact/').$model->img;
        echo Html::img('@web/uploads/contact/'.$model->img, ['alt' => 'My pic','class'=>'img-thumbnail']);
        // unlink($filename);
    }
    
}
?>
</fieldset> 
<?= $form->field($model, 'code')->hiddenInput(['value'=>Yii::$app->security->generateRandomString(10)])->label(false);?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
