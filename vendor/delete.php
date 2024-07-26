<?php

require_once '../config/connect.php';

$account_id = $_GET['id'];

mysqli_query($connect, "DELETE FROM accounts WHERE `accounts`.`id` = '$account_id'");

header('Location: /');
