        <div class="col-md-10">
            <h2 class="page-header">Basic Information</h2>
            <?php if(isset($data['customer'])) : ?>
                <p><strong>Full Name :</strong> <?= $data['customer']->name ?></p>
                <p><strong>Username :</strong> <?= $data['customer']->username ?> </p>
                <p><strong>Phone :</strong> <?= $data['customer']->phone ?> </p>
                <p><strong>Address :</strong> <?= $data['customer']->address ?> </p>
            <?php else: ?>
                <div class="alert alert-info">
                    No basic Information for this customer
                </div>
            <?php endif; ?>

            <h4 class="page-header">Customer Devices</h4>
            <?php if(isset($data['products'])) :
                if(count($data['products']) > 0) : ?>
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
                    <?php foreach($data['products'] as $product) : ?>
                        <tr>
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
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    No added device/product found for this customer.
                </div>
            <?php endif; 
            endif; ?>

            <h4 class="page-header">Customer Fault Request</h4>
            
            <h4 class="page-header">Customer Maintenance Services</h4>
        </div>
    </div>
</div>
