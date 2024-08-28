<?php

require '../../vendor/autoload.php';

use App\core\Database;

$db = new Database();
$db->deleteAccount($_GET['id']);

header('Location: /');
