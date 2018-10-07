<div class="wrapper" >
    <div class="container">
        <form name="edit-profile" action="" class="form-horizontal" method="POST" role="form">
            <legend class="page-header">Edit Profile</legend>
            <input type="hidden" name="id" value="<?= $_SESSION['user']->id ?>">
            <div class="form-group">
                <label class="control-label col-md-2">Username :</label>
                <div class="col-md-10">
                    <input name="name" type="text" class="form-control" placeholder="Your Full Name" value="<?= $_SESSION['user']->username ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Name :</label>
                <div class="col-md-10">
                    <input name="name" type="text" class="form-control" placeholder="Your Full Name" value="<?= $_SESSION['user']->name ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Address :</label>
                <div class="col-md-10">
                    <input name="address" type="text" class="form-control" placeholder="Your Full Address" value="<?= $_SESSION['user']->address ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Phone No :</label>
                <div class="col-md-10">
                    <input name="phone" type="text" class="form-control" placeholder="Your Phone No." value="<?= $_SESSION['user']->phone ?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4 col-md-offset-2">
                    <button name="submit" type="submit" class="btn btn-lg btn-success">Update</button>
                    <a href="<?= SC_URL ?>customer/profile" class="btn btn-lg btn-default">cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>