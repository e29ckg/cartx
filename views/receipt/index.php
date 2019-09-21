<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบรับของเข้าสต๊อก';
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
            <a href= "<?=Url::to(['receipt/add'])?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> เพิ่มวัสดุเข้าสต๊อก</a>
					</div>	  
        </div>
            <!-- /.box-header -->
        <div class="box-body">
          <table id="receipt-index" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Code</th>
                <th>ผู้ขาย/ร้านค้า/บริษัท</th>
                <th>ผู้นำเข้าระบบ</th>
                <th>ราคารวม</th>
                <!-- <th>สถานะ(s)</th> -->
                <!-- <th>วัน-เวลา</th> -->
                <th>เครื่องมือ</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($models as $model): ?>
              <tr>
                <td style="text-align:center"><?=$model->id?></td>
                <td>
                  <a href= "#" class="act-view" data-id='<?=$model->id?>'><?=$model->receipt_code?></a>
                  <br><?=$model->DateThai_full($model->create_at)?>
                </td>
                <td>
                  <?= $model->receipt_from ? $model->seller->name : '-'?>
                  <br><a href="#" data-id ="<?=$model->id?>" class="btn btn-warning btn-xs act-update-seller">แก้ไข</a>
                </td>
                <td><?=$model->getProfileName()?></td>
                <td style="text-align:right"><?=number_format($model->sumtotal, 2)?></td>
                <!-- <td><label class="label <?= $model->status == 4 ? 'label-danger' : 'label-info'?>"><?=$model->getStatus()[$model->status]?></label></td> -->
                <!-- <td><?=$model->create_at?></td> -->
                <td>
                <?= $model->status == 4 ?
                  '<label class="label label-danger">'.$model->getStatus()[$model->status].'</label>'
                  :
                  '<a href="'.Url::to(['receipt/print','id'=>$model->id]).'" target="_blank" class="btn btn-info btn-xs">พิมพ์ใบนำเข้า</a>
                  <a href= "'.Url::to(['receipt/update_list_cancel','id'=>$model->id]).'" class="btn btn-warning  btn-xs" data-confirm="Are you sure this item?"> <i class="fa fa-pencil-square-o"></i> ยกเลิก</a>
                ' ;?>
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

      var url_update_s = "update_seller";
    	$(".act-update-seller").click(function(e) {            
			var fID = $(this).data("id");
			// alert(fID);
        	$.get(url_update_s,{id: fID},function (data){
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
	$('#receipt-index').DataTable({
    "order": [[ 0, 'desc' ]]
  });

	// $('#activity-modal').on('hidden.bs.modal', function () {
 	// 	location.reload();
	// })
	
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
       