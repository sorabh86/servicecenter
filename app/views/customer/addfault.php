<div class="container" style="margin-bottom:40px">
    <h1 class="page-header">Request Fault</h1>
    <form action="" method="POST" role="form">
        <input type="hidden" name="type" value="fault_repair">
        <div class="form-group row">
            <?php if(isset($data['devices'])) : ?>
                <div class="col-md-9">
                    <label>Product/Device :</label>
                    <select class="form-control" name="device_id">
                        <?php foreach($data['devices'] as $device): ?>
                            <option value="<?= $device->id ?>"><?= $device->device_category_name.' : '.$device->brand_name.' '.$device->serial_no ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label style="margin:5px 25px 5px 5px;padding:15px" class="alert-danger">OR</label>
                    <a class="btn btn-success" href="<?= SC_URL ?>customer/adddevice">Add New Device</a>
                </div>
            <?php else : ?>
                <label>Product/Device :</label>
                <div class="alert alert-info">
                    No Product/Device found, Please Add your device from <strong><a href="<?= SC_URL ?>customer/devices">here</a></strong>, then come back to add your repair request.  
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Description :</label>
            <textarea name="description" class="form-control" placeholder="Describe those problems"></textarea>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="checkbox">
                    <label>
                        <input id="alt-address" type="checkbox" checked>
                        Address and Phone Same as your Profile
                    </label>
                </div>    
            </div>
            <div id="alt-address-box" class="col-md-8 hide">
                <div class="form-group">
                    <label>Alternative Address :</label>
                    <input name="alternative_address" type="text" class="form-control" placeholder="If address is not same as your profile address">
                </div>
                <div class="form-group">
                    <label>Alternative Phone :</label>
                    <input name="alternative_phone" type="text" class="form-control" placeholder="If phone no. is not same as your profile phone no.">
                </div>
            </div>
        </div>
        
        <button name="submit" type="submit" class="btn btn-primary">Add</button>
        <a href="<?= SC_URL ?>customer/faultservice" class="btn btn-default">cancel</a>
    </form>
</div>