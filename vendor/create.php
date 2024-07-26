<?php

require_once '../config/connect.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['mail'];
$company = $_POST['company'];
$position = $_POST['position'];
$phone1 = $_POST['tel1'];
$phone2 = $_POST['tel2'];
$phone3 = $_POST['tel3'];

$check_email = mysqli_query($connect, "SELECT COUNT(*) FROM accounts WHERE email = '$email'");
$check_email = mysqli_fetch_all($check_email);
$check_email = filter_var($check_email[0][0], FILTER_VALIDATE_BOOLEAN);

if ($check_email) {
  die('Email must be unique');
} else {
  mysqli_query($connect, "INSERT INTO `accounts` (`id`, `name`, `surname`, `email`, `company`, `position`, `phone1`, `phone2`, `phone3`) VALUES (NULL, '$name', '$surname', '$email', '$company', '$position', '$phone1', '$phone2', '$phone2')");
}

header('Location: /');
