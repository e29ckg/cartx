<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รับเข้าสต็อก';
$this->params['breadcrumbs'][] = $this->title;
?>
<a href = "index.php?r=receipt/add_list" class="btn btn-warning act-update"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a>

<div class="table-responsive cart_info">
			
	<?php
		if(isset($_SESSION['inLineR'])){
	?>
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
			// $Total = "";		
			// $sumTotal = "";
			for($i=0;$i<=(int)$_SESSION['inLineR'];$i++){
				if($_SESSION['strProductCodeR'][$i] != ""){
					$productCode = $_SESSION['strProductCodeR'][$i];
					// $model = Product::find()->where(['code'=> $idProduct])->one();
					// $ss['strProductId'][$i] =  $_SESSION['inLine'][$i];
					// $Total = $_SESSION['strQtyR'][$i] * $model->unit_price;
					// $sumTotal = $sumTotal + $Total;
		?>
			<tr>
				<td class="">
					<?=$i?>
				</td>
				<td class="">
					<?=$_SESSION['strProductCodeR'][$i]?>
				</td>
				<td class="">
					<?=$_SESSION['strProductUnitPriceR'][$i]?> 
				</td>
				<td class="">
					<?=$_SESSION['strQtyR'][$i]?>
				</td>
				<td class="">
					
				</td>
				<td class="cart_delete">
					<a class="" data-id="<?=$i?>" href="index.php?r=receipt/delete_list&id=<?=$i?>"><i class="fa fa-times"></i></a>
				</td>
			</tr>						

		<?php }	} } ?>		
		</tbody>
	</table>
<a class="" data-id="<?=$i?>" href="index.php?r=receipt/delete_list&id=<?=$i?>"><i class="fa fa-times"></i></a>
			
</div>						
