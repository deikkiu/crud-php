<?php

require_once dirname(__DIR__) . '/core/Database.php';

$db = new Database();
$db->createAccount($_POST);

header('Location: /');
