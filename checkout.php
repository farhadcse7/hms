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
                            <li class="active">Checkout</li>
                        </ol>
                        <h1>Checkout</h1>
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
                            <td><?php echo $arr_qty[$i]; ?></td>
                            <?php
                            $t = $arr_room_price[$i] * $arr_qty[$i];
                            $c = $c + $t;
                            ?>
                            <td>$<?php echo $t; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>

                <div class="text-right" style="font-size:20px;">
                    <b>Total:</b> $<?php echo $c; ?> <br>
                </div>

                <?php if (isset($_SESSION['customer'])): ?>

                    <h3>Payment Section</h3>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pay With PayPal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pay With Stripe</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <form class="paypal" action="payment/paypal/payment_process.php" method="post" id="paypal_form" target="_blank">
                                <input type="hidden" name="cmd" value="_xclick" />
                                <input type="hidden" name="no_note" value="1" />
                                <input type="hidden" name="lc" value="UK" />
                                <input type="hidden" name="currency_code" value="USD" />
                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />

                                <input type="hidden" name="final_total" value="<?php echo $c; ?>">

                                <div class="col-md-12 form-group">
                                    <input type="submit" class="btn btn-primary" value="Pay Now" name="form1">
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <form action="payment/stripe/init.php" method="post" id="stripe_form">
                                <input type="hidden" name="payment" value="posted">
                                <input type="hidden" name="amount" value="<?php echo $c; ?>">

                                <div class="col-md-12 form-group">
                                    <label for="">Card Number *</label>
                                    <input type="text" name="card_number" class="form-control card-number" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="">CVV *</label>
                                    <input type="text" name="card_cvv" class="form-control card-cvc" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="">Expire Month *</label>
                                    <input type="text" name="card_month" class="form-control card-expiry-month" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="">Expire Year *</label>
                                    <input type="text" name="card_year" class="form-control card-expiry-year" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="submit" class="btn btn-primary" value="Pay Now" name="form2" id="submit-button">
                                    <div id="msg-container"></div>
                                </div>
                            </form>

                        </div>
                    </div>

                <?php else: ?>
                    You must have to <a href="login.php">login</a> to checkout
                <?php endif; ?>

                <div>
                </div>

            </div>
        </section>
    </div>
</div>

<?php require_once('footer.php'); ?>