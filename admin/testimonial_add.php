<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    $person_name_designation = $_POST['person_name_designation'];
    $person_comment = $_POST['person_comment'];

    $path = $_FILES['person_photo']['name'];
    $path_tmp = $_FILES['person_photo']['tmp_name'];

    if ($person_name_designation == '') {
        $valid = 0;
        $error_message .= 'Name and Designation can not be empty<br>';
    }

    if ($person_comment == '') {
        $valid = 0;
        $error_message .= 'Comment can not be empty<br>';
    }

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

        $q = $pdo->prepare("SHOW TABLE STATUS LIKE 'testimonial'");
        $q->execute();
        $result = $q->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row[10];
        }


        //echo $mime;
        if ($mime == 'image/jpeg') {
            $ext = 'jpg';
        } elseif ($mime == 'image/png') {
            $ext = 'png';
        } elseif ($mime == 'image/gif') {
            $ext = 'gif';
        }

        $final_name = 'person_' . $ai_id . '.' . $ext;
        //move_uploaded_file($path_tmp, '../uploads/'.$final_name);

        $source_image = $path_tmp;
        $destination = '../uploads/' . $final_name;
        //functions called from functions.php file and resized image
        image_handler($path_tmp, $destination, 100, 100, 100);


        $q = $pdo->prepare("INSERT INTO testimonial (person_name_designation,person_comment,person_photo) VALUES (?,?,?)");
        $q->execute([$person_name_designation, $person_comment, $final_name]);

        $success_message = 'Testimonial is added successfully!';
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Testimonial</h1>
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
                                <label for="" class="col-sm-4 control-label">Name and Designation *</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="person_name_designation">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Person Comment *</label>
                                <div class="col-sm-8">
                                    <textarea name="person_comment" class="form-control" cols="30" rows="10" style="height: 100px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Photo *</label>
                                <div class="col-sm-8" style="padding-top:5px;">
                                    <input type="file" name="person_photo">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
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