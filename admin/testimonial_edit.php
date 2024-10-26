<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE testimonial SET 
                person_name_designation=?, 
                person_comment=?

                WHERE testimonial_id=?
            ");
    $q->execute([
        $_POST['person_name_designation'],
        $_POST['person_comment'],
        $_REQUEST['id']
    ]);

    $success_message = 'Testimonial Information is updated successfully!';
}



if (isset($_POST['form2'])) {

    $valid = 1;

    $current_photo = $_POST['current_photo'];

    $path = $_FILES['person_photo']['name'];
    $path_tmp = $_FILES['person_photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if ($mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif') {
            $valid = 0;
            $error_message .= 'Only jpg, png and gif files are allowed for testimonial photo<br>';
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
        $final_name = 'testimonial_' . $_REQUEST['id'] . '.' . $ext;
        //move_uploaded_file($path_tmp, '../uploads/'.$final_name);

        $source_image = $path_tmp;
        $destination = '../uploads/' . $final_name;
        image_handler($path_tmp, $destination, 100, 100, 100);

        $q = $pdo->prepare("UPDATE testimonial SET 
                person_photo=?
                WHERE testimonial_id=?
            ");
        $q->execute([
            $final_name,
            $_REQUEST['id']
        ]);

        $success_message = 'Person Photo is updated successfully!';
    }
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM testimonial WHERE testimonial_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $person_name_designation = $row['person_name_designation'];
    $person_comment = $row['person_comment'];
    $person_photo = $row['person_photo'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Testimonial</h1>
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
                    <li><a href="#t_photo" data-toggle="tab">Photo</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="t_info">

                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Name and Designation *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="person_name_designation" value="<?php echo $person_name_designation; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Comment *</label>
                                <div class="col-sm-9">
                                    <textarea name="person_comment" class="form-control" cols="30" rows="10" style="height: 100px;"><?php echo $person_comment; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary" name="form1">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="t_photo">

                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="current_photo" value="<?php echo $person_photo; ?>">

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Existing Photo</label>
                                <div class="col-sm-10">
                                    <img src="../uploads/<?php echo $person_photo; ?>" style="width:100px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Change Photo *</label>
                                <div class="col-sm-10" style="padding-top:5px;">
                                    <input type="file" name="person_photo">
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