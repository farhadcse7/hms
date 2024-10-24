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
              <li class="active">Registration</li>
            </ol>
            <h1>Registration</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row"> 
    
    <!-- Contact form -->
    <section id="contact-form" class="mt50">
      <div class="col-md-7">
        <form class="clearfix mt50" role="form" method="post" action="">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name"><span class="required">*</span> Email Address</label>
                <input name="name" type="text" id="name" class="form-control" value=""/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="pass"><span class="required">*</span> Password</label>
                <input name="name" type="text" id="pass" class="form-control" value=""/>
              </div>
            </div>
          </div>
          <button type="submit" class="btn  btn-lg btn-primary" name="form_login">Login</button>
        </form>
      </div>
    </section>
  </div>
</div>

<?php require_once('footer.php'); ?>