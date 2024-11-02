<?php require_once('header.php'); ?>
<?php

$q = $pdo->prepare("DELETE FROM reply WHERE comment_id=?");
$q->execute([$_REQUEST['id']]);

$q = $pdo->prepare("DELETE FROM comment WHERE comment_id=?");
$q->execute([$_REQUEST['id']]);


header('location: all_comments.php');
