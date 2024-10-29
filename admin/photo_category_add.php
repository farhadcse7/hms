<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    $photo_category_name = strip_tags($_POST['photo_category_name']);

    if ($photo_category_name == '') {
        $valid = 0;
        $error_message .= 'Photo Category Name can not be empty<br>';
    }

    if ($valid == 1) {
        $q = $pdo->prepare("INSERT INTO photo_category (photo_category_name) VALUES (?)");
        $q->execute([$photo_category_name]);

        $success_message = 'Photo Category is added successfully!';
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Photo Category</h1>
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

                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Photo Category Name *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="photo_category_name">
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