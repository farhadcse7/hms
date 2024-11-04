<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
  header('location: rooms.php');
  exit;
}
?>

<?php
//here join relation use for room_type_name
$q = $pdo->prepare("SELECT * 
                FROM room t1
                JOIN room_type t2
                ON t1.room_type_id = t2.room_type_id
                WHERE t1.room_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
  $room_name = $row['room_name'];
  $room_description = $row['room_description'];
  $room_overview = $row['room_overview'];
  $room_facility = $row['room_facility'];
  $room_featured_photo = $row['room_featured_photo'];
  $room_price = $row['room_price'];
  $room_type_id = $row['room_type_id'];
  $room_type_name = $row['room_type_name'];
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
              <li><a href="rooms.php">Rooms</a></li>
              <li class="active"><?php echo $room_name; ?></li>
            </ol>
            <h1><?php echo $room_name; ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row">
    <!-- Slider -->
    <section class="room-slider standard-slider mt50">
      <div class="col-sm-12 col-md-8">
        <div id="owl-standard" class="owl-carousel">

          <div class="item">
            <a href="uploads/<?php echo $room_featured_photo; ?>" data-rel="prettyPhoto[gallery1]">
              <img src="uploads/<?php echo $room_featured_photo; ?>" alt="Bed" class="img-responsive">
            </a>
          </div>


          <?php
          $q = $pdo->prepare("SELECT * FROM room_photo WHERE room_id=? ORDER BY room_photo_id ASC");
          $q->execute([$_REQUEST['id']]);
          $res = $q->fetchAll();
          foreach ($res as $row) {
          ?>
            <div class="item">
              <a href="uploads/<?php echo $row['room_photo']; ?>" data-rel="prettyPhoto[gallery1]">
                <img src="uploads/<?php echo $row['room_photo']; ?>" alt="Bathroom" class="img-responsive">
              </a>
            </div>
          <?php
          }
          ?>


        </div>
      </div>
    </section>

    <!-- Reservation form -->
    <section id="reservation-form" class="mt50 clearfix">
      <div class="col-sm-12 col-md-4">
        <form class="reservation-vertical clearfix" role="form" method="post" action="https://www.slashdown.net/starhotel-html/php/reservation.php" name="reservationform" id="reservationform">
          <h2 class="lined-heading"><span>Reservation</span></h2>
          <div class="price">
            <h4><?php echo $room_type_name; ?></h4>
            $ <?php echo $room_price; ?>,-<span> a night</span>
          </div>
          <div id="message"></div>
          <!-- Error message display -->
          <div class="form-group">
            <label for="email" accesskey="E">E-mail</label>
            <input name="email" type="text" id="email" value="" class="form-control" placeholder="Please enter your E-mail" />
          </div>
          <div class="form-group">
            <select class="hidden" name="room" id="room">
              <option selected="selected">Double Room</option>
            </select>
          </div>
          <div class="form-group">
            <label for="checkin">Check-in</label>
            <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
            <i class="fa fa-calendar infield"></i>
            <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in" />
          </div>
          <div class="form-group">
            <label for="checkout">Check-out</label>
            <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
            <i class="fa fa-calendar infield"></i>
            <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out" />
          </div>
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
          <button type="submit" class="btn btn-primary btn-block">Book Now</button>
        </form>
      </div>
    </section>

    <!-- Room Content -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-7 mt50">
            <h2 class="lined-heading"><span>Room Details</span></h2>
            <h3 class="mt50">Features</h3>
            <table class="table table-striped mt30">
              <tbody>
                <tr>
                  <?php
                  $i = 0;
                  $q = $pdo->prepare("SELECT * 
                              FROM room_room_feature t1
                              JOIN room_feature t2
                              ON t1.room_feature_id = t2.room_feature_id
                              WHERE t1.room_id=? 
                              ORDER BY t1.room_room_feature_id ASC");
                  $q->execute([$_REQUEST['id']]);
                  $res = $q->fetchAll();
                  foreach ($res as $row) {
                    $i++;
                  ?>
                    <td><i class="<?php echo $row['room_feature_icon']; ?>"></i> <?php echo $row['room_feature_name']; ?></td>
                  <?php
                    if ($i % 3 == 0) {
                      echo '</tr><tr>';
                    }
                  }
                  ?>
                </tr>

              </tbody>
            </table>
            <p class="mt50">
              <?php echo $room_description; ?>
            </p>
          </div>
          <div class="col-sm-5 mt50">

            <h2 class="lined-heading"><span>Overview</span></h2>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
              <li><a href="#facilities" data-toggle="tab">Facilities</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane fade in active" id="overview">
                <?php echo $room_overview; ?>
              </div>
              <div class="tab-pane fade" id="facilities">
                <?php echo $room_facility; ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- Other Rooms -->
<section class="rooms mt50">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="lined-heading"><span>Related rooms</span></h2>
      </div>

      <?php
      $q = $pdo->prepare("SELECT * 
                        FROM room 
                        WHERE room_type_id=? AND room_id!=?
                        ORDER BY room_id ASC");
      $q->execute([$room_type_id, $_REQUEST['id']]);
      $res = $q->fetchAll();
      foreach ($res as $row) {
      ?>
        <div class="col-sm-4">
          <div class="room-thumb"> <img src="uploads/<?php echo $row['room_featured_photo']; ?>" alt="room 1" class="img-responsive" />
            <div class="mask">
              <div class="main">
                <h5><?php echo $row['room_name']; ?></h5>
                <div class="price">$ <?php echo $row['room_price']; ?><span>a night</span></div>
              </div>
              <div class="content">
                <p><?php echo $row['room_short_description']; ?></p>
                <div class="row">
                  <!-- features side by decoration rules start here -->
                  <?php
                  $r = $pdo->prepare("SELECT * 
                              FROM room_room_feature t1
                              JOIN room_feature t2
                              ON t1.room_feature_id = t2.room_feature_id
                              WHERE t1.room_id=? 
                              ORDER BY t1.room_id ASC");
                  $r->execute([$row['room_id']]);
                  $tot = $r->rowCount();
                  if ($tot % 2 == 0) {
                    $left = $tot / 2;
                    $right = $left;
                  } else {
                    $left = ceil($tot / 2);
                    $right = $left - 1;
                  }

                  $left_arr_name = array();
                  $left_arr_icon = array();
                  $right_arr_name = array();
                  $right_arr_icon = array();

                  $i = 0;
                  $res1 = $r->fetchAll();
                  foreach ($res1 as $row1) {
                    $i++;
                    if ($i <= $left) {
                      $left_arr_name[] = $row1['room_feature_name'];
                      $left_arr_icon[] = $row1['room_feature_icon'];
                    } else {
                      $right_arr_name[] = $row1['room_feature_name'];
                      $right_arr_icon[] = $row1['room_feature_icon'];
                    }
                  }
                  ?>


                  <div class="col-xs-6">
                    <ul class="list-unstyled">
                      <?php
                      for ($i = 0; $i < count($left_arr_name); $i++) {
                      ?><li><i class="<?php echo $left_arr_icon[$i]; ?>"></i> <?php echo $left_arr_name[$i]; ?></li>
                      <?php
                      }
                      ?>
                    </ul>
                  </div>
                  <div class="col-xs-6">
                    <ul class="list-unstyled">
                      <?php
                      for ($i = 0; $i < count($right_arr_name); $i++) {
                      ?><li><i class="<?php echo $right_arr_icon[$i]; ?>"></i> <?php echo $right_arr_name[$i]; ?></li>
                      <?php
                      }
                      ?>
                    </ul>
                  </div>
                  <!-- features side by decoration rules ends here -->
                </div>
                <a href="room.php?id=<?php echo $row['room_id']; ?>" class="btn btn-primary btn-block">View Details</a>
                <a href="room-detail.html" class="btn btn-primary btn-block">Book Now</a>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>

    </div>
  </div>
</section>

<?php require_once('footer.php'); ?>