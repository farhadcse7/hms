<?php
ob_start();
session_start();
require_once('db.php');
require_once('functions.php');
$error_message = '';
$success_message = '';

if (!isset($_SESSION['user'])) {
	header('location: login.php');
	exit;
}


if ($_SESSION['user']['role_id'] != 1 && $_SESSION['user']['role_id'] != 2):

	$q = $pdo->prepare("
			SELECT * 
			FROM role_access t1
			JOIN pages t2
			ON t1.page_id = t2.page_id
			WHERE t1.role_id=?
		");
	$q->execute([
		$_SESSION['user']['role_id']
	]);
	$res = $q->fetchAll();

	$page_names = array();
	foreach ($res as $row) {
		if ($row['access_status'] == 1) {
			$page_names[] = $row['page_name'];
		}
	}

	$cur_page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

	if ($cur_page == 'feature_view.php' || $cur_page == 'feature_edit.php') {
		if (in_array('feature_view.php', $page_names) || in_array('feature_edit.php', $page_names)) {
		} else {
			header('location: logout.php');
			exit;
		}
	}

/* only giving user based access for pages -use it when need. */
// if (!in_array($cur_page, $page_names)) {
// 	header('location: logout.php');
// 	exit;
// }

endif;


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

	<!-- DataTables CSS -->
	<link href="assets/css/dataTables.bootstrap.css" rel="stylesheet">

	<!-- DataTables Responsive CSS -->
	<link href="assets/css/dataTables.responsive.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="assets/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- select2  -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
	<!-- jquery date picker  -->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- CKeditor  -->
	<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

</head>

<body>

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Admin Panel</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<li>
					Logged in as <?php echo $_SESSION['user']['user_full_name']; ?>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
						</li>
						<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">

						<!-- for developer and admin access -->
						<?php if ($_SESSION['user']['role_id'] == 1 || $_SESSION['user']['role_id'] == 2): ?>
							<li><a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> Sliders<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="slider_add.php">Add Slider</a></li>

									<li><a href="slider_view.php">View Sliders</a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> Features<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="feature_add.php">Add Feature</a></li>
									<li><a href="feature_view.php">View Features</a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> Testimonials<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="testimonial_add.php">Add Testimonial</a></li>
									<li><a href="testimonial_view.php">View Testimonials</a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> Service<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="service_add.php">Add Service</a></li>
									<li><a href="service_view.php">View Services</a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> Gallery<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="photo_category_add.php">Add Photo Category</a></li>
									<li><a href="photo_category_view.php">View Photo Categories</a></li>
									<li><a href="photo_add.php">Add Photo</a></li>
									<li><a href="photo_view.php">View Photos</a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> Blog / Post<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="category_add.php">Add Category</a></li>
									<li><a href="category_view.php">View Categories</a></li>
									<li><a href="post_add.php">Add Post</a></li>
									<li><a href="post_view.php">View Posts</a></li>
								</ul>
							</li>
						<?php endif; ?>

						<!-- for other access -->
						<?php if ($_SESSION['user']['role_id'] != 1 && $_SESSION['user']['role_id'] != 2): ?>

							<?php if (in_array('index.php', $page_names)): ?>
								<li><a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
							<?php endif; ?>

							<?php if (in_array('slider_add.php', $page_names) || in_array('slider_view.php', $page_names)): ?>
								<li>
									<a href="#"><i class="fa fa-files-o fa-fw"></i> Sliders<span class="fa arrow"></span></a>
									<ul class="nav nav-second-level">

										<?php if (in_array('slider_add.php', $page_names)): ?>
											<li><a href="slider_add.php">Add Slider</a></li>
										<?php endif; ?>

										<?php if (in_array('slider_view.php', $page_names)): ?>
											<li><a href="slider_view.php">View Sliders</a></li>
										<?php endif; ?>
									</ul>
								</li>
							<?php endif; ?>

							<?php if (in_array('feature_add.php', $page_names) || in_array('feature_view.php', $page_names)): ?>
								<li>
									<a href="#"><i class="fa fa-files-o fa-fw"></i> Features<span class="fa arrow"></span></a>
									<ul class="nav nav-second-level">

										<?php if (in_array('feature_add.php', $page_names)): ?>
											<li><a href="feature_add.php">Add Feature</a></li>
										<?php endif; ?>

										<?php if (in_array('feature_view.php', $page_names) || in_array('feature_edit.php', $page_names) || in_array('feature_delete.php', $page_names)): ?>
											<li><a href="feature_view.php">View Features</a></li>
										<?php endif; ?>

									</ul>
								</li>
							<?php endif; ?>

							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> Testimonials<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="testimonial_add.php">Add Testimonial</a></li>
									<li><a href="testimonial_view.php">View Testimonials</a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> Service<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="service_add.php">Add Service</a></li>
									<li><a href="service_view.php">View Services</a></li>
								</ul>
							</li>

						<?php endif; ?>

						<!-- for developer access only -->
						<?php if ($_SESSION['user']['role_id'] == 1): ?>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> Role Settings<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="role_add.php">Add Role</a></li>
									<li><a href="role_view.php">View Roles</a></li>
								</ul>
							</li>
						<?php endif; ?>

						<!-- for developer and admin access -->
						<?php if ($_SESSION['user']['role_id'] == 1 || $_SESSION['user']['role_id'] == 2): ?>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i> User Settings<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="user_add.php">Add User</a></li>
									<li><a href="user_view.php">View Users</a></li>
								</ul>
							</li>
						<?php endif; ?>

					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>

		<div id="page-wrapper">