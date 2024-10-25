<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE feature SET 
                feature_title=?, 
                feature_text=?, 
                feature_icon=?
                WHERE feature_id=?
            ");
    $q->execute([
        $_POST['feature_title'],
        $_POST['feature_text'],
        $_POST['feature_icon'],
        $_REQUEST['id']
    ]);

    $success_message = 'Feature Information is updated successfully!';
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM feature WHERE feature_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $feature_title = $row['feature_title'];
    $feature_text = $row['feature_text'];
    $feature_icon = $row['feature_icon'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Slider</h1>
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
                        <label for="" class="col-sm-2 control-label">Feature Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="feature_title" value="<?php echo $feature_title; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Feature Text</label>
                        <div class="col-sm-10">
                            <textarea name="feature_text" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $feature_text; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Feature Icon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="feature_icon" value="<?php echo $feature_icon; ?>">
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