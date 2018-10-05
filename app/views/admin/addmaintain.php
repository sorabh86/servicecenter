<div class="container" style="margin-bottom:40px">
    <h1 class="page-header">Add Service</h1>
    <form action="" method="POST" role="form">
        <input type
        <div class="form-group">
            <label>Type :</label>
            <input type="text" name="type" class="form-control" placeholder="Define a type"></textarea>
        </div>
        <div class="form-group">
            <label>Description :</label>
            <textarea name="description" class="form-control" placeholder="Describe those problems"></textarea>
        </div>
        <div class="form-group">
            <label>Price :</label>
            <input type="text" name="price" class="form-control" placeholder="Price Per Year"></textarea>
        </div>
        
        <button name="submit" type="submit" class="btn btn-primary">Add</button>
        <a href="<?= SC_URL ?>admin/managemaintain" class="btn btn-default">cancel</a>
    </form>
</div>