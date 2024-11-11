<?php require_once('header.php'); ?>
<?php
$q = $pdo->prepare("DELETE FROM feature WHERE feature_id=?");
$q->execute([$_REQUEST['id']]);

$q = $pdo->prepare("DELETE FROM feature_language WHERE feature_id=?");
$q->execute([$_REQUEST['id']]);

header('location: feature_view.php');
