<div class="container" style="margin-bottom:40px">
    <a class="btn btn-default btn-back" href="<?= SC_URL ?>customer">back</a>
    <h1 class="page-header">Devices <a class="btn btn-primary pull-right" href="<?= SC_URL ?>customer/adddevice">Add</a></h1>
    <p>In order to provide different services, we request some basic information about your device, it will help you in future to send any type of service request in future.</p>
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
            <?php if(isset($data['devices']) && count($data['devices'])>0) : 
                foreach($data['devices'] as $device) : ?>
                <tr>
                    <td><?= $device->id ?></td>
                    <td><?= $device->device_category_name ?></td>
                    <td><?= $device->brand_name ?></td>
                    <td><?= $device->serial_no ?></td>
                    <td><?= $device->purchase_price ?></td>
                    <td><?= $device->date_of_purchase ?></td>
                    <td>
                        <a class="btn btn-success" href="<?= SC_URL ?>customer/editdevice?id=<?= $device->id ?>">edit</a></td>
                </tr>
            <?php endforeach; 
            else: ?>
                <tr><td colspan="7" class="alert alert-info">No Product/Device found.</td></tr>
            <?php endif;?>
        </tbody>
    </table>
    
</div>
