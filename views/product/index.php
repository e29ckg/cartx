<?php

use yii\helpers\Html;
//  use yii\grid\GridView;
use app\model\Product;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
// var_dump();
?>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">			
              <h3 class="box-title"><?=$this->title?></h3>
			  <div class="box-tools">
                
					<a href= "#" id="act-create" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="product-index" class="table table-bordered table-hover">
                <thead>
                	<tr>
						<th data-class="expand">Id</th>
						<th>Image</th>
						<!-- <th data-hide="phone">Code</th> -->
						<th data-hide="phone">ชื่อวัสดุ</th>
						<th data-hide="phone">ประเภท</th>
						<th data-hide="phone">ประเภท</th>
						<th data-hide="phone,tablet">InStock</th>
					    <th>เครื่องมือ</th>
                	</tr>
                </thead>
                <tbody>
				<?php foreach ($models as $model): ?>
					<tr>
						<td><?=$model['id']?></td>
						<td>
							<div class="project-members">
								<a href="javascript:void(0)">
								<?php if(!empty($model['img'])){
									echo Html::img('@web/uploads/product/img/'.$model['img'], ['alt' => 'My pic','class'=>'offline act-view','height'=>'50px','data-id'=> $model->code]); 
								}else{
									echo Html::img('@web/img/none.png', ['alt' => 'My pic','class'=>'offline act-view', 'height'=>'50px', 'data-id'=> $model->code]); 
								}?>
								</a>
							</div>
						</td>
						<!-- <td><?=$model->code?>  -->
							<!-- <a href= "index.php?r=product/gencode&id=<?=$model['id']?>" class="btn btn-warning btn-xs" data-id=<?=$model['id']?>><i class="fa fa-pencil-square-o"></i> GenCode</a> -->
						</td>
						<td>
							<?=$model['product_name']?>
							<label class="label <?= $model->status == 1 ? 'label-info' : 'label-danger'?>"><?=$model->getStatusName($model->status)?></label>
						</td>
						<td><?=$model->getCatalogtName()?></td>
						<td><?=$model->create_at?></td>
						<td><?=$model['instoke']?> <?=$model->getUnitName()?></td>
						<td>
							<a herf= "#" class="btn btn-warning btn-xs act-update" data-id=<?=$model['id']?>><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
							<a href= "<?=Url::to(['view','codeProduct'=>$model->code])?>" target="_blank" class="btn btn-info btn-xs" data-id=<?=$model->id?>><i class="fa fa-print"></i> Print </a>
							<?php
							// echo Html::a('<i class="fa fa-remove"></i> ลบ',['product/delete','id' => $model->id],
							// 		[
							// 			'class' => 'btn btn-danger act-update',
							// 			'data-confirm' => 'Are you sure to delete this item?',
							// 			'data-method' => 'post',
							// 		]);
							?>
						</td>
					</tr>
					<?php  endforeach; ?>
				
				</tbody>
                <!-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->





<?php
$script = <<< JS

	var url_update = "update";
    	$(".act-update").click(function(e) {            
			var fID = $(this).data("id");
			// alert(fID);
        	$.get(url_update,{id: fID},function (data){
            	$("#activity-modal").find(".modal-body").html(data);
            	$(".modal-body").html(data);
            	$(".modal-title").html("แก้ไขข้อมูลสมาชิก");
            	$("#activity-modal").modal("show");
        	});
    	});

	var url_view = "view";		
    	$(".act-view").click(function(e) {					
                var fID = $(this).data("id");
				// alert(fID);
                $.get(url_view,{codeProduct: fID},function (data){
                        $("#activity-modal").find(".modal-body").html(data);
                        $(".modal-body").html(data);
                        $(".modal-title").html("ข้อมูล");
                        $("#activity-modal").modal("show");
                    }
                );
            });  
			   
    var url_create = "create";
	$( "#act-create" ).click(function() { 
        $.get(url_create,function (data){
            $("#activity-modal").find(".modal-body").html(data);
            $(".modal-body").html(data);
            $(".modal-title").html("เพิ่มข้อมูล");
            // $(".modal-footer").html(footer);
            $("#activity-modal").modal("show");
            //   $("#myModal").modal('toggle');
        });     
	}); 
    
     
$(document).ready(function() {	
/* BASIC ;*/	
$('#product-index').DataTable({
	// lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
	"order": [[ 0, "desc" ]]
});

	// $('#activity-modal').on('hidden.bs.modal', function () {
 	// 	location.reload();
	// })

			

 
		
});
JS;
$this->registerJs($script);
?>
       