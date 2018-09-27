<div class="wrapper parallax-01">
    <div class="container register">
        <div class="row">
            <div class="panel panel-danger col-md-8 col-md-offset-2">
                <div class="panel-header">
                    <h1 class="title">Register</h1>
                </div>
                <div class="panel-body">
                    <?php if(isset($data['error'])) : ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?= $data['error'] ?>
                        </div>
                    <?php endif; ?>
                    <form name="customer-register" action="" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="username" class="control-label col-md-3">Username :</label>
                            <div class="col-md-9">
                            <input name="username" type="text" class="form-control" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-md-3">Password :</label>
                            <div class="col-md-9">
                            <input name="password" type="password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label col-md-3">Name :</label>
                            <div class="col-md-9">
                            <input id="name" name="name" type="text" class="form-control" placeholder="Your Full Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-md-3">Address :</label>
                            <div class="col-md-9">
                            <input id="address" name="address" type="text" class="form-control" placeholder="Your Full Address" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label col-md-3">Phone No :</label>
                            <div class="col-md-9">
                            <input id="phone" name="phone" type="text" class="form-control" placeholder="+91 5555-555-555" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button name="submit" class="btn btn-success btn-lg col-md-4 col-md-offset-4 btn-border-success" type="submit">Register</button>
                        </div>
                    </form>
                    <div class="already-mem">
                        <h4 style="text-align:center">Already a member ? 
                            <a href="<?= SC_URL ?>customer/login" class="btn btn-lg btn-primary btn-border-primary">login</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
