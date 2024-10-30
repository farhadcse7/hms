<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    if ($_POST['post_title'] == '') {
        $valid = 0;
        $error_message .= 'Title can not be empty<br>';
    }

    if ($_POST['post_short_description'] == '') {
        $valid = 0;
        $error_message .= 'Short Description can not be empty<br>';
    }

    if ($_POST['post_description'] == '') {
        $valid = 0;
        $error_message .= 'Description can not be empty<br>';
    }

    if ($_POST['post_date'] == '') {
        $valid = 0;
        $error_message .= 'Date can not be empty<br>';
    }

    if ($valid == 1) {

        $day = substr($_POST['post_date'], 0, 2);
        $month = substr($_POST['post_date'], 3, 2);
        $year = substr($_POST['post_date'], 6, 4);

        $q = $pdo->prepare("UPDATE post SET 
                post_title=?, 
                post_short_description=?, 
                post_description=?,
                post_day=?,
                post_month=?,
                post_year=?
                WHERE post_id=?
            ");
        $q->execute([
            $_POST['post_title'],
            $_POST['post_short_description'],
            $_POST['post_description'],
            $day,
            $month,
            $year,
            $_REQUEST['id']
        ]);

        $success_message = 'Post Information is updated successfully!';
    }
}

//category form
if (isset($_POST['form2'])) {
    $valid = 1;

    if (!isset($_POST['category_ids'])) {
        $valid = 0;
        $error_message .= 'You must have to select a category<br>';
    }

    if ($valid == 1) {
        //remove existing category_id row data from post_category
        $q = $pdo->prepare("DELETE FROM post_category WHERE post_id=?");
        $q->execute([$_REQUEST['id']]);
        //insert category_id and post_id into post_category
        foreach ($_POST['category_ids'] as $value) {
            $q = $pdo->prepare("INSERT INTO post_category (
                            post_id,
                            category_id
                        ) 
                        VALUES (?,?)");
            $q->execute([$_REQUEST['id'], $value]);
        }
    }
}

//tag form
if (isset($_POST['form3'])) {
    if (isset($_POST['tag_names'])) {
        foreach ($_POST['tag_names'] as $value) {
            $q = $pdo->prepare("INSERT INTO post_tag (
                            post_id,
                            tag_name
                        ) 
                        VALUES (?,?)");
            $q->execute([$_REQUEST['id'], $value]);
        }
    }
}


//image form
if (isset($_POST['form4'])) {

    $valid = 1;

    $current_photo = $_POST['current_photo'];

    $path = $_FILES['post_photo']['name'];
    $path_tmp = $_FILES['post_photo']['tmp_name'];

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
        $final_name = 'post_' . $_REQUEST['id'] . '.' . $ext;
        move_uploaded_file($path_tmp, '../uploads/' . $final_name);

        $q = $pdo->prepare("UPDATE post SET 
                post_photo=?
                WHERE post_id=?
            ");
        $q->execute([
            $final_name,
            $_REQUEST['id']
        ]);

        $success_message = 'Post Photo is updated successfully!';
    }
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM post WHERE post_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $post_title = $row['post_title'];
    $post_short_description = $row['post_short_description'];
    $post_description = $row['post_description'];
    $post_photo = $row['post_photo'];
    $post_day = $row['post_day'];
    $post_month = $row['post_month'];
    $post_year = $row['post_year'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Post</h1>
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
                    <li><a href="#t_cats" data-toggle="tab">Categories</a></li>
                    <li><a href="#t_tags" data-toggle="tab">Tags</a></li>
                    <li><a href="#t_photo" data-toggle="tab">Photo</a></li>
                </ul>

                <!-- Information form  -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="t_info">
                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Post Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Post Short Description</label>
                                <div class="col-sm-10">
                                    <textarea name="post_short_description" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $post_short_description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Post Description</label>
                                <div class="col-sm-10">
                                    <textarea name="post_description" class="form-control" cols="30" rows="10"><?php echo $post_description; ?></textarea>
                                    <script>
                                        CKEDITOR.replace('post_description');
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Post Date</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="post_date" id="datepicker" value="<?php echo $post_day . '-' . $post_month . '-' . $post_year; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="form1">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- category form  -->
                    <div class="tab-pane fade" id="t_cats">
                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Select Category</label>
                                <div class="col-sm-10">
                                    <?php
                                    $q = $pdo->prepare("
                                                SELECT * 
                                                FROM category
                                                ORDER BY category_name ASC
                                            ");
                                    $q->execute();
                                    $res = $q->fetchAll();
                                    foreach ($res as $row) {
                                        $r = $pdo->prepare("
                                                    SELECT * 
                                                    FROM post_category 
                                                    WHERE post_id=? AND category_id=?
                                                ");
                                        $r->execute([
                                            $_REQUEST['id'],
                                            $row['category_id']
                                        ]);
                                        $total = $r->rowCount();
                                    ?>
                                        <input type="checkbox" name="category_ids[]" value="<?php echo $row['category_id']; ?>"
                                            <?php if ($total) {
                                                echo 'checked';
                                            } ?>> <?php echo $row['category_name']; ?> <br>
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

                    <!-- tag form  -->
                    <div class="tab-pane fade" id="t_tags">
                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Tags</label>
                                <div class="col-sm-8">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Tag Name</td>
                                            <td>Action</td>
                                        </tr>
                                        <?php
                                        $q = $pdo->prepare("
                                                   SELECT * 
                                                   FROM post_tag 
                                                   WHERE post_id=?
                                               ");
                                        $q->execute([
                                            $_REQUEST['id']
                                        ]);
                                        $res = $q->fetchAll();
                                        foreach ($res as $row) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['tag_name']; ?></td>
                                                <td><a href="post_tag_delete.php?id=<?php echo $row['post_tag_id']; ?>&id1=<?php echo $row['post_id']; ?>" class="btn btn-sm btn-danger" onClick="return confirm('Are you sure?');">X</a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>

                                    <select name="tag_names[]" class="form-control our-tag" multiple style="width:100%;">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    <button type="submit" class="btn btn-primary" name="form3">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- photo form  -->
                    <div class="tab-pane fade" id="t_photo">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="current_photo" value="<?php echo $post_photo; ?>">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Existing Photo</label>
                                <div class="col-sm-10">
                                    <img src="../uploads/<?php echo $post_photo; ?>" style="width:200px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Change Photo *</label>
                                <div class="col-sm-10" style="padding-top:5px;">
                                    <input type="file" name="post_photo">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="form4">Update</button>
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