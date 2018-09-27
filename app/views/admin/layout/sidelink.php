<div class="container-fluid" style="margin-top:20px">
	<div class="row">
		<div class="col-md-2">
			<ul class="list-group">
				<a class="list-group-item <?php echo ($data['mcat'])?'active':'' ?>" href="<?= SC_URL ?>admin/managecategory">
					Categories 
					<span class="badge"></span>
				</a>
				<a class="list-group-item <?php echo ($data['mproduct'])?'active':'' ?>" href="<?= SC_URL ?>admin/manageproduct">
					Devices 
					<span class="badge"></span>
				</a>
				<a class="list-group-item <?php echo ($data['mcustomers'])?'active':'' ?>" href="<?= SC_URL ?>admin/managecustomer">
					Customers
					<span class="badge">15</span>
				</a>
				<a class="list-group-item <?php echo ($data['mengineers'])?'active':'' ?>" href="<?= SC_URL ?>admin/manageengineer">
					<span class="badge"></span>
					Engineers
				</a>
				<a class="list-group-item <?php echo ($data['mfault'])?'active':'' ?>" href="<?= SC_URL ?>admin/managefault">
					<span class="badge">10</span>
					Fault Request 
				</a>
				<a class="list-group-item <?php echo ($data['mmaintain'])?'active':'' ?>" href="<?= SC_URL ?>admin/managemaintain">
					Maintenance Service 
				</a>
				</li>
			</ul>
		</div>