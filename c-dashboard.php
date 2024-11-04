<?php require_once('header.php'); ?>

<?php
if (!isset($_SESSION['customer'])) {
  header('location: login.php');
  exit;
}
?>

<!-- Parallax Effect -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#parallax-pagetitle').parallax("50%", -0.55);
  });
</script>

<section class="parallax-effect">
  <div id="parallax-pagetitle" style="background-image: url(images/parallax/parallax-01.jpg);">
    <div class="color-overlay">
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li class="active">Customer Dashboard</li>
            </ol>
            <h1>Customer Dashboard</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row">

    <section class="contact-details">
      <div class="col-md-3">
        <h2 class="lined-heading  mt50"></h2>
        <!-- Panel -->
        <div class="panel panel-default text-center">
          <div class="panel-body">
            <?php require_once('c-sidebar.php'); ?>
          </div>
        </div>
      </div>
    </section>


    <section id="contact-form" class="mt50">
      <div class="col-md-9">
        <h2>Welcome to our dashboard</h2>
      </div>
    </section>
  </div>
</div>


<?php require_once('footer.php'); ?>