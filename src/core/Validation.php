<?php

namespace App\core;

require_once dirname(__DIR__) . '/helpers/uniqueEmail.php';
require_once dirname(__DIR__) . '/helpers/clearFormData.php';
require_once dirname(__DIR__) . '/helpers/auth.php';

class Validation
{
	private array $data;
	private string $pattern_phone = '/^\+?[\(]?[0-9]{1,4}[\)]?[-\s\.]?[0-9]{1,4}[-\s\.]?[0-9]{1,4}[-\s\.]?[0-9]{1,9}$/';
	private string $pattern_name = '/^[\p{L}]+$/u';

	private array $errors = [];
	private bool $flag = true;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function validateAccount(): array
	{
		$id = $this->data['id'] ?? null;
		$table = 'accounts';

		$name = clearFormData($this->data['name']);
		$surname = clearFormData($this->data['surname']);
		$email = $this->data['email'];
		$phone1 = clearFormData($this->data['phone1']);
		$phone2 = clearFormData($this->data['phone2']);
		$phone3 = clearFormData($this->data['phone3']);

		// validate
		$this->checkName($name);
		$this->checkSurname($surname);
		$this->checkEmail($id, $email, $table);
		$this->checkPhones($phone1, $phone2, $phone3);

		return [$this->errors, $this->flag];
	}

	public function validateLogin(): array
	{
		$email = $this->data['email'];
		$password = $this->data['password'];

		// validate
		$this->checkLoginUser($email, $password);

		return [$this->errors, $this->flag];
	}

	public function validateRegister(): array
	{
		$table = 'users';

		$name = clearFormData($this->data['name']);
		$email = $this->data['email'];
		$password = $this->data['password'];
		$password_confirm = $this->data['password-confirm'];

		$this->checkName($name);
		$this->checkEmail(null, $email, $table);
		$this->confirmPassword($password, $password_confirm);

		return [$this->errors, $this->flag];
	}


	// validation methods
	private function checkName($name): void
	{
		if (!preg_match($this->pattern_name, $name)) {
			$this->errors['name'] = '<div class="form__input-error">Имя не должно содержать числа или символы!</div>';
			$this->flag = false;
		}

		if (mb_strlen($name) > 20 || empty($name)) {
			$this->errors['name'] = '<div class="form__input-error">Имя не должно содержать больше 20 символов!</div>';
			$this->flag = false;
		}
	}

	private function checkSurname($surname): void
	{
		if (!preg_match($this->pattern_name, $surname)) {
			$this->errors['surname'] = '<div class="form__input-error">Фамилия не должна содержать числа или символы!</div>';
			$this->flag = false;
		}

		if (mb_strlen($surname) > 20 || empty($surname)) {
			$this->errors['surname'] = '<div class="form__input-error">Фамилия не должна содержать больше 20 символов!</div>';
			$this->flag = false;
		}
	}

	private function checkEmail($id, $email, $table): void
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = '<div class="form__input-error">Email должен быть в формате: example@example.com!</div>';
			$this->flag = false;
		}

		if (checkUniqueEmail($table, $email, $id)) {
			$this->errors['email'] = '<div class="form__input-error">Пользователь с таким email уже существует!</div>';
			$this->flag = false;
		}
	}

	private function checkPhones($phone1, $phone2, $phone3): void
	{
		if (!empty($phone1)) {
			if (!preg_match($this->pattern_phone, $phone1)) {
				$this->errors['phone'] = '<div class="form__input-error">Неправильно введен формат номера телефона!</div>';
				$this->flag = false;
			}
		}

		if (!empty($phone2)) {
			if (!preg_match($this->pattern_phone, $phone2)) {
				$this->errors['phone'] = '<div class="form__input-error">Неправильно введен формат номера телефона!</div>';
				$this->flag = false;
			}
		}

		if (!empty($phone3)) {
			if (!preg_match($this->pattern_phone, $phone3)) {
				$this->errors['phone'] = '<div class="form__input-error">Неправильно введен формат номера телефона!</div>';
				$this->flag = false;
			}
		}
	}

	private function confirmPassword($password, $password_confirm): void
	{
		if($password !== $password_confirm) {
			$this->errors['password'] = '<div class="form__input-error">Пароль подтверждения не совпадает!</div>';
			$this->flag = false;
		}
	}

	private function checkLoginUser($email, $password): void
	{
		if(!existUser($email)) {
			$this->errors['email'] = '<div class="form__input-error">Пользователь c таким email не найден!</div>';
			$this->flag = false;
		}

		if(!correctPassword($email, $password)) {
			$this->errors['password'] = '<div class="form__input-error">Не верный пароль!</div>';
			$this->flag = false;
		}
	}
}