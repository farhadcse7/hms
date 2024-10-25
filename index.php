<?php require_once('header.php'); ?>

<!-- Revolution Slider -->
<section class="revolution-slider">
  <div class="bannercontainer">
    <div class="banner">
      <ul>
        <?php
        $q = $pdo->prepare("SELECT * FROM slider ORDER BY slider_id ASC");
        $q->execute();
        $res = $q->fetchAll();
        foreach ($res as $row) {
        ?>
          <li data-transition="fade" data-slotamount="7" data-masterspeed="1500">

            <img src="uploads/<?php echo $row['slider_photo']; ?>" style="opacity:0;" alt="slidebg1" data-bgfit="cover" data-bgposition="left bottom" data-bgrepeat="no-repeat">

            <div class="caption sft revolution-starhotel bigtext"
              data-x="505"
              data-y="30"
              data-speed="700"
              data-start="1700"
              data-easing="easeOutBack">
              <span><?php echo $row['slider_title']; ?></span>
            </div>

            <div class="caption sft revolution-starhotel smalltext"
              data-x="505"
              data-y="105"
              data-speed="800"
              data-start="1700"
              data-easing="easeOutBack">
              <span><?php echo $row['slider_subtitle']; ?></span>
            </div>

            <?php if ($row['slider_button_text'] != ''): ?>
              <div class="caption sft"
                data-x="505"
                data-y="175"
                data-speed="1000"
                data-start="1900"
                data-easing="easeOutBack">
                <a href="<?php echo $row['slider_button_url']; ?>" class="button btn btn-purple btn-lg"><?php echo $row['slider_button_text']; ?></a>
              </div>
            <?php endif; ?>

          </li>
        <?php
        }
        ?>

      </ul>
    </div>
  </div>
</section>

<!-- Reservation form -->
<section id="reservation-form">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form class="form-inline reservation-horizontal clearfix" role="form" method="post" action="https://www.slashdown.net/starhotel-html/php/reservation.php" name="reservationform" id="reservationform">
          <!-- Error message -->
          <div id="message"></div>
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label for="email" accesskey="E">E-mail</label>
                <input name="email" type="text" id="email" value="" class="form-control" placeholder="Please enter your E-mail" />
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="room">Room Type</label>
                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."> <i class="fa fa-info-circle fa-lg"> </i> </div>
                <select class="form-control" name="room" id="room">
                  <option selected="selected" disabled="disabled">Select a room</option>
                  <option value="Single">Single room</option>
                  <option value="Double">Double Room</option>
                  <option value="Deluxe">Deluxe room</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="checkin">Check-in</label>
                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                <i class="fa fa-calendar infield"></i>
                <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in" />
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="checkout">Check-out</label>
                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                <i class="fa fa-calendar infield"></i>
                <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out" />
              </div>
            </div>
            <div class="col-sm-1">
              <div class="form-group">
                <div class="guests-select">
                  <label>Guests</label>
                  <i class="fa fa-user infield"></i>
                  <div class="total form-control" id="test">1</div>
                  <div class="guests">
                    <div class="form-group adults">
                      <label for="adults">Adults</label>
                      <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="+18 years"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                      <select name="adults" id="adults" class="form-control">
                        <option value="1">1 adult</option>
                        <option value="2">2 adults</option>
                        <option value="3">3 adults</option>
                      </select>
                    </div>
                    <div class="form-group children">
                      <label for="children">Children</label>
                      <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="0 till 18 years"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                      <select name="children" id="children" class="form-control">
                        <option value="0">0 children</option>
                        <option value="1">1 child</option>
                        <option value="2">2 children</option>
                        <option value="3">3 children</option>
                      </select>
                    </div>
                    <button type="button" class="btn btn-default button-save btn-block">Save</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <button type="submit" class="btn btn-primary btn-block">Book Now</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- Rooms -->
<section class="rooms mt50">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="lined-heading"><span>Guests Favorite Rooms</span></h2>
      </div>
      <!-- Room -->
      <div class="col-sm-4">
        <div class="room-thumb"> <img src="images/rooms/room-01.jpg" alt="room 1" class="img-responsive" />
          <div class="mask">
            <div class="main">
              <h5>Double bedroom</h5>
              <div class="price">&euro; 99<span>a night</span></div>
            </div>
            <div class="content">
              <p><span>A modern hotel room in Star Hotel</span> Nunc tempor erat in magna pulvinar fermentum. Pellentesque scelerisque at leo nec vestibulum.
                malesuada metus.</p>
              <div class="row">
                <div class="col-xs-6">
                  <ul class="list-unstyled">
                    <li><i class="fa fa-check-circle"></i> Incl. breakfast</li>
                    <li><i class="fa fa-check-circle"></i> Private balcony</li>
                    <li><i class="fa fa-check-circle"></i> Sea view</li>
                  </ul>
                </div>
                <div class="col-xs-6">
                  <ul class="list-unstyled">
                    <li><i class="fa fa-check-circle"></i> Free Wi-Fi</li>
                    <li><i class="fa fa-check-circle"></i> Incl. breakfast</li>
                    <li><i class="fa fa-check-circle"></i> Bathroom</li>
                  </ul>
                </div>
              </div>
              <a href="room-detail.html" class="btn btn-primary btn-block">Read More</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Room -->
      <div class="col-sm-4">
        <div class="room-thumb"> <img src="images/rooms/room-02.jpg" alt="room 2" class="img-responsive" />
          <div class="mask">
            <div class="main">
              <h5>King Size Bedroom </h5>
              <div class="price">&euro; 149<span>a night</span></div>
            </div>
            <div class="content">
              <p><span>A modern hotel room in Star Hotel</span> Nunc tempor erat in magna pulvinar fermentum. Pellentesque scelerisque at leo nec vestibulum.
                malesuada metus.</p>
              <div class="row">
                <div class="col-xs-6">
                  <ul class="list-unstyled">
                    <li><i class="fa fa-check-circle"></i> Incl. breakfast</li>
                    <li><i class="fa fa-check-circle"></i> Private balcony</li>
                    <li><i class="fa fa-check-circle"></i> Sea view</li>
                  </ul>
                </div>
                <div class="col-xs-6">
                  <ul class="list-unstyled">
                    <li><i class="fa fa-check-circle"></i> Free Wi-Fi</li>
                    <li><i class="fa fa-check-circle"></i> Incl. breakfast</li>
                    <li><i class="fa fa-check-circle"></i> Bathroom</li>
                  </ul>
                </div>
              </div>
              <a href="room-detail.html" class="btn btn-primary btn-block">Read More</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Room -->
      <div class="col-sm-4">
        <div class="room-thumb"> <img src="images/rooms/room-03.jpg" alt="room 3" class="img-responsive" />
          <div class="mask">
            <div class="main">
              <h5>Single room</h5>
              <div class="price">&euro; 120<span>a night</span></div>
            </div>
            <div class="content">
              <p><span>A modern hotel room in Star Hotel</span> Nunc tempor erat in magna pulvinar fermentum. Pellentesque scelerisque at leo nec vestibulum.
                malesuada metus.</p>
              <div class="row">
                <div class="col-xs-6">
                  <ul class="list-unstyled">
                    <li><i class="fa fa-check-circle"></i> Incl. breakfast</li>
                    <li><i class="fa fa-check-circle"></i> Private balcony</li>
                    <li><i class="fa fa-check-circle"></i> Sea view</li>
                  </ul>
                </div>
                <div class="col-xs-6">
                  <ul class="list-unstyled">
                    <li><i class="fa fa-check-circle"></i> Free Wi-Fi</li>
                    <li><i class="fa fa-check-circle"></i> Incl. breakfast</li>
                    <li><i class="fa fa-check-circle"></i> Bathroom</li>
                  </ul>
                </div>
              </div>
              <a href="room-detail.html" class="btn btn-primary btn-block">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- USP's -->
<section class="usp mt100">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="lined-heading"><span>Our Features</span></h2>
      </div>

      <?php
      $q = $pdo->prepare("SELECT * FROM feature ORDER BY feature_id ASC");
      $q->execute();
      $res = $q->fetchAll();
      foreach ($res as $row) {
      ?>
        <div class="col-sm-3 bounceIn appear" data-start="0">
          <div class="box-icon">
            <div class="circle"><i class="fa <?php echo $row['feature_icon']; ?> fa-lg"></i></div>
            <h3><?php echo $row['feature_title']; ?></h3>
            <p>
              <?php echo nl2br($row['feature_text']); ?>
            </p>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<!-- Parallax Effect -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#parallax-image').parallax("50%", -0.35);
  });
</script>

<section class="parallax-effect mt100">
  <div id="parallax-image" style="background-image: url(images/parallax/parallax-01.jpg);">
    <div class="color-overlay fadeIn appear" data-start="600">
      <div class="container">
        <div class="content">
          <h3 class="text-center"><i class="fa fa fa-star-o"></i> STARHOTEL</h3>
          <p class="text-center">An Exceptional Hotel Template!
            <br>
            <a href="blog.html" class="btn btn-default btn-lg mt30">Checkout the blog</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Gallery -->
<section class="gallery-slider mt100">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="lined-heading"><span>Gallery</span></h2>
      </div>
    </div>
  </div>
  <div id="owl-gallery" class="owl-carousel">
    <div class="item"><a href="images/gallery/1.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/1.jpg" alt="Image 1"><i class="fa fa-search"></i></a></div>
    <div class="item"><a href="images/gallery/2.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/2.jpg" alt="Image 2"><i class="fa fa-search"></i></a></div>
    <div class="item"><a href="images/gallery/3.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/3.jpg" alt="Image 3"><i class="fa fa-search"></i></a></div>
    <div class="item"><a href="images/gallery/4.jpg" data-rel="prettyPhoto[gallery1]"><img src="images/gallery/4.jpg" alt="Image 4"><i class="fa fa-search"></i></a></div>
  </div>
</section>

<div class="container">
  <div class="row">
    <!-- Testimonials -->
    <section class="testimonials mt100">
      <div class="col-md-6">
        <h2 class="lined-heading bounceInLeft appear" data-start="0"><span>What Other Visitors Experienced</span></h2>
        <div id="owl-reviews" class="owl-carousel">
          <div class="item">
            <div class="row">
              <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12"> <img src="images/reviews/review-01.jpg" alt="Review 1" class="img-circle" /></div>
              <div class="col-lg-9 col-md-8 col-sm-10 col-xs-12">
                <div class="text-balloon">Searched the internet and i found, booked and visited this hotel that i like to call utopia... <span>Kim Jones, Single Room</span> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12"> <img src="images/reviews/review-02.jpg" alt="Review 2" class="img-circle" /></div>
              <div class="col-lg-9 col-md-8 col-sm-10 col-xs-12">
                <div class="text-balloon">I give it a 5 out of 5! Great hotel, friendly staff, clean, relaxing... Yep i'm coming back! ;-) <span>Sandra Donnathan, Double Room</span> </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="row">
              <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12"> <img src="images/reviews/review-03.jpg" alt="Review 3" class="img-circle" /></div>
              <div class="col-lg-9 col-md-8 col-sm-10 col-xs-12">
                <div class="text-balloon">Such a nice place... Next time i will book a 3 weeks stay at this place. <span>Rosanne O'Donald, Single Room</span> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12"> <img src="images/reviews/review-04.jpg" alt="Review 4" class="img-circle" /></div>
              <div class="col-lg-9 col-md-8 col-sm-10 col-xs-12">
                <div class="text-balloon">By far the best hotel in the city! Location is nice and the service is great! <span>Carl Adams, Single Room</span> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About -->
    <section class="about mt100">
      <div class="col-md-6">
        <h2 class="lined-heading bounceInRight appear" data-start="800"><span>Hotel Tabs</span></h2>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#hotel" data-toggle="tab">Our hotels</a></li>
          <li><a href="#events" data-toggle="tab">Events</a></li>
          <li><a href="#kids" data-toggle="tab">Kids</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane fade in active" id="hotel">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. In hendrerit risus arcu, in eleifend metus dapibus varius. Nulla dolor sapien, laoreet vel tincidunt non, egestas non justo. Phasellus et mattis lectus, et gravida urna.</p>
            <p><img src="images/tab/restaurant-01.jpg" alt="food" class="pull-right"> Donec pretium sem non tincidunt iaculis. Nunc at pharetra eros, a varius leo. Mauris id hendrerit justo. Mauris egestas magna vitae nisi ultricies semper. Nam vitae suscipit magna. Nam et felis nulla. Ut nec magna tortor. Nulla dolor sapien, laoreet vel tincidunt non, egestas non justo. </p>
          </div>
          <div class="tab-pane fade" id="events">Phasellus sodales justo felis, a vestibulum risus mattis vitae. Aliquam vitae varius elit, non facilisis massa. Vestibulum luctus diam mollis gravida bibendum. Aliquam mattis velit dolor, sit amet semper erat auctor vel. Integer auctor in dui ac vehicula. Integer fermentum nunc ut arcu feugiat, nec placerat nunc tincidunt. Pellentesque in massa eu augue placerat cursus sed quis magna.</div>
          <div class="tab-pane fade" id="kids">Aa vestibulum risus mattis vitae. Aliquam vitae varius elit, non facilisis massa. Vestibulum luctus diam mollis gravida bibendum. Aliquam mattis velit dolor, sit amet semper erat auctor vel. Integer auctor in dui ac vehicula. Integer fermentum nunc ut arcu feugiat, nec placerat nunc tincidunt. Pellentesque in massa eu augue placerat cursus sed quis magna.</div>
        </div>
      </div>
    </section>
  </div>
</div>

<?php require_once('footer.php'); ?>