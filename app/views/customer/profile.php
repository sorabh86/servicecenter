<div class="container">
    <a class="btn btn-default btn-back" href="<?= SC_URL ?>customer"><span class="glyphicon glyphicon-arrow-left"></span> back</a>
    <h1 class="page-header">Your Profile</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>Username:</strong> <?= $_SESSION['user']->username ?></li>
        <li class="list-group-item"><strong>Name:</strong> <?= $_SESSION['user']->name ?></li>
        <li class="list-group-item"><strong>Address:</strong> <?= $_SESSION['user']->address ?></li>
        <li class="list-group-item"><strong>Phone:</strong> <?= $_SESSION['user']->phone ?></li>
        <li class="list-group-item">
            <a href="<?= SC_URL ?>customer/editprofile" class="btn btn-success">Edit Details</a>
            <a href="<?= SC_URL ?>customer/changepassword" class="btn btn-danger">Change Password</a>
        </li>
    </ul>
</div>
