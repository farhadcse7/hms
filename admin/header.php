<?php
ob_start();
session_start();
require_once('db.php');
$error_message = '';
$success_message = '';
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

						<li><a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>

						<!--					<li><a href="table.php"><i class="fa fa-table fa-fw"></i> Tables</a></li>-->
						<!--					<li><a href="form.php"><i class="fa fa-edit fa-fw"></i> Forms</a></li>-->
						<!--					<li><a href="tab.php"><i class="fa fa-edit fa-fw"></i> Tab</a></li>-->
						<!--					<li>-->
						<!--						<a href=-->
						<!--						   <a href="#">Second Level Item</a>-->
						<!--						"#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>-->
						<!--						<ul class="nav nav-second-level">-->
						<!--							<li></li>-->
						<!--							<li>-->
						<!--								<a href="#">Second Level Item</a>-->
						<!--							</li>-->
						<!--							<li>-->
						<!--								<a href="#">Third Level <span class="fa arrow"></span></a>-->
						<!--								<ul class="nav nav-third-level">-->
						<!--									<li>-->
						<!--										<a href="#">Third Level Item</a>-->
						<!--									</li>-->
						<!--									<li>-->
						<!--										<a href="#">Third Level Item</a>-->
						<!--									</li>-->
						<!--									<li>-->
						<!--										<a href="#">Third Level Item</a>-->
						<!--									</li>-->
						<!--									<li>-->
						<!--										<a href="#">Third Level Item</a>-->
						<!--									</li>-->
						<!--								</ul>-->
						<!--							</li>-->
						<!--						</ul>-->
						<!--					</li>-->
						<li>
							<a href="#"><i class="fa fa-files-o fa-fw"></i>Slider<span class="fa arrow"></span></a>
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
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>

		<div id="page-wrapper">