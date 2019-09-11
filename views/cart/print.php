<?php
use yii\helpers\Html;
?>

<table width="100%">
    <tr>
        <td colspan="2" style="text-align: center"><h1>ใบเบิกพัสดุ<h1></td>
    </tr>
    <tr><td colspan="2"></td></tr>
    <tr><td colspan="2"></td></tr>
    <tr>
        <td><h3>ผู้เบิก : <?= $model->getProfileName() ?></h3></td>
        <td style="text-align: right"><h4>รหัสใบเบิก <?= $model->order_code ?></h4></td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: right"><h5>วันที่ <?= $model->DateThai_full($model->create_at) ?></h5></td>
    </tr>
</table>
<br>
<table class="table_bordered" width="100%" border="0" cellpadding="2" cellspacing="0">
    <thead>        
		<tr class="cart_menu">
            <th width="5%" class="image">ลำดับ<br>no.</th>
	    	<th width="5%" class="image">ภาพ</th>
			<th width="50%" class="description">รายการ</th>
			<th width="10%"class="price">ราคาต่อหน่วย</th>
			<th width="12%" class="quantity">จำนวนเบิก</th>
			<th width="10%" class="total">ราคารวม<br>Total</th>
		</tr>
	</thead>
    <tbody>
        <?php $i = 1;
            $quantity = 0;
            $unit = 0;
            $product = '';
            $product_code = null;
            $productQTY_old = 0;
            $A = '';
        ?>
        <?php foreach ($model_lists as $model): ?>
        <tr>
            <td style="text-align:center"><?=$i?></td>
            <td style="text-align:center"><img src="<?=$model->getProductImg()?>" height="32" ></td>
            <td><?=$model->getProductName()?></td>
            <td style="text-align:center"><?=$model->unit_price?></td>
            <td style="text-align:center"><?=$model->quantity?> <?=$model->getProductUnitName()?></td>
            <td style="text-align:right"><?= number_format($model->unit_price * $model->quantity, 2); ?></td>
        </tr>
            <?php  
                ++$i;
                $quantity = $quantity + $model->unit_price * $model->quantity;
                endforeach; 
            ?>    
    </tbody>    
</table>

<table cellspacing="0" cellpadding="2" border="0" width="100%">
    <tr>
        <td width="50%"></td>
        <td width="50%">
            <table cellspacing="0" cellpadding="0" class="table_bordered" width="100%">
                <tr>
                    <td colspan="2" style="text-align:right" width="50%">
                        <u>ราคารวม :</u><br />
                        Total
                    </td>
                    <td colspan="2" width="50%" style="text-align:right">
                        <h3><?=number_format($quantity, 2);?></h3>
                    </td>
                </tr>                
            </table>
        </td>        
    </tr>
</table>

<table cellspacing="0" cellpadding="2" border="0" width="100%" style= "margin-top: 50px">
    <tr>
        <td width="5%">ผู้เบิก</td>
        <td width="40%">...............................................................</td>
        <td width="5%"></td>
        <td width="10%">ผู้อนุมัติ</td> 
        <td width="40%">...............................................................</td>
    </tr>
</table>
    <table cellspacing="0" cellpadding="2" border="0" width="100%" style= "margin-top: 75px">
    <tr>
        <td width="5%">ผู้จ่าย</td>
        <td width="40%">...............................................................</td>
        <td width="5%"></td>
        <td width="10%">ผู้รับของ</td> 
        <td width="40%">...............................................................</td>
    </tr>
    
</table>
