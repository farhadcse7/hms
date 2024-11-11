<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE settings SET 
                top_bar_email=?, 
                top_bar_phone=?,
                top_bar_show=?
                WHERE id=?
            ");
    $q->execute([
        $_POST['top_bar_email'],
        $_POST['top_bar_phone'],
        $_POST['top_bar_show'],
        1
    ]);

    $success_message = 'Top Bar Settings is updated successfully!';
}

if (isset($_POST['form2'])) {

    $q = $pdo->prepare("UPDATE settings SET 
                footer_address=?,
                footer_phone=?,
                footer_email=?, 
                footer_website=?, 
                footer_copyright=?,
                footer_how_many_post=?               
                WHERE id=?
            ");
    $q->execute([
        $_POST['footer_address'],
        $_POST['footer_phone'],
        $_POST['footer_email'],
        $_POST['footer_website'],
        $_POST['footer_copyright'],
        $_POST['footer_how_many_post'],
        1
    ]);

    $success_message = 'Footer Settings is updated successfully!';
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM settings WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $top_bar_email = $row['top_bar_email'];
    $top_bar_phone = $row['top_bar_phone'];
    $top_bar_show = $row['top_bar_show'];
    $footer_address = $row['footer_address'];
    $footer_phone = $row['footer_phone'];
    $footer_email = $row['footer_email'];
    $footer_website = $row['footer_website'];
    $footer_copyright = $row['footer_copyright'];
    $footer_how_many_post = $row['footer_how_many_post'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Settings</h1>
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
                    <li class="active"><a href="#t_info" data-toggle="tab">Top Bar</a></li>
                    <li><a href="#t_photo" data-toggle="tab">Footer</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="t_info">

                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Top Bar Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="top_bar_email" value="<?php echo $top_bar_email; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Top Bar Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="top_bar_phone" value="<?php echo $top_bar_phone; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Top Bar Show?</label>
                                <div class="col-sm-2">
                                    <select name="top_bar_show" class="form-control">
                                        <option value="Yes" <?php if ($top_bar_show == 'Yes') {
                                                                echo 'selected';
                                                            } ?>>Yes</option>
                                        <option value="No" <?php if ($top_bar_show == 'No') {
                                                                echo 'selected';
                                                            } ?>>No</option>
                                    </select>
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

                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea name="footer_address" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $footer_address; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="footer_phone" value="<?php echo $footer_phone; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="footer_email" value="<?php echo $footer_email; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Website</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="footer_website" value="<?php echo $footer_website; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Copyright</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="footer_copyright" value="<?php echo $footer_copyright; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">How many post?</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="footer_how_many_post" value="<?php echo $footer_how_many_post; ?>">
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