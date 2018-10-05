<div class="container" style="margin-bottom:40px">
    <h1 class="page-header">Add Device</h1>
    <form action="" method="POST" role="form">
        <input type="hidden" name="id" value="<?= $data['device']->id ?>">
        <input type="hidden" name="customer_id" value="<?= $data['customer_id'] ?>">
        <div class="form-group">
            <label>Product Category</label>
            <?php if(isset($data['categories'])) : ?>
            <select class="form-control" name="device_category_id">
                <?php foreach($data['categories'] as $category): 
                    $selected=($category->id==$data['device']->device_category_id)?'selected':'';?>
                    <option value="<?= $category->id ?>" <?= $selected ?>><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
            <?php else : ?>
                <div class="alert alert-info">
                    No Device/Product category found.
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Brand Name</label>
            <input type="text" name="brand_name" class="form-control" 
            value="<?= $data['device']->brand_name ?>"
            placeholder="Brand Name" required>
        </div>
        <div class="form-group">
            <label>Serial No.</label>
            <input type="text" name="serial_no" class="form-control" 
            value="<?= $data['device']->serial_no ?>"
            placeholder="Serial No." required>
        </div>
        <div class="form-group">
            <label>Purchased Price</label>
            <input type="text" name="purchase_price" class="form-control" 
            value="<?= $data['device']->purchase_price ?>"
            placeholder="Purchased Price" required>
        </div>
        <div class="form-group">
            <label>Date of purchase</label>
            <input type="date" name="date_of_purchase" class="form-control" 
            value="<?= $data['device']->date_of_purchase ?>"
            placeholder="Date of Purchase" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">update</button>
        <a href="<?= SC_URL ?>customer/devices" class="btn btn-default">cancel</a>
    </form>
</div>