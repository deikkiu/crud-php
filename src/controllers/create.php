<?php

require_once dirname(__DIR__) . '/core/Database.php';
require_once dirname(__DIR__) . '/helpers/validation.php';

session_start();

$db = new Database();

[$flag, $errors] = validateData($_POST);

if ($flag) {
  $db->createAccount($_POST);
  session_unset();
  header('Location: /');
} else {
  $_SESSION['form_data'] = $_POST;
  $_SESSION['form_errors'] = $errors;
  header('Location: /src/views/add.php');
}
