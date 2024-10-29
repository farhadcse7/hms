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
		$q = $pdo->prepare("SELECT * FROM photo_category WHERE photo_category_id=?");
		$q->execute([$_REQUEST['id']]);
		$total = $q->rowCount();
		if (!$total) {
			header('location: index.php');
			exit;
		}
	}
}

// Delete all photos under this category
$q = $pdo->prepare("
			SELECT * 
			FROM photo 
			WHERE photo_category_id=?
		");
$q->execute([
	$_REQUEST['id']
]);
$res = $q->fetchAll();
foreach ($res as $row) {
	unlink('../uploads/' . $row['photo_name']);
}

//also Delete all photos under this category- photo table
$q = $pdo->prepare("DELETE FROM photo WHERE photo_category_id=?");
$q->execute([$_REQUEST['id']]);

$q = $pdo->prepare("DELETE FROM photo_category WHERE photo_category_id=?");
$q->execute([$_REQUEST['id']]);


header('location: photo_category_view.php');
