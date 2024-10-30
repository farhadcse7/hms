<?php require_once('header.php'); ?>
<?php
if (!isset($_REQUEST['id'])) {
	header('location: index.php');
	exit;
} else {
	if (!is_numeric($_REQUEST['id'])) {
		header('location: index.php');
		exit;
	} else {
		$q = $pdo->prepare("SELECT * FROM post WHERE post_id=?");
		$q->execute([$_REQUEST['id']]);
		$total = $q->rowCount();
		if (!$total) {
			header('location: index.php');
			exit;
		}
	}
}


$q = $pdo->prepare("SELECT * FROM post WHERE post_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$post_photo = $row['post_photo'];
}
unlink('../uploads/' . $post_photo);

$q = $pdo->prepare("DELETE FROM post WHERE post_id=?");
$q->execute([$_REQUEST['id']]);

//post_category relation table's post id data delete
$q = $pdo->prepare("DELETE FROM post_category WHERE post_id=?");
$q->execute([$_REQUEST['id']]);

$q = $pdo->prepare("DELETE FROM post_tag WHERE post_id=?");
$q->execute([$_REQUEST['id']]);

header('location: post_view.php');
