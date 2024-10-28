<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    $user_full_name = strip_tags($_POST['user_full_name']);
    $user_email = strip_tags($_POST['user_email']);
    $user_password = strip_tags($_POST['user_password']);
    $role_id = strip_tags($_POST['role_id']);

    if ($user_full_name == '') {
        $valid = 0;
        $error_message .= 'Full Name can not be empty<br>';
    }

    if ($user_email == '') {
        $valid = 0;
        $error_message .= 'Email Address can not be empty<br>';
    } else {
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $valid = 0;
            $error_message .= 'Email Address is invalid<br>';
        }
    }

    if ($user_password == '') {
        $valid = 0;
        $error_message .= 'Password can not be empty<br>';
    }


    if ($valid == 1) {
        $q = $pdo->prepare("INSERT INTO user (
                    user_full_name,
                    user_email,
                    user_password,
                    user_hash,
                    role_id
                ) 
                VALUES (?,?,?,?,?)");
        $q->execute([
            $user_full_name,
            $user_email,
            md5($user_password),
            '',
            $role_id
        ]);

        $success_message = 'User is added successfully!';
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add User</h1>
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
                                <label for="" class="col-sm-2 control-label">Full Name *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="user_full_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Email Address *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="user_email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Password *</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="user_password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Select Role *</label>
                                <div class="col-sm-10">
                                    <select name="role_id" class="form-control">
                                        <?php
                                        $q = $pdo->prepare("
                                                    SELECT * 
                                                    FROM role
                                                    WHERE role_id != ? AND role_id != ?
                                                    ORDER BY role_id ASC
                                                ");
                                        $q->execute([1, 2]);
                                        $res = $q->fetchAll();
                                        foreach ($res as $row) {
                                        ?>
                                            <option value="<?php echo $row['role_id']; ?>"><?php echo $row['role_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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