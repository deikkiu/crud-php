<?php

require_once '../config/connect.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['mail'];
$company = $_POST['company'];
$position = $_POST['position'];

$checkEmail = mysqli_query($connect, "SELECT COUNT(*) FROM accounts WHERE email = '$email'");
$checkEmail = mysqli_fetch_all($checkEmail);
$checkEmail = filter_var($checkEmail[0][0], FILTER_VALIDATE_BOOLEAN);

if ($checkEmail) {
  echo 'Email must be unique';
} else {
  mysqli_query($connect, "INSERT INTO `accounts` (`id`, `name`, `surname`, `email`, `company`, `position`) VALUES (NULL, '$name', '$surname', '$email', '$company', '$position')");
}

// tels
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];
$tel3 = $_POST['tel3'];

header('Location: /');
