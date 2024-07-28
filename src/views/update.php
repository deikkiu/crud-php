<?php

require_once dirname(__DIR__) . '/core/Database.php';

session_start();

$db = new Database();
$id = $_GET['id'];

$data = $_SESSION['form_data1'] ?? null;
$errors = $_SESSION['form_errors1'] ?? null;

var_dump($data);
var_dump($errors);

$account = isset($data) ? $data : $db->getAccountById($id);

var_dump($account);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../../public/assets/css/normalize.css" />
  <link rel="stylesheet" href="../../public/assets/css/font.css" />
  <link rel="stylesheet" href="../../public/assets/css/style.css" />
  <link rel="stylesheet" href="../../public/assets/css/media.css" />
  <title>Form</title>
</head>

<body class="body__form">
  <main class="main main__form">
    <section class="form">

      <div class="back">
        <a href="/" class="back__link">
          <img src="../../public/assets/icons/back.svg" alt="Back">
        </a>

        <h1 class="form__title">Изменить аккаунт</h1>
      </div>

      <form action="../controllers/update.php" method="post">

        <!-- hidden id input -->
        <input hidden name="id" value="<?= $id ?>">

        <div class="form__block">
          <label for="name">Имя</label>
          <input value="<?= $account['name']; ?>" id="name" type="text" name="name" required placeholder="Введите имя*" />
          <?php if (isset($errors)) {
            echo $errors['name'] ?? '';
          } ?>
        </div>

        <div class="form__block">
          <label for="surname">Фамилия</label>
          <input value="<?= $account['surname']; ?>" id="surname" type="text" name="surname" required placeholder="Введите фамилия*" />
          <?php if (isset($errors)) {
            echo $errors['surname'] ?? '';
          } ?>
        </div>

        <div class="form__block">
          <label for="email">Email</label>
          <input value="<?= $account['email']; ?>" id="email" type="email" name="email" required placeholder="Введите email*" />
          <?php if (isset($errors)) {
            echo $errors['email'] ?? '';
          } ?>
        </div>

        <div class="form__block">
          <label for="company">Компания</label>
          <input value="<?= $account['company']; ?>" id="company" type="text" name="company" placeholder="Введите название компании" />
        </div>

        <div class="form__block">
          <label for="position">Должность</label>
          <input value="<?= $account['position']; ?>" id="position" type="text" name="position" placeholder="Введите должность" />
        </div>

        <div class="form__block">
          <label for="tel">Телефон</label>
          <input value="<?= $account['phone1']; ?>" id="phone1" type="tel" name="phone1" placeholder="Введите номер телефона" />
          <input value="<?= $account['phone2']; ?>" id="phone2" type="tel" name="phone2" placeholder="Введите доп. номер телефона" />
          <input value="<?= $account['phone3']; ?>" id="phone3" type="tel" name="phone3" placeholder="Введите доп. номер телефона" />

          <?php if (isset($errors)) {
            echo $errors['phone'] ?? '';
          } ?>
        </div>

        <div class="form__btn">
          <button class="button form__button form__button-add" type="submit">
            Изменить
          </button>
        </div>
      </form>
    </section>
  </main>
</body>

</html>

<?php
session_unset();
?>