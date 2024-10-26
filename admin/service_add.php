<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    $service_title = strip_tags($_POST['service_title']);
    $service_text = $_POST['service_text'];

    if ($service_title == '') {
        $valid = 0;
        $error_message .= 'Title can not be empty<br>';
    }
    if ($service_text == '') {
        $valid = 0;
        $error_message .= 'Text can not be empty<br>';
    }

    if ($valid == 1) {
        $q = $pdo->prepare("INSERT INTO service (service_title,service_text) VALUES (?,?)");
        $q->execute([$service_title, $service_text]);

        $_SESSION['temp_success'] = 'Service is added successfully!';
        header('location: service_add.php');
        exit;
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Service</h1>
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
                                <label for="" class="col-sm-2 control-label">Service Title *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="service_title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Service Text *</label>
                                <div class="col-sm-10">
                                    <textarea name="service_text" class="form-control" cols="30" rows="10" style="height:100px;"></textarea>
                                    <script>
                                        CKEDITOR.replace('service_text');
                                    </script>
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