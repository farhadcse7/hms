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
		$q = $pdo->prepare("SELECT * FROM testimonial WHERE testimonial_id=?");
		$q->execute([$_REQUEST['id']]);
		$total = $q->rowCount();
		if (!$total) {
			header('location: index.php');
			exit;
		}
	}
}


$q = $pdo->prepare("SELECT * FROM testimonial WHERE testimonial_id=?");
$q->execute([$_REQUEST['id']]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$person_photo = $row['person_photo'];
}
unlink('../uploads/' . $person_photo);

$q = $pdo->prepare("DELETE FROM testimonial WHERE testimonial_id=?");
$q->execute([$_REQUEST['id']]);

header('location: testimonial_view.php');
