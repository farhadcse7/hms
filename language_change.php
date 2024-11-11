<?php
ob_start();
session_start();

$code = $_REQUEST['code'];

$_SESSION['current_lang_code'] = $code;

header('location: ' . $_REQUEST['page']);
