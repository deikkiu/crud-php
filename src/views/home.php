<?php

require '../../vendor/autoload.php';

use App\core\Pagination;

$pagination = new Pagination();
[$accounts, $pages, $page_id, $length] = $pagination->getAccountsByPage($_GET['page'] ?? null);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php require_once '../components/head.php' ?>

	<title>PHP CRUD - App</title>
</head>

<body>
<main class="main">
	<section class="head">
		<h1 class="head__title">Список аккаунтов</h1>

		<a href="add.php" class="button head__button">
			<span>Добавить аккаунт</span>
		</a>
	</section>

	<section class="account">
		<?php
		if ($length < 1) {
			echo '<p class="account__empty">Нажмите кнопку - <b>ДОБАВИТЬ АККАУНТ</b>, чтобы создать новый аккаунт.</p>';
		}
		?>

		<div class="account__list">
			<?php
			foreach ($accounts as $account) {
				?>
				<div class="account__item">
					<div class="account__item-info">
						<div class="account__item-text">
							<span class="account__item-sub">Имя:</span>
							<span><?= $account['name'] ?></span>
						</div>
						<div class="account__item-text">
							<span class="account__item-sub">Фамилия:</span>
							<span><?= $account['surname'] ?></span>
						</div>
						<div class="account__item-text">
							<span class="account__item-sub">Email:</span>
							<a href="mailto:<?= $account['email'] ?>"><?= $account['email'] ?></a>
						</div>
						<div class="account__item-text">
							<span class="account__item-sub">Компания:</span>
							<span><?= $account['company'] ?></span>
						</div>
						<div class="account__item-text">
							<span class="account__item-sub">Должность:</span>
							<span><?= $account['position'] ?></span>
						</div>
						<div class="account__item-text">
							<span class="account__item-sub">Телефон:</span>
							<div class="account__item-tels">
								<?php
								if ($account['phone1']) {
									echo '<a href="tel:' . $account['phone1'] . '">' . $account['phone1'] . '</a>';
								}

								if ($account['phone2']) {
									echo '<a href="tel:' . $account['phone2'] . '">' . $account['phone2'] . '</a>';
								}

								if ($account['phone3']) {
									echo '<a href="tel:' . $account['phone3'] . '">' . $account['phone3'] . '</a>';
								}
								?>
							</div>
						</div>
					</div>

					<div class="account__item-btn">
						<a href="update.php?id=<?= $account['id'] ?>" class="button button__edit">
							<span>Изменить</span>
						</a>
						<a href="../controllers/delete.php?id=<?= $account['id'] ?>" class="button button__delete">
							<span>Удалить</span>
						</a>
					</div>
				</div>

				<?php
			}
			?>

		</div>
	</section>

	<?php
	if ($length > 10) {
		?>

		<!-- Pagination -->
		<?php require_once '../components/pagination.php' ?>
		<?php
	}
	?>
</main>
</body>

</html>
