<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->order_code;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$model->order_code?> # <?=$model->status?> <small><?=$model->getProfileName()?></small></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Rendering engine</th>
				  <th>Browser</th>
				  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </thead>
                <tbody>
                <tr>                  
				<?php foreach ($model_lists as $model_list): ?>
				<td><?=$model_list->id?></td>
					<td><?=$model_list->order_code?></td>
                    <td><?=$model_list->product_code?></td>
                    <td><?=$model_list->quantity?></td>
                    <td><?=$model->create_at?></td>
                    <td><a herf= "#" class="btn btn-warning act-update" data-id=<?=$model_list->id?>><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
                        <a herf= "#" class="btn btn-warning act-view" data-id=<?=$model_list->id?>><i class="fa fa-pencil-square-o"></i> ดู</a>
                        <?= Html::a('<i class="fa fa-remove"></i> ลบ',['product/delete','id' => $model_list->id],
                            [
                                'class' => 'btn btn-danger act-update',
                                'data-confirm' => 'Are you sure to delete this item?',
                                'data-method' => 'post',
                            ]);
                        ?>
                    </td>
				</tr>
				<?php  endforeach; ?>
				</tbody>
                <!-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> -->
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
 
    
<section id="widget-grid" class="">
				
                <!-- row -->
                <div class="row">
                    
                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                         <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2><?= $this->title;?> </h2>
                        
                            </header>
                                <!-- widget div-->
                            <div>
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->
                                </div>
                                <!-- end widget edit box -->
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th data-class="expand">Id</th>
                                                <th>Image</th>
                                                <th data-hide="phone">ชื่อวัสดุ</th>
                                                <th data-hide="phone,tablet">InStock</th>
                                                <th>เครื่องมือ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($model_lists as $model_list): ?>
                                            <tr>
                                                <td><?=$model_list->id?></td>
                                                <td>
                                                    <?=$model_list->order_code?>
                                                </td>
                                                <td><?=$model_list->product_code?></td>
                                                <td><?=$model_list->quantity?></td>
                                                <td>
                                                    <a herf= "#" class="btn btn-warning act-update" data-id=<?=$model_list->id?>><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
                                                    <a herf= "#" class="btn btn-warning act-view" data-id=<?=$model_list->id?>><i class="fa fa-pencil-square-o"></i> ดู</a>
                                                    <?= Html::a('<i class="fa fa-remove"></i> ลบ',['product/delete','id' => $model_list->id],
                                                            [
                                                                'class' => 'btn btn-danger act-update',
                                                                'data-confirm' => 'Are you sure to delete this item?',
                                                                'data-method' => 'post',
                                                            ]);
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php  endforeach; ?>
                                        </tbody>	
                                    </table>
                                </div>
                            </div>							
                    </article>
                </div>
            </section>
   

</div>
