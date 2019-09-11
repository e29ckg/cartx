<?php
use yii\helpers\Url;
?>	
	<section>
		<div class="container">
			<div class="row">
			<div id="features_items" class="col-sm-12 padding-right">
					<div  class="features_items"><!--features_items-->
						<h2 class="title text-center">ประวัติการเบิก</h2>

						<div class="widget-body no-padding">
							<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
					                    <th data-class="expand">Id</th>
					                    <th data-hide="phone">order_code</th>
					                    <th data-hide="phone">name</th>
					                    <th data-hide="phone,tablet">เวลา</th>
										<th ></th>
						            </tr>
								</thead>
								<tbody>
									<?php foreach ($models as $model): ?>
						            <tr>
						                <td><?=$model->id?></td>			
								        <td><?=$model->order_code?></td>
										<td><?=$model->getProfileName()?></td>
										<td><?=$model->create_at?></td>											
										<td><?= $model->status == 4 ? 'ยกเลิก' : '<a href="'.Url::to(['cart/pdf','id'=>$model->id]).'" target="_blank">พิมพ์ใบเบิก</a>' ?></td>									        
									</tr>
									<?php  endforeach; ?>
								</tbody>	
							</table>
						</div>
					</div></div>
			</div>
		</div>
	</section>
	