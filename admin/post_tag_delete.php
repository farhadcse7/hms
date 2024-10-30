<?php require_once('header.php'); ?>
<?php
if (!isset($_REQUEST['id'])) {
    header('location: index.php');
    exit;
}

$q = $pdo->prepare("DELETE FROM post_tag WHERE post_tag_id=?");
$q->execute([$_REQUEST['id']]);

header('location: post_edit.php?id=' . $_REQUEST['id1']);
