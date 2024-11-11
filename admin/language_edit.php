<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE language SET 
                lang_name=?, 
                lang_code=?
                WHERE lang_id=?
            ");
    $q->execute([
        $_POST['lang_name'],
        $_POST['lang_code'],
        $_REQUEST['id']
    ]);

    $q = $pdo->prepare("UPDATE feature_language SET
                lang_code=?
                WHERE lang_code=?
            ");
    $q->execute([
        $_POST['lang_code'],
        $_POST['current_lang_code']
    ]);

    $success_message = 'Language is updated successfully!';
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM language WHERE lang_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $lang_name = $row['lang_name'];
    $lang_code = $row['lang_code'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Language</h1>
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
                    <input type="hidden" name="current_lang_code" value="<?php echo $lang_code; ?>">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Language Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="lang_name" value="<?php echo $lang_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Language Code</label>
                        <div class="col-sm-10">
                            <textarea name="lang_code" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $lang_code; ?></textarea>
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