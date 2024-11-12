<?php require_once('header.php'); ?>

<?php
$q = $pdo->prepare("SELECT * FROM subscriber WHERE s_email=? AND s_hash=?");
$q->execute([$_REQUEST['email'], $_REQUEST['hash']]);
$tot = $q->rowCount();
if ($tot) {
	$q = $pdo->prepare("UPDATE subscriber SET 
				s_hash=?, 
				s_active=?	
				WHERE s_email=? AND s_hash=?
			");
	$q->execute([
		'',
		1,
		$_REQUEST['email'],
		$_REQUEST['hash']
	]);
	header('location: verify_subscriber_success.php');
} else {
	header('location: index.php');
	exit;
}
?>