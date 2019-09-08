<?php

use app\models\ProductCatalog;
use app\models\profile;
use app\widgets\Alert;
use yii\helpers\Url;

$modelCatalogs = ProductCatalog::find()->all();

if (Yii::$app->user->identity) {
	$id = Yii::$app->user->identity->id;
	$profile = profile::find()->where(['user_id' => $id])->one();
	if(isset($profile)){
		$fullname = $profile->fname.$profile->name.' '.$profile->sname;
	}else{
		$fullname = Yii::$app->user->identity->username;
	} 
}
?>
<?php
	$bCart = 0 ;
	//  $model = Product::find()->all();
	if(isset($_SESSION['inLine'])){
			for($i=0;$i<=(int)$_SESSION['inLine'];$i++){
				if($_SESSION['strProductCode'][$i] != ""){
					$bCart++; 
				}
			}
	}
							
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop | E-Shopper</title>
    <link href="<?=Url::to('@web/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=Url::to('@web/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=Url::to('@web/css/prettyPhoto.css')?>" rel="stylesheet">
    <link href="<?=Url::to('@web/css/price-range.css')?>" rel="stylesheet">
    <link href="<?=Url::to('@web/css/animate.css')?>" rel="stylesheet">
	<link href="<?=Url::to('@web/css/main.css')?>" rel="stylesheet">
	<link href="<?=Url::to('@web/css/responsive.css')?>" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<!--header_top-->
		<div class="header_top">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 ">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> 032 600 806-11 ต่อ 105</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> pkkjc@coj.go.th</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								<li><a href=""><i class="fab fa-line"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div> 
		</div>
		<!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?=Url::to(['cart/index'])?>"><img src="<?=Url::to('@web/images/home/logo.png')?>" alt="" /></a>							
						</div>
						<div class="btn-group pull-right">
						
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li>
								<?php if(Yii::$app->user->identity->role == '9'){
									echo '<li><a href="'.Url::to(['site/dashboard']).'"><i class="fa fa-lock"></i> blankEnd</a></li>';
								}
								?>
								<li><a href="<?=Url::to(['cart/account'])?>"><i class="fa fa-user"></i><font color="green"><?= $fullname?></font></a></li>
								<li><a href="<?=Url::to(['cart/account'])?>"><i class="fa fa-bookmark"></i><font color="red"> ประวัติการเบิก</font></a></li>
								<!-- <li><a href="print"><i class="fa fa-crosshairs"></i> Checkout</a></li> -->
								<li><a href="<?=Url::to(['cart/cart'])?>"><i class="fa fa-shopping-cart"></i> Cart <span id="badge_cart" class="badge"><?=$bCart<>0 ? $bCart : ''?></span></a></li>
								<?php if(Yii::$app->user->identity){
									echo '<li><a href="'.Url::to(['site/logout']).'"><i class="fa fa-lock"></i> Logout</a></li>';
								}else{
									echo '<li><a href="'.Url::to(['site/login']).'"><i class="fa fa-lock"></i> Login</a></li>';
								}  ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?=Url::to(['cart/index'])?>">Home</a></li>
								
								<li class="dropdown"><a href="#" class="active">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									<?php 
										foreach ($modelCatalogs as $modelCatalog): 
											echo '<li><a class="" data-id="$modelCatalog->id" href="'.Url::to(['cart/search','m'=> $modelCatalog->id]).'"> '.$modelCatalog->name_catalog.'</a></li>';
									  	endforeach; 
									?>
                                    </ul>
                                </li> 

								
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<!-- <input type="text" placeholder="Search"/> -->
							<input id = "search" type="text" name="table_search" class="form-control pull-right" placeholder="Search" data-cip-id="cIPJQ342845640" autofocus>
						</div>
					</div>
				</div>
				</div>
			</div>
	</header>
<!-- 	
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section> -->
<div id="content">	
	<section>
		<div id="container1" class="container">
			<div class="row">
				<?= Alert::widget() ?>
				<?= $content ?>
			</div>
		</div>
	</section>

</div>
	
	<footer>
		
		<div class="footer-widget">
			<div class="container">
				
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-Shopper. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
  
    <script src="<?=Url::to('@web/js/jquery.js')?>"></script>
	<script src="<?=Url::to('@web/js/price-range.js')?>"></script>
    <script src="<?=Url::to('@web/js/jquery.scrollUp.min.js')?>"></script>
	<script src="<?=Url::to('@web/js/bootstrap.min.js')?>"></script>
    <script src="<?=Url::to('@web/js/jquery.prettyPhoto.js')?>"></script>
    <script src="<?=Url::to('@web/js/main.js')?>"></script>
	<script >
		$(document).ready(function() {
			// add-to-cart						
			// $( ".add-to-cart" ).click(function() {    
    		// 	var url = "add_to_cart";
			// 	code = $(this).data("id");
				
        	// 	$.get(url,{code:code},function (data){
			// 			$("#content").html(data);
        	// 		}
			// 	);     
			// });  
			
			$(".qty_up").click(function() {    
    			var url = "qty_up";
				id= $(this).data("id");
				// alert(val);
        		$.get(url,{id:id},function (data){
						$("#content").html(data);
						$("#badge_cart").html($i);
        			}
				);     
			});

			$(".qty_down").click(function() {    
    			var url = "qty_down";
				id= $(this).data("id");
				// alert(val);
        		$.get(url,{id:id},function (data){
						$("#content").html(data);
        			}
				);     
			});

			// $(".quantity-input").change(function() {    
    		// 	var url = "qty_change";
			// 	id= $(this).data("id");
			// 	val= $(this).val();
			// 	// $("#badge_cart").html(val);
			// });

			$(".quantity-input").change(function() {    
    			var url = "qty_change";
				id= $(this).data("id");
				val= $(this).val();
				// alert(val);
        		$.get(url,{id:id,val:val},function (data){
						$("#content").html(data);
        			}
				);     
			});

			$("#content").change(function() {    
    			var url = "qty_change";
				id= $(this).data("id");
				val= $(this).val();
				// alert(val);
        		// $.get(url,{id:id,val:val},function (data){
				// 		$("#content").html(data);
        		// 	}
				// );     
			});

			// delete_item
			// $(".delete_item" ).click(function() {    
    		// 	var url = "delete";
			// 	id= $(this).data("id");
        	// 	$.get(url,{id:id},function (data){
			// 		alert(id);
			// 			$("#content").html(data);						
        	// 		}
			// 	); 			
			// }); 

			$( ".search-m" ).click(function() {    
    			var url_create = "search";
				id= $(this).data("id");
        		$.get(url_create,{m:id},
					function (data){
						$("#features_items").html(data);
        			}
				);     
			}); 

			$("#search").keyup(function () {
		//        var that = this,
			value = $(this).val();
			// if(value == ""){
	  		// 	location.reload();  
			// }
			$.get("search",{q:value},
				function (data)
					{
						$("#container1").html(data);
					}
				);

			});	
		});
	</script>
</body>
</html>