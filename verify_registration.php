<?php require_once('header.php'); ?>

<?php
$q = $pdo->prepare("SELECT * FROM customer WHERE cust_email=? AND cust_hash=?");
$q->execute([$_REQUEST['email'], $_REQUEST['hash']]);
$tot = $q->rowCount();
if ($tot) {
	$q = $pdo->prepare("UPDATE customer SET 
				cust_hash=?, 
				cust_active=?	
				WHERE cust_email=? AND cust_hash=?
			");
	$q->execute([
		'',
		1,
		$_REQUEST['email'],
		$_REQUEST['hash']
	]);
	header('location: verify_registration_success.php');
} else {
	header('location: index.php');
	exit;
}

?>