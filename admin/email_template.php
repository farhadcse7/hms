<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE email_template SET 
                et_content=?
                WHERE et_id=?
            ");
    $q->execute([
        $_POST['et_content'],
        1
    ]);

    $success_message = 'Content is updated successfully!';
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM email_template WHERE et_id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $et_content = $row['et_content'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Email Template</h1>
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

                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Email Template Content *</label>
                        <div class="col-sm-10">
                            <textarea name="et_content" class="form-control" cols="30" rows="10"><?php echo $et_content; ?></textarea>
                            <small>
                                Subscriber Name: {{subscriber_name}} <br>
                                Post URL: {{post_url}}
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" name="form1">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

<?php require_once('footer.php'); ?>