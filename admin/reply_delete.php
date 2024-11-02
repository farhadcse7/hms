<?php require_once('header.php'); ?>
<?php

$q = $pdo->prepare("DELETE FROM reply WHERE reply_id=?");
$q->execute([$_REQUEST['id']]);


header('location: all_replies.php');
