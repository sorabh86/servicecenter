<div class="container" style="margin-bottom:40px">
    <a class="btn btn-default btn-back" href="<?= SC_URL ?>customer"><span class="glyphicon glyphicon-arrow-left"></span> back</a>
    <h1 class="page-header">Devices <a class="btn btn-primary pull-right" href="<?= SC_URL ?>customer/adddevice">Add</a></h1>
    <p class="alert alert-info">In order to access of different services, like <span class="alert-warning">FAULT REPAIR</span> or <span class="alert-warning">MAINTENANCE</span>,     You must add your device in this list.</p>
    
    <div class="clearfix" style="padding:0 0 20px 0">
        <form name="pagination-form" class="pull-right form form-inline" action="" method="POST" role="form">
            <input name="offset" type="hidden" value="0">
            <div class="form-group">
                <label for="">Number of records: </label>
                <select name="limit" class="form-control">
                    <option value="10" <?= ($data['limit']==10)?'selected':'' ?>>10</option>
                    <option value="20" <?= ($data['limit']==20)?'selected':'' ?>>20</option>
                    <option value="50" <?= ($data['limit']==50)?'selected':'' ?>>50</option>
                    <option value="100" <?= ($data['limit']==100)?'selected':'' ?>>100</option>
                </select>
            </div>
        </form>
    </div>
    
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
    
    <?php if(isset($data['totalPages']) && !empty($data['totalPages'])): ?>
    <div class="clearfix">
        <ul class="pagination pull-right">
        <?php for($i = 0; $i < $data['totalPages']; $i++) : ?>
            <li class="<?= ($data['currentPage']==$i+1)?'active':'' ?>"><a class="page-change" href=""><?= $i+1 ?></a></li>
        <?php endfor; ?>
        </ul>
    </div>
    <?php endif; ?>
</div>
