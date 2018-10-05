
		<div class="col-md-10">
			<h2 class="page-header">Manage Customers <a href="<?= SC_URL ?>admin/addcustomer" class="pull-right btn btn-primary">ADD</a></h2>

			<table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Full Name</th>
                        <th>username</th>
                        <th>phone</th>
                        <th>address</th>
                        <th>options</th>
                    </tr>
                </thead>
                <tbody>
					<?php if(isset($data['customers'])): 
						foreach($data['customers'] as $customer) : ?>
						<tr>
							<td><?= $customer->id ?></td>
							<td><?= $customer->name ?></td>
							<td><?= $customer->username ?></td>
							<td><?= $customer->phone ?></td>
							<td><?= $customer->address ?></td>
							<td><a href="<?= SC_URL ?>admin/viewcustomer?id=<?= $customer->id ?>">view</a></td>
						</tr>
					<?php endforeach; 
					else : ?>
						<tr><td colspan=6>No customer found</td><tr>
					<?php endif; ?>
                </tbody>
			</table>
			
		</div>
	</div>
</div>