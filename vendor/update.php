<?php

require_once '../lib/Database.php';

$db = new Database();
$db->updateAccount($_POST);

header('Location: /');
