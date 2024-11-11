<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $q = $pdo->prepare("INSERT INTO language (lang_code,lang_name,lang_default) VALUES (?,?,?)");
    $q->execute([$_POST['lang_code'], $_POST['lang_name'], '']);

    $q = $pdo->prepare("SELECT * FROM feature_language WHERE lang_code=?");
    $q->execute(['en']);
    $res = $q->fetchAll();
    foreach ($res as $row) {
        $arr1[] = $row['feature_id'];
        $arr2[] = $row['feature_title'];
        $arr3[] = $row['feature_text'];
    }

    for ($i = 0; $i < count($arr1); $i++) {
        $q = $pdo->prepare("INSERT INTO feature_language (
                    feature_id,
                    lang_code,
                    feature_title,
                    feature_text
                ) 
                VALUES (?,?,?,?)");
        $q->execute([
            $arr1[$i],
            $_POST['lang_code'],
            $arr2[$i],
            $arr3[$i]
        ]);
    }

    $success_message = 'Language is added successfully!';
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Language</h1>
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
                                <label for="" class="col-sm-2 control-label">Lang Name *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lang_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Lang Code *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lang_code">
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