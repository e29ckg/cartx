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
                
					<a href= "<?=Url::to(['report/report_add'])?>" id="act-create" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> สร้างรายงาน</a>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <table id="product-index" class="table table-bordered table-hover">
                <thead>
                	<tr>
                    <th>#</th>
										<th>รายงานประจำเดือน</th>
					    			<th>Tools</th>
                	</tr>
                </thead>
              <tbody>
              <?php foreach ($ReportM as $model): ?>
                <tr>
                  <td><?=$model->month?></td>
                  <td><a href="<?=Url::to(['report/view2','m' =>$model->month])?>"><?=$model->DateThai_full($model->month)?></a></td>
                  <td><a href="<?=Url::to(['report/del','id' =>$model->id])?>" class="btn btn-danger btn-xs" data-confirm="ต้องการ ลบ ?">ลบ</a></td>
                </tr>              
              <?php endforeach; ?>
				
				</tbody>
        <tfoot>
                <tr>
                  <th></th>
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




