<?php

function checkUniqueEmail($context, $email, $id = null)
{
  $stmt = $context->connect->prepare("SELECT COUNT(*) FROM accounts WHERE email = ? AND id != ?");
  $stmt->execute([$email, $id]);

  $result = $stmt->fetch();
  $result =  filter_var($result[0], FILTER_VALIDATE_BOOLEAN);

  return $result;
}
