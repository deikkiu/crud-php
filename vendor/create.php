<?php

require_once '../lib/Database.php';

$db = new Database();
$db->createAccount($_POST);

header('Location: /');
