<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE service SET 
                service_title=?, 
                service_text=?
                WHERE service_id=?
            ");
    $q->execute([
        $_POST['service_title'],
        $_POST['service_text'],
        $_REQUEST['id']
    ]);

    $success_message = 'Service Information is updated successfully!';
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM service WHERE service_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $service_title = $row['service_title'];
    $service_text = $row['service_text'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Service</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">

                <?php
                if ($error_message) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                }
                if ($success_message) {
                    echo '<div class="alert alert-success">' . $success_message . '</div>';
                }
                ?>

                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Service Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="service_title" value="<?php echo $service_title; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Service Text</label>
                        <div class="col-sm-10">
                            <textarea name="service_text" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $service_text; ?></textarea>
                            <script>
                                CKEDITOR.replace('service_text');
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" name="form1">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

<?php require_once('footer.php'); ?>