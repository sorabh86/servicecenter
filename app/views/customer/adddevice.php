<div class="container">
    <h1 class="page-header">Add Device</h1>
    <form action="" method="POST" role="form">
        <div class="form-group">
            <label>Product Category</label>
            <select name="product_category"></select>
        </div>
        <div class="form-group">
            <label>Brand Name</label>
            <input type="text" class="form-control" id="" placeholder="Input field">
        </div>
        <div class="form-group">
            <label>Serial No.</label>
            <input type="text" class="form-control" id="" placeholder="Input field">
        </div>
        <div class="form-group">
            <label>Purchased Price</label>
            <input type="text" class="form-control" id="" placeholder="Input field">
        </div>
        <div class="form-group">
            <label>Date of purchase</label>
            <input type="text" class="form-control" id="" placeholder="Input field">
        </div>
        <button type="submit" class="btn btn-primary">ADD</button>
        <a href="<?= SC_URL ?>customer/devices" class="btn btn-default">cancel</a>
    </form>
</div>