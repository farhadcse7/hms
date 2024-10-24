<?php require_once('header.php'); ?>

<!-- Parallax Effect -->
<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>

<section class="parallax-effect">
  <div id="parallax-pagetitle" style="background-image: url(images/parallax/parallax-01.jpg);">
    <div class="color-overlay"> 
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="index.html">Home</a></li>
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
        <li class="active"><a href="#" data-filter="*">All</a></li>
        <li><a href="#" data-filter=".rooms">Rooms</a></li>
        <li><a href="#" data-filter=".restaurant">Restaurant</a></li>
        <li><a href="#" data-filter=".pool">Swimming Pool</a></li>
        <li><a href="#" data-filter=".business">Business</a></li>
      </ul>
    </div>
  </div>
</div>

<!-- Gallery -->
<section id="gallery" class="mt50">
  <div class="container">
    <div class="row gallery"> 
      <!-- Image 1 -->
      <div class="col-sm-3 restaurant fadeIn appear" data-start="200"> <a href="images/gallery/1.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/1.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 2 -->
      <div class="col-sm-3 pool fadeIn appear" data-start="200"> <a href="images/gallery/2.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/2.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 3 -->
      <div class="col-sm-3 restaurant fadeIn appear" data-start="200"> <a href="images/gallery/3.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/3.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 4 -->
      <div class="col-sm-3 pool fadeIn appear" data-start="200"> <a href="images/gallery/4.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/4.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 5 -->
      <div class="col-sm-3 business fadeIn appear" data-start="200"> <a href="images/gallery/5.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/5.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 6 -->
      <div class="col-sm-3 pool fadeIn appear" data-start="200"> <a href="images/gallery/6.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/6.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 7 -->
      <div class="col-sm-3 business fadeIn appear" data-start="200"> <a href="images/gallery/7.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/7.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 8 -->
      <div class="col-sm-3 pool fadeIn appear" data-start="200"> <a href="images/gallery/8.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/8.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 1 -->
      <div class="col-sm-3 restaurant fadeIn appear" data-start="200"> <a href="images/gallery/9.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/9.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 2 -->
      <div class="col-sm-3 pool fadeIn appear" data-start="200"> <a href="images/gallery/10.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/10.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 3 -->
      <div class="col-sm-3 rooms fadeIn appear" data-start="200"> <a href="images/gallery/11.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/11.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <!-- Image 4 -->
      <div class="col-sm-3 pool fadeIn appear" data-start="200"> <a href="images/gallery/12.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/12.jpg" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
    </div>
  </div>
</section>

<?php require_once('footer.php'); ?>