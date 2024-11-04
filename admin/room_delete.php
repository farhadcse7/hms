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
		$q = $pdo->prepare("SELECT * FROM room WHERE room_id=?");
		$q->execute([$_REQUEST['id']]);
		$total = $q->rowCount();
		if (!$total) {
			header('location: index.php');
			exit;
		}
	}
}

//delete image from room table
$q = $pdo->prepare("SELECT * FROM room WHERE room_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$room_featured_photo = $row['room_featured_photo'];
	unlink('../uploads/' . $room_featured_photo);
}
//delete images from room_photo table
$q = $pdo->prepare("SELECT * FROM room_photo WHERE room_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$room_photo = $row['room_photo'];
	unlink('../uploads/' . $room_photo);
}
//delete data from room table
$q = $pdo->prepare("DELETE FROM room WHERE room_id=?");
$q->execute([$_REQUEST['id']]);
//delete data from room_room_feature table
$q = $pdo->prepare("DELETE FROM room_room_feature WHERE room_id=?");
$q->execute([$_REQUEST['id']]);
//delete data from room_photo table
$q = $pdo->prepare("DELETE FROM room_photo WHERE room_id=?");
$q->execute([$_REQUEST['id']]);

header('location: room_view.php');
