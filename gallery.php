<?php require_once('header.php'); ?>

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
              <li class="active">Gallery</li>
            </ol>
            <h1>Gallery</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Filter -->
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-pills" id="filters">
        <!-- All tabs (category name show here) -->
        <li class="active"><a href="#" data-filter="*">All</a></li>
        <?php
        $q = $pdo->prepare("SELECT * FROM photo_category ORDER BY photo_category_id ASC");
        $q->execute();
        $res = $q->fetchAll();
        foreach ($res as $row) {
        ?>
          <li><a href="#" data-filter=".cat<?php echo $row['photo_category_id']; ?>"><?php echo $row['photo_category_name']; ?></a></li>
        <?php
        }
        ?>

        <!-- <li><a href="#" data-filter=".rooms">Rooms</a></li>
        <li><a href="#" data-filter=".restaurant">Restaurant</a></li>
        <li><a href="#" data-filter=".pool">Swimming Pool</a></li>
        <li><a href="#" data-filter=".business">Business</a></li> -->
      </ul>
    </div>
  </div>
</div>

<!-- Gallery (images show here)-->
<section id="gallery" class="mt50">
  <div class="container">
    <div class="row gallery">
      <?php
      $q = $pdo->prepare("SELECT * FROM photo ORDER BY photo_id ASC");
      $q->execute();
      $res = $q->fetchAll();
      foreach ($res as $row) {
      ?>
        <div class="col-sm-3 cat<?php echo $row['photo_category_id']; ?> fadeIn appear" data-start="200"> <a href="uploads/<?php echo $row['photo_name']; ?>" data-rel="prettyPhoto[gallery1]"><img src="uploads/<?php echo $row['photo_name']; ?>" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<?php require_once('footer.php'); ?>