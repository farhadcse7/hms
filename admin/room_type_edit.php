<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE room_type SET 
                room_type_name=?
                WHERE room_type_id=?
            ");
    $q->execute([
        $_POST['room_type_name'],
        $_REQUEST['id']
    ]);

    $success_message = 'Room Type is updated successfully!';
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM room_type WHERE room_type_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $room_type_name = $row['room_type_name'];
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
                        <label for="" class="col-sm-2 control-label">Room Type Name *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="room_type_name" value="<?php echo $room_type_name; ?>">
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