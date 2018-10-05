<div class="container">
    <h2 class="page-header">Add Device/Product</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label class="control-label">Customer :</label>
            <?php if(isset($data['customers'])) : ?>
                <select name="customer_id" class="form-control" required>
                    <?php foreach($data['customers'] as $customer) : ?>
                        <option value="<?= $customer->id ?>"><?= $customer->name ?></option>
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
                    <?php foreach($data['cat'] as $category) : ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else : ?>
                <p class="alert alert-info">You didn't add any device categories in admin area</p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label class="control-label">Brand Name :</label>
            <input name="brand_name" type="text" class="form-control" placeholder="Brand Name" required>
        </div>
        <div class="form-group">
            <label class="control-label">Serial No :</label>
            <input name="serial_no" type="text" class="form-control" placeholder="Serial No" required>
        </div>
        <div class="form-group">
            <label class="control-label">Purchased Price :</label>
            <input name="purchase_price" type="text" class="form-control" placeholder="Purchased Price" required>
        </div>
        <div class="form-group">
            <label class="control-label">Purchased Date :</label>
            <input name="date_of_purchase" type="date" class="form-control" placeholder="Date of Purchase" required>
        </div>
        
        <div class="form-group">
            <button name="submit" class="btn btn-success" type="submit">ADD</button>
            <a href="<?= SC_URL ?>admin/managedevice" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>