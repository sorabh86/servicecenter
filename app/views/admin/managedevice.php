		<div class="col-md-10">
			<h2 class="page-header">Manage Devices/Product 
                <a href="<?= SC_URL ?>admin/adddevice" class="btn btn-primary pull-right">ADD</a>
            </h2>
            
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Customer Name</th>
                        <th>Product Category</th>
                        <th>Brand Name</th>
                        <th>Serial No</th>
                        <th>Purchase Price</th>
                        <th>Purchase Date</th>
                        <th>options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($data['devices'])): 
                        foreach ($data['devices'] as $device) : ?>
                        <tr>
                            <!-- <pre><?php print_r($device) ?></pre> -->
                            <td><?= $device->id ?></td>
                            <td><?= $device->customer_name.' ('.$device->customer_id.')' ?></td>
                            <td><?= $device->device_category_name.' ('.$device->device_category_id.')' ?></td>
                            <td><?= $device->brand_name ?></td>
                            <td><?= $device->serial_no ?></td>
                            <td><?= $device->purchase_price ?></td>
                            <td><?= $device->date_of_purchase ?></td>
                            <td><a href="<?= SC_URL ?>admin/editdevice?id=<?= $device->id ?>" class="btn btn-success">Edit</a>
                                <a href="<?= SC_URL ?>admin/deletedevice?id=<?= $device->id ?>" class="btn btn-delete btn-danger">Delete</a></td>
                        </tr>
                    <?php endforeach;
                    else : ?>
                        <tr><td colspan=6>No device device found</td><tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
		</div>
	</div>
</div>