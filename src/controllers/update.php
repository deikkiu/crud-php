<?php

require_once dirname(__DIR__) . '/core/Database.php';

$db = new Database();
$db->updateAccount($_POST);

header('Location: /');
