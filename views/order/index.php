<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$this->title?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
				  <th>Code</th>
				  <th>ผู้เบิก</th>
				  <td>ราคารวม</td>
                  <th>สถานะ(s)</th>
                  <!-- <th>วัน-เวลา</th> -->
                  <th>เครื่องมือ</th>
                </tr>
                </thead>
                <tbody>
                <tr>                  
				<?php foreach ($models as $model): ?>
				<td><?=$model->id?></td>
					<td>
            <a href= "#" class="act-view" data-id='<?=$model->id?>'><?=$model->order_code?></a>
            <br><?=$model->DateThai_full($model->create_at)?>
          </td>
                  	<td><?=$model->getProfileName()?></td>
                  	<td style="text-align:right"><?=number_format($model->sumtotal, 2)?></td>
					          <td>
                      <label class="label <?= $model->status == 4 ? 'label-danger' : 'label-info'?>">
                        <?= isset($model->status) ? $model->getStatus()[$model->status] : '';?>
                      </label>
                    </td>
                  	<!-- <td><?=$model->create_at?></td> -->
                  	<td>
					  	<a href="<?=Url::to(['order/print','id'=>$model->id])?>" class ="btn btn-info btn-xs" target="_blank">พิมพ์ใบเบิก</a>
						<?php
							echo Html::a('<i class="fa fa-remove "></i> ยกเลิกใบเบิก',[
								'order/cancel','id' => $model->id],
								[
									'class' => 'btn btn-danger  btn-xs',									
									'data-confirm' => 'Are you sure to ยกเลิก this item?',
                        			// 'data-method' => 'post',
								]);
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
// alert('ddd');
$('#eg8').click(function() {
		
        $.smallBox({
			title : "James Simmons liked your comment",
			content : "<i class='fa fa-clock-o'></i> <i>2 seconds ago...</i>",
            color : "#296191",
            iconSmall : "fa fa-thumbs-up bounce animated",
            timeout : 4000
        });

    });

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
                $.get(url_view,{id: fID},function (data){
                        $("#activity-modal").find(".modal-body").html(data);
                        $(".modal-body").html(data);
                        $(".modal-title").html("ข้อมูล");
                        $("#activity-modal").modal("show");
                    }
                );
            });   
    
     
$(document).ready(function() {	
/* BASIC ;*/	
$('#example').DataTable({
    "order": [[ 0, 'desc' ]]
});

	// $('#activity-modal').on('hidden.bs.modal', function () {
 	// 	location.reload();
	// })

			
$( "#act-create" ).click(function() {    
    var url_create = "order/create";
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
       