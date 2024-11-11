<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form_book']))
{

  $q = $pdo->prepare("SELECT * 
                  FROM room t1
                  JOIN room_type t2
                  ON t1.room_type_id = t2.room_type_id
                  WHERE t1.room_id=?");
  $q->execute([$_POST['room_id']]);
  $res = $q->fetchAll();
  foreach ($res as $row) {
    $room_total = $row['room_total'];
    $room_type_name = $row['room_type_name'];
    $room_price = $row['room_price'];
    $room_name = $row['room_name'];
  }

  $valid = 1;
  if( $_POST['checkin'] == '' || $_POST['checkout'] == '' || $_POST['qty'] == '')
  {
    $valid = 0;
    $error_message .= 'You must have to fill up all the fields.';
  }
  else
  {
    if(strtotime($_POST['checkin']) >= strtotime($_POST['checkout']))
    {
      $valid = 0;
      $error_message .= 'Checkin date must be previous date of checkout date';
    }
    else
    {
      $err = 0;
      $q = $pdo->prepare("SELECT * FROM payment_detail WHERE room_id=?");
      $q->execute([$_POST['room_id']]);
      $res = $q->fetchAll();
      foreach ($res as $row) {
        if( (strtotime($_POST['checkin']) >= $row['checkin_date_value']) && (strtotime($_POST['checkin']) <= $row['checkout_date_value']) ) {
          $err += $row['qty'];
        }
        elseif( (strtotime($_POST['checkout']) >= $row['checkin_date_value']) && (strtotime($_POST['checkout']) <= $row['checkout_date_value']) ) {
         $err += $row['qty'];
        }
      }
      if($err >= $room_total)
      {
        $valid = 0;
        $error_message .= 'No such room available on that date';
      }
      else
      {
        if($_POST['qty'] > $room_total)
        {
          $valid = 0;
          $error_message .= 'Number of rooms exceed the total room limit. You can book only '.$room_total.' rooms';
        }
      }
    }
  }

  if($valid == 1)
  {

    if(isset($_SESSION['cart_room_id']))
    {

      $arr_room_id = array();
      $i=0;
      foreach($_SESSION['cart_room_id'] as $val)
      {
        $i++;
        $arr_room_id[$i] = $val;
      }

      $arr_qty = array();
      $i=0;
      foreach($_SESSION['cart_qty'] as $val)
      {
        $i++;
        $arr_qty[$i] = $val;
      }

      $arr_room_name = array();
      $i=0;
      foreach($_SESSION['cart_room_name'] as $val)
      {
        $i++;
        $arr_room_name[$i] = $val;
      }

      $arr_room_price = array();
      $i=0;
      foreach($_SESSION['cart_room_price'] as $val)
      {
        $i++;
        $arr_room_price[$i] = $val;
      }

      $arr_room_type_name = array();
      $i=0;
      foreach($_SESSION['cart_room_type_name'] as $val)
      {
        $i++;
        $arr_room_type_name[$i] = $val;
      }

      $arr_checkin_date = array();
      $i=0;
      foreach($_SESSION['cart_checkin_date'] as $val)
      {
        $i++;
        $arr_checkin_date[$i] = $val;
      }

      $arr_checkin_date_value = array();
      $i=0;
      foreach($_SESSION['cart_checkin_date_value'] as $val)
      {
        $i++;
        $arr_checkin_date_value[$i] = $val;
      }

      $arr_checkout_date = array();
      $i=0;
      foreach($_SESSION['cart_checkout_date'] as $val)
      {
        $i++;
        $arr_checkout_date[$i] = $val;
      }

      $arr_checkout_date_value = array();
      $i=0;
      foreach($_SESSION['cart_checkout_date_value'] as $val)
      {
        $i++;
        $arr_checkout_date_value[$i] = $val;
      }

      if(in_array($_POST['room_id'],$arr_room_id))
      {
        $valid = 0;
        $error_message .= 'This room is already added to the cart';
      }
      else
      {
        $new_key = $i+1;
        $_SESSION['cart_room_id'][$new_key] = $_POST['room_id'];
        $_SESSION['cart_qty'][$new_key] = $_POST['qty'];
        $_SESSION['cart_room_name'][$new_key] = $room_name;
        $_SESSION['cart_room_price'][$new_key] = $room_price;
        $_SESSION['cart_room_type_name'][$new_key] = $room_type_name;
        $_SESSION['cart_checkin_date'][$new_key] = $_POST['checkin'];
        $_SESSION['cart_checkin_date_value'][$new_key] = strtotime($_POST['checkin']);
        $_SESSION['cart_checkout_date'][$new_key] = $_POST['checkout'];
        $_SESSION['cart_checkout_date_value'][$new_key] = strtotime($_POST['checkout']);
      }

    }
    else
    {
      $_SESSION['cart_room_id'][1] = $_POST['room_id'];
      $_SESSION['cart_qty'][1] = $_POST['qty'];
      $_SESSION['cart_room_name'][1] = $room_name;
      $_SESSION['cart_room_price'][1] = $room_price;
      $_SESSION['cart_room_type_name'][1] = $room_type_name;
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
if($error_message) {
  ?><script>alert('<?php echo $error_message; ?>');</script><?php
}

if($success_message) {
  ?><script>alert('<?php echo $success_message; ?>');</script><?php
}
?>

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
        <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" > 
          
          <img src="uploads/<?php echo $row['slider_photo']; ?>" style="opacity:0;" alt="slidebg1"  data-bgfit="cover" data-bgposition="left bottom" data-bgrepeat="no-repeat"> 
        
          <div class="caption sft revolution-starhotel bigtext"  
                  data-x="505" 
                        data-y="30" 
                        data-speed="700" 
                        data-start="1700" 
                        data-easing="easeOutBack"> 
            <span><?php echo $row['slider_title']; ?></span></div>
          
          <div class="caption sft revolution-starhotel smalltext"  
                  data-x="505" 
                        data-y="105" 
                        data-speed="800" 
                        data-start="1700" 
                        data-easing="easeOutBack">
            <span><?php echo $row['slider_subtitle']; ?></span></div>
              
              <?php if($row['slider_button_text']!=''): ?>
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
        <form class="form-inline reservation-horizontal clearfix" role="form" method="post" action="">
        <!-- Error message -->
		<div id="message"></div>
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label for="room">Room Type</label>
                <select class="form-control" name="room_id" id="room">
                  <?php
                  $q = $pdo->prepare("SELECT * 
                                FROM room t1
                                JOIN room_type t2
                                ON t1.room_type_id = t2.room_type_id
                                ORDER BY t1.room_id ASC");
                  $q->execute();
                  $res = $q->fetchAll();
                  foreach ($res as $row) {
                    ?>
                    <option value="<?php echo $row['room_id']; ?>"><?php echo $row['room_name']; ?> (<?php echo $row['room_type_name']; ?>)</option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="checkin">Check-in</label>
                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                <i class="fa fa-calendar infield"></i>
                <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in"/>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="checkout">Check-out</label>
                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                <i class="fa fa-calendar infield"></i>
                <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out"/>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="room">How Many Rooms?</label>                
                <input name="qty" type="number" value="1" class="form-control" min="1" max="5">
              </div>
            </div>
            <div class="col-sm-2">
              <button type="submit" class="btn btn-primary btn-block" name="form_book">Book Now</button>
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

      
      <?php
      $q = $pdo->prepare("SELECT * FROM room WHERE room_show_on_home=? ORDER BY room_id ASC");
      $q->execute(['Yes']);
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
                <?php
                  $r = $pdo->prepare("SELECT * 
                              FROM room_room_feature t1
                              JOIN room_feature t2
                              ON t1.room_feature_id = t2.room_feature_id
                              WHERE t1.room_id=? 
                              ORDER BY t1.room_id ASC");
                  $r->execute([$row['room_id']]);
                  $tot = $r->rowCount();
                  if($tot%2 == 0)
                  {
                    $left = $tot/2;
                    $right = $left;
                  }
                  else
                  {
                    $left = ceil($tot/2);
                    $right = $left-1;
                  }

                  $left_arr_name = array();
                  $left_arr_icon = array();
                  $right_arr_name = array();
                  $right_arr_icon = array();
                  
                  $i=0;
                  $res1 = $r->fetchAll();
                  foreach ($res1 as $row1) {
                    $i++;
                    if($i<=$left)
                    {
                      $left_arr_name[] = $row1['room_feature_name'];
                      $left_arr_icon[] = $row1['room_feature_icon'];  
                    }
                    else
                    {
                      $right_arr_name[] = $row1['room_feature_name'];
                      $right_arr_icon[] = $row1['room_feature_icon'];  
                    } 
                  }
                  ?>
                <div class="col-xs-6">
                    <ul class="list-unstyled">
                      <?php
                      for($i=0;$i<count($left_arr_name);$i++)
                      {
                        ?><li><i class="<?php echo $left_arr_icon[$i]; ?>"></i> <?php echo $left_arr_name[$i]; ?></li><?php  
                      }
                      ?>
                    </ul>
                  </div>
                  <div class="col-xs-6">
                    <ul class="list-unstyled">
                      <?php
                      for($i=0;$i<count($right_arr_name);$i++)
                      {
                        ?><li><i class="<?php echo $right_arr_icon[$i]; ?>"></i> <?php echo $right_arr_name[$i]; ?></li><?php  
                      }
                      ?>
                    </ul>
                  </div>
              </div>
              <a href="room.php?id=<?php echo $row['room_id']; ?>" class="btn btn-primary btn-block">Read More</a>
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
<script type="text/javascript">$(document).ready(function(){$('#parallax-image').parallax("50%", -0.35);});</script>

<section class="parallax-effect mt100">
  <div id="parallax-image" style="background-image: url(images/parallax/parallax-01.jpg);">
    <div class="color-overlay fadeIn appear" data-start="600">
      <div class="container">
        <div class="content">
          <h3 class="text-center"><i class="fa fa fa-star-o"></i> STARHOTEL</h3>
          <p class="text-center">An Exceptional Hotel Template!
		  <br>
		  <a href="blog.html" class="btn btn-default btn-lg mt30">Checkout the blog</a></p>
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
  
    <?php
    $q = $pdo->prepare("
          SELECT * 
          FROM photo
          ORDER BY photo_id ASC
        ");
    $q->execute();
    $res = $q->fetchAll();
    foreach ($res as $row) {
      ?>
      <div class="item"><a href="uploads/<?php echo $row['photo_name']; ?>" data-rel="prettyPhoto[gallery1]"><img src="uploads/<?php echo $row['photo_name']; ?>" alt=""><i class="fa fa-search"></i></a></div>
      <?php
    }
    ?>
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
            <?php
            $i=0;
            $flag=0;
            $q = $pdo->prepare("SELECT * FROM testimonial ORDER BY testimonial_id ASC");
            $q->execute();
            $res = $q->fetchAll();
            foreach ($res as $row) {
              $i++;
              $flag++;
              ?>
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12"> <img src="uploads/<?php echo $row['person_photo']; ?>" alt="Review 1" class="img-circle" /></div>
                <div class="col-lg-9 col-md-8 col-sm-10 col-xs-12">
                  <div class="text-balloon">
                    <?php echo $row['person_comment']; ?>
                    <span><?php echo $row['person_name_designation']; ?></span> </div>
                </div>
              </div>
              <?php
              if($flag == 2)
              {
                $flag=0;
                echo '</div><div class="item">';
              }
              ?>
              <?php
            }
            ?>
          </div>

        </div>
      </div>
    </section>
    
    <!-- About -->
    <section class="about mt100">
      <div class="col-md-6">
        <h2 class="lined-heading bounceInRight appear" data-start="800"><span>Our Services</span></h2>
        

        <ul class="nav nav-tabs">
          
          <?php
          $i=0;
          $q = $pdo->prepare("SELECT * FROM service ORDER BY service_id ASC");
          $q->execute();
          $res = $q->fetchAll();
          foreach ($res as $row) {
            $i++;
            ?>
            <li <?php if($i==1) {echo 'class="active"';} ?>><a href="#abc<?php echo $i; ?>" data-toggle="tab"><?php echo $row['service_title']; ?></a></li>
            <?php
          }
          ?>

        </ul>

        <div class="tab-content">

          <?php
          $i=0;
          $q = $pdo->prepare("SELECT * FROM service ORDER BY service_id ASC");
          $q->execute();
          $res = $q->fetchAll();
          foreach ($res as $row) {
            $i++;
            ?>
            <div class="tab-pane fade <?php if($i==1) {echo 'in active';} ?>" id="abc<?php echo $i; ?>">
              <p>
                <?php echo $row['service_text']; ?>
              </p>
            </div>
            <?php
          }
          ?>

        </div>



      </div>
    </section>
  </div>
</div>

<?php require_once('footer.php'); ?>