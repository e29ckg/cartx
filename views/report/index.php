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
										<th data-class="expand">Id</th>
										<th>รายงานประจำเดือน</th>
					    			<th>เครื่องมือ</th>
                	</tr>
                </thead>
              <tbody>
              <?php foreach ($ReportM as $model): ?>
                <tr>
                  <td></td>
                  <td><?=$model->month?></td>
                  <td><a href="<?=Url::to(['report/view2','m' =>$model->month])?>"><?=$model->month?></a></td>
                </tr>
              
              <?php endforeach; ?>
				
				</tbody>
                <tfoot>
                <tr>
                  <th><?=$start?></th>
                  <th><?=$end?></th>
                  <th><?=$month?></th>
                  <th><?=$monthB?></th>
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
<?php
              // $product_c = null;
              // $quantity = null;
              ?>

<?php // foreach ($Log as $model): ?>
                <?php //

                  // if(isset($product_c) && $model->product->product_name <> $product_c){
                  //   echo '<tr>    
                  //   <td>'.$model->code.'</td>
                  //   <td>'.$product_c.'</td>
                  //   <td>'.$quantity.'</td>
                  //   <td></td>
                  // </tr>';
                //   }

                // if($model->product->product_name == $product_c){
                //   // $product_c = $model->product->product_name;
                //   $quantity = $quantity + $model->quantity ;
                // }else{                 
                  
                // $product_c = $model->product->product_name;
                // $quantity = $model->quantity;

                // } 

                
              ?>
						      
							<?php // endforeach; ?>



