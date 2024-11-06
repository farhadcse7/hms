<?php require_once('header.php'); ?>

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


unset($_SESSION['cart_room_id']);
unset($_SESSION['cart_qty']);
unset($_SESSION['cart_room_name']);
unset($_SESSION['cart_room_price']);
unset($_SESSION['cart_room_type_name']);
unset($_SESSION['cart_checkin_date']);
unset($_SESSION['cart_checkin_date_value']);
unset($_SESSION['cart_checkout_date']);
unset($_SESSION['cart_checkout_date_value']);


for ($i = 1; $i <= count($arr_room_id); $i++) {
  if ($arr_room_id[$i] == $_REQUEST['id']) {
    continue;
  }

  $_SESSION['cart_room_id'][$i]             = $arr_room_id[$i];
  $_SESSION['cart_qty'][$i]                 = $arr_qty[$i];
  $_SESSION['cart_room_name'][$i]           = $arr_room_name[$i];
  $_SESSION['cart_room_price'][$i]          = $arr_room_price[$i];
  $_SESSION['cart_room_type_name'][$i]      = $arr_room_type_name[$i];
  $_SESSION['cart_checkin_date'][$i]        = $arr_checkin_date[$i];
  $_SESSION['cart_checkin_date_value'][$i]  = $arr_checkin_date_value[$i];
  $_SESSION['cart_checkout_date'][$i]       = $arr_checkout_date[$i];
  $_SESSION['cart_checkout_date_value'][$i] = $arr_checkout_date_value[$i];
}

header('location: cart.php');


?>