<div class="container">
    <h2 class="page-header">Add Customer</h2>
    <form name="customer-register" action="" method="POST">
        <div class="form-group">
            <label for="username" class="control-label">Username :</label>
            <input name="username" type="text" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password :</label>
            <input name="password" type="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Name :</label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Your Full Name" required>
        </div>
        <div class="form-group">
            <label for="address" class="control-label">Address :</label>
            <input id="address" name="address" type="text" class="form-control" placeholder="Your Full Address" required>
        </div>
        <div class="form-group">
            <label for="phone" class="control-label">Phone No :</label>
            <input id="phone" name="phone" type="text" class="form-control" placeholder="+91 5555-555-555" required>
        </div>
        <div class="form-group">
            <button name="submit" class="btn btn-success" type="submit">ADD</button>
            <a href="<?= SC_URL ?>admin/managecustomer" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>