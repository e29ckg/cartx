<?php

use yii\helpers\Html;
//  use yii\grid\GridView;
use app\model\ReportML;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตารางสรุปการรับ-จ่ายวัสดุ ประจำเดือน '. $month;
$this->params['breadcrumbs'][] = $month;
// var_dump();

?>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="box-tools">
                <!-- <a href= "#" id="act-create" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> สร้างรายงาน</a> -->

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="product-index" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th colspan="10" class="text-center"><b><?=$this->title?></b></th>
                  </tr>
                	<tr>
										<th style="text-align:center" data-class="expand">#</th>
                    <!-- <th>เดือน</th> -->
                    <th width="50%" style="text-align:center">name</th>
                    <th style="text-align:center">หน่วยนับ</th>
                    <th style="text-align:center">ยกมา</th>
                    <th style="text-align:center">รับ</th>
                    <th style="text-align:center">จ่าย</th>
					    			<th style="text-align:center">คงเหลือ</th>
                    <th style="text-align:center">ราคาต่อหน่วย</th>
                    <th style="text-align:center">จำนวนเงิน</th>
					    			<th style="text-align:center">หมายเหตุ</th>
                	</tr>
                </thead>
              <tbody>
              <?php 
                $i = 1 ;
                $K_price = 0 ;
                $K_price_sum = 0;
              foreach ($rRMLs as $modelRMLs): 
              if($modelRMLs->kb <> 0 || $modelRMLs->r <> 0 || $modelRMLs->o <> 0){?>

						      <tr>    
										<td style="text-align:center"><?=$i?></td>
										<!-- <td><?=$modelRMLs->month?></td> -->
                    <td><?=$modelRMLs->getProductName()?></td>
                    <td style="text-align:center"><?=$modelRMLs->productUnit->name_unit?></td>
								    <td style="text-align:center"><?=$modelRMLs->kb ? $modelRMLs->kb : '0' ?></td>
                    <td style="text-align:center"><?=$modelRMLs->r ? $modelRMLs->r : '0' ?></td>
                    <td style="text-align:center"><?=$modelRMLs->o ? $modelRMLs->o : '0'  ?></td>
                    <td style="text-align:center"><?=$modelRMLs->k ? $modelRMLs->k : '0'?></td>
                    <td style="text-align:right"><?=number_format($modelRMLs->unit_price,2)?></td>
                    <?php $K_price = $modelRMLs->k * $modelRMLs->unit_price?>
                    <td style="text-align:right" ><?=number_format($K_price, 2);?></td>
                    <td><?=$modelRMLs->detail?></td>
									</tr>
              <?php  
              }
              $K_price_sum = $K_price_sum + $K_price;
                $i++;
                endforeach; ?>
				
				</tbody>
                <tfoot>
                 <tr>
                  <th colspan="5">ประจำเดือน : <?=$month?></th>
                  
                  <!-- <th></th> -->
                  <th colspan="2" class="text-right">รวม : </th>
                  <th colspan="2" class="text-right success"><?=number_format($K_price_sum, 2);?></th>
                  <th></th>
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

<?php//var_dump($RL)?>




