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
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('product_name').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>
</div>

<div class="row">

    

    
<div>

<?= $form->field($model, 'category',[
    'template' => '<section><label class="select">{label}{input}</label><i class="icon-append fa fa-user"></i></label><em for="dep" class="invalid">{error}{hint}</em></section>'
    ])->dropDownList($model->getCatalogList(),['prompt'=> $model->getAttributeLabel('category')])->label(false);?>




<div>
<?= $form->field($model, 'unit',[
    'template' => '<section><label class="select">{label}{input}</label><i class="icon-append fa fa-user"></i></label><em for="dep" class="invalid">{error}{hint}</em></section>'
    ])->dropDownList($model->getUnitList(),['prompt'=> $model->getAttributeLabel('unit')])->label(false);?>
</div>


    <?= $form->field($model, 'Description', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('Description')
    ],
    'template' => '<section><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('Description').'</b></label><em for="email" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>

   
    <?= $form->field($model, 'location', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('location')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('location').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>

    <?= $form->field($model, 'price', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('price')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('price').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>

    <?= $form->field($model, 'status',[
    'template' => '<section><label class="select">{label}{input}</label><i class="icon-append fa fa-user"></i></label><em for="dep" class="invalid">{error}{hint}</em></section>'
    ])->dropDownList(['1' => '1'],['prompt'=> $model->getAttributeLabel('status')])->label(false);?>


    <?= $form->field($model, 'lower', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('lower')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('lower').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>
    
    <?= $form->field($model, 'instoke', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('instoke')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('instoke').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>

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
    $filename = Url::to('@webroot/uploads/product/img/').$model->img;
    if (file_exists($filename)) {
        //echo Url::to('@web/uploads/contact/').$model->img;
        echo Html::img('@web/uploads/product/img/'.$model->img, ['alt' => 'My pic','class'=>'img-thumbnail']);
        // unlink($filename);
    }
    
}
?>
</fieldset> 
<?= $form->field($model, 'code')->hiddenInput(['value'=>Yii::$app->security->generateRandomString(10)])->label(false);?>
    <footer>
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </footer>

    <?php ActiveForm::end(); ?>

</div>
