<?php
ob_start();
session_start();
require_once('admin/db.php');
require_once('admin/functions.php');
$error_message = '';
$success_message = '';
?>
<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <title>Starhotel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="shortcut icon" href="favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/owl.theme.css">
  <link rel="stylesheet" href="css/prettyPhoto.css">
  <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.4.custom.min.css">
  <link rel="stylesheet" href="rs-plugin/css/settings.css">
  <link rel="stylesheet" href="css/theme.css">
  <link rel="stylesheet" href="css/colors/turquoise.css" id="switch_style">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600,700">

  <!-- Javascripts -->
  <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-hover-dropdown.min.js"></script>
  <script src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript" src="js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
  <script type="text/javascript" src="js/jquery.nicescroll.js"></script>
  <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
  <script type="text/javascript" src="js/jquery.forms.js"></script>
  <script type="text/javascript" src="js/jquery.sticky.js"></script>
  <script type="text/javascript" src="js/waypoints.min.js"></script>
  <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
  <script type="text/javascript" src="js/jquery.gmap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>
  <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
  <script type="text/javascript" src="js/switch.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../../www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-50960990-1', 'slashdown.nl');
    ga('send', 'pageview');
  </script>
</head>

<body>

  <!-- Top header -->
  <div id="top-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          <div class="th-text pull-left">
            <div class="th-item"> <a href="#"><i class="fa fa-phone"></i> 05-460789986</a> </div>
            <div class="th-item"> <a href="#"><i class="fa fa-envelope"></i> MAIL@STARHOTEL.COM </a></div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="th-text pull-right">
            <div class="th-item">
              <div class="btn-group">
                <button class="btn btn-default btn-xs dropdown-toggle js-activated" type="button" data-toggle="dropdown"> English <span class="caret"></span> </button>
                <ul class="dropdown-menu">
                  <li> <a href="#">ENGLISH</a> </li>
                  <li> <a href="#">FRANCE</a> </li>
                  <li> <a href="#">GERMAN</a> </li>
                  <li> <a href="#">SPANISH</a> </li>
                </ul>
              </div>
            </div>
            <div class="th-item">
              <div class="social-icons"> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-youtube-play"></i></a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header>
    <!-- Navigation -->
    <div class="navbar yamm navbar-default" id="sticky">
      <div class="container">
        <div class="navbar-header">
          <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a href="index.php" class="navbar-brand">
            <!-- Logo -->
            <div id="logo"> <img id="default-logo" src="images/logo.png" alt="Starhotel" style="height:44px;"> <img id="retina-logo" src="images/logo-retina.png" alt="Starhotel" style="height:44px;"> </div>
          </a>
        </div>
        <div id="navbar-collapse-grid" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown active"> <a href="index.php">Home</a></li>
            <!-- <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated">Rooms<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="room-list.php">Room List View</a></li>
                <li><a href="room-detail.php">Room Detail</a></li>
              </ul>
            </li> -->

            <li><a href="rooms.php">Rooms</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">Contact us</a></li>

            <?php if (!isset($_SESSION['customer'])): ?>
              <li><a href="login.php">Login</a></li>
              <li><a href="registration.php">Sign Up</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['customer'])): ?>
              <li><a href="c-dashboard.php">Dashboard</a></li>
            <?php endif; ?>

            <li><a href="cart.php">View Cart</a></li>

          </ul>
        </div>
      </div>
    </div>
  </header>