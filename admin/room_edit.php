<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    if ($_POST['room_name'] == '') {
        $valid = 0;
        $error_message .= 'Room Name can not be empty<br>';
    }

    if ($_POST['room_short_description'] == '') {
        $valid = 0;
        $error_message .= 'Short Description can not be empty<br>';
    }

    if ($_POST['room_description'] == '') {
        $valid = 0;
        $error_message .= 'Description can not be empty<br>';
    }

    if ($_POST['room_facility'] == '') {
        $valid = 0;
        $error_message .= 'Facility can not be empty<br>';
    }

    if ($_POST['room_overview'] == '') {
        $valid = 0;
        $error_message .= 'Overview can not be empty<br>';
    }

    if ($_POST['room_price'] == '') {
        $valid = 0;
        $error_message .= 'Room Price can not be empty<br>';
    }

    if ($_POST['room_total'] == '') {
        $valid = 0;
        $error_message .= 'Room Total can not be empty<br>';
    }

    if ($valid == 1) {

        $q = $pdo->prepare("UPDATE room SET 
                room_name=?, 
                room_short_description=?, 
                room_description=?,
                room_overview=?,
                room_facility=?,
                room_price=?,
                room_total=?,
                room_show_on_home=?,
                room_type_id=?
                WHERE room_id=?
            ");
        $q->execute([
            $_POST['room_name'],
            $_POST['room_short_description'],
            $_POST['room_description'],
            $_POST['room_overview'],
            $_POST['room_facility'],
            $_POST['room_price'],
            $_POST['room_total'],
            $_POST['room_show_on_home'],
            $_POST['room_type_id'],
            $_REQUEST['id']
        ]);

        $success_message = 'Room Information is updated successfully!';
    }
}


if (isset($_POST['form2'])) {
    $valid = 1;

    if ($valid == 1) {
        if (isset($_POST['room_feature_ids'])) {
            $q = $pdo->prepare("DELETE FROM room_room_feature WHERE room_id=?");
            $q->execute([$_REQUEST['id']]);

            foreach ($_POST['room_feature_ids'] as $value) {
                $q = $pdo->prepare("INSERT INTO room_room_feature (
                                room_id,
                                room_feature_id
                            ) 
                            VALUES (?,?)");
                $q->execute([$_REQUEST['id'], $value]);
            }
        }
    }
}


if (isset($_POST['form3'])) {

    $valid = 1;

    $current_photo = $_POST['current_photo'];

    $path = $_FILES['room_featured_photo']['name'];
    $path_tmp = $_FILES['room_featured_photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if ($mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif') {
            $valid = 0;
            $error_message .= 'Only jpg, png and gif files are allowed for post photo<br>';
        }
    }

    if ($valid == 1) {
        if ($mime == 'image/jpeg') {
            $ext = 'jpg';
        } elseif ($mime == 'image/png') {
            $ext = 'png';
        } elseif ($mime == 'image/gif') {
            $ext = 'gif';
        }


        unlink('../uploads/' . $current_photo);
        $final_name = 'room_' . $_REQUEST['id'] . '.' . $ext;
        move_uploaded_file($path_tmp, '../uploads/' . $final_name);

        $q = $pdo->prepare("UPDATE room SET 
                room_featured_photo=?
                WHERE room_id=?
            ");
        $q->execute([
            $final_name,
            $_REQUEST['id']
        ]);

        $success_message = 'Room Featured Photo is updated successfully!';
    }
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM room WHERE room_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $room_name = $row['room_name'];
    $room_short_description = $row['room_short_description'];
    $room_description = $row['room_description'];
    $room_featured_photo = $row['room_featured_photo'];
    $room_overview = $row['room_overview'];
    $room_facility = $row['room_facility'];
    $room_price = $row['room_price'];
    $room_total = $row['room_total'];
    $room_show_on_home = $row['room_show_on_home'];
    $room_type_id = $row['room_type_id'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Room</h1>
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

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#t_info" data-toggle="tab">Information</a></li>
                    <li><a href="#t_feature" data-toggle="tab">Features</a></li>
                    <li><a href="#t_photo" data-toggle="tab">Photo</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="t_info">

                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Room Name *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="room_name" value="<?php echo $room_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Short Description *</label>
                                <div class="col-sm-10">
                                    <textarea name="room_short_description" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $room_short_description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Description *</label>
                                <div class="col-sm-10">
                                    <textarea name="room_description" class="form-control" cols="30" rows="10"><?php echo $room_description; ?></textarea>
                                    <script>
                                        CKEDITOR.replace('room_description');
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Overview *</label>
                                <div class="col-sm-10">
                                    <textarea name="room_overview" class="form-control" cols="30" rows="10"><?php echo $room_overview; ?></textarea>
                                    <script>
                                        CKEDITOR.replace('room_overview');
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Facilities *</label>
                                <div class="col-sm-10">
                                    <textarea name="room_facility" class="form-control" cols="30" rows="10"><?php echo $room_facility; ?></textarea>
                                    <script>
                                        CKEDITOR.replace('room_facility');
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Room Price *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="room_price" value="<?php echo $room_price; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Room Total *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="room_total" value="<?php echo $room_total; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Room Show on home? *</label>
                                <div class="col-sm-10">
                                    <select name="room_show_on_home" class="form-control">
                                        <option value="No" <?php if ($room_show_on_home == 'No') {
                                                                echo 'selected';
                                                            } ?>>No</option>
                                        <option value="Yes" <?php if ($room_show_on_home == 'Yes') {
                                                                echo 'selected';
                                                            } ?>>Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Room Type *</label>
                                <div class="col-sm-10">
                                    <select name="room_type_id" class="form-control">
                                        <?php
                                        $q = $pdo->prepare("
                                                SELECT * 
                                                FROM room_type
                                                ORDER BY room_type_id ASC
                                            ");
                                        $q->execute();
                                        $res = $q->fetchAll();
                                        foreach ($res as $row) {
                                        ?>
                                            <option value="<?php echo $row['room_type_id']; ?>" <?php if ($room_type_id == $row['room_type_id']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row['room_type_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="form1">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="t_feature">

                        <form class="form-horizontal" action="" method="post">

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Select Room Features</label>
                                <div class="col-sm-10">
                                    <?php
                                    $q = $pdo->prepare("
                                                SELECT * 
                                                FROM room_feature
                                                ORDER BY room_feature_id ASC
                                            ");
                                    $q->execute();
                                    $res = $q->fetchAll();
                                    foreach ($res as $row) {
                                        $r = $pdo->prepare("
                                                    SELECT * 
                                                    FROM room_room_feature 
                                                    WHERE room_id=? AND room_feature_id=?
                                                ");
                                        $r->execute([
                                            $_REQUEST['id'],
                                            $row['room_feature_id']
                                        ]);
                                        $total = $r->rowCount();
                                    ?>
                                        <input type="checkbox" name="room_feature_ids[]" value="<?php echo $row['room_feature_id']; ?>" <?php if ($total) {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>> <?php echo $row['room_feature_name']; ?> <br>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="form2">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>


                    <div class="tab-pane fade" id="t_photo">

                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="current_photo" value="<?php echo $room_featured_photo; ?>">

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Existing Photo</label>
                                <div class="col-sm-10">
                                    <img src="../uploads/<?php echo $room_featured_photo; ?>" style="width:200px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Change Photo *</label>
                                <div class="col-sm-10" style="padding-top:5px;">
                                    <input type="file" name="room_featured_photo">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="form3">Update</button>
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