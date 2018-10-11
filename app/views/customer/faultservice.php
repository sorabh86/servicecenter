
<div class="container" style="margin-bottom:40px">
    <a class="btn btn-default btn-back" href="<?= SC_URL ?>customer"><span class="glyphicon glyphicon-arrow-left"></span> back</a>
    <h1 class="page-header">Fault Repair Request <a class="btn btn-primary pull-right" href="<?= SC_URL ?>customer/addfault">Add</a></h1>
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
                        <tr><td class="alert alert-info" colspan=7>No Past Fault Repair Request found.</td><tr> 
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <p>Repair means responding to the breakdown of equipment and undertaking work to correct the problem in order to return the equipment to a working condition.</p>
            <ul>
                <li>
                    <strong>Simple repairs</strong> can be done by the in-house or external maintenance and repair team. If the equipment is repaired where it is used, it is important that the team is trained to work safely and that they don't create hazards for customers or staff.
                </li>
                <li>
                    <strong>More complex repairs</strong> will be carried out by specialised maintenance personnel; they might come to the eye care unit or you may have to send the equipment to them for repairs.
                </li>
            </ul>
        </div>
    </div>    
</div>
