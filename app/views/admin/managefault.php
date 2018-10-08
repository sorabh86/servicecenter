
		<div class="col-md-10">
			<h2 class="page-header">Manage Fault Request <a href="<?= SC_URL ?>admin/addfault" class="pull-right btn btn-primary">ADD</a></h2>
            
            <table class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Customer</th>
					<th>Product</th>
					<th>Status</th>
					<th>Date of Request</th>
					<th>options</td>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($data['faults']) && !empty($data['faults'])) :
				foreach($data['faults'] as $fault) : ?>
				<tr>
					<td><?= $fault->id ?></td>
					<td><?= $fault->customer_name ?> (<a href="<?= SC_URL ?>admin/viewcustomer?id=<?= $fault->customer_id ?>"><?= $fault->customer_id ?></a>)</td>
					<td><?= $fault->device_name ?> (<a href="<?= SC_URL ?>admin/editdevice?id=<?= $fault->id ?>"><?= $fault->id ?></a>)</td>
					<td class="<?=($fault->status=='REQUESTED')?'alert alert-info':(($fault->status=='PAID')?'alert alert-success':'alert alert-warning') ?>"><?= $fault->status ?></td>
					<td><?= $fault->requested_date ?></td>
					<td><a href="<?= SC_URL ?>admin/viewfault?id=<?= $fault->id ?>">view</a></td>
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