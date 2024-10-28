<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    $role_name = strip_tags($_POST['role_name']);

    if ($role_name == '') {
        $valid = 0;
        $error_message .= 'Role Name can not be empty<br>';
    }

    if ($valid == 1) {
        $q = $pdo->prepare("SHOW TABLE STATUS LIKE 'role'");
        $q->execute();
        $result = $q->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row[10];
        }

        $q = $pdo->prepare("INSERT INTO role (role_name) VALUES (?)");
        $q->execute([$role_name]);

        $q = $pdo->prepare("SELECT * FROM pages ORDER BY page_id ASC");
        $q->execute();
        $res = $q->fetchAll();
        foreach ($res as $row) {
            //$page_ids[] = $row['page_id'];
            $r = $pdo->prepare("INSERT INTO role_access (role_id,page_id,access_status) 
                    VALUES (?,?,?)");
            $r->execute([$ai_id, $row['page_id'], 0]);
        }

        $success_message = 'Role is added successfully!';
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Role</h1>
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
                                <label for="" class="col-sm-2 control-label">Role Name *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="role_name">
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