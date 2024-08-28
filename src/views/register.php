<?php

session_start();

$data = $_SESSION['form_data'] ?? null;
$errors = $_SESSION['form_errors'] ?? null;

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<?php require_once '../components/head.php' ?>
	<title>Регистрация</title>
</head>

<body class="body__form">
<main class="main main__form">
	<section class="form">

		<div class="back">
			<h1 class="form__title">Регистрация</h1>
		</div>

		<form action="../controllers/register.php" method="post">
			<div class="form__block">
				<label for="name">
					Имя
				</label>
				<input value="<?php if (isset($data)) {
					echo $data['name'];
				} ?>" id="name" type="text" name="name" required placeholder="Введите имя*"/>
				<?php if (isset($errors['name'])) {
					echo $errors['name'];
				} ?>
			</div>

			<div class="form__block">
				<label for="email">Email</label>
				<input value="<?php if (isset($data)) {
					echo $data['email'];
				} ?>" id="email" type="email" name="email" required placeholder="Введите email*"/>
				<?php if (isset($errors['email'])) {
					echo $errors['email'];
				} ?>
			</div>

			<div class="form__block">
				<div class="line">
					<label for="password">
						Пароль
						<input id="password" type="password" name="password" required placeholder="Введите пароль*"/>
					</label>

					<label for="password-confirm">
						Повторите пароль
						<input id="password-confirm" type="password" name="password-confirm" required
						       placeholder="Повторите пароль*"/>
					</label>
				</div>

				<?php if (isset($errors['password'])) {
					echo $errors['password'];
				} ?>
			</div>

			<div class="form__block checkbox">
				<input type="checkbox" name="agree" required/>
				<label for="email">
					Я принимаю все условия пользования!
				</label>
			</div>

			<div class="form__btn">
				<button class="button form__button form__button-add" type="submit">
					Продолжить
				</button>
			</div>
		</form>


		<a class="link__login" href="login.php">У меня уже есть <span>аккаунт</span></a>
	</section>
</main>
</body>
</html>

<?php
session_destroy();
?>
