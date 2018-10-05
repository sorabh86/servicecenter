<div class="container">
    <h2 class="page-header">Update Customer</h2>
    <?php if(isset($data['customer']) && !empty($data['customer'])): ?>
        <form name="customer-register" action="" method="POST">
            <div class="form-group">
                <label for="username" class="control-label">Username :</label>
                <input name="username" type="text" class="form-control" 
                value="<?= $data['customer']->username ?>"
                placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password" class="control-label">Password :</label>
                <input name="password" type="password" class="form-control" 
                value="<?= $data['customer']->password ?>"
                placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="name" class="control-label">Name :</label>
                <input id="name" name="name" type="text" class="form-control" 
                value="<?= $data['customer']->name ?>"
                placeholder="Your Full Name" required>
            </div>
            <div class="form-group">
                <label for="address" class="control-label">Address :</label>
                <input id="address" name="address" type="text" class="form-control" 
                value="<?= $data['customer']->address ?>"
                placeholder="Your Full Address" required>
            </div>
            <div class="form-group">
                <label for="phone" class="control-label">Phone No :</label>
                <input id="phone" name="phone" type="text" class="form-control" 
                value="<?= $data['customer']->phone ?>"
                placeholder="+91 5555-555-555" required>
            </div>
            <div class="form-group">
                <button name="submit" class="btn btn-success" type="submit">ADD</button>
                <a href="<?= SC_URL ?>admin/managecustomer" class="btn btn-default">Cancel</a>
            </div>
        </form>
        <?php else: ?>
            <p class="alert alert-danger"> No Customer found for this id </p>
        <?php endif; ?>
</div>