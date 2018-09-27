<div class="wrapper">
    <div class="container">
        <div class="panel panel-primary col-md-6 col-md-offset-3">
            <div class="panel-header">
                <h2 class="text-center panel-heading">Admin Login</h2>
            </div>
            <div class="panel-body">
                <?php if(isset($data['error'])): ?>
                    
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?= $data['error'] ?>
                    </div>
                    
                <?php endif; ?>
                <form method="POST" class="">
                    <div class="form-group">
                        <label for="username" class="control-label">Username :</label>
                        <input class="form-control" type="text" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password :</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <button class="col-md-offset-4 col-md-4 btn btn-primary btn-lg" type="submit">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .wrapper {
        padding:60px;
    }
</style>