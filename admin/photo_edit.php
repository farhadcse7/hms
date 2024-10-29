<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE photo SET 
                photo_category_id=?
                WHERE photo_id=?
            ");
    $q->execute([
        $_POST['photo_category_id'],
        $_REQUEST['id']
    ]);

    $success_message = 'Photo Category is updated successfully!';
}



if (isset($_POST['form2'])) {

    $valid = 1;

    $current_photo = $_POST['current_photo'];

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if ($mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif') {
            $valid = 0;
            $error_message .= 'Only jpg, png and gif files are allowed for photo<br>';
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
        $final_name = 'gallery_photo_' . $_REQUEST['id'] . '.' . $ext;
        move_uploaded_file($path_tmp, '../uploads/' . $final_name);

        $q = $pdo->prepare("UPDATE photo SET 
                photo_name=?
                WHERE photo_id=?
            ");
        $q->execute([
            $final_name,
            $_REQUEST['id']
        ]);

        $success_message = 'Photo is updated successfully!';
    }
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM photo WHERE photo_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $photo_name = $row['photo_name'];
    $photo_category_id = $row['photo_category_id'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Photo</h1>
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
                    <li class="active"><a href="#t_info" data-toggle="tab">Change Category</a></li>
                    <li><a href="#t_photo" data-toggle="tab">Change Photo</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="t_info">

                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Select Photo Category *</label>
                                <div class="col-sm-10">
                                    <select name="photo_category_id" class="form-control">
                                        <?php
                                        $q = $pdo->prepare("
                                                    SELECT * 
                                                    FROM photo_category
                                                    ORDER BY photo_category_name ASC
                                                ");
                                        $q->execute();
                                        $res = $q->fetchAll();
                                        foreach ($res as $row) {
                                        ?>
                                            <option value="<?php echo $row['photo_category_id']; ?>"
                                                <?php if ($row['photo_category_id'] == $photo_category_id) {
                                                    echo 'selected';
                                                } ?>>
                                                <?php echo $row['photo_category_name']; ?></option>
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
                    <div class="tab-pane fade" id="t_photo">

                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="current_photo" value="<?php echo $photo_name; ?>">

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Existing Photo</label>
                                <div class="col-sm-10">
                                    <img src="../uploads/<?php echo $photo_name; ?>" style="width:200px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Change Photo *</label>
                                <div class="col-sm-10" style="padding-top:5px;">
                                    <input type="file" name="photo">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="form2">Update</button>
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