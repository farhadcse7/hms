<?php
ob_start();
session_start();
require_once('admin/db.php');
require_once('admin/functions.php');

unset($_SESSION['customer']);
header('location: login.php');
