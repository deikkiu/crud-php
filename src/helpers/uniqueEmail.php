<?php

use App\core\Database;

function checkUniqueEmail($table, $email, $id = null): mixed
{
  $db = new Database();

  if (!isset($id)) {
    $stmt = $db->connect->prepare("SELECT COUNT(*) FROM $table WHERE email = ?");
    $stmt->execute([$email]);
  } else {
    $stmt = $db->connect->prepare("SELECT COUNT(*) FROM $table WHERE email = ? AND id != ?");
    $stmt->execute([$email, $id]);
  }

  [$result] = $stmt->fetch();
  return filter_var($result, FILTER_VALIDATE_BOOLEAN);
}
