<?php

require_once dirname(__DIR__) . '/core/Database.php';

function checkUniqueEmail($email, $id)
{
  $db = new Database();

  $stmt = $db->connect->prepare("SELECT COUNT(*) FROM accounts WHERE email = ? AND id != ?");
  $stmt->execute([$email, $id]);

  $result = $stmt->fetch();
  $result =  filter_var($result[0], FILTER_VALIDATE_BOOLEAN);

  return $result;
}
