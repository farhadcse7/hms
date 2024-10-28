<?php require_once('header.php'); ?>
<?php

$q = $pdo->prepare("DELETE FROM user WHERE user_id=?");
$q->execute([$_REQUEST['id']]);

header('location: user_view.php');
