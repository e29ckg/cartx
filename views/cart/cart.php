<?php
use app\models\Product;
// echo var_dump($_SESSION['inLine']);
?>

<section id="cart_items">
		<div class="container">
			<!-- <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div> -->
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
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
									if($_SESSION['strProductId'][$i] != ""){
										$idProduct=$_SESSION['strProductId'][$i];
                    					$model = Product::find()->where(['id'=> $idProduct])->one();
                    					// $ss['strProductId'][$i] =  $_SESSION['inLine'][$i];
										$Total = $_SESSION['strQty'][$i] * $model->price;
										$sumTotal = $sumTotal + $Total;
										
						?>
							<tr>
								<td class="cart_product"><a href=""><img src="<?= $model->img ? 'uploads/product/img/'.$model->img : 'img/no_image.png'?>" height="110" alt=""></a></td>
								<td class="cart_description">
									<h4><a href=""><?=$model->product_name?></a></h4>
									<p>Web ID:<?=$model->id?> </p>
								</td>
								<td class="cart_price">
									<p>$ <?= $model->price?></p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a data-id="<?=$i?>" class="cart_quantity_up qty_up" href="#"> + </a>
										<input data-id="<?=$i?>" class="cart_quantity_input quantity-input" type="text" name="quantity" value="<?=$_SESSION['strQty'][$i]?>" autocomplete="off" size="2">
										<a data-id="<?=$i?>" class="cart_quantity_down qty_down" href="#"> - </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">$ <?=$Total?> </p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete " data-id="<?=$i?>" href="index.php?r=cart/delete&id=<?=$i?>"><i class="fa fa-times"></i></a>
								</td>
							</tr>						

						<?php
                					}
								}
							}
			
						?>

						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tbody><tr>
										<!-- <td>Cart Sub Total</td>
										<td>$59</td> -->
									</tr>
									<tr>
										<!-- <td>Exo Tax</td>
										<td>$2</td> -->
									</tr>
									<tr class="shipping-cost">
										<!-- <td>Shipping Cost</td>
										<td>Free</td>										 -->
									</tr>
									<tr>
										<td>Total</td>
										<td><span>$ <?=$sumTotal?></span></td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
<script >
		$(document).ready(function() {
			
			$(".quantity-input").change(function() {    
    			var url = "index.php?r=cart/qty_change";
				id= $(this).data("id");
				val= $(this).val();
				// alert(val);
        		$.get(url,{id:id,val:val},function (data){
						$("#content").html(data);
        			}
				);     
			});

			$(".qty_up").click(function() {    
    			var url = "index.php?r=cart/qty_up";
				id= $(this).data("id");
				// alert(val);
        		$.get(url,{id:id},function (data){
						$("#content").html(data);
        			}
				);     
			});

			$(".qty_down").click(function() {    
    			var url = "index.php?r=cart/qty_down";
				id= $(this).data("id");
				// alert(val);
        		$.get(url,{id:id},function (data){
						$("#content").html(data);
        			}
				);     
			});

		});

</script>	