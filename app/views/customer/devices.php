<div class="container" style="margin-bottom:40px">
    <a class="btn btn-default btn-back" href="<?= SC_URL ?>customer">back</a>
    <h1 class="page-header">Devices <a class="btn btn-primary pull-right" href="<?= SC_URL ?>customer/adddevice">Add</a></h1>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Category</th>
                <th>Brand Name</th>
                <th>Serial No.</th>
                <th>Purchase Price</th>
                <th>Date of Purchase</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($data['products']) && count($data['products'])>0) : 
                foreach($data['products'] as $product) : ?>
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->product_category_name ?></td>
                    <td><?= $product->brand_name ?></td>
                    <td><?= $product->serial_no ?></td>
                    <td><?= $product->purchase_price ?></td>
                    <td><?= $product->date_of_purchase ?></td>
                    <td>
                        <a class="btn btn-success" href="<?= SC_URL ?>customer/editdevice?id=<?= $product->id ?>">edit</a></td>
                </tr>
            <?php endforeach; 
            else: ?>
                <tr><td colspan="7" class="alert alert-info">No Product/Device found.</td></tr>
            <?php endif;?>
        </tbody>
    </table>
    
</div>
