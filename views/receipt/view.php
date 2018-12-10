<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id.' # '.$model->receipt_code;
$this->params['breadcrumbs'][] = ['label' => 'Receipt', 'url' => ['index']];
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
              <table id="receipt-index" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
				          <th>Code</th>
				          <th>Product</th>
                  <th>ราคาต่อหน่วย</th>
                  <th>จำนวน</th>
                  <th>เครื่องมือ</th>
                </tr>
                </thead>
                <tbody>                  
				<?php foreach ($model_lists as $model_list): ?>
                    <tr>
                        <td><?=$model_list->id?></td>
                        <td><?=$model_list->receipt_code?></td>
                        <td><?=$model_list->product_code?></td>
                        <td><?=$model_list->unit_price?></td>
                        <td><?=$model_list->quantity?></td>                        
                  	    <td><a herf= "#" class="btn btn-warning act-update" data-id=<?=$model->id?>><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
						    <a herf= "#" class="btn btn-warning act-view" data-id=<?=$model->id?>><i class="fa fa-pencil-square-o"></i> ดู</a>
						    <?= Html::a('<i class="fa fa-remove"></i> ลบ',['product/delete','id' => $model->id],
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

