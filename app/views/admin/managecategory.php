
		<div class="col-md-10">
			<h2 class="page-header">Manage Categories</h2>
            
            <div class="row">
                <div class="col-md-4" style="padding:20px;border:1px solid #ddd;">
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name of Category, i.e. TV, AC, etc." required>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">ADD NEW</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($data['cat'])): 
                                foreach ($data['cat'] as $category) : ?>
                                <tr>
                                    <td><?= $category->id ?></td>
                                    <td><?= $category->name ?></td>
                                    <td><a href="<?= SC_URL ?>admin/deletecategory?id=<?= $category->id ?>" class="btn btn-delete btn-danger">Delete</a></td>
                                </tr>
                            <?php endforeach;
                            else : ?>
                                <tr><td colspan=6>No device category found</td><tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>