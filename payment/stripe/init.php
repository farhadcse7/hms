<?php
ob_start();
session_start();
include("../../admin/db.php");
include("../../admin/functions.php");
?>

<?php require 'lib/init.php'; ?>

<?php

$stripe_secret_key = 'sk_test_TFcsLJ7xxUtpALbDo1L5c1PN';

if (isset($_POST['payment']) && $_POST['payment'] == 'posted' && floatval($_POST['amount']) > 0) {

    \Stripe\Stripe::setApiKey($stripe_secret_key);
    try {
        if (!isset($_POST['stripeToken']))
            throw new Exception("The Stripe Token was not generated correctly");

        $payment_date = date('Y-m-d H:i:s');
        $payment_id = time();
        $amount = floatval($_POST['amount']);
        $cents = floatval($amount * 100); //converting to cents

        $response = \Stripe\Charge::create(array("amount" => $cents,
                    "currency" => "usd",
                    "card" => $_POST['stripeToken'],
                    //"receipt_email" => $_POST['customer_email'],
                    "description" => 'Stripe Room Booking'
        ));

        $transaction_id = $response->id; // Its unique charge ID
        $transaction_status = $response->status;
        $statement = $pdo->prepare("INSERT INTO payment (   
                                cust_id,
                                cust_name,
                                cust_email,
                                txnid, 
                                payment_date,
                                payment_method,
                                paid_amount,
                                card_number,
                                card_cvv,
                                card_month,
                                card_year,                                
                                payment_status,
                                payment_id
                            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array(
                                $_SESSION['customer']['cust_id'],
                                $_SESSION['customer']['cust_name'],
                                $_SESSION['customer']['cust_email'],
                                $transaction_id,
                                $payment_date,
                                'Stripe',
                                $_POST['amount'],
                                $_POST['card_number'], 
                                $_POST['card_cvv'], 
                                $_POST['card_month'], 
                                $_POST['card_year'],                                
                                'Completed',
                                $payment_id
                            ));

        $i=0;
        foreach($_SESSION['cart_room_id'] as $value) 
        {
            $i++;
            $arr_room_id[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_checkin_date'] as $value) 
        {
            $i++;
            $arr_checkin_date[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_checkin_date_value'] as $value) 
        {
            $i++;
            $arr_checkin_date_value[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_checkout_date'] as $value) 
        {
            $i++;
            $arr_checkout_date[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_checkout_date_value'] as $value) 
        {
            $i++;
            $arr_checkout_date_value[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_room_price'] as $value) 
        {
            $i++;
            $arr_room_price[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_qty'] as $value) 
        {
            $i++;
            $arr_qty[$i] = $value;
        }

        for($i=1;$i<=count($arr_room_id);$i++) 
        {
            $statement = $pdo->prepare("INSERT INTO payment_detail (
                            room_id,
                            checkin_date,
                            checkin_date_value,
                            checkout_date,
                            checkout_date_value,
                            room_price, 
                            qty, 
                            payment_id
                            ) 
                            VALUES (?,?,?,?,?,?,?,?)");
            $sql = $statement->execute(array(
                            $arr_room_id[$i],
                            $arr_checkin_date[$i],
                            $arr_checkin_date_value[$i],
                            $arr_checkout_date[$i],
                            $arr_checkout_date_value[$i],
                            $arr_room_price[$i],
                            $arr_qty[$i],
                            $payment_id
                        ));
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

        header('location: ../../payment_success.php');

    } catch (Exception $e) {
        $error = $e->getMessage();
        ?><script type="text/javascript">alert('Error: <?php echo $error; ?>');</script><?php
    }
}
?>