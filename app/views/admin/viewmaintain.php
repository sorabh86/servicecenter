<?php
    if(!isset($data['service']) && empty($data['service'])) die('Error:Service Not defined. <a href="'.SC_URL.'admin/managemaintain">goback</a>');
    $service = $data['service'];
// echo '<pre>'; print_r($service); echo '</pre>'; ?>
<div class="container" style="margin-bottom:40px;">
    <h2 class="page-header">
        <a href="<?= SC_URL ?>admin/managemaintain" class="btn btn-default">&lt; go back</a>
        <span style="margin-left:40px">Maintenance Request Details</span>
        <?php if($service->status == 'APPROVED') : ?>
            <form class="pull-right" action="<?= SC_URL ?>admin/maintainbill" method="POST">
                <input name="id" type="hidden" value="<?= $_GET['id'] ?>">
                <button name="submit" class="btn btn-warning" href="">Generate Bill</button>
            </form>
        <?php elseif($service->status == 'PAID'): ?>
            <p class="alert-info pull-right">PAID</p>
        <?php endif;?>
    </h2>
    <div class="row">
        <div class="basic-desc col-md-9" style="border:1px solid #eee;padding:10px;">
            <?php 
            $date = strtotime($service->requested_date);
            $startdate = date('d F Y', $date);
            $enddate = date('d F Y', strtotime($startdate.' + '.(365*$service->duration).' days'));
            ?>
            <p><strong class="col-md-3 text-right">Name: </strong> <?= $service->customer_name ?></p>
            <p><strong class="col-md-3 text-right">Address: </strong> <?= (isset($service->alternative_address)
                && $service->alternative_address!='')?$service->alternative_address:$service->address ?></p>
            <p><strong class="col-md-3 text-right">Phone: </strong> <?= (isset($service->alternative_phone) && $service->alternative_phone!='')?
                $service->alternative_phone:$service->phone ?></p>
            <p><strong class="col-md-3 text-right">Description: </strong> <?= $service->description ?></p>
            <p><strong class="col-md-3 text-right">Start Date: </strong> <?= $startdate ?></p>
            <p><strong class="col-md-3 text-right">End Date: </strong> <?= $enddate ?></p>
            <p><strong class="col-md-3 text-right">Duration: </strong> <?= $service->duration ?> Year's</p>
            <p><strong class="col-md-3 text-right">Device: </strong> <i><?= $service->device_category_name ?> : </i><?= $service->brand_name.' '.$service->serial_no.' ( '.$service->date_of_purchase.' ) ' ?></p>
            <p><strong class="col-md-3 text-right">Subscription Fee (Rs): </strong> <?= number_format($service->price*$service->duration, 2, '.', '') ?></p>
            <p class="text-warning bg-warning"><strong class="col-md-3 text-right">Status: </strong> <i><?= $service->status ?></p>
        </div>
        <div class="col-md-3">
            <?php if($service->status == 'REQUESTED') : ?>
                <form class="form" action="" method="POST" role="form">
                    <input name="id" type="hidden" value="<?= $_GET['id'] ?>">
                    <div class="form-group">
                        <button name="submit-approve" class="btn btn-success">approve</button>
                        <a class="btn btn-danger" href="<?= SC_URL ?>admin/rejectmaintain?id=<?= $_GET['id'] ?>">reject</a>
                    </div>
                </form>
            <?php elseif($service->status == 'APPROVED' || $service->status == 'PAID') : ?>
                <div class="alert alert-info">
                    <strong class="col-md-6 text-right">Fee : </strong> Rs.<?= $service->price ?>
                    <?php if($service->status == 'APPROVED') : ?>
                        <br>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <input type="hidden" name="status" value="PAID">
                            <button name="submit-paid" type="submit" class="btn btn-success" >Paid</button>
                        <form>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if($service->status == 'APPROVED' || $service->status == 'PAID') : ?>
    <form name="part-bill-form" action="<?= SC_URL ?>admin/maintainbill?id=<?= $_GET['id'] ?>" method="POST" role="form">
        <h3 class="page-header">Replaced Parts 
            <div class="pull-right">
                <small class="text-muted">Choose checkbox from Add bill, then click [Generate Bill]</small>
                <button name="part-submit" class="btn btn-warning" >Generate Bill</button> 
                <a class="btn btn-primary" href="<?= SC_URL ?>admin/adddevicepart?id=<?= $_GET['id'] ?>">Add Part</a>
            </div>
        </h3>
        <style>th,tr{text-align:center;vertical-align:middle;}</style>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price (Rs)</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Option</th>
                    <th>Add Bill</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($data['parts']) && !empty($data['parts'])) : 
                    foreach($data['parts'] as $part) : ?>
                <tr>
                    <td><?= $part->id ?></td>
                    <td><?= $part->part_name ?></td>
                    <td><?= $part->description ?></td>
                    <td><?= $part->price ?></td>
                    <td><?= $part->date ?></td>
                    <td class="alert <?= ($part->status=='')?'alert-danger':'alert-success' ?>"><?= ($part->status=='')?'PENDING':$part->status ?></td>
                    <td>
                        <form style="display:inline-block" action="" method="POST">
                            <input type="hidden" name="id" value="<?= $part->id ?>">
                            <input type="hidden" name="status" value="PAID">
                            <button name="submit-part" class="btn btn-success">paid</button>
                        </form>
                        <a class="btn btn-danger btn-delete" href="<?= SC_URL ?>admin/deletedevicepart?sid=<?= $_GET['id'] ?>&id=<?= $part->id ?>">delete</a>
                    </td>
                    <td>
                        <?php if($part->status!='PAID'): ?>
                        <label style="display:block;margin:0">
                            <input name="parts[]" type='checkbox' value="<?= $part->id ?>" >
                        </label>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach;
                else : ?>
                    <tr><td colspan=8 class="alert alert-info">No Replaced Parts Found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
    <?php endif; ?>
</div>