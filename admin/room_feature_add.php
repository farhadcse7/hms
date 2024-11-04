<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    $room_feature_name = strip_tags($_POST['room_feature_name']);
    $room_feature_icon = strip_tags($_POST['room_feature_icon']);

    if ($room_feature_name == '') {
        $valid = 0;
        $error_message .= 'Room Feature Name can not be empty<br>';
    }

    if ($room_feature_icon == '') {
        $valid = 0;
        $error_message .= 'Room Feature Icon can not be empty<br>';
    }

    if ($valid == 1) {
        $q = $pdo->prepare("INSERT INTO room_feature (room_feature_name,room_feature_icon) VALUES (?,?)");
        $q->execute([$room_feature_name, $room_feature_icon]);

        $success_message = 'Room Feature is added successfully!';
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Room Feature</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

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
                                <label for="" class="col-sm-3 control-label">Room Feature Name *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="room_feature_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Room Feature Icon *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="room_feature_icon">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary" name="form1">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once('footer.php'); ?>