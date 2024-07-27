<?php

function checkUniqueEmail($connect, $email, $id = null)
{
  $stmt = $connect->prepare("SELECT COUNT(*) FROM accounts WHERE email = ? AND id != ?");
  $stmt->execute([$email, $id]);

  $result = $stmt->fetch();
  $result =  filter_var($result[0], FILTER_VALIDATE_BOOLEAN);

  return $result;
}
