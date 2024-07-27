<?php

require_once '../core/Database.php';

$db = new Database();
$db->deleteAccount($_GET['id']);

header('Location: /');
