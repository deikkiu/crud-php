<?php

require_once dirname(__DIR__) . '/core/Database.php';

$db = new Database();
$db->deleteAccount($_GET['id']);

header('Location: /');
