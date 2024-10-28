<?php require_once('header.php'); ?>
<?php

$q = $pdo->prepare("DELETE FROM role WHERE role_id=?");
$q->execute([$_REQUEST['id']]);

$q = $pdo->prepare("DELETE FROM role_access WHERE role_id=?");
$q->execute([$_REQUEST['id']]);

$q = $pdo->prepare("DELETE FROM user WHERE role_id=?");
$q->execute([$_REQUEST['id']]);

header('location: role_view.php');
