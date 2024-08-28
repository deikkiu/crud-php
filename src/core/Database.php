<?php

namespace App\core;

use PDO;
use PDOException;

require_once dirname(__DIR__) . '/config/config.php';

class Database
{
  // mysql values for connect
  private string $host = HOST;
  private string $user = USER;
  private string $password = PASSWORD;
  private string $database = DATABASE;

  // pdo connect
  public PDO $connect;

  public function __construct()
  {
    $this->dbConnect();
  }

  private function dbConnect(): void
  {
    try {
      $this->connect = new PDO("mysql:host=$this->host;dbname=$this->database;", $this->user, $this->password);
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  // db getters
  public function getAllAccounts()
  {
    try {
      $sql = "SELECT * FROM accounts";
      $stmt = $this->connect->query($sql);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $result;
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  public function getAccountsByLimit($start, $end)
  {
    try {
      $sql = "SELECT * FROM accounts LIMIT :start, :end;";
      $stmt = $this->connect->prepare($sql);
      $stmt->bindValue(':start', $start, PDO::PARAM_INT);
      $stmt->bindValue(':end', $end, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $result;
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  public function getAccountById($id)
  {
    try {
      $sql = "SELECT * FROM accounts WHERE `id` = ?";
      $stmt = $this->connect->prepare($sql);
      $stmt->execute([$id]);
      $account = $stmt->fetch(PDO::FETCH_ASSOC);

      return $account;
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  public function getAccountsLength()
  {
    try {
      $sql = "SELECT COUNT(*) FROM accounts";
      $stmt = $this->connect->query($sql);
	    $result = $stmt->fetch();

      return $result;
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

	public function getUser(string $email)
	{
		try {
			$sql = "SELECT id FROM users WHERE `email` = ?";
			$stmt = $this->connect->prepare($sql);
			$stmt->execute([$email]);
			[$user_id] = $stmt->fetch();

			return $user_id;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			die();
		}
	}

  // db crud methods
  public function createAccount($data): void
  {
    $name = $data['name'];
    $surname = $data['surname'];
    $email = $data['email'];
    $company = $data['company'];
    $position = $data['position'];
    $phone1 = $data['phone1'];
    $phone2 = $data['phone2'];
    $phone3 = $data['phone3'];

    try {
      $sql = "INSERT INTO `accounts` (`id`, `name`, `surname`, `email`, `company`, `position`, `phone1`, `phone2`, `phone3`) VALUES (:id, :name, :surname, :email, :company, :position, :phone1, :phone2, :phone3)";
      $params = [
        ':id' => NULL,
        ':name' => $name,
        ':surname' => $surname,
        ':email' => $email,
        ':company' => $company,
        ':position' => $position,
        ':phone1' => $phone1,
        ':phone2' => $phone2,
        ':phone3' => $phone3,
      ];
      $stmt = $this->connect->prepare($sql);
      $stmt->execute($params);
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  public function updateAccount($data): void
  {
    $id = $data['id'];
    $name = $data['name'];
    $surname = $data['surname'];
    $email = $data['email'];
    $company = $data['company'];
    $position = $data['position'];
    $phone1 = $data['phone1'];
    $phone2 = $data['phone2'];
    $phone3 = $data['phone3'];

    try {
      $sql = "UPDATE `accounts` SET `name` = :name, `surname` = :surname, `email` = :email, `company` = :company, `position` = :position, `phone1` = :phone1, `phone2` = :phone2, `phone3` = :phone3 WHERE `accounts`.`id`= :id";
      $params = [
        ':id' => $id,
        ':name' => $name,
        ':surname' => $surname,
        ':email' => $email,
        ':company' => $company,
        ':position' => $position,
        ':phone1' => $phone1,
        ':phone2' => $phone2,
        ':phone3' => $phone3,
      ];
      $stmt = $this->connect->prepare($sql);
      $stmt->execute($params);
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  public function deleteAccount($id): void
  {
    try {
      $sql = "DELETE FROM `accounts` WHERE `id` = ?";
      $params = [$id];
      $stmt = $this->connect->prepare($sql);
      $stmt->execute($params);
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

	// db user methods
	public function registerUser($data): void
	{
		$email = $data['email'];
		$password = $data['password'];
		$name = $data['name'];

		try {
			$sql = "INSERT INTO `users` (`email`, `password`, `name`) VALUES (:email, :password, :name)";
			$params = [
				':email' => $email,
				':password' => password_hash($password, PASSWORD_DEFAULT),
				':name' => $name
			];
			$stmt = $this->connect->prepare($sql);
			$stmt->execute($params);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			die();
		}
	}

	public function loginUser(string $email, string $password): bool
	{
		try {
			$sql = "SELECT COUNT(*) FROM users WHERE email = :email AND password = :password";
			$params = [
				':email' => $email,
				':password' => $password,
			];
			$stmt = $this->connect->prepare($sql);
			$stmt->execute($params);

			[$result] = $stmt->fetch();
			return boolval($result);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			die();
		}
	}


}
