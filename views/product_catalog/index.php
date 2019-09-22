<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Catalogs';
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$this->title?></h3>
			  <div class="box-tools">
                
					<a href= "#" id="act-create" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
					                    <th data-class="expand">Id</th>
					                    <th data-hide="phone">ชื่อวัสดุ</th>
					                    <th data-hide="phone,tablet">เครื่องมือ</th>
						            </tr>
								</thead>
								<tbody>
									<?php foreach ($models as $models): ?>
						            <tr>
						                <td><?=$models['id']?></td>
								        <td><?=$models['name_catalog']?></td>
								        <td>
											<a herf= "#" class="btn btn-warning act-update" data-id=<?=$models['id']?>><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
											<!-- <a herf= "#" class="btn btn-warning act-view" data-id=<?=$models['id']?>><i class="fa fa-pencil-square-o"></i> ดู</a> -->
											<?= Html::a('<i class="fa fa-remove"></i> ลบ',['product_catalog/delete','id' => $models->id],
													[
														'class' => 'btn btn-danger act-update',
														'data-confirm' => 'Are you sure to delete this item?',
                                    					'data-method' => 'post',
													]);
											?>
										</td>
									</tr>
									<?php  endforeach; ?>
								</tbody>	
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
	
	$('#activity-modal').on('hidden.bs.modal', function () {
 		location.reload();
	})
			
		$('#datatable_fixed_column').DataTable();		    


$( "#act-create" ).click(function() {    
    var url_create = "create";
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
