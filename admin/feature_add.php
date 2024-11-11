<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    foreach ($_POST['lang_code'] as $val) {
        $arr1[] = $val;
    }

    foreach ($_POST['feature_title'] as $val) {
        $arr2[] = $val;
    }

    foreach ($_POST['feature_text'] as $val) {
        $arr3[] = $val;
    }

    $q = $pdo->prepare("SHOW TABLE STATUS LIKE 'feature'");
    $q->execute();
    $result = $q->fetchAll();
    foreach ($result as $row) {
        $ai_id = $row[10];
    }

    $q = $pdo->prepare("INSERT INTO feature (feature_icon) VALUES (?)");
    $q->execute([$_POST['feature_icon']]);

    for ($i = 0; $i < count($arr1); $i++) {
        $q = $pdo->prepare("INSERT INTO feature_language (feature_id,lang_code,feature_title,feature_text) VALUES (?,?,?,?)");
        $q->execute([$ai_id, $arr1[$i], $arr2[$i], $arr3[$i]]);
    }

    $success_message = 'Feature is added successfully!';
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
                        if ($success_message) {
                            echo '<div class="alert alert-success">' . $success_message . '</div>';
                        }
                        ?>

                        <form class="form-horizontal" action="" method="post">

                            <?php
                            $q = $pdo->prepare("SELECT * FROM language ORDER BY lang_id ASC");
                            $q->execute();
                            $res = $q->fetchAll();
                            foreach ($res as $row) {
                            ?>
                                <h4 style="font-weight:bold;color:blue;">Language: <?php echo $row['lang_name']; ?></h4>
                                <input type="hidden" name="lang_code[]" value="<?php echo $row['lang_code']; ?>">
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Feature Title *</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="feature_title[]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Feature Text *</label>
                                    <div class="col-sm-10">
                                        <textarea name="feature_text[]" class="form-control" cols="30" rows="10" style="height:100px;"></textarea>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <h4 style="font-weight:bold;color:blue;">For All Language</h4>
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