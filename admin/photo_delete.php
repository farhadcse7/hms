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
		$q = $pdo->prepare("SELECT * FROM photo WHERE photo_id=?");
		$q->execute([$_REQUEST['id']]);
		$total = $q->rowCount();
		if (!$total) {
			header('location: index.php');
			exit;
		}
	}
}


$q = $pdo->prepare("SELECT * FROM photo WHERE photo_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$photo_name = $row['photo_name'];
}
unlink('../uploads/' . $photo_name);

$q = $pdo->prepare("DELETE FROM photo WHERE photo_id=?");
$q->execute([$_REQUEST['id']]);

header('location: photo_view.php');
