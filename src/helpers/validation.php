<?php

require_once __DIR__ . '/uniqueEmail.php';

function clearFormData($value)
{
  $value = trim($value);
  $value = stripslashes($value); // Убирает /
  $value = strip_tags($value); // Убирает html теги
  $value = htmlspecialchars($value); // Приобразует html символы

  return $value;
}

function validateData($data)
{
  $id = $data['id'] ?? null;

  $name = clearFormData($data['name']);
  $surname = clearFormData($data['surname']);
  $email = clearFormData($data['email']);
  $phone1 = clearFormData($data['phone1']);
  $phone2 = clearFormData($data['phone2']);
  $phone3 = clearFormData($data['phone3']);

  // filter_var($mail, FILTER_VALIDATE_EMAIL)
  $pattern_phone = '/^\+?[\(]?[0-9]{1,4}[\)]?[-\s\.]?[0-9]{1,4}[-\s\.]?[0-9]{1,4}[-\s\.]?[0-9]{1,9}$/';
  $pattern_name = '/^[\p{L}]+$/u';

  $errors = [];
  $flag = true;

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // check name
    if (!preg_match($pattern_name, $name)) {
      $errors['name'] = '<div class="form__input-error">Имя не должно содержать числа или символы!</div>';
      $flag = false;
    }

    if (mb_strlen($name) > 20 || empty($name)) {
      $errors['name'] = '<div class="form__input-error">Имя не должно содержать больше 20 символов!</div>';
      $flag = false;
    }

    // check surname
    if (!preg_match($pattern_name, $surname)) {
      $errors['surname'] = '<div class="form__input-error">Фамилия не должна содержать числа или символы!</div>';
      $flag = false;
    }

    if (mb_strlen($name) > 20 || empty($surname)) {
      $errors['surname'] = '<div class="form__input-error">Фамилия не должна содержать больше 20 символов!</div>';
      $flag = false;
    }

    // check email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = '<div class="form__input-error">Email должен быть в формате: example@example.com!</div>';
      $flag = false;
    }

    if (!checkUniqueEmail($email, $id)) {
      $errors['email'] = '<div class="form__input-error">Email должен быть уникальным!</div>';
      $flag = false;
    }

    // check phone
    if (!empty($phone1)) {
      if (!preg_match($pattern_phone, $phone1)) {
        $errors['phone'] = '<div class="form__input-error">Неправильно введен формат номера телефона!</div>';
        $flag = false;
      }
    }

    if (!empty($phone2)) {
      if (!preg_match($pattern_phone, $phone2)) {
        $errors['phone'] = '<div class="form__input-error">Неправильно введен формат номера телефона!</div>';
        $flag = false;
      }
    }

    if (!empty($phone3)) {
      if (!preg_match($pattern_phone, $phone3)) {
        $errors['phone'] = '<div class="form__input-error">Неправильно введен формат номера телефона!</div>';
        $flag = false;
      }
    }
  }

  return [$flag, $errors];
}
