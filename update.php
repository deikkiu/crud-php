<?php

require_once 'config/connect.php';

$account_id = $_GET['id'];

$account = mysqli_query($connect, "SELECT * FROM `accounts` WHERE `id` = '$account_id'");
$account = mysqli_fetch_assoc($account);

?>


<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="/css/normalize.css" />
  <link rel="stylesheet" href="/css/font.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/media.css" />
  <title>Form</title>
</head>

<body class="body__form">
  <main class="main main__form">
    <section class="form">

      <div class="back">
        <a href="/" class="back__link">
          <img src="/icons/back.svg" alt="Back">
        </a>

        <h1 class="form__title">Изменить аккаунт</h1>
      </div>

      <form action="vendor/update.php" method="post">

        <!-- hidden id input -->
        <input hidden name="id" value="<?= $account_id ?>">

        <div class="form__block">
          <label for="name">Имя</label>
          <input value="<?= $account['name'] ?>" id="name" type="text" name="name" required placeholder="Введите имя*" />
        </div>

        <div class="form__block">
          <label for="surname">Фамилия</label>
          <input value="<?= $account['surname'] ?>" id="surname" type="text" name="surname" required placeholder="Введите фамилия*" />
        </div>

        <div class="form__block">
          <label for="mail">Email</label>
          <input value="<?= $account['email'] ?>" id="mail" type="email" name="mail" required placeholder="Введите email*" />
        </div>

        <div class="form__block">
          <label for="company">Компания</label>
          <input value="<?= $account['company'] ?>" id="company" type="text" name="company" placeholder="Введите название компании" />
        </div>

        <div class="form__block">
          <label for="position">Должность</label>
          <input value="<?= $account['position'] ?>" id="position" type="text" name="position" placeholder="Введите должность" />
        </div>

        <div class="form__block">
          <label for="tel">Телефон</label>
          <input value="<?= $account['phone1'] ?>" id="tel1" type="tel" name="tel1" placeholder="Введите номер телефона" />
          <input value="<?= $account['phone2'] ?>" id="tel2" type="tel" name="tel2" placeholder="Введите доп. номер телефона" />
          <input value="<?= $account['phone3'] ?>" id="tel3" type="tel" name="tel3" placeholder="Введите доп. номер телефона" />
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