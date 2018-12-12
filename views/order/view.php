<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->order_code;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$model->order_code?> # <?=$model->status?> <small><?=$model->getProfileName()?></small></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>                    
				            <!-- <th>Code</th> -->
				            <th>ProductCode</th>
                    <th>Product</th>
                    <th>Product</th>
                    <th>จำนวน(s)</th>
                    <th>สร้างเมื่อ</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>                  
				<?php foreach ($model_lists as $model_list): ?>				            
					          <!-- <td><?php //echo $model_list->order_code?></td> -->
                    <td><?=$model_list->product_code?></td>
                    <td>
											<div class="project-members">
												<a href="javascript:void(0)">
												<?php if(!empty($model_list->getProductImg())){
													echo Html::img('@web/uploads/product/img/'.$model_list->getProductImg(), ['alt' => 'My pic','class'=>'offline','height'=>'50px']); 
												}else{
													echo Html::img('@web/img/avatars/male.png', ['alt' => 'My pic','class'=>'offline', 'height'=>'50px']); 
												}?>
												</a>
											</div>
										</td>
                    <td><?=$model_list->getProductName()?></td>
                    <td><?=$model_list->quantity?></td>
                    <td><?=$model->create_at?></td>
                  <?php ?>
                    <td>
                    <?php
                    // echo Html::a('<i class="fa fa-remove"></i> ลบ',['order-/delete','id' => $model_list->id],
                    //         [
                    //             'class' => 'btn btn-danger act-update',
                    //             'data-confirm' => 'Are you sure to delete this item?',
                    //             'data-method' => 'post',
                    //         ]);
                        ?>
                    </td>
	                </tr>
				<?php endforeach; ?>
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
 
