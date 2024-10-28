<?php
ob_start();
session_start();
require_once('db.php');
require_once('functions.php');
$error_message = '';
$success_message = '';
?>

<?php
if (isset($_POST['form_login'])) {
	if ($_POST['user_email'] == '' || $_POST['user_password'] == '') {
		$error_message = 'Please give the correct email and password';
	} else {
		$q = $pdo->prepare("
					SELECT * 
					FROM user 
					WHERE user_email=?
				");
		$q->execute([$_POST['user_email']]);
		$res = $q->fetchAll();
		$total = $q->rowCount();

		if ($total) {
			foreach ($res as $row) {
				$stored_password = $row['user_password'];
			}

			if (md5($_POST['user_password']) == $stored_password) {
				// Everything is fine!
				$_SESSION['user'] = $row;

				header('location: index.php');
				exit;
			} else {
				$error_message = 'Please give the correct email and password';
			}
		} else {
			$error_message = 'Please give the correct email and password';
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SB Admin 2 - Bootstrap Admin Theme</title>

	<!-- Bootstrap Core CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="assets/css/metisMenu.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="assets/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign In</h3>
					</div>
					<div class="panel-body">

						<?php
						if ($error_message) {
							echo '<div class="alert alert-danger">' . $error_message . '</div>';
						}
						?>

						<form role="form" action="" method="post">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Email Address" name="user_email" type="email" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="user_password" type="password">
								</div>
								<input type="submit" class="btn btn-lg btn-success btn-block" value="Login" name="form_login">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="assets/js/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="assets/js/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="assets/js/sb-admin-2.js"></script>

</body>

</html>