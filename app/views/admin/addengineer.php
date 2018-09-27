<div class="container">
    <h2 class="page-header">Add Engineer</h2>
    <form name="engineer-form" action="" method="POST">
        <div class="form-group">
            <label class="control-label">Name :</label>
            <input name="name" type="text" class="form-control" placeholder="Your Full Name" required>
        </div>
        <div class="form-group">
            <label class="control-label">Address :</label>
            <input name="address" type="text" class="form-control" placeholder="Your Full Address" required>
        </div>
        <div class="form-group">
            <label class="control-label">Expert In :</label>
            <div class="alert alert-warning skill-notice hide">
                Please check atleast one skill for engineer
            </div>
            <?php if(isset($data['cat']) && count($data['cat'])>0) : 
                foreach($data['cat'] as $category): ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="expertise[]" value="<?= $category->id ?>"> <?= $category->name ?>
                    </label> 
                </div>
            <?php endforeach; 
            else : ?>
                <p class="alert alert-info">You didn't add any product categories in admin area</p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <button name="submit" class="btn btn-success" type="submit">ADD</button>
            <a href="<?= SC_URL ?>admin/manageengineer" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>