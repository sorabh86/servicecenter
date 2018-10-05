<div class="container" style="margin-top:40px;margin-bottom:40px">
    <h3 class="page-header">Assign Engineer to Work</h3>
    <form action="" method="POST" role="form">
    
        <div class="form-group">
            <label >Choose an Engineer</label>
            <?php if(isset($data['engineers'])) : ?>
                <select class="form-control" name="engineer_id">
                    <?php foreach($data['engineers'] as $engineer) : ?>
                        <option value="<?= $engineer->id ?>"><?= $engineer->name ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else : ?>
                <div class="alert alert-info">No Enginner found</div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Replace Parts : </label>
            <textarea class="form-control" rowspan="4" ></textarea>
        </div>
            
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="<?= SC_URL ?>admin/managefault" class="btn btn-default">Cancel</a>
    </form>
    
</div>