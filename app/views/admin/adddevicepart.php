<div class="container" style="margin-bottom:40px">
    <h2 class="page-heading">Add Device Part</h2>
    
    <form action="" method="POST" role="form">
        <input name="service_id" type="hidden" value="<?= $_GET['id'] ?>">
        <div class="form-group">
            <label>Part Name:</label>
            <input name="part_name" type="text" class="form-control" placeholder="Part Name" required>
        </div>
        <div class="form-group">
            <label>Part Description:</label>
            <input name="description" type="text" class="form-control" placeholder="Description for part, reasoning for change" required>
        </div>
        <div class="form-group">
            <label>Price (Rs):</label>
            <input name="price" type="text" class="form-control" placeholder="100.00" required>
        </div>
    
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        <a href="<?= SC_URL ?>admin/viewfault?id=<?= $_GET['id'] ?>" class="btn btn-default">Cancel</a>
    </form>
</div>