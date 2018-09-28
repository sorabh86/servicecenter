
<div class="container" style="margin-bottom:40px">
    <a class="btn btn-default btn-back" href="<?= SC_URL ?>customer">back</a>
    <h1 class="page-header">Fault Request <a class="btn btn-primary pull-right" href="<?= SC_URL ?>customer/addfault">Add</a></h1>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Alternative Address</th>
                <th>Alternative Phone</th>
                <th>Status</th>
                <th>Date of Request</th>
                <!-- <th>options</td> -->
            </tr>
        </thead>
        <tbody>
            <?php if(isset($data['faults'])) : 
                foreach($data['faults'] as $fault) : ?>
                <tr>
                    <td><?= $fault->id ?></td>
                    <td><?= $fault->product_name ?> (<a href="<?= SC_URL ?>customer/editdevice?id=<?= $fault->id ?>"><?= $fault->id ?></a>)</td>
                    <td><?= $fault->alternative_address ?></td>
                    <td><?= $fault->alternative_phone ?></td>
                    <td><?= $fault->status ?></td>
                    <td><?= $fault->requested_date ?></td>
                    <!-- <td><a href="">view</a></td> -->
                </tr>
            <?php endforeach;
            else : ?>
                <tr><td class="alert alert-info" colspan=7>No Past Fault Repair Request found.</td><tr> 
            <?php endif; ?>
        </tbody>
    </table>
    
</div>
