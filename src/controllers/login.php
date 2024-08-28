<?php

require '../../vendor/autoload.php';

use App\core\Database;
use App\core\Validation;

session_start();

$db = new Database();
$validation = new Validation($_POST);

[$errors, $flag] = $validation->validateLogin();

if ($flag) {
	$user_id = $db->getUser($_POST['email']);
	$_SESSION['user']['id'] = $user_id;
	header('Location: /src/views/home.php');
} else {
	$_SESSION['form_data'] = $_POST;
	$_SESSION['form_errors'] = $errors;
	header('Location: /src/views/login.php');
}



