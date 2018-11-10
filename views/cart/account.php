
	
	<section>
		<div class="container">
			<div class="row">
			<div class="widget-body no-padding">
							<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
								<thead>
									<tr>
					                    <th data-class="expand">Id</th>
					                    <th data-hide="phone">code</th>
					                    <th data-hide="phone">name</th>
					                    <th data-hide="phone,tablet">เวลา</th>
										<th ></th>
						            </tr>
								</thead>
								<tbody>
									<?php foreach ($models as $model): ?>
						            <tr>
						                <td><?=$model->id?></td>			
								        <td><?=$model->code?></td>
										<td><?=$model->getProfileName()?></td>
										<td><?=$model->create_at?></td>	
										<td><a>พิมพ์ใบเบิก</a></td>									        
									</tr>
									<?php  endforeach; ?>
								</tbody>	
							</table>
						</div>
			</div>
		</div>
	</section>
	