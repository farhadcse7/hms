<?php require_once('header.php'); ?>
<?php
$q = $pdo->prepare("SELECT * FROM comment WHERE comment_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$comment_status = $row['comment_status'];
}

if ($comment_status == 'Active') {
	$q = $pdo->prepare("UPDATE comment SET comment_status=? WHERE comment_id=?");
	$q->execute(['Inactive', $_REQUEST['id']]);
} else {
	$q = $pdo->prepare("UPDATE comment SET comment_status=? WHERE comment_id=?");
	$q->execute(['Active', $_REQUEST['id']]);
}

header('location: all_comments.php');
