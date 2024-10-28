<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    $user_full_name = strip_tags($_POST['user_full_name']);
    $user_email = strip_tags($_POST['user_email']);
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

    if ($valid == 1) {
        $q = $pdo->prepare("UPDATE user SET 
                    user_full_name=?,
                    user_email=?,
                    role_id=?

                    WHERE user_id=?
                ");
        $q->execute([
            $_POST['user_full_name'],
            $_POST['user_email'],
            $_POST['role_id'],
            $_REQUEST['id']
        ]);
    }

    $success_message = 'Information is updated successfully!';
}

if (isset($_POST['form2'])) {

    $valid = 1;

    $password = strip_tags($_POST['password']);
    $re_password = strip_tags($_POST['re_password']);

    if ($password == '') {
        $valid = 0;
        $error_message .= 'Password can not be empty<br>';
    } elseif ($re_password == '') {
        $valid = 0;
        $error_message .= 'Retype Password can not be empty<br>';
    } elseif ($password != $re_password) {
        $valid = 0;
        $error_message .= 'Passwords must match<br>';
    }

    if ($valid == 1) {
        $q = $pdo->prepare("UPDATE user SET 
                user_password=?
                WHERE user_id=?
            ");
        $q->execute([
            md5($_POST['password']),
            $_REQUEST['id']
        ]);

        $success_message = 'Password is updated successfully!';
    }
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM user WHERE user_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $user_full_name = $row['user_full_name'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
    $role_id = $row['role_id'];
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit User</h1>
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
                    <li class="active"><a href="#t_info" data-toggle="tab">Change Data</a></li>
                    <li><a href="#t_pass" data-toggle="tab">Change Password</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="t_info">
                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Full Name *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="user_full_name" value="<?php echo $user_full_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Email Address *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
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
                                            <option value="<?php echo $row['role_id']; ?>" <?php if ($row['role_id'] == $role_id) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo $row['role_name']; ?></option>
                                        <?php
                                        }
                                        ?>
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
                    <div class="tab-pane fade" id="t_pass">
                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">New Password *</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Retype Password *</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="re_password">
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