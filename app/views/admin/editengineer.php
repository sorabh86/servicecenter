<div class="container">
    <h2 class="page-header">Edit Engineer</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $data['engineer']->id ?>">
        <div class="form-group">
            <label class="control-label">Name :</label>
            <input name="name" type="text" class="form-control" 
            value="<?= $data['engineer']->name ?>"
            placeholder="Your Full Name" required>
        </div>
        <div class="form-group">
            <label class="control-label">Address :</label>
            <input name="address" type="text" class="form-control" 
            value="<?= $data['engineer']->address ?>"
            placeholder="Your Full Address" required>
        </div>
        <div class="form-group">
            <button name="submit" class="btn btn-success" type="submit">Update</button>
            <a href="<?= SC_URL ?>admin/manageengineer" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>