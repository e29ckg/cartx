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
$this->params['breadcrumbs'][] = $this->title;
// var_dump();

?>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> : <?=$month?></h3>
			  <div class="box-tools">
         	<!-- <a href= "#" id="act-create" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> สร้างรายงาน</a> -->

        </div>
      </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="product-index" class="table table-bordered table-hover">
                <thead>
                	<tr>
										<th data-class="expand">Id</th>
                    <!-- <th>เดือน</th> -->
                    <th>name</th>
                    <th>หน่วยนับ</th>
                    <th>ยกมา</th>
                    <th>รับ</th>
                    <th>จ่าย</th>
					    			<th>คงเหลือ</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>จำนวนเงิน</th>
					    			<th>หมายเหตุ</th>
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
										<td><?=$i?></td>
										<!-- <td><?=$modelRMLs->month?></td> -->
                    <td><?=$modelRMLs->getProductName()?></td>
                    <td><?=$modelRMLs->productUnit->name_unit?></td>
								    <td><?=$modelRMLs->kb ? $modelRMLs->kb : '0' ?></td>
                    <td><?=$modelRMLs->r ? $modelRMLs->r : '0' ?></td>
                    <td><?=$modelRMLs->o ? $modelRMLs->o : '0'  ?></td>
                    <td><?=$modelRMLs->k ? $modelRMLs->k : '0'?></td>
                    <td><?=$modelRMLs->unit_price?></td>
                    <td><?=$K_price = $modelRMLs->k * $modelRMLs->unit_price?></td>
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
                  <th></th>
                  <th>ประจำเดือน : <?=$month?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>ราคารวม</th>
                  <th><?=$K_price_sum?></th>
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



