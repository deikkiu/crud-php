<?php

use App\core\Database;



function existUser($email): bool
{
	$db = new Database();

	try {
		$sql = "SELECT COUNT(*) FROM users WHERE email = ?";
		$stmt = $db->connect->prepare($sql);
    $stmt->execute([$email]);
		[$result] = $stmt->fetch();

		return boolval($result);
	} catch (PDOException $e) {
		print('Error: ' . $e->getMessage());
		die();
	}
}


function correctPassword($email, $password): bool
{
	$db = new Database();

	try {
		$sql = "SELECT `password` FROM users WHERE email = ?";
		$stmt = $db->connect->prepare($sql);
		$stmt->execute([$email]);
		[$user_password] = $stmt->fetch();

		return password_verify($password, $user_password);
	} catch (PDOException $e) {
		print('Error: ' . $e->getMessage());
		die();
	}
}
