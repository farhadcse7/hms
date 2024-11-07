<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
  header('location: rooms.php');
  exit;
}
?>

<?php
//total room count as per room_id from room table
$q = $pdo->prepare("SELECT * FROM room WHERE room_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
  $room_total = $row['room_total'];
}

if (isset($_POST['form1'])) {
  $valid = 1;
  if ($_POST['checkin'] == '' || $_POST['checkout'] == '' || $_POST['qty'] == '') {
    $valid = 0;
    $error_message .= 'You must have to fill up all the fields.';
  } else {
    if (strtotime($_POST['checkin']) >= strtotime($_POST['checkout'])) {
      $valid = 0;
      $error_message .= 'Checkin date must be previous date of checkout date';
    } else {
      $err = 0;
      $q = $pdo->prepare("SELECT * FROM payment_detail WHERE room_id=?");
      $q->execute([$_REQUEST['id']]);
      $res = $q->fetchAll();
      foreach ($res as $row) {
        if ((strtotime($_POST['checkin']) >= $row['checkin_date_value']) && (strtotime($_POST['checkin']) <= $row['checkout_date_value'])) {
          $err += $row['qty'];
        } elseif ((strtotime($_POST['checkout']) >= $row['checkin_date_value']) && (strtotime($_POST['checkout']) <= $row['checkout_date_value'])) {
          $err += $row['qty'];
        }
      }
      if ($_POST['qty'] > $room_total) {
        $valid = 0;
        $error_message .= 'Number of rooms exceed the total room limit. You can book only ' . $room_total . ' rooms';
      } else {
        if ($err + $_POST['qty'] > $room_total) {
          //echo $err + $_POST['qty'];
          //exit;
          $valid = 0;
          $error_message .= 'No such room available on that date';
        }
      }
    }
  }

  if ($valid == 1) {


    if (isset($_SESSION['cart_room_id'])) {

      $arr_room_id = array();
      $i = 0;
      foreach ($_SESSION['cart_room_id'] as $val) {
        $i++;
        $arr_room_id[$i] = $val;
      }

      $arr_qty = array();
      $i = 0;
      foreach ($_SESSION['cart_qty'] as $val) {
        $i++;
        $arr_qty[$i] = $val;
      }

      $arr_room_name = array();
      $i = 0;
      foreach ($_SESSION['cart_room_name'] as $val) {
        $i++;
        $arr_room_name[$i] = $val;
      }

      $arr_room_price = array();
      $i = 0;
      foreach ($_SESSION['cart_room_price'] as $val) {
        $i++;
        $arr_room_price[$i] = $val;
      }

      $arr_room_type_name = array();
      $i = 0;
      foreach ($_SESSION['cart_room_type_name'] as $val) {
        $i++;
        $arr_room_type_name[$i] = $val;
      }

      $arr_checkin_date = array();
      $i = 0;
      foreach ($_SESSION['cart_checkin_date'] as $val) {
        $i++;
        $arr_checkin_date[$i] = $val;
      }

      $arr_checkin_date_value = array();
      $i = 0;
      foreach ($_SESSION['cart_checkin_date_value'] as $val) {
        $i++;
        $arr_checkin_date_value[$i] = $val;
      }

      $arr_checkout_date = array();
      $i = 0;
      foreach ($_SESSION['cart_checkout_date'] as $val) {
        $i++;
        $arr_checkout_date[$i] = $val;
      }

      $arr_checkout_date_value = array();
      $i = 0;
      foreach ($_SESSION['cart_checkout_date_value'] as $val) {
        $i++;
        $arr_checkout_date_value[$i] = $val;
      }

      if (in_array($_REQUEST['id'], $arr_room_id)) {
        $valid = 0;
        $error_message .= 'This room is already added to the cart';
      } else {
        $new_key = $i + 1;
        $_SESSION['cart_room_id'][$new_key] = $_REQUEST['id'];
        $_SESSION['cart_qty'][$new_key] = $_POST['qty'];
        $_SESSION['cart_room_name'][$new_key] = $_POST['room_name'];
        $_SESSION['cart_room_price'][$new_key] = $_POST['room_price'];
        $_SESSION['cart_room_type_name'][$new_key] = $_POST['room_type_name'];
        $_SESSION['cart_checkin_date'][$new_key] = $_POST['checkin'];
        $_SESSION['cart_checkin_date_value'][$new_key] = strtotime($_POST['checkin']);
        $_SESSION['cart_checkout_date'][$new_key] = $_POST['checkout'];
        $_SESSION['cart_checkout_date_value'][$new_key] = strtotime($_POST['checkout']);
      }
    } else {
      $_SESSION['cart_room_id'][1] = $_REQUEST['id'];
      $_SESSION['cart_qty'][1] = $_POST['qty'];
      $_SESSION['cart_room_name'][1] = $_POST['room_name'];
      $_SESSION['cart_room_price'][1] = $_POST['room_price'];
      $_SESSION['cart_room_type_name'][1] = $_POST['room_type_name'];
      $_SESSION['cart_checkin_date'][1] = $_POST['checkin'];
      $_SESSION['cart_checkin_date_value'][1] = strtotime($_POST['checkin']);
      $_SESSION['cart_checkout_date'][1] = $_POST['checkout'];
      $_SESSION['cart_checkout_date_value'][1] = strtotime($_POST['checkout']);
    }

    header('location: cart.php');
    exit;
  }
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

<?php
if ($error_message) {
?><script>
    alert('<?php echo $error_message; ?>');
  </script><?php
          }

          if ($success_message) {
            ?><script>
    alert('<?php echo $success_message; ?>');
  </script><?php
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
        <form class="reservation-vertical clearfix" role="form" method="post" action="">

          <input type="hidden" name="room_name" value="<?php echo $room_name; ?>">
          <input type="hidden" name="room_price" value="<?php echo $room_price; ?>">
          <input type="hidden" name="room_type_name" value="<?php echo $room_type_name; ?>">

          <h2 class="lined-heading"><span>Reservation</span></h2>
          <div class="price">
            <h4><?php echo $room_type_name; ?></h4>
            $ <?php echo $room_price; ?>,-<span> a night</span>
          </div>

          <!-- <h4>This room is booked for the following date(s):</h4> -->
          <!-- use comment when this section when finally done project start-->
          <?php
          $q = $pdo->prepare("SELECT * FROM payment_detail WHERE room_id=?");
          $q->execute([$_REQUEST['id']]);
          $res = $q->fetchAll();
          foreach ($res as $row) {
            if ($row['checkout_date_value'] < strtotime(date('Y-m-d'))) {
              continue;
            }
            echo 'Checkin: ' . $row['checkin_date'] . ' and ';
            echo 'Checkout: ' . $row['checkout_date'];
            echo '<br><br>';
          }
          ?>
          <!-- use comment when this section when finally done project end-->

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
            <label for="checkout">How many rooms</label>
            <input name="qty" type="number" value="1" class="form-control" min="1" max="5">
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="form1">Book Now</button>
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