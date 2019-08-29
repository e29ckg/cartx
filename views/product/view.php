<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ReceiptList;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $modelsP['product_name'];
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
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
                
					<!-- <a href= "#" id="act-create" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a> -->

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="product-index" class="table table-bordered table-hover">
                <thead>
                	<tr>
						<!-- <th data-class="expand">Id</th> -->
						<th data-hide="phone">DateTime</th>
						<th data-hide="phone">รับจาก / จ่ายให้</th>
						<th data-hide="phone">เลขที่เอกสาร</th>
            <th data-hide="phone,tablet">ราคาต่อหน่วย</th>
            <th data-hide="phone,tablet">จำนวนรับ</th>
            <th data-hide="phone,tablet">จำนวนจ่าย</th>
            <th data-hide="phone,tablet">คงเหลือ</th>
						<th data-hide="phone">หมายเหตุ</th>
						      </tr>
                </thead>
                <tbody>
                <?php 
                    $total = 0;
                    $sumtotal = 0;
                ?>
				<?php foreach ($modelsLST as $model): 
            //   $modelsRL = ReceiptList::findOne($model->receipt_list_id);
            // if($modelsRL['quantity'] <> 0){
            ?>
						<tr>
						    <!-- <td><?=$model['id']?></td> -->
                <td><?=$model->create_at?></td>
                <td><?=$model->getUserName()?></td>
                <td><?=$model->code?> </td>						
							<td><?=$model->unit_price?></td>
              <td><?=$model->quantity > 0 ? $model->quantity : '';?></td>
              <td><?=$model->quantity < 0 ? $model->quantity : '';?></td>
              <?php  
                  $total = $model->quantity;
                  $sumtotal =$sumtotal + $total;
              ?>
							<td><?=$sumtotal;?></td>	
              <td><?php //$model->receipt_list_id?></td>						
						</tr>
                        <?php 
                           
                            
            // }
            endforeach; ?>
				
				</tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th><?=$modelsP['instoke']?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th><?=$sumtotal?></th>
                </tr>
                </tfoot>
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
