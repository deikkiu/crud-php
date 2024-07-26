<?php

require_once '../lib/Database.php';

$db = new Database();
$db->deleteAccount($_GET['id']);

header('Location: /');
