<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

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
        //image name's id use
        $q = $pdo->prepare("SHOW TABLE STATUS LIKE 'photo'");
        $q->execute();
        $result = $q->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row[10];
        }

        $photo_category_id = $_POST['photo_category_id'];

        //echo $mime;
        if ($mime == 'image/jpeg') {
            $ext = 'jpg';
        } elseif ($mime == 'image/png') {
            $ext = 'png';
        } elseif ($mime == 'image/gif') {
            $ext = 'gif';
        }

        $final_name = 'gallery_photo_' . $ai_id . '.' . $ext;
        move_uploaded_file($path_tmp, '../uploads/' . $final_name);

        $q = $pdo->prepare("INSERT INTO photo (photo_name,photo_category_id) VALUES (?,?)");
        $q->execute([$final_name, $photo_category_id]);

        $success_message = 'Photo is added successfully!';
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Photo</h1>
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
                                <label for="" class="col-sm-2 control-label">Select Photo *</label>
                                <div class="col-sm-10" style="padding-top:5px;">
                                    <input type="file" name="photo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Select Photo Category *</label>
                                <div class="col-sm-10">
                                    <select name="photo_category_id" class="form-control">
                                        <?php
                                        $q = $pdo->prepare("
                                                    SELECT * 
                                                    FROM photo_category 
                                                    ORDER BY photo_category_id ASC
                                                ");
                                        $q->execute();
                                        $res = $q->fetchAll();
                                        foreach ($res as $row) {
                                        ?>
                                            <option value="<?php echo $row['photo_category_id']; ?>"><?php echo $row['photo_category_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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