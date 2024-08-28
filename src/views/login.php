<?php

session_start();

$data = $_SESSION['form_data'] ?? null;
$errors = $_SESSION['form_errors'] ?? null;

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<?php require_once '../components/head.php' ?>
	<title>Авторизация</title>
</head>

<body class="body__form">
<main class="main main__form">
	<section class="form">
		<div class="back">
			<h1 class="form__title">Авторизация</h1>
		</div>

		<form action="../controllers/login.php" method="post">
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
				<label for="password">
					Пароль
				</label>
				<input id="password" type="password" name="password" required placeholder="Введите пароль*"/>
				<?php if (isset($errors['password'])) {
					echo $errors['password'];
				} ?>
			</div>

			<div class="form__btn">
				<button class="button form__button form__button-add" type="submit">
					Продолжить
				</button>
			</div>
		</form>

		<a class="link__login" href="register.php">У меня нет <span>аккаунта</span></a>
	</section>
</main>
</body>
</html>

<?php
session_destroy();
?>
