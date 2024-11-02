<?php require_once('header.php'); ?>
<?php
$q = $pdo->prepare("SELECT * FROM reply WHERE reply_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$reply_status = $row['reply_status'];
}

if ($reply_status == 'Active') {
	$q = $pdo->prepare("UPDATE reply SET reply_status=? WHERE reply_id=?");
	$q->execute(['Inactive', $_REQUEST['id']]);
} else {
	$q = $pdo->prepare("UPDATE reply SET reply_status=? WHERE reply_id=?");
	$q->execute(['Active', $_REQUEST['id']]);
}

header('location: all_replies.php');
