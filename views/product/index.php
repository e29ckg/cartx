<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
// var_dump();
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
        <div class="text-right"><button id="act-create" class="btn btn-success btn-md" alt="act-create"><i class="fa fa-plus "></i> act-create</button></div>
		    
    </p>    
</div>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
			<?= $this->title;?>
			<span></span>
		</h1>
	</div>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
		<ul id="sparks" class="">
			<li class="sparks-info">
				<h5> ข้อมูลทั้งหมด <span class="txt-color-blue"><i class="fa fa-user" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;<?= $countAll?></span></h5>
				<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm"></div>
			</li>
			<li class="sparks-info">
				<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
					<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm"></div>
			</li>
			<li class="sparks-info">
				<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
					<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm"></div>
			</li>
		</ul>
	</div>
</div>
<div>
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
					                    <th>Image</th>
					                    <th data-hide="phone">ชื่อวัสดุ</th>
					                    <th data-hide="phone">ประเภท</th>
					                    <th data-hide="phone,tablet">InStock</th>
					                    <th data-hide="phone,tablet">เครื่องมือ</th>
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
								        <td><?=$models['product_name']?></td>
								        <td><?=$models->getCatalogtName()?></td>
								        <td><?=$models['instoke']?> <?=$models->getUnitName()?></td>
								        <td>
											<a herf= "#" class="btn btn-warning act-update" data-id=<?=$models['id']?>><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
											<a herf= "#" class="btn btn-warning act-view" data-id=<?=$models['id']?>><i class="fa fa-pencil-square-o"></i> ดู</a>
											<?= Html::a('<i class="fa fa-remove"></i> ลบ',['co/delete','id' => $models->id],
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
</div>



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

     
$(document).ready(function() {	
/* BASIC ;*/	
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
       