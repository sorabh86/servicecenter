		<div class="col-md-10">
			<h2 class="page-header">Manage Devices/Product 
                <a href="<?= SC_URL ?>admin/addproduct" class="btn btn-primary pull-right">ADD</a>
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
                    <?php if(isset($data['products'])): 
                        foreach ($data['products'] as $product) : ?>
                        <tr>
                            <!-- <pre><?php print_r($product) ?></pre> -->
                            <td><?= $product->id ?></td>
                            <td><?= $product->customer_name.' ('.$product->customer_id.')' ?></td>
                            <td><?= $product->product_category_name.' ('.$product->product_category_id.')' ?></td>
                            <td><?= $product->brand_name ?></td>
                            <td><?= $product->serial_no ?></td>
                            <td><?= $product->purchase_price ?></td>
                            <td><?= $product->date_of_purchase ?></td>
                            <td><a href="<?= SC_URL ?>admin/editproduct?id=<?= $product->id ?>" class="btn btn-success">Edit</a>
                                <a href="<?= SC_URL ?>admin/deleteproduct?id=<?= $product->id ?>" class="btn btn-delete btn-danger">Delete</a></td>
                        </tr>
                    <?php endforeach;
                    else : ?>
                        <tr><td colspan=6>No device product found</td><tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
		</div>
	</div>
</div>