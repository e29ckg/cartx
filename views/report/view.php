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
										<th>name</th>
                    <th>ยกมา</th>
                    <th>รับ</th>
                    <th>จ่าย</th>
					    			<th>คงเหลือ</th>
                	</tr>
                </thead>
              <tbody>
							<?php foreach ($modelRLs as $modelRL): ?>
						      <tr>    
										<td><?=$modelRL->id?></td>
										<td><?=$modelRL->getProductName()?></td>
                    <td><?=$modelRL->create_at?></td>
                    <td><?=$modelRL->create_at?></td>
								    <td></td>
                    <td><?=$modelRL->quantity?></td>
                    <th><?=$modelRL->unit_price?></th>
									</tr>
							<?php  endforeach; ?>
				
				</tbody>
                <tfoot>
                 <tr>
                  <th>Rendering engine</th>
                  <th></th>
                  <th>KB : <?=$Log_KB_Qty_sum?></th>
                  <th>รับ : <?=$Log_R_Qty_sum?></th>
                  <th>จ่าย : <?=$Log_O_Qty_sum?></th>
                  <th><?=$Log_KB_Qty_sum + $Log_R_Qty_sum - $Order_Qty_sum?> # RL : <?=$Receipt_Qty_sum?> # KB : <?=$Log_K_Qty_sum?></th>
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




