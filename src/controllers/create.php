<?php

require_once '../core/Database.php';

$db = new Database();
$db->createAccount($_POST);

header('Location: /');
