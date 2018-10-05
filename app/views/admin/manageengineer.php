
		<div class="col-md-10">
			<h2 class="page-header">Manage Engineers <a href="<?= SC_URL ?>admin/addengineer" class="pull-right btn btn-primary">ADD</a></h2>

			<table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>address</th>
                        <th>join date</th>
                        <th>expertise</th>
                        <th>options</th>
                    </tr>
                </thead>
                <tbody>
					<?php if(isset($data['engineers']) && !empty($data['engineers'])): 
						foreach($data['engineers'] as $engineer) :?>
						<tr>
							<td><?= $engineer->id ?></td>
							<td><?= $engineer->name ?></td>
							<td><?= $engineer->address ?></td>
							<td><?= $engineer->date_of_joining ?></td>
							<td><?= $engineer->expertise ?></td>
							<td><a href="<?= SC_URL ?>admin/editengineer?id=<?= $engineer->id ?>">edit</a> | 
								<a class="btn-delete" href="<?= SC_URL ?>admin/deleteengineer?id=<?= $engineer->id ?>">delete</a></td>
						</tr>
					<?php endforeach; 
					else : ?>
						<tr><td colspan=6>No Engineer found.</td><tr>
					<?php endif; ?>
                </tbody>
			</table>
		</div>
	</div>
</div>