<?php

use yii\helpers\Html;
//  use yii\grid\GridView;
use app\model\Product;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report';
$this->params['breadcrumbs'][] = $this->title;
// var_dump();
?>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$this->title?></h3>
			  <div class="box-tools">
                
					<a href= "#" id="act-create" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> สร้างรายงาน</a>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="product-index" class="table table-bordered table-hover">
                <thead>
                	<tr>
										<th data-class="expand">Id</th>
                    <th>เดือน</th>
                    <th>name</th>
                    <th>หน่วยนับ</th>
                    <th>ยกมา</th>
                    <th>รับ</th>
                    <th>จ่าย</th>
					    			<th>คงเหลือ</th>
                	</tr>
                </thead>
              <tbody>
              <?php 
                $i = 1 ;
              foreach ($ReportRMLs as $modelRMLs): ?>
						      <tr>    
										<td><?=$i?></td>
										<td><?=$modelRMLs->month?></td>
                    <td><?=$modelRMLs->getProductName()?></td>
                    <td><?=$modelRMLs->product_unit?></td>
								    <td><?=$modelRMLs->kb?></td>
                    <td><?=$modelRMLs->r?></td>
                    <td><?=$modelRMLs->o?></td>
                    <td><?=$modelRMLs->kb + $modelRMLs->r - $modelRMLs->o?></td>
                    <td><?=$modelRMLs->unit_price?></td>
                    <td><?=$modelRMLs->total_price?></td>
                    <td><?=$modelRMLs->create_at?></td>
									</tr>
              <?php  
                $i++;
                endforeach; ?>
				
				</tbody>
                <tfoot>
                 <tr>
                  <th>Rendering engine</th>
                  <th></th>
                  <th>KB : </th>
                  <th>รับ :</th>
                  <th>จ่าย : </th>
                  <th> # RL :  # KB : </th>
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




