
<div class="container" style="margin-bottom:40px">
    <a class="btn btn-default btn-back" href="<?= SC_URL ?>customer"><span class="glyphicon glyphicon-arrow-left"></span> back</a>
    <h1 class="page-header">Maintenance Request <a class="btn btn-primary pull-right" href="<?= SC_URL ?>customer/addmaintenance">Add</a></h1>
    <div class="row">
        <div class="col-md-9">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <!-- <th>Alternative Address</th>
                        <th>Alternative Phone</th> -->
                        <th>Status</th>
                        <th>Date of Request</th>
                        <!-- <th>options</td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($data['services']) && !empty($data['services'])) : 
                        foreach($data['services'] as $service) : ?>
                        <tr>
                            <td><?= $service->id ?></td>
                            <td><?= $service->device_name ?> (<a href="<?= SC_URL ?>customer/editdevice?id=<?= $service->device_id ?>"><?= $service->device_id ?></a>)</td>
                            <!-- <td><?= $service->alternative_address ?></td>
                            <td><?= $service->alternative_phone ?></td> -->
                            <td class="<?=($service->status=='REQUESTED')?'alert alert-info':(($service->status=='PAID')?'alert alert-success':'alert alert-warning') ?>"><?= $service->status ?></td>
                            <td><?= $service->requested_date ?></td>
                            <!-- <td><a href="">view</a></td> -->
                        </tr>
                    <?php endforeach;
                    else : ?>
                        <tr><td class="alert alert-info" colspan=7>No Past Maintenance Request found.</td><tr> 
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <p>We Are providing Quater cycle of maintenance to your devices</p>
            <p> These schedules should provide simple guidelines for all types of equipment, covering the tasks to be undertaken in the following areas:</p>
            <ul>
                <li>Care and cleaning</li>
                <li>Safety checks</li>
                <li>Functional and performance checks</li>
                <li>Maintenance tasks (changing parts, lubricating moving parts, etc.)</li>
            </ul>
        
        </div>
    </div>
</div>
