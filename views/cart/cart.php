<?php
use app\models\ReceiptList;
use app\models\Product;
use yii\helpers\Url;
//  echo var_dump($_SESSION['inLine']);
?>

<section id="cart_items">
		<div class="container">
			<!-- <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div> -->
			<div id="features_items" class="col-sm-12 padding-right">
					<div  class="features_items"><!--features_items-->
						<h2 class="title text-center">ตะกร้า</h2>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">วัสดุ</td>
							<td class="description">จำนวนที่มี</td>
							<td class="quantity">จำนวนที่เบิก</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php
			
						$Total = 0 ;
						$sumTotal = 0;
						//  $model = Product::find()->all();
						if(isset($_SESSION['inLine'])){
								for($i=0;$i<=(int)$_SESSION['inLine'];$i++){
									if($_SESSION['strProductCode'][$i] != ""){
										$codeProduct = $_SESSION['strProductCode'][$i];
										$model = Product::find()->where(['code'=> $codeProduct])->one();
										  									
                    					// $ss['strProductCode'][$i] =  $_SESSION['inLine'][$i];
										$Total = $_SESSION['strQty'][$i];
										$sumTotal = $sumTotal + $Total;
										
						?>
							<tr>
								<td class="cart_product">
									<a href=""><img src="<?= $model->img ? Url::to(['uploads/product/img/'.$model->img]) : Url::to(['img/no_image.png'])?>" height="110" alt=""></td>
								</td>
								<td class="cart_description">
									<h4><a href=""><?=$model->product_name?></a></h4>
									<p>Web ID: <?=$model->code?> </p>
								</td>

								<td class="cart_description">
									<h4>มี <?=$model->instoke.' '.$model->getUnitName()?></h4>
								</td>
								
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<!-- <a data-id="<?=$i?>" class="cart_quantity_up qty_up" href="#"> + </a> -->
										<input data-id="<?=$i?>" class="cart_quantity_input quantity-input" type="number" name="quantity" value="<?=$_SESSION['strQty'][$i]?>" autocomplete="off" size="2">
										<!-- <a data-id="<?=$i?>" class="cart_quantity_down qty_down" href="#"> - </a> -->
									</div>
								</td>
								
								<!-- <td class="cart_quantity"> -->
								<td class="cart_delete">
									<a class="cart_quantity_delete" data-id="<?=$i?>" href="<?=Url::to(['cart/delete','id' => $i])?>"><i class="fa fa-times"></i> ลบ</a>
								</td>
							</tr>						

					<?php }	} } ?>		
						
								
									<tr >
										
										<td colspan="5" class="text-center">
											<?= $sumTotal <> 0 ? '<a class="btn btn-success" href="'.Url::to(['cart/checkout']).'"><i class="fa fa-crosshairs"></i> Checkout</a>' : "" ?>
										</td>
									</tr>
					</tbody>
				</table>
				</div>
			
			</div>	
			</div>

		</div>
	</section> <!--/#cart_items-->

<script >
		$(document).ready(function() {
			
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

			$(".qty_up").click(function() {    
    			var url = "qty_up";
				id= $(this).data("id");
				// alert(val);
        		$.get(url,{id:id},function (data){
						$("#content").html(data);
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


		});

</script>	