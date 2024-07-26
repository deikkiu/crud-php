<?php

require_once '../config/connect.php';

$account_id = $_POST['id'];

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['mail'];
$company = $_POST['company'];
$position = $_POST['position'];
$phone1 = $_POST['tel1'];
$phone2 = $_POST['tel2'];
$phone3 = $_POST['tel3'];

mysqli_query($connect, "UPDATE `accounts` SET `name` = '$name', `surname` = '$surname', `email` = '$email', `company` = '$company', `position` = '$position', `phone1` = '$phone1', `phone2` = '$phone2', `phone3` = '$phone3' WHERE `accounts`.`id` = $account_id");

header('Location: /');
