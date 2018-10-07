<div class="wrapper">
    <div class="container">
        <form name="change-password" action="" class="form-horizontal" method="POST" role="form">
            <legend class="page-header">Edit Profile</legend>
            <input type="hidden" name="id" value="<?= $_SESSION['user']->id ?>">
            <div class="form-group">
                <label class="control-label col-md-2">New Password :</label>
                <div class="col-md-10">
                    <input id="password" name="password" type="password" class="form-control" placeholder="New Password" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Confirm Password :</label>
                <div class="col-md-10">
                    <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" required>
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