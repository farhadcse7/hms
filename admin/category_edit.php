<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("UPDATE category SET 
                category_name=?
                WHERE category_id=?
            ");
    $q->execute([
        $_POST['category_name'],
        $_REQUEST['id']
    ]);

    $success_message = 'Category is updated successfully!';
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM category WHERE category_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $category_name = $row['category_name'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Category</h1>
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
                        <label for="" class="col-sm-2 control-label">Category Name *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="category_name" value="<?php echo $category_name; ?>">
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