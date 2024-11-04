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
            $error_message .= 'Only jpg, png and gif files are allowed for featured photo<br>';
        }
    }


    if ($valid == 1) {

        $q = $pdo->prepare("SHOW TABLE STATUS LIKE 'room'");
        $q->execute();
        $result = $q->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row[10];
        }

        if ($mime == 'image/jpeg') {
            $ext = 'jpg';
        } elseif ($mime == 'image/png') {
            $ext = 'png';
        } elseif ($mime == 'image/gif') {
            $ext = 'gif';
        }

        $final_name = 'room_' . $ai_id . '.' . $ext;
        move_uploaded_file($path_tmp, '../uploads/' . $final_name);

        $q = $pdo->prepare("INSERT INTO room (
                        room_name,
                        room_short_description,
                        room_description,
                        room_featured_photo,
                        room_overview,
                        room_facility,
                        room_price,
                        room_type_id
                    ) VALUES (?,?,?,?,?,?,?,?)");
        $q->execute([$_POST['room_name'], $_POST['room_short_description'], $_POST['room_description'], $final_name, $_POST['room_overview'], $_POST['room_facility'], $_POST['room_price'], $_POST['room_type_id']]);


        if (isset($_POST['room_feature_ids'])) {
            foreach ($_POST['room_feature_ids'] as $value) {
                $q = $pdo->prepare("INSERT INTO room_room_feature (
                                room_id,
                                room_feature_id
                            ) 
                            VALUES (?,?)");
                $q->execute([$ai_id, $value]);
            }
        }



        $success_message = 'Room is added successfully!';
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Room</h1>
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

                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Room Name *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="room_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Short Description *</label>
                                <div class="col-sm-10">
                                    <textarea name="room_short_description" class="form-control" cols="30" rows="10" style="height:100px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Description *</label>
                                <div class="col-sm-10">
                                    <textarea name="room_description" class="form-control" cols="30" rows="10"></textarea>
                                    <script>
                                        CKEDITOR.replace('room_description');
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Overview *</label>
                                <div class="col-sm-10">
                                    <textarea name="room_overview" class="form-control" cols="30" rows="10"></textarea>
                                    <script>
                                        CKEDITOR.replace('room_overview');
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Facilities *</label>
                                <div class="col-sm-10">
                                    <textarea name="room_facility" class="form-control" cols="30" rows="10"></textarea>
                                    <script>
                                        CKEDITOR.replace('room_facility');
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Featured Photo *</label>
                                <div class="col-sm-10" style="padding-top:5px;">
                                    <input type="file" name="room_featured_photo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Room Price *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="room_price">
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
                                            <option value="<?php echo $row['room_type_id']; ?>"><?php echo $row['room_type_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Select Feature</label>
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
                                    ?>
                                        <input type="checkbox" name="room_feature_ids[]" value="<?php echo $row['room_feature_id']; ?>"> <?php echo $row['room_feature_name']; ?> <br>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
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