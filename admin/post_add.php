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

    if (!isset($_POST['category_ids'])) {
        $valid = 0;
        $error_message .= 'You must have to select a category<br>';
    }

    if ($valid == 1) {

        $q = $pdo->prepare("SHOW TABLE STATUS LIKE 'post'");
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

        $day = substr($_POST['post_date'], 0, 2);
        $month = substr($_POST['post_date'], 3, 2);
        $year = substr($_POST['post_date'], 6, 4);

        $final_name = 'post_' . $ai_id . '.' . $ext;
        move_uploaded_file($path_tmp, '../uploads/' . $final_name);

        $q = $pdo->prepare("INSERT INTO post (
                        post_title,
                        post_short_description,
                        post_description,
                        post_photo,
                        post_day,
                        post_month,
                        post_year,
                        total_view,
                        user_id
                    ) VALUES (?,?,?,?,?,?,?,?,?)");
        $q->execute([$_POST['post_title'], $_POST['post_short_description'], $_POST['post_description'], $final_name, $day, $month, $year, 0, $_SESSION['user']['user_id']]);

        foreach ($_POST['category_ids'] as $value) {
            $q = $pdo->prepare("INSERT INTO post_category (
                            post_id,
                            category_id
                        ) 
                        VALUES (?,?)");
            $q->execute([$ai_id, $value]);
        }

        //for tag -different approach where name exists
        if (count($_POST['tag_names']) > 0) {
            foreach ($_POST['tag_names'] as $value) {
                $q = $pdo->prepare("INSERT INTO post_tag (
                                post_id,
                                tag_name
                            ) 
                            VALUES (?,?)");
                $q->execute([$ai_id, $value]);
            }
        }

        //send mail when a new post added
        $q = $pdo->prepare("SELECT * FROM email_template WHERE et_id=?");
        $q->execute([1]);
        $res = $q->fetchAll();
        foreach ($res as $row) {
            $et_content = $row['et_content'];
        }

        require_once('../mail/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        try {
            // $mail->SMTPSecure = "ssl";
            // $mail->IsSMTP();
            // $mail->SMTPAuth   = true;
            // $mail->Host       = 'business32.web-hosting.com';
            // $mail->Port       = '465';
            // $mail->Username   = 'usa@commercialcleaningjanitorialserviceslosangeles.com';
            // $mail->Password   = '63@n6#3)W.G%';
            // $mail->addReplyTo('noreply@yourwebsite.com');
            // $mail->setFrom('usa@commercialcleaningjanitorialserviceslosangeles.com');

            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'miafm6@gmail.com';
            $mail->Password   = 'upakmuzjkyztaytz';
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            // Email headers and addresses
            $mail->setFrom('miafm6@gmail.com', 'HMS');
            $mail->addReplyTo('noreply@yourwebsite.com');

            $mail->isHTML(true);
            $mail->Subject = 'New Post is Added';

            $q = $pdo->prepare("SELECT * FROM subscriber WHERE s_active=?");
            $q->execute([1]);
            $res = $q->fetchAll();
            foreach ($res as $row) {

                $mail2 = clone $mail;
                $s_name = $row['s_name'];
                $s_email = $row['s_email'];

                $post_link = '<a href="' . SITE_URL . 'blog-detail.php?id=' . $ai_id . '">Click here</a>';

                // $a_message = '';
                // $a_message .= 'Hi '.$s_name.',<br>';
                // $a_message .= 'A new post is added to our website. Please click on the link below:<br>';
                // $a_message .= $post_link;
                // $a_message .= '<br>Thank you!<br>ABC Company';

                $a_message = str_replace('{{subscriber_name}}', $s_name, $et_content);
                $a_message = str_replace('{{post_url}}', $post_link, $a_message);

                $mail2->MsgHTML(nl2br($a_message));
                $mail2->addAddress($s_email);
                $mail2->send();
            }
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        $success_message = 'Post is added successfully!';
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Post</h1>
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
                                <label for="" class="col-sm-2 control-label">Post Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="post_title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Post Short Description</label>
                                <div class="col-sm-10">
                                    <textarea name="post_short_description" class="form-control" cols="30" rows="10" style="height:100px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Post Description</label>
                                <div class="col-sm-10">
                                    <textarea name="post_description" class="form-control" cols="30" rows="10"></textarea>
                                    <script>
                                        CKEDITOR.replace('post_description');
                                    </script>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Post Photo *</label>
                                <div class="col-sm-10" style="padding-top:5px;">
                                    <input type="file" name="post_photo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Post Date</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="post_date" id="datepicker">
                                </div>
                            </div>
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
                                    ?>
                                        <input type="checkbox" name="category_ids[]" value="<?php echo $row['category_id']; ?>"> <?php echo $row['category_name']; ?> <br>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Tags</label>
                                <div class="col-sm-8">
                                    <!-- <input type="text" class="form-control our-tag" name="tag_names[]"> -->
                                    <select name="tag_names[]" class="form-control our-tag" multiple>

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