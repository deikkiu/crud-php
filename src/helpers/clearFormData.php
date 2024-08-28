<?php

function clearFormData($value): string
{
  $value = trim($value);
  $value = stripslashes($value); // Delete /
  $value = strip_tags($value); // Delete html tags
  $value = htmlspecialchars($value); // Сonverts html chars

  return $value;
}