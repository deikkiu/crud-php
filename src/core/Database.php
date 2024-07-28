<?php

require_once dirname(__DIR__) . '/config/config.php';

class Database
{
  private $host = HOST;
  private $user = USER;
  private $password = PASSWORD;
  private $database = DATABASE;

  public $connect;
  public $error;

  public function __construct()
  {
    $this->dbConnect();
  }

  private function dbConnect()
  {
    try {
      $this->connect = new PDO("mysql:host=$this->host;dbname=$this->database;", $this->user, $this->password);
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

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
      $sql = "SELECT * FROM accounts";
      $stmt = $this->connect->query($sql);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return count($result);
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  // crud methods

  public function createAccount($data)
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

  public function updateAccount($data)
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

  public function deleteAccount($id)
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
}
