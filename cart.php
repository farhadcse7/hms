<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form_update'])) {

  $arr1 = array();
  $i = 0;
  foreach ($_POST['a_room_id'] as $val) {
    $i++;
    $arr1[$i] = $val;
  }

  $arr2 = array();
  $i = 0;
  foreach ($_POST['a_qty'] as $val) {
    $i++;
    $arr2[$i] = $val;
  }

  for ($i = 1; $i <= count($arr1); $i++) {
    $_SESSION['cart_qty'][$arr1[$i]] = $arr2[$i];
  }
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
              <li class="active">Cart</li>
            </ol>
            <h1>Cart</h1>
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
      <div class="col-md-12">

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

        <?php if (!isset($_SESSION['cart_room_id'])): ?>

          No item is found in the cart

        <?php else: ?>


          <form action="" method="post">
            <table class="table table-bordered">
              <tr>
                <th>Serial</th>
                <th>Room Name</th>
                <th>Type</th>
                <th>Checkin Date</th>
                <th>Checkout Date</th>
                <th>Room Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
              </tr>


              <?php
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
              ?>

              <?php
              $c = 0;
              for ($i = 1; $i <= count($arr_room_id); $i++) {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $arr_room_name[$i]; ?></td>
                  <td><?php echo $arr_room_type_name[$i]; ?></td>
                  <td><?php echo $arr_checkin_date[$i]; ?></td>
                  <td><?php echo $arr_checkout_date[$i]; ?></td>
                  <td>$<?php echo $arr_room_price[$i]; ?></td>
                  <td>
                    <input type="hidden" name="a_room_id[<?php echo $i; ?>]" value="<?php echo $arr_room_id[$i]; ?>">
                    <input type="number" name="a_qty[<?php echo $i; ?>]" value="<?php echo $arr_qty[$i]; ?>" style="width:80px;">
                  </td>
                  <?php
                  $t = $arr_room_price[$i] * $arr_qty[$i];
                  $c = $c + $t;
                  ?>
                  <td>$<?php echo $t; ?></td>
                  <td>
                    <a href="cart_item_delete.php?id=<?php echo $arr_room_id[$i]; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure to delete this item from the cart?');">X</a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </table>

            <div class="text-right" style="font-size:20px;">
              <b>Total:</b> $<?php echo $c; ?> <br>
            </div>

            <div>

              <input type="submit" value="Update Cart" class="btn btn-primary" name="form_update">
          </form>
          <a href="checkout.php" class="btn btn-primary">Checkout</a>
      </div>

    <?php endif; ?>


  </div>
  </section>
</div>
</div>


<?php require_once('footer.php'); ?>