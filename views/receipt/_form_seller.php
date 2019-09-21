<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'receipt_from', [
					'options' => ['class' => '']])
					->widget(Select2::classname(), [
						'data' => $model->getSellerName(), 
						'options' => ['placeholder' => 'select ...'], 
						'pluginOptions' => ['allowClear' => true]
						]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
