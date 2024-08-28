<?php

require 'vendor/autoload.php';

if (isset($_SESSION['user']['id'])) {
	header('Location: /src/views/home.php');
} else {
	header('Location: /src/views/login.php');
}


