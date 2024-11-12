<?php require_once('header.php'); ?>
<?php
$q = $pdo->prepare("DELETE FROM subscriber WHERE s_active=?");
$q->execute([0]);

header('location: subscriber_view.php');
