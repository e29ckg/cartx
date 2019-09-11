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
                  <th class="text-center">ID</th>
				          <th class="text-center">ProductCode</th>
                  <th class="text-center">Product</th>
                  <th class="text-center">ราคาต่อหน่วย</th>
                  <th class="text-center">จำนวน</th>
                  <th class="text-center">จำนวนเงิน</th>
                </tr>
                </thead>
                <tbody>   
                <?php 
                    $Total = 0 ;
                    $sumTotal = 0;
                ?>               
				          <?php foreach ($model_lists as $model_list): ?>
                    <tr>
                        <td class="text-center"><?=$model_list->id?></td>
                        <td class="text-center">
                          <img src="<?=$model_list->getProductImg();?>" alt="img-product" width="42px">
                        </td>
                        <td><?=$model_list->getProductName()?></td>
                        <td class="text-center"><?=number_format($model_list->unit_price,2)?></td>
                        <td class="text-center"><?=$model_list->quantity .' '. $model_list->product->getUnitName()?></td>                        
                  	    <td class="text-right">                            
                          <?php
                              $Total = $model_list->quantity * $model_list->unit_price;
                              echo number_format($Total,2);
                              $sumTotal = $sumTotal + $Total;                          
                            ?>
					              </td>
				              </tr>
				          <?php  endforeach; ?>
				        </tbody>
                <tfoot>
                <tr>                  
                  <th colspan="5" class="text-right">รวม : </th>   
                  <th class="text-right success"><?= number_format($sumTotal,2)?></th>                                 
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

