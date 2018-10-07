        <div class="col-md-10">
            <h2 class="page-header">Basic Information <a href="<?= SC_URL ?>admin/editcustomer?id=<?= $_GET['id'] ?>" class="btn btn-success pull-right" >Edit</a></h2>
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
            <?php if(isset($data['devices']) && !empty($data['devices'])) :?>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Product Category</th>
                            <th>Brand Name</th>
                            <th>Serial No</th>
                            <th>Purchase Price</th>
                            <th>Purchase Date</th>
                            <th>options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data['devices'] as $device) : ?>
                        <tr>
                            <td><?= $device->id ?></td>
                            <td><?= $device->device_category_name.' ('.$device->device_category_id.')' ?></td>
                            <td><?= $device->brand_name ?></td>
                            <td><?= $device->serial_no ?></td>
                            <td><?= $device->purchase_price ?></td>
                            <td><?= $device->date_of_purchase ?></td>
                            <td><a href="<?= SC_URL ?>admin/editdevice?id=<?= $device->id ?>" class="btn btn-success">Edit</a>
                                <a href="<?= SC_URL ?>admin/deletedevice?id=<?= $device->id ?>" class="btn btn-delete btn-danger">Delete</a></td>
                        </tr> 
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    No added device found for this customer.
                </div>
            <?php endif; ?>

            <h4 class="page-header">Customer Fault Request</h4>
            <?php if(isset($data['faults']) && !empty($data['faults'])) : ?>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Date of Request</th>
                            <th>options</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data['faults'] as $fault) : ?>
                        <tr>
                            <td><?= $fault->id ?></td>
                            <td><?= $fault->device_name ?> (<a href="<?= SC_URL ?>admin/editdevice?id=<?= $fault->id ?>"><?= $fault->id ?></a>)</td>
                            <td><?= $fault->status ?></td>
                            <td><?= $fault->requested_date ?></td>
                            <td><a href="<?= SC_URL ?>admin/viewfault?id=<?= $fault->id ?>">view</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    No fault service found for this customer.
                </div>
            <?php endif;  ?>
            
            <h4 class="page-header">Customer Maintenance Services</h4>
            <?php if(isset($data['services']) && !empty($data['services'])) : ?>
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
                            <td><?= $service->status ?></td>
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
            <?php else: ?>
                <div class="alert alert-info">
                    No maintenances subscription found for this customer.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
