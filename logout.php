<?php
ob_start();
require_once 'core/init.php';

$user = new UserLogin();

$user->logout();
Redirect::to('index.php');
ob_end_flush();