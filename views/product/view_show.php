<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ReceiptList;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $modelP['product_name'];
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php if(!empty($modelP->img)){
									echo Html::img('@web/uploads/product/img/'.$modelP['img'], ['alt' => 'My pic','class'=>'offline act-view','height'=>'50px']); 
								}else{
									echo Html::img('@web/img/none.png', ['alt' => 'My pic','class'=>'offline act-view', 'height'=>'50px']); 
								}?>
              <h3 class="box-title"><?=$this->title?></h3>
			  <div class="box-tools">
        <!-- <button onclick="myFunction()">Print</button> -->
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
                    <th class="text-center" >รับจาก / จ่ายให้ : เลขที่เอกสาร</th>
                    <th class="text-center" >ราคาต่อหน่วย</th>
                    <th class="text-center" >หน่วยนับ</th>
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
              <td><?= $model->DateThai_full($model->create_at)?></td>
              <td><?= $model->quantity > 0 ? $model->getSellerName() : $model->getUserName();?>
              <br><?=$model->code?> </td>						
							<td class="text-center"><?=number_format($model->unit_price,2)?></td>
              <td class="text-center"><?=$model->getUnitName()?></td>
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
                    <th><?=$modelP['instoke']?></th>
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


<script>
function myFunction() {
  window.print();
}
</script>
