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
              <li class="active">Blog</li>
            </ol>
            <h1>Blog</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row"> 
    <!-- Blog -->
    <section class="blog mt50">
      <div class="col-md-9"> 
       
        <article> <a href="blog-post.html" class="mask"><img src="images/blog/slide2.jpg" alt="image" class="img-responsive zoom-img"></a>
          <div class="row">
            <div class="col-sm-1 col-xs-2 meta">
              <div class="meta-date"><span>Apr</span>14</div>
            </div>
            <div class="col-sm-11 col-xs-10 meta">
              <h2><a href="blog-post.html">An image post</a></h2>
              <span class="meta-author"><i class="fa fa-user"></i><a href="#">Starhotel</a></span> <span class="meta-category"><i class="fa fa-pencil"></i><a href="#">Hotel business</a></span> <span class="meta-comments"><i class="fa fa-comment"></i><a href="#">3 Comments</a></span>
              <p class="intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed turpis neque. In auctor, odio eget luctus lobortis, sapien erat blandit felis, eget volutpat augue felis in purus. Aliquam ultricies est id ultricies facilisis. Maecenas tempus... </p>
              <a href="blog-post.html" class="btn btn-primary pull-right">Read More</a> </div>
          </div>
        </article>


        <article> <a href="blog-post.html" class="mask"><img src="images/blog/slide2.jpg" alt="image" class="img-responsive zoom-img"></a>
          <div class="row">
            <div class="col-sm-1 col-xs-2 meta">
              <div class="meta-date"><span>Apr</span>14</div>
            </div>
            <div class="col-sm-11 col-xs-10 meta">
              <h2><a href="blog-post.html">An image post</a></h2>
              <span class="meta-author"><i class="fa fa-user"></i><a href="#">Starhotel</a></span> <span class="meta-category"><i class="fa fa-pencil"></i><a href="#">Hotel business</a></span> <span class="meta-comments"><i class="fa fa-comment"></i><a href="#">3 Comments</a></span>
              <p class="intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed turpis neque. In auctor, odio eget luctus lobortis, sapien erat blandit felis, eget volutpat augue felis in purus. Aliquam ultricies est id ultricies facilisis. Maecenas tempus... </p>
              <a href="blog-post.html" class="btn btn-primary pull-right">Read More</a> </div>
          </div>
        </article>

       
        <!-- Pagination -->
        <div class="text-center mt50">
          <ul class="pagination clearfix">
            <li class="disabled"><a href="#">«</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">»</a></li>
          </ul>
        </div>

        
      </div>
    </section>
    
    <!-- Aside -->
    <aside class="mt50"> 
      <!-- Widget: Text -->
      <div class="col-md-3">
        <?php require_once('sidebar.php'); ?>        
      </div>

    </aside>
  </div>
</div>


<?php require_once('footer.php'); ?>