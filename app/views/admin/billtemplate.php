<?php
    $status = $data['status'];
    $service = $data['service'];
    $parts = $data['parts'];
    $page = isset($data['page'])?$data['page']:'viewfault';

    $address = (isset($service->alternative_address) && $service->alternative_address!='')?$service->alternative_address:$service->address;
    $phone = (isset($service->alternative_phone) && $service->alternative_phone!='')?$service->alternative_phone:$service->phone;
    $total = $service->price;
?>
<html>
<head><title>Bill</title></head>
<body style="background:#eee">
    <form name="bill-form" method="POST">
        <div style="margin:auto;width:800px;background:#fff;padding:10px">
            <div style="padding:20px;overflow:hidden">
                <a href="<?= SC_URL ?>admin/<?= $page ?>?id=<?= $_GET['id'] ?>">< go back</a>
                <button name="submit" style="float:right;margin-left:20px">Save Bill</button>
                <button onclick="window.print()" style="float:right;margin-left:20px">print</button>
            </div>
            <table style="width:100%;">
                <tr style="border-bottom:1px solid #ddd;">
                    <td><img height="60" src="<?= SC_URL ?>img/logo.png" alt="Service Center"></td>
                    <td></td>
                    <td align="right">Date : <?= date('Y-m-d') ?></td>
                </tr>
            </table>
            <?php if(isset($status) && $status != 'APPROVED') : ?>
                <p>Bill cannot be generated for non approved service</p>
            <?php else : ?>
                <div style="padding:20px;border:1px solid #ccc;">
                    <div>
                        <strong style="display:inline-block;width:150px;">Name: </strong>
                        <span><?= $service->customer_name ?></span>
                    </div>
                    <div>
                        <strong style="display:inline-block;width:150px;">Address: </strong>
                        <span><?= $address ?></span>
                    </div>
                    <div>
                        <strong style="display:inline-block;width:150px;">Phone: </strong>
                        <span><?= $phone ?></span>
                    </div>
                    <div>
                        <strong style="display:inline-block;width:150px;">Description: </strong>
                        <span><?= $service->description ?></span>
                    </div>
                    <div>
                        <strong style="display:inline-block;width:150px;">Requested Date: </strong>
                        <span><?= $service->requested_date ?></span>
                    </div>
                    <div style="margin-bottom:10px;">
                        <strong style="display:inline-block;width:150px;">Device: </strong>
                        <span><?= $service->device_category_name ?>: <?= $service->brand_name ?> <?= $service->serial_no ?>(<?= $service->date_of_purchase ?>)</span>
                    </div>
                </div>
                <table style="width:100%;padding:10px;">
                    <tr>
                        <td align="right">Service Charge: </td>
                        <td align="center">____________________</td>
                        <td align="right"><?= $service->price ?></td>
                    </tr>
                    <?php if(isset($parts) && !empty($parts)) : 
                    foreach($parts as $part) : ?>
                        <tr>
                            <td align="right"><?= $part->part_name ?></td>
                            <td align="center">____________________</td>
                            <td align="right"><?= $part->price ?></td>
                        </tr>
                    <?php $total += $part->price; 
                        endforeach;  
                    endif; ?>
                    <tr>
                        <td></td>
                        <td align="right"><strong>TOTAL:</strong></td>
                        <td align="right"><strong><?= number_format($total,2,'.','') ?></strong></td>
                    </tr>
                </table>
            <?php endif; ?>
        </div>
    </form>
</body>
</html>