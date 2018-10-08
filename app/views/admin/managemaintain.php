		<div class="col-md-10">
			<h2 class="page-header">Manage Maintenance Request <a href="<?= SC_URL ?>admin/addmaintain" class="pull-right btn btn-primary">ADD</a></h2>
            
            <table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Customer</th>
						<th>Product</th>
						<th>Status</th>
						<th>Date of Request</th>
						<th>Duration (Years)</th>
						<th>options</td>
					</tr>
				</thead>
				<tbody>
					<?php if(isset($data['services']) && !empty($data['services'])) :
					foreach($data['services'] as $service) : ?>
					<tr>
						<td><?= $service->id ?></td>
						<td><?= $service->customer_name ?> (<a href="<?= SC_URL ?>admin/viewcustomer?id=<?= $service->customer_id ?>"><?= $service->customer_id ?></a>)</td>
						<td><?= $service->device_name ?> (<a href="<?= SC_URL ?>admin/editdevice?id=<?= $service->id ?>"><?= $service->id ?></a>)</td>
						<td class="<?=($service->status=='REQUESTED')?'alert alert-info':(($service->status=='PAID')?'alert alert-success':'alert alert-warning') ?>"><?= $service->status ?></td>
						<td><?= $service->requested_date ?></td>
						<td><?= $service->duration ?></td>
						<td><a href="<?= SC_URL ?>admin/viewmaintain?id=<?= $service->id ?>">view</a></td>
					</tr>
					<?php endforeach;
					else : ?>
					<tr><td class="alert alert-info" colspan=7>No Past Fault Repair Request found.</td><tr> 
					<?php endif; ?>
				</tbody>
			</table>
            
		</div>
	</div>
</div>