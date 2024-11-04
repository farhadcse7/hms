<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE room_feature SET 
                room_feature_name=?,
                room_feature_icon=?
                WHERE room_feature_id=?
            ");
    $q->execute([
        $_POST['room_feature_name'],
        $_POST['room_feature_icon'],
        $_REQUEST['id']
    ]);

    $success_message = 'Room Feature is updated successfully!';
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM room_feature WHERE room_feature_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $room_feature_name = $row['room_feature_name'];
    $room_feature_icon = $row['room_feature_icon'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Room Type</h1>
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
                        <label for="" class="col-sm-2 control-label">Room Feature Name *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="room_feature_name" value="<?php echo $room_feature_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Room Feature Icon *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="room_feature_icon" value="<?php echo $room_feature_icon; ?>">
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