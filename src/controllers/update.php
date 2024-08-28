<?php

require '../../vendor/autoload.php';

use App\core\Database;
use App\core\Validation;

session_start();

$db = new Database();
$validation = new Validation($_POST);

[$errors, $flag] = $validation->validateAccount();

$id = $_POST['id'];

if ($flag) {
  $db->updateAccount($_POST);
  session_unset();
  header('Location: /');
} else {
  $_SESSION['form_data'] = $_POST;
  $_SESSION['form_errors'] = $errors;
  header("Location: /src/views/update.php?id=$id");
}
