<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Catalogs';
$this->params['breadcrumbs'][] = $this->title;
?>
    <!-- widget grid -->
	<section id="widget-grid" class="">
				
        <!-- row -->
        <div class="row">
            
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            
             	<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1">
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2><?= $this->title;?> </h2>
						<?= Html::a('Create Product Catalog', ['create'], ['class' => 'btn btn-success']) ?>
					</header>
						<!-- widget div-->
					<div>
						<!-- widget edit box -->
						<div class="jarviswidget-editbox">
							<!-- This area used as dropdown edit box -->
						</div>
						<!-- end widget edit box -->
						<!-- widget content -->
						<div class="widget-body no-padding">
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
											<a herf= "#" class="btn btn-warning act-view" data-id=<?=$models['id']?>><i class="fa fa-pencil-square-o"></i> ดู</a>
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
					</div>							
            </article>
        </div>
	</section>



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
    var url_create = "index.php?r=product_catalog/create";
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
