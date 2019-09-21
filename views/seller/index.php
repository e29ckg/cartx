<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'ผู้ขาย';
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
                
					<a href= "#" id="act-create" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="product-index" class="table table-bordered table-hover">
                <thead>
                	<tr>
						<th data-class="expand">Id</th>
						<th data-hide="phone">ชื่อ</th>
						<th data-hide="phone">ที่อยู่</th>
						<th data-hide="phone">เบอร์โทรศัพท์</th>
					    <th>เครื่องมือ</th>
                	</tr>
                </thead>
                <tbody>
				<?php foreach ($models as $model): ?>
					<tr>
						<td><?=$model->id?></td>
						<td><?=$model->name?></td>
						<td><?=$model->address?></td>
						<td><?=$model->phone?></td>
						<td>
							<a herf= "#" class="btn btn-warning act-update" data-id=<?=$model->id?>><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
							<!-- <a herf= "#" class="btn btn-warning act-view" data-id=<?=$model->id?>><i class="fa fa-pencil-square-o"></i> ดู</a> -->
							<?php
							echo Html::a('<i class="fa fa-remove"></i> ลบ',['seller/delete','id' => $model->id],
									[
										'class' => 'btn btn-danger',
										'data-confirm' => 'Are you sure to delete this item?',
										'data-method' => 'post',
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