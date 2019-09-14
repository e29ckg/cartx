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
                    <th class="text-center" >DateTime</th>
                    <th class="text-center" >รับจาก / จ่ายให้</th>
                    <th class="text-center" >เลขที่เอกสาร</th>
                    <th class="text-center" >ราคาต่อหน่วย</th>
                    <th class="text-center" >จำนวนรับ</th>
                    <th class="text-center" >จำนวนจ่าย</th>
                    <th class="text-center" >คงเหลือ</th>
                    <th class="text-center" >หมายเหตุ</th>
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
              <td class="text-center"><?=$model->code?> </td>						
							<td class="text-center"><?=number_format($model->unit_price,2)?></td>
              <td class="text-center"><?=$model->quantity > 0 ? $model->quantity : '';?></td>
              <td class="text-center"><?=$model->quantity < 0 ? $model->quantity : '';?></td>
              <?php  
                  $total = $model->quantity;
                  $sumtotal =$sumtotal + $total;
              ?>
							<td class="text-center"><?=$sumtotal;?></td>	
              <td><?=$model->note?></td>						
						</tr>
                        <?php 
                           
                            
            // }
            endforeach; ?>
				
				</tbody>
                <tfoot>
                  <tr>
                    <!-- <th></th>
                    <th></th>
                    <th><?=$modelsP['instoke']?></th>
                    <th></th>
                    <th></th> -->
                    <th colspan="6"></th>
                    <th class="text-center success"><?=$sumtotal?></th>
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
