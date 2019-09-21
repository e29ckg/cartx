<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Product;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รับเข้าสต็อก';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
          	<div class="box">
            	<div class="box-header">
              		<h3 class="box-title">ใบรับของ</h3>
			  		<div class="box-tools">                
						<!-- <a href= "index.php?r=receipt/add_list" class="btn btn-warning act-update"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a> -->
						<a href= "#" id="act-create" class="btn btn-warning act-update"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a>
					</div>
           	 	</div>
            	<!-- /.box-header -->
            	<div class="box-body">
              	<table id="receipt-index" class="table table-bordered table-hover">
                	<thead>
                		<tr >
                  			<!-- <th class="text-center">ID</th> -->
				  			<th class="text-center">Img</th>
							<th class="text-center">Product</th>
				  			<th class="text-center">ราคาต่อหน่วย</th>
                  			<th class="text-center">จำนวน</th>
							<th class="text-center">ราคา</th>
                		</tr>
                	</thead>
                	<tbody>
                	<?php
						$Total = 0;		
						$sumTotal = 0;
						if(isset($_SESSION['inLineR'])){
						
						for($i=0;$i<=(int)$_SESSION['inLineR'];$i++){
							if($_SESSION['strProductCodeR'][$i] != ""){
								$productCode = $_SESSION['strProductCodeR'][$i];
								$model = Product::find()->where(['code'=> $productCode])->one();
								// $ss['strProductId'][$i] =  $_SESSION['inLine'][$i];
								$Total = $_SESSION['strQtyR'][$i] * $_SESSION['strProductUnitPriceR'][$i];
								$sumTotal = $sumTotal + $Total;
					?>
						<tr>
							<!-- <td class="text-center"><?=$i?></td>				 -->
							<!-- <td class=""><?=$_SESSION['strProductCodeR'][$i]?></td> -->
							<td class="text-center"><img src="<?=$model->getProductImg($model->img);?>" alt="img-product" width="42px"></td>
							<td><?=$model->product_name;?></td>
							<td class="text-center"><?=number_format($_SESSION['strProductUnitPriceR'][$i],2)?></td>
							<td class="text-center"><?=$_SESSION['strQtyR'][$i].' '.$model->getUnitName()?></td>	
							<td class="text-right"><?=number_format($Total, 2)?></td>				
							<td class="cart_delete">
								<a class="btn btn-warning "  data-id="<?=$i?>" href="<?=Url::to(['receipt/delete_list','id'=>$i])?>" data-confirm = "Are you sure you want to delete this item?"><i class="fa fa-times"></i> ลบ</a>
							</td>
						</tr>						

					<?php }	} } ?>	

					</tbody> 
					<tfoot> 							
						<th colspan="4" class="text-right">ราคารวม : </th>
						<th class="text-right success"><?=number_format($sumTotal, 2)?></th>
						
					</tfoot>
              	</table>
            	</div>
           	 	<!-- /.box-body -->
        	</div>
        	<!-- /.box -->
			<?php if($sumTotal <> 0){?>
			<div>
				
					<!-- <a data-id="" href="<?=Url::to(['receipt/add_conform'])?>" class="btn btn-success"> บันทึก</a> -->
							
			</div>
			<div>
				<?php $form = ActiveForm::begin(['action' => Url::to(['receipt/add_conform'])]); ?>
				<?php echo $form->field($modelR, 'receipt_from', [
					'options' => ['class' => '']])
					->widget(Select2::classname(), [
						'data' => $modelR->getSellerName(), 
						'options' => ['placeholder' => 'select ...'], 
						'pluginOptions' => ['allowClear' => true]
						]);?>
						<div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
				<?php ActiveForm::end(); ?>
			</div>
			<?php } ?>	
			

    	</div>
    	<!-- /.col -->
			
	</div>
    <!-- /.row -->
</section>
<!-- /.content -->


<?php
$script = <<< JS
$(document).ready(function() {	

$( "#act-create" ).click(function() {    
	// alert(123);
    var url_create = "add_list";
        $.get(url_create,function (data){
            $("#activity-modal").find(".modal-body").html(data);
            $(".modal-body").html(data);
            $(".modal-title").html("เพิ่มข้อมูล");
            // $(".modal-footer").html(footer);
            $("#activity-modal").modal("show");
            //   $("#myModal").modal('toggle');
        });     
	}); 

});
JS;
$this->registerJs($script);
?>
