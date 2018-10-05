<div class="container">
    <h2 class="page-header">Edit Device/Product</h2>
    <?php $device = $data['device']; 
    if(isset($device)) : ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $device->id ?>">
            <div class="form-group">
                <label class="control-label">Customer :</label>
                <?php if(isset($data['customers'])) : ?>
                    <select name="customer_id" class="form-control" required>
                        <?php foreach($data['customers'] as $customer) : 
                            $selected = ($customer->id==$device->customer_id)?'selected':''; ?>
                            <option value="<?= $customer->id ?>" <?= $selected ?>><?= $customer->name ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else : ?>
                    <p class="alert alert-info">Organization didn't have any customer, please add manually or wait for someone to register</p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="control-label">Product Type :</label>
                <?php if(isset($data['cat'])) : ?>
                    <select name="device_category_id" class="form-control" required>
                        <?php foreach($data['cat'] as $category) : 
                            $selected = ($category->id==$device->device_category_id)?'selected':''; ?>
                            <option value="<?= $category->id ?>" <?= $selected ?>><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else : ?>
                    <p class="alert alert-info">You didn't add any device categories in admin area</p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="control-label">Brand Name :</label>
                <input name="brand_name" type="text" class="form-control" 
                value="<?= $device->brand_name ?>"
                placeholder="Brand Name" required>
            </div>
            <div class="form-group">
                <label class="control-label">Serial No :</label>
                <input name="serial_no" type="text" class="form-control" 
                value="<?= $device->serial_no ?>"
                placeholder="Serial No" required>
            </div>
            <div class="form-group">
                <label class="control-label">Purchased Price :</label>
                <input name="purchase_price" type="text" class="form-control" 
                value="<?= $device->purchase_price ?>"
                placeholder="Purchased Price" required>
            </div>
            <div class="form-group">
                <label class="control-label">Purchased Date :</label>
                <input name="date_of_purchase" type="date" class="form-control" 
                value="<?= $device->date_of_purchase ?>"
                placeholder="Date of Purchase" required>
            </div>
            <div class="form-group">
                <button name="submit" class="btn btn-success" type="submit">UPDATE</button>
                <a href="<?= SC_URL ?>admin/managedevice" class="btn btn-default">Cancel</a>
            </div>
        </form>
    <?php else : ?>
        <p>No Product Data found</p>
    <?php endif; ?>
</div>