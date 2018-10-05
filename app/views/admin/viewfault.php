<?php $fault = $data['fault'];
// echo '<pre>'; print_r($fault); echo '</pre>'; ?>
<div class="container" style="margin-bottom:40px;">
    <h2 class="page-header">
        <a href="<?= SC_URL ?>admin/managefault" class="btn btn-default">&lt; go back</a>
        <span style="margin-left:40px">Fault Request Details</span>
        <a class="btn btn-warning pull-right" href="<?= SC_URL ?>admin/generatebill">Generate Bill</a>
    </h2>
    <div class="row">
        <div class="basic-desc col-md-8" style="border:1px solid #eee;padding:10px;">
            <p><strong class="col-md-3 text-right">Name: </strong> <?= $fault->customer_name ?></p>
            <p><strong class="col-md-3 text-right">Address: </strong> <?= (isset($fault->alternative_address)
                && $fault->alternative_address!='')?$fault->alternative_address:$fault->address ?></p>
            <p><strong class="col-md-3 text-right">Phone: </strong> <?= (isset($fault->alternative_phone) && $fault->alternative_phone!='')?
                $fault->alternative_phone:$fault->phone ?></p>
            <p><strong class="col-md-3 text-right">Description: </strong> <?= $fault->description ?></p>
            <p><strong class="col-md-3 text-right">Requested Date: </strong> <?= $fault->requested_date ?></p>
            <p><strong class="col-md-3 text-right">Device: </strong> <i><?= $fault->device_category_name ?> : </i><?= $fault->brand_name.' '.$fault->serial_no.' ( '.$fault->date_of_purchase.' ) ' ?></p>
            <p class="text-warning bg-warning"><strong class="col-md-3 text-right">Status: </strong> <i><?= $fault->status ?></p>
        </div>
        <div class="col-md-4">
            <?php if($fault->status != 'APPROVED') : ?>
                <form class="form" action="" method="POST" role="form">
                    <input name="id" type="hidden" value="<?= $_GET['id'] ?>">
                    <div class="form-group">
                        <label class="">Service Charge (Rs.) : </label>
                        <input name="price" required class="form-control" type="text" placeholder="200">
                    </div>
                    <div class="form-group">
                        <label class="">Engineer : </label>
                        <?php if(isset($data['engineers']) && !empty($data['engineers'])) : ?>
                            <select name="engineer_id" class="form-control">
                                <?php foreach($data['engineers'] as $engineer) : ?>
                                    <option value="<?= $engineer->id ?>"><?= $engineer->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <span class="alert alert-warning">No Engineer available to repair this device, please hire one</span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <button name="submit-approve" class="btn btn-success">approve</button>
                        <a class="btn btn-danger" href="<?= SC_URL ?>admin/rejectfault?id=<?= $_GET['id'] ?>">reject</a>
                    </div>
                </form>
            <?php else : ?>
                <div class="alert alert-info">
                    <p><strong class="col-md-5 text-right">Service Charge: </strong> Rs.<?= $fault->price ?></p>
                    <p><strong class="col-md-5 text-right">Engineer Name: </strong> <?= $fault->engineer_name ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if($fault->status == 'APPROVED') : ?>
    <h3 class="page-header">Replaced Parts <a class="btn btn-primary pull-right" href="">Add</a></h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>description</th>
                <th>Price</th>
                <th>date</th>
                <th>option</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($data['parts']) && !empty($data['parts'])) : ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="">delete</a></td>
            </tr>
            <?php else : ?>
                <tr><td colspan=6 class="alert alert-info">No Replaced Parts Found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>