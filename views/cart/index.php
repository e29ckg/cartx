<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php // var_dump($models)?>

<section>

		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
														
							<?php foreach ($modelCatalogs as $modelCatalog): ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="index.php?r=cart/search&m=<?=$modelCatalog->id?>"><?=$modelCatalog->name_catalog?></a></h4>
								</div>
							</div>
							<?php  endforeach; ?>
							
						</div><!--/category-productsr-->					
						
						<div class="shipping text-center"><!--shipping-->
							<!-- <img src="images/home/shipping.jpg" alt="" /> -->
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div id="features_items" class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						
						<?php foreach ($models as $model): ?>

						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?= $model->img ? 'uploads/product/img/'.$model->img : 'img/no_image.png'?>"  height="250" width="200" sizes= "50" alt="<?=$model->product_name?>" />
										<h2>  <?=$model->instoke ? 'มี '.$model->instoke: '-' ?> <?=$model->getUnitName() ?></h2>
										<p><?=$model->product_name?></p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2><?=$model->instoke ? $model->instoke: '-' ?></h2>
											<p><?=$model->product_name?></p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>

						<?php  endforeach; ?>
						
					</div><!--features_items-->
					<div>
						<!-- <ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul> -->
						
					</div>
					
				</div>
			</div>
		</div>
	</section>