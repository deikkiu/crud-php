<?php

require_once dirname(__DIR__) . '/core/Database.php';
require_once dirname(__DIR__) . '/helpers/validation.php';

$db = new Database();

[$flag, $errors] = validateData($_POST);

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
