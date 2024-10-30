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
		$q = $pdo->prepare("SELECT * FROM category WHERE category_id=?");
		$q->execute([$_REQUEST['id']]);
		$total = $q->rowCount();
		if (!$total) {
			header('location: index.php');
			exit;
		}
	}
}
//delete category from category
$q = $pdo->prepare("DELETE FROM category WHERE category_id=?");
$q->execute([$_REQUEST['id']]);

//select all from post_category (to delete related all posts)
$q = $pdo->prepare("
			SELECT * 
			FROM post_category 
			WHERE category_id=?
		");
$q->execute([
	$_REQUEST['id']
]);
$res = $q->fetchAll();

//one category to all post traveling in table post_category (as same category may have different post ids.) 
// example category id 6, 6 having post id 2 3 in table post_category
foreach ($res as $row) {
	$post_id = $row['post_id'];
	//select all from post
	$r = $pdo->prepare("SELECT * FROM post WHERE post_id=?");
	$r->execute([$post_id]);
	$res1 = $r->fetchAll();

	//delete image from single post
	foreach ($res1 as $row1) {
		unlink('../uploads/' . $row1['post_photo']);
	}

	//delete all data from single post
	$r = $pdo->prepare("DELETE FROM post WHERE post_id=?");
	$r->execute([$post_id]);
}

//delete category from post_category
$q = $pdo->prepare("DELETE FROM post_category WHERE category_id=?");
$q->execute([$_REQUEST['id']]);


header('location: category_view.php');
