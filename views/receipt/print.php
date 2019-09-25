<?php
use yii\helpers\Html;
?>

<table class="table_bordered" width="100%" cellpadding="2" cellspacing="1">
    <tr>
        <td width="100%" style="text-align: center" >
            <h3>รหัสใบนำเข้า <?= $model->receipt_code ?></h3>            
        </td>
        
    </tr>
    
</table>
<table class="table_bordered" width="100%" border="0" cellpadding="2" cellspacing="0">
    <thead>
		<tr class="cart_menu">
	    	<th width="5%" class="image">ลำดับ<br>no.</th>
			<th width="50%" class="description">รายการ</th>
			<th width="10%" class="price">ราคาต่อหน่วย</th>
			<th width="10%" class="quantity">จำนวน</th>
			<th width="10%" class="total">ราคารวม<br>Total</th>
		</tr>
	</thead>
    <tbody>
        <?php $i = 1;
                $total = 0;
                $totalSum = 0;
                ?>
        <?php foreach ($model_lists as $model_list): ?>
            <tr>
                <td style="text-align: center"><?=$i?></td>
                <td >
                    <?=$model_list->getProductName()?>
                </td>
                <td style="text-align: center"><?=number_format($model_list->unit_price, 2)?></td>
                <td style="text-align: center"><?=$model_list->quantity?></td>
                <td style="text-align: right">
                <?php 
                    $total = $model_list->unit_price * $model_list->quantity;
                    echo number_format($total, 2);
                ?>
                </td>
            </tr>
            <?php $totalSum = $totalSum + $total;
            $i++;
            ?>
        <?php  endforeach; ?>    
    </tbody>
    <tbody>
        <?php for($i;$i<=10;$i++){ ?>         
            <tr>
                <td style="text-align: center"><?=$i?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php  } ?>    
    </tbody>
</table>
<table cellspacing="0" cellpadding="2" border="0" width="100%">
    <tr>
        <td width="50%"></td>
        <td width="50%">
            <table cellspacing="0" cellpadding="0" class="table_bordered" width="100%">
                <tr>
                    <td colspan="2" width="50%">
                        <u>ราคารวม :</u><br />
                        Total
                    </td>
                    <td colspan="2" width="50%" style="text-align: right">
                        <h3><?=number_format($totalSum, 2)?></h3>
                    </td>
                </tr>                
            </table>
        </td>        
    </tr>
</table>

<table width="100%">
    <tr>
        <td colspan="2" width="80%">
            <h3>ผู้นำเข้า : <?= $model->getProfileName() ?></h3>
        </td>
        
    </tr>
    <tr>
        <td colspan="2" width="80%">
            <h3>ร้านค้า/บริษัท : <?= $model->getSellerName() ?></h3>
        </td>
        
    </tr>
    <tr>       
        <td colspan="2" width="80%">
        วันที่นำเข้า : <?= $model->DateThai_full($model->create_at) ?>
        </td>
    </tr>
</table>
