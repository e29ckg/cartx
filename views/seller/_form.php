<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Seller */
/* @var $form ActiveForm */
?>
<div class="seller-create">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    
<div class="row">
	<div class ="col-md-12">		
 <!-- Default box -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">เพิ่มข้อมูล <?=$model->getAttributeLabel('name')?></h3>
				<div class="box-tools pull-right">
					<!-- <button id="act-create-b" class="btn btn-primary btn-md" alt="act-create"><i class="fa fa-plus "></i> เพิ่ม<button> --> 
				</div>			
			</div>
			<div class="box-body">
				<div class="row">									
					<div class ="col-md-12">
					<?= $form->field($model, 'name',[
						'inputOptions' => [
							'class' => 'form-control',
							'placeholder' => $model->getAttributeLabel('name')
						],])->textInput(['maxlength' => true]) ?>
					</div>													
				</div>
                <div class="row">									
					<div class ="col-md-8">
					<?= $form->field($model, 'address',[
						'inputOptions' => [
							'class' => 'form-control',
							'placeholder' => $model->getAttributeLabel('address')
						],])->textInput(['maxlength' => true]) ?>
					</div>													
													
					<div class ="col-md-4">
					<?= $form->field($model, 'phone',[
						'inputOptions' => [
							'class' => 'form-control',
							'placeholder' => $model->getAttributeLabel('phone')
						],])->textInput(['maxlength' => true]) ?>
					</div>													
				</div>
				
			</div>
			<!-- box-boby -->
			
		</div>
	</div>
	
</div>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- seller-create -->
