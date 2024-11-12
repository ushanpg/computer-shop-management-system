<?php
include("header.php");
$data = unserialize(base64_decode($_REQUEST['data']));
?>

<div class="container topMargin">
    <div class="card pb-3">
        <div class="card-body">
            <h4 class="card-title mb-5"><?php echo ($data['title']) ?></h4>
            <p><?php echo ($data['msg']) ?></p>
            <?php
            if ($data['btn1']) { ?>
                <a class="btn btn-primary mb-3" href="<?php echo ($data['btn1']['action']) ?>"><?php echo ($data['btn1']['name']) ?></a>
            <?php }
            ?>
            <br />
            <a class="btn btn-success mb-3" href="../index.php">Go Home|^^|</a>
        </div>
    </div>
</div>