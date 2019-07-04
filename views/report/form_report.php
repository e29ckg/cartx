<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Product;
use app\models\ProductUnit;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
// usage without model
echo '<label>Check Issue Date</label>';
echo DatePicker::widget([
	'name' => 'dp_1',
    'type' => DatePicker::TYPE_INPUT,
    'value' => '23-Feb-1982',
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd-M-yyyy'
    ]
]);
?>

<div class="receiptlist-form">

    <?php $form = ActiveForm::begin([
		'id' => 'report-form',
		
        'enableAjaxValidation' => false,
	]); ?>

    <?php 
    
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'month',
            'data' => [
                '2018-10' => '2018-10',
            '2018-11' => '2018-11',
            '2018-12' => '2018-12',
            '2019-01' => '2019-01',
            ],
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?php echo $form->field($model, 'month')->dropDownList([
        '2018-10' => '2018-10',
        '2018-11' => '2018-11',
        '2018-12' => '2018-12',
        '2019-01' => '2019-01',
        '2019-02' => '2019-02',
        '2019-03' => '2019-03',
        '2019-04' => '2019-04',
        '2019-05' => '2019-05',
        '2019-06' => '2019-06',
        '2019-07' => '2019-07',
        '2019-08' => '2019-08',
        '2019-09' => '2019-09',
        '2019-10' => '2019-10',
        '2019-11' => '2019-11',
        '2019-12' => '2019-12',
        ]);
?> 

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

