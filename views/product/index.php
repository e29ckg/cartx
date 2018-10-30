<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
// var_dump();
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $fullname = 'Satit Seethaphon'; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'code',            
            [
                'attribute' => 'img',
                'label'=>'Image',
                'format'=>'raw',
                'value' => function($data){
                    $url = "http://127.0.0.1/yii2/logo.png";
                    return Html::img($url,['alt'=>'yii']); 
                }
            ],
            [
                'attribute' => 'product_name',
                'label'=>'ชื่อวัสดุ',
                'format'=>'raw',
                'value' => function($model){
                    $url = "index.php?r=product/view&id=".$model->id;
                    return Html::a($model->product_name, $url, ['title' => $model->product_name]); 
                }
            ],
            [
                'attribute' => 'category',
                 'format' => 'html',
                // 'filter'=>array("1"=>"Active","2"=>"Inactive"),
                // 'filter'=> Product::get_catalog(),
                'content'=>function($model){
                    return $model->getCatalogtName();
                }
            ],
            
            // [
            //     'attribute' => 'created_at',
            //     'value'=>function($model) use ($fullname){
            //       return $model->create_at . " | " . $fullname;
            //     }
            // ],
            // [
            //     'attribute' => '่เครื่องมือ',
            //     'format' => 'html',
            //     'value'=>function($model, $key, $index, $column){
            //       return '<a href="index.php?r=product/view&id='.$model->id.'" title="ดู" aria-label="ดู" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>'.$key. " | " . $model->product_name;
            //     }
            // ],
            
            
            // 'product_name',
            // 'img',
            // 'category',
            [
                'attribute' => 'instoke',
                'label'=>'In Stork',
                //  'format' => 'html',
                'content'=>function($model){
                    return $model->instoke.' '.$model->getUnitName();
                }
            ],
            
            
            //'Description',
            //'location',
            //'price',
            //'status',
            //'lower',
            //'instoke',
            //'create_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
