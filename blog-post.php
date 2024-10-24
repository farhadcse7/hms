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
              <li><a href="blog.html">Blog</a></li>
              <li class="active">Blog Post</li>
            </ol>
            <h1>Blog Post</h1>
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
        <!-- Article -->
        <article>
          <div class="video-format">
            <iframe src="http://player.vimeo.com/video/89409343"></iframe>
          </div>
          <div class="row">
            <div class="col-sm-1 col-xs-2 meta">
              <div class="meta-date"><span>Apr</span>15</div>
            </div>
            <div class="col-sm-11 col-xs-10 meta">
              <h2>This is a video post</h2>
              <span class="meta-author"><i class="fa fa-user"></i><a href="#">Starhotel</a></span> <span class="meta-category"><i class="fa fa-pencil"></i><a href="#">Hotel business</a></span> <span class="meta-comments"><i class="fa fa-comment"></i><a href="#">3 Comments</a></span> </div>
            <div class="col-md-12">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed turpis neque. In auctor, odio eget luctus lobortis, sapien erat blandit felis, eget volutpat augue felis in purus. Aliquam ultricies est id ultricies facilisis. Maecenas tempus... </p>
              <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed feugiat tristique mauris, vitae ultrices mauris ultricies eu. In viverra ut sem eget venenatis. Sed nec ligula non eros ultrices euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget arcu imperdiet, semper dolor in, lacinia augue. Mauris hendrerit vestibulum lorem, non auctor felis dignissim vel. Sed arcu est, posuere pulvinar arcu non, porttitor consequat ligula. Curabitur ac volutpat mauris. Duis pretium commodo accumsan. Nullam ut facilisis velit. </p>
              <blockquote>
                <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante."</em></p>
                <span>John Doe in <cite title="Source Title">CEO Travel</cite></span> </blockquote>
              <p> Donec sit amet urna eu nisi egestas iaculis sed ac massa. Morbi interdum nibh sapien, non fermentum diam laoreet quis. Maecenas congue, nibh id placerat lacinia, nisi felis dictum risus, at commodo nisl quam ac libero. Fusce imperdiet vehicula luctus. Sed at auctor ligula. Phasellus a commodo dui, at iaculis odio. Mauris diam eros, tempor at neque eget, imperdiet facilisis mauris. Donec adipiscing nisi vel nisl tristique fermentum. Quisque ultrices justo vitae massa mollis, eu ultricies tortor varius. Nam auctor viverra sodales. Suspendisse ac lobortis sem. Nunc pretium molestie mauris in aliquet. Sed vitae ante porttitor mi condimentum eleifend. Duis at dictum libero, vel pellentesque enim. </p>
            </div>
          </div>
        </article>
        
        <!-- Blog: Author -->
        <section class="blog-author clearfix">
          <h3>About the author: <span>Gigi Adriano</span></h3>
          <img src="images/blog/author-01.jpg" alt="Author"  class="img-circle"/>
          <p>Proin venenatis, diam in iaculis venenatis, ante lacus dictum dolor, sed laoreet nisl dui vel magna. Cras pulvinar tortor quis dolor viverra vel scelerisque magna suscipit. Maecenas nec placerat augue. Cras feugiat imperdiet nulla ut feugiat. Vestibulum nunc enim, consequat ac euismod vel, commodo eget nulla. Donec augue est, consectetur posuere dapibus non, aliquam tempor ligula. Suspendisse potenti. Cras vel vestibulum dolor L.orem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed turpis neque. In auctor, odio eget luctus lobortis!</p>
        </section>
        
        <!-- Blog: Comments -->
        <section class="comments mt50">
          <div class="blog-comments">
            <h2 class="lined-heading"><span><i class="fa fa-comments"></i>3 Comments</span></h2>
          </div>
          <!-- Comment 1 -->
          <div class="comment"> <a href="#">
            <div class="reply-button"> Reply </div>
            </a>
            <div class="avatar"> <img src="images/blog/comment-01.jpg" alt="comment-01" class="img-circle"/> </div>
            <div class="comment-text">
              <div class="author">
                <div class="name">Grandpa</div>
                <div class="date">Apr 30, 2013 at 3:20 pm</div>
              </div>
              <div class="text">
                <p>Proin venenatis, diam in iaculis venenatis, ante lacus dictum dolor, sed laoreet nisl dui vel magna. Cras pulvinar tortor quis dolor viverra vel scelerisque magna suscipit. </p>
              </div>
            </div>
          </div>
          <!-- Comment 2(Reply) -->
          <div class="reply-line"></div>
          <div class="reply">
            <div class="comment"> <a href="#">
              <div class="reply-button"> Reply </div>
              </a>
              <div class="avatar"> <img src="images/blog/comment-02.jpg" alt="comment-02" class="img-circle"/> </div>
              <div class="comment-text">
                <div class="author">
                  <div class="name">Hoo Lang</div>
                  <div class="date">Apr 30, 2013 at 3:45 pm</div>
                </div>
                <div class="text">
                  <p>Proin venenatis, diam in iaculis venenatis, ante lacus dictum dolor, sed laoreet nisl dui vel magna. Cras pulvinar tortor quis dolor viverra vel scelerisque magna suscipit. </p>
                </div>
              </div>
            </div>
          </div>
          <!-- Comment 3 -->
          <div class="comment"> <a href="#">
            <div class="reply-button"> Reply </div>
            </a>
            <div class="avatar"> <img src="images/blog/comment-03.jpg" alt="comment-03" class="img-circle"/> </div>
            <div class="comment-text">
              <div class="author">
                <div class="name">Gigi Adriano</div>
                <div class="date">Apr 30, 2013 at 3:50 pm</div>
              </div>
              <div class="text">
                <p>Proin venenatis, diam in iaculis venenatis, ante lacus dictum dolor, sed laoreet nisl dui vel magna. Cras pulvinar tortor quis dolor viverra vel scelerisque magna suscipit. </p>
              </div>
            </div>
          </div>
          <!-- Leave comment -->
          <div class="mt50">
            <h3><i class="fa fa-comment"></i> Leave a comment</h3>
            <form role="form" class="mt30">
              <div class="form-group">
                <label for="email">Your Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="name"><span class="required">*</span> Your Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name">
              </div>
              <div class="form-group">
                <label for="comment"><span class="required">*</span> Your comment</label>
                <textarea name="comment" rows="9" id="comment" class="form-control"></textarea>
              </div>
              <button type="submit" class="btn btn-default btn-lg">Post comment</button>
            </form>
          </div>
        </section>
      </div>
    </section>
    
    <!-- Aside -->
    <aside class="mt50">
      <div class="col-md-3"> 
        <!-- Widget: Text -->
        <div class="widget">
          <h3>About our blog</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed turpis neque. In auctor, odio eget luctus lobortis, sapien erat blandit felis, eget volutpat augue felis in purus.</p>
        </div>
        <!-- Widget: Latest news -->
        <div class="widget clearfix">
          <h3>Latest News</h3>
          <ul class="list-unstyled">
            <li>
              <article>
                <div class="news-thumb"> <a href="blog-post.html"><img src="images/blog/blog-sm-1.jpg" alt="Popular news"></a> </div>
                <div class="news-content clearfix">
                  <h4><a href="blog-post.html">This is a video post</a></h4>
                  <span><a href="blog-post.html">April 15 2014</a></span> </div>
              </article>
            </li>
            <li>
              <article>
                <div class="news-thumb"> <a href="blog-post.html"><img src="images/blog/blog-sm-2.jpg" alt="Popular news"></a> </div>
                <div class="news-content clearfix">
                  <h4><a href="blog-post.html">An image post</a></h4>
                  <span><a href="blog-post.html">April 14 2014</a></span> </div>
              </article>
            </li>
            <li>
              <article>
                <div class="news-thumb"> <a href="blog-post.html"><img src="images/blog/blog-sm-3.jpg" alt="Popular news"></a> </div>
                <div class="news-content clearfix">
                  <h4><a href="blog-post.html">Audio included post</a></h4>
                  <span><a href="blog-post.html">April 12 2014</a></span> </div>
              </article>
            </li>
          </ul>
        </div>
        <!-- Widget: Categories -->
        <div class="widget">
          <h3>Category</h3>
          <ul class="list-unstyled arrow">
            <li><a href="#">Rooms <span class="badge pull-right">46</span></a></li>
            <li><a href="#">Media <span class="badge pull-right">11</span></a></li>
            <li><a href="#">Marketing <span class="badge pull-right">42</span></a></li>
          </ul>
        </div>
        <!-- Widget: Tags -->
        <div class="widget">
          <h3>Tags</h3>
          <div class="tags"> <a href="#">HTML</a> <a href="#">CSS</a> <a href="#">Jquery</a> <a href="#">Modern</a> <a href="#">Responsive</a> <a href="#">Wordpress</a> <a href="#">Fun</a> <a href="#">Movies</a> <a href="#">Music</a> <a href="#">Information</a> </div>
        </div>
        <!-- Widget: Archive -->
        <div class="widget">
          <h3>Archive</h3>
          <ul class="list-unstyled arrow">
            <li><a href="#">April 2014 <span class="badge pull-right">15</span></a></li>
            <li><a href="#">May 2014 <span class="badge pull-right">9</span></a></li>
            <li><a href="#">February 2014 <span class="badge pull-right">3</span></a></li>
            <li><a href="#">January 2014 <span class="badge pull-right">5</span></a></li>
          </ul>
        </div>
      </div>
    </aside>
  </div>
</div>

<?php require_once('footer.php'); ?>