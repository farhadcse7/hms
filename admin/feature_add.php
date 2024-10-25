<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    $feature_title = strip_tags($_POST['feature_title']);
    $feature_text = strip_tags($_POST['feature_text']);
    $feature_icon = strip_tags($_POST['feature_icon']);

    if ($feature_title == '') {
        $valid = 0;
        $error_message .= 'Title can not be empty<br>';
    }
    if ($feature_text == '') {
        $valid = 0;
        $error_message .= 'Text can not be empty<br>';
    }
    if ($feature_icon == '') {
        $valid = 0;
        $error_message .= 'Icon can not be empty<br>';
    }

    if ($valid == 1) {
        $q = $pdo->prepare("INSERT INTO feature (feature_title,feature_text,feature_icon) VALUES (?,?,?)");
        $q->execute([$feature_title, $feature_text, $feature_icon]);

        $_SESSION['temp_success'] = 'Feature is added successfully!';
        header('location: feature_add.php');
        exit;
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Feature</h1>
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
                        // if($success_message)
                        // {
                        //     echo '<div class="alert alert-success">'.$success_message.'</div>';
                        // }

                        //echo $_SESSION['temp_success'];

                        if (isset($_SESSION['temp_success'])) {
                            echo '<div class="alert alert-success">' . $_SESSION['temp_success'] . '</div>';
                            unset($_SESSION['temp_success']);
                        }
                        ?>

                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Feature Title *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="feature_title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Feature Text *</label>
                                <div class="col-sm-10">
                                    <textarea name="feature_text" class="form-control" cols="30" rows="10" style="height:100px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Feature Icon *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="feature_icon">
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