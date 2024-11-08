<?php
ob_start();
session_start();
include("../../admin/db.php");

$error_message = '';

$paypal_email = 'sb-iagha33876344@business.example.com';

$return_url = SITE_URL.'payment_success.php';
$cancel_url = SITE_URL.'index.php';
$notify_url = SITE_URL.'payment/paypal/verify_process.php';

$item_name = 'Hotel Rooms';
$item_amount = $_POST['final_total'];
$item_number = time();
$payment_date = date('Y-m-d H:i:s');

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
	$querystring = '';
	
	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	$querystring .= "item_number=".urlencode($item_number)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;

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
                            '',
                            $payment_date,
                            'PayPal',
                            $item_amount,
                            '', 
                            '', 
                            '', 
                            '',
                            'Pending',
                            $item_number
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
                        cust_id,
                        checkin_date,
                        checkin_date_value,
                        checkout_date,
                        checkout_date_value,
                        room_price, 
                        qty, 
                        payment_id
                        ) 
                        VALUES (?,?,?,?,?,?,?,?,?)");
        $sql = $statement->execute(array(
                        $arr_room_id[$i],
                        $_SESSION['customer']['cust_id'],
                        $arr_checkin_date[$i],
                        $arr_checkin_date_value[$i],
                        $arr_checkout_date[$i],
                        $arr_checkout_date_value[$i],
                        $arr_room_price[$i],
                        $arr_qty[$i],
                        $item_number
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

	
	if($sql){
		// Redirect to paypal IPN
		header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
		exit();
	}
	
} else {

	// Response from Paypal

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	
	// assign posted variables to local variables
	$data['item_name']			= $_POST['item_name'];
	$data['item_number'] 		= $_POST['item_number'];
	$data['payment_status'] 	= $_POST['payment_status'];
	$data['payment_amount'] 	= $_POST['mc_gross'];
	$data['payment_currency']	= $_POST['mc_currency'];
	$data['txn_id']			    = $_POST['txn_id'];
	$data['receiver_email'] 	= $_POST['receiver_email'];
	$data['payer_email'] 		= $_POST['payer_email'];
	$data['custom'] 			= $_POST['custom'];
		
	// post back to PayPal system to validate
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
	
	if (!$fp) {
		// HTTP ERROR
		
	} else {
		fputs($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp($res, "VERIFIED") == 0) {
				
				// Used for debugging
				// mail('user@domain.com', 'PAYPAL POST - VERIFIED RESPONSE', print_r($post, true));
				
			
			} else if (strcmp ($res, "INVALID") == 0) {
			

				// PAYMENT INVALID & INVESTIGATE MANUALY!
				// E-mail admin or alert user
				
				// Used for debugging
				//@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
			}
		}
	fclose ($fp);
	}
}