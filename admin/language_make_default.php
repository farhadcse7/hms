<?php require_once('header.php'); ?>
<?php
$q = $pdo->prepare("UPDATE language SET 
			lang_default=?
		");
$q->execute([
	''
]);

$q = $pdo->prepare("UPDATE language SET 
			lang_default=?
			WHERE lang_id=?
		");
$q->execute([
	'default',
	$_REQUEST['id']
]);

header('location: language_view.php');
