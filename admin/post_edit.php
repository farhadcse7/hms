<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE slider SET 
                slider_title=?, 
                slider_subtitle=?, 
                slider_button_text=?,
                slider_button_url=?
                WHERE slider_id=?
            ");
    $q->execute([
        $_POST['slider_title'],
        $_POST['slider_subtitle'],
        $_POST['slider_button_text'],
        $_POST['slider_button_url'],
        $_REQUEST['id']
    ]);

    $success_message = 'Slider Information is updated successfully!';
}



if (isset($_POST['form2'])) {

    $valid = 1;

    $current_photo = $_POST['current_photo'];

    $path = $_FILES['slider_photo']['name'];
    $path_tmp = $_FILES['slider_photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if ($mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif') {
            $valid = 0;
            $error_message .= 'Only jpg, png and gif files are allowed for slider photo<br>';
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
        $final_name = 'slider_' . $_REQUEST['id'] . '.' . $ext;
        move_uploaded_file($path_tmp, '../uploads/' . $final_name);

        $q = $pdo->prepare("UPDATE slider SET 
                slider_photo=?
                WHERE slider_id=?
            ");
        $q->execute([
            $final_name,
            $_REQUEST['id']
        ]);

        $success_message = 'Slider Photo is updated successfully!';
    }
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM slider WHERE slider_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $slider_title = $row['slider_title'];
    $slider_subtitle = $row['slider_subtitle'];
    $slider_button_text = $row['slider_button_text'];
    $slider_button_url = $row['slider_button_url'];
    $slider_photo = $row['slider_photo'];
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

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#t_info" data-toggle="tab">Information</a></li>
                    <li><a href="#t_photo" data-toggle="tab">Photo</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="t_info">

                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Slider Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slider_title" value="<?php echo $slider_title; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Slider SubTitle</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slider_subtitle" value="<?php echo $slider_subtitle; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Slider Button Text</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slider_button_text" value="<?php echo $slider_button_text; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Slider Button URL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slider_button_url" value="<?php echo $slider_button_url; ?>">
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

                            <input type="hidden" name="current_photo" value="<?php echo $slider_photo; ?>">

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Existing Photo</label>
                                <div class="col-sm-10">
                                    <img src="../uploads/<?php echo $slider_photo; ?>" style="width:200px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Change Photo *</label>
                                <div class="col-sm-10" style="padding-top:5px;">
                                    <input type="file" name="slider_photo">
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