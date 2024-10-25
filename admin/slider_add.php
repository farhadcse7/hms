<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;
    $path = $_FILES['slider_photo']['name'];
    $path_tmp = $_FILES['slider_photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if ($mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif') {
            $valid = 0;
            $error_message .= 'Only jpg, png and gif files are allowed for slider photo<br>';
        }
    }

    if ($valid == 1) {
        //for image name - auto increment serial number set
        $q = $pdo->prepare("SHOW TABLE STATUS LIKE 'slider'");
        $q->execute();
        $result = $q->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row[10];
        }

        $slider_title = $_POST['slider_title'];
        $slider_subtitle = $_POST['slider_subtitle'];
        $slider_button_text = $_POST['slider_button_text'];
        $slider_button_url = $_POST['slider_button_url'];

        //echo $mime;
        if ($mime == 'image/jpeg') {
            $ext = 'jpg';
        } elseif ($mime == 'image/png') {
            $ext = 'png';
        } elseif ($mime == 'image/gif') {
            $ext = 'gif';
        }

        $final_name = 'slider_' . $ai_id . '.' . $ext;
        move_uploaded_file($path_tmp, '../uploads/' . $final_name);

        $q = $pdo->prepare("INSERT INTO slider (slider_title,slider_subtitle,slider_button_text,slider_button_url,slider_photo) VALUES (?,?,?,?,?)");
        $q->execute([$slider_title, $slider_subtitle, $slider_button_text, $slider_button_url, $final_name]);
        $success_message = 'Slider is added successfully!';
    }
}

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Slider</h1>
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
                                <label for="" class="col-sm-2 control-label">Slider Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slider_title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Slider SubTitle</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slider_subtitle">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Slider Button Text</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slider_button_text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Slider Button URL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slider_button_url">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Slider Photo *</label>
                                <div class="col-sm-10" style="padding-top: 5px;">
                                    <input type="file" name="slider_photo">
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
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php require_once('footer.php'); ?>