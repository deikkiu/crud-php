<?php

require_once '../config/connect.php';

$account_id = $_POST['id'];

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['mail'];
$company = $_POST['company'];
$position = $_POST['position'];

mysqli_query($connect, "UPDATE `accounts` SET `name` = '$name', `surname` = '$surname', `email` = '$email', `company` = '$company', `position` = '$position' WHERE `accounts`.`id` = $account_id");

// tels
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];
$tel3 = $_POST['tel3'];

header('Location: /');
