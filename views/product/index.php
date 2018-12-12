<?php

use yii\helpers\Html;
//  use yii\grid\GridView;
use app\models\Product;
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
						<th data-hide="phone">Code</th>
						<th data-hide="phone">ชื่อวัสดุ</th>
						<th data-hide="phone">ประเภท</th>
						<th data-hide="phone,tablet">InStock</th>
					    <th>เครื่องมือ</th>
                	</tr>
                </thead>
                <tbody>
				<?php foreach ($models as $models): ?>
						            <tr>
						                <td><?=$models['id']?></td>
						                <td>
											<div class="project-members">
												<a href="javascript:void(0)">
												<?php if(!empty($models['img'])){
													echo Html::img('@web/uploads/product/img/'.$models['img'], ['alt' => 'My pic','class'=>'offline']); 
												}else{
													echo Html::img('@web/img/avatars/male.png', ['alt' => 'My pic','class'=>'offline']); 
												}?>
											</div>
										</td>
										<td><?=$models->code?></td>
								        <td><?=$models['product_name']?></td>
								        <td><?=$models->getCatalogtName()?></td>
								        <td><?=$models['instoke']?> <?=$models->getUnitName()?></td>
								        <td>
											<a herf= "#" class="btn btn-warning act-update" data-id=<?=$models['id']?>><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
											<!-- <a herf= "#" class="btn btn-warning act-view" data-id=<?=$models->id?>><i class="fa fa-pencil-square-o"></i> ดู</a> -->
											<?php
											// echo Html::a('<i class="fa fa-remove"></i> ลบ',['product/delete','id' => $models->id],
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


	var url_update = "index.php?r=product/update";
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

	var url_view = "index.php?r=product/view";		
    	$(".act-view").click(function(e) {	
				
                var fID = $(this).data("id");
				alert(fID);
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
$('#product-index').DataTable();

	$('#activity-modal').on('hidden.bs.modal', function () {
 		location.reload();
	})

				var responsiveHelper_dt_basic = undefined;
				var responsiveHelper_datatable_fixed_column = undefined;
				var responsiveHelper_datatable_col_reorder = undefined;
				var responsiveHelper_datatable_tabletools = undefined;
				
				var breakpointDefinition = {
					tablet : 1024,
					phone : 480
				};	
				
			/* COLUMN FILTER  */
		    var otable = $('#datatable_fixed_column').DataTable({
		    	//"bFilter": false,
		    	//"bInfo": false,
		    	//"bLengthChange": false
		    	//"bAutoWidth": false,
		    	//"bPaginate": false,
		    	//"bStateSave": true // saves sort state using localStorage
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 'f><'col-sm-6 col-xs-12 '<'toolbar'>>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_fixed_column) {
						responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					// responsiveHelper_datatable_fixed_column.respond();
				}		
			
		    });
		    
		    // custom toolbar
		    $("div.toolbar").html('<div class="text-right"><button id="act-create" class="btn btn-success btn-md" alt="act-create"><i class="fa fa-plus "></i> act-create</button></div>');
		    	   
		    // Apply the filter
		    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
		    	
		        otable
		            .column( $(this).parent().index()+':visible' )
		            .search( this.value )
		            .draw();
		            
		    } );

			otable.order( [[ 0, 'desc' ], [ 2, 'asc' ]] ).draw();

/* END COLUMN FILTER */  


$( "#act-create" ).click(function() {    
    var url_create = "index.php?r=product/create";
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
       