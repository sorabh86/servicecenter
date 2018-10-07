<div class="container" style="margin-bottom:40px">
    <h1 class="page-header">Add Service</h1>
    <form name="add_maintenanceservice_form" action="" method="POST" role="form">
        <input name="type" type="hidden" value="maintenance">
        <input name="status" type="hidden" value="APPROVED">
        <div class="form-group">
            <label>Customer & Device :</label>
            <?php if(isset($data['devices']) && !empty($data['devices'])): ?>
                <select name="device_id" class="form-control">
                    <?php foreach($data['devices'] as $device): ?>
                        <option value="<?= $device->id ?>" data-catid="<?= $device->device_category_id ?>"><?= $device->customer_name.' : '.$device->device_category_name.' ('.
                        $device->brand_name.' '.$device->serial_no.')' ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else: ?>
                <div class="alert alert-info">No Device found for any customer</div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Engineers :</label>
            <?php if(isset($data['engineers']) && !empty($data['engineers'])): ?>
                <select name="engineer_id" class="form-control">
                    <?php foreach($data['engineers'] as $engineer): ?>
                        <option value="<?= $engineer->id ?>"><?= $engineer->name ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else: ?>
                <div class="alert alert-info">No Engineer found to repair this device, please hire one.</div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Description :</label>
            <textarea name="description" class="form-control" placeholder="Some notes to inform" required></textarea>
        </div>
        <div class="form-group">
            <label>Duration (Years):</label>
            <select name="duration" class="form-control" required>
                <option value="1">1 Year</option>
                <option value="2">2 Year</option>
                <option value="3">3 Year</option>
                <option value="4">4 Year</option>
                <option value="5">5 Year</option>
            </select>
        </div>
        <div class="form-group">
            <label>Service Charge (Rs/year):</label>
            <input type="text" name="price" class="form-control" value="1000.00" required></textarea>
        </div>
        
        <button name="submit" type="submit" class="btn btn-primary">Add</button>
        <a href="<?= SC_URL ?>admin/managemaintain" class="btn btn-default">cancel</a>
    </form>
</div>