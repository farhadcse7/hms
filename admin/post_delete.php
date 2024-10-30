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
		$q = $pdo->prepare("SELECT * FROM slider WHERE slider_id=?");
		$q->execute([$_REQUEST['id']]);
		$total = $q->rowCount();
		if (!$total) {
			header('location: index.php');
			exit;
		}
	}
}


$q = $pdo->prepare("SELECT * FROM slider WHERE slider_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$slider_photo = $row['slider_photo'];
}
unlink('../uploads/' . $slider_photo);

$q = $pdo->prepare("DELETE FROM slider WHERE slider_id=?");
$q->execute([$_REQUEST['id']]);

header('location: slider_view.php');
