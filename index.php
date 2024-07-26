<?php

require_once 'config/connect.php';

$accounts = mysqli_query($connect, "SELECT * FROM `accounts`");
$accounts = mysqli_fetch_all($accounts);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- styles -->
  <link rel="stylesheet" href="/css/normalize.css" />
  <link rel="stylesheet" href="/css/font.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/media.css" />

  <title>PHP - CRUD App</title>
</head>

<body>
  <main class="main">
    <section class="head">
      <h1 class="head__title">Список аккаунтов</h1>

      <a href="create.php" class="button head__button">
        <span>Добавить аккаунт</span>
      </a>
    </section>

    <section class="account">
      <div class="account__list">
        <?php
        foreach ($accounts as $account) {
        ?>
          <div class="account__item">
            <div class="account__item-info">
              <div class="account__item-text">
                <span class="account__item-sub">Имя:</span>
                <span><?= $account[1] ?></span>
              </div>
              <div class="account__item-text">
                <span class="account__item-sub">Фамилия:</span>
                <span><?= $account[2] ?></span>
              </div>
              <div class="account__item-text">
                <span class="account__item-sub">Email:</span>
                <a href="mailto:<?= $account[3] ?>"><?= $account[3] ?></a>
              </div>
              <div class="account__item-text">
                <span class="account__item-sub">Компания:</span>
                <span><?= $account[4] ?></span>
              </div>
              <div class="account__item-text">
                <span class="account__item-sub">Должность:</span>
                <span><?= $account[5] ?></span>
              </div>
              <div class="account__item-text">
                <span class="account__item-sub">Телефон:</span>
                <div class="account__item-tels">
                  <?php
                  if ($account[6]) {
                    echo '<a href="tel:' . $account[6] . '">' . $account[6] . '</a>';
                  }

                  if ($account[7]) {
                    echo '<a href="tel:' . $account[7] . '">' . $account[7] . '</a>';
                  }

                  if ($account[8]) {
                    echo '<a href="tel:' . $account[8] . '">' . $account[8] . '</a>';
                  }
                  ?>
                </div>
              </div>
            </div>

            <div class="account__item-btn">
              <a href="update.php?id=<?= $account[0] ?>" class="button button__edit">
                <span>Изменить</span>
              </a>
              <a href="vendor/delete.php?id=<?= $account[0] ?>" class="button button__delete">
                <span>Удалить</span>
              </a>
            </div>
          </div>

        <?php
        }
        ?>

      </div>
    </section>

    <section class="pagination">
      <button class="pag__first" type="button">
        <img src="/icons/left-m.svg" alt="First" />
      </button>
      <button class="pag__back" type="button">
        <img src="/icons/left.svg" alt="Back" />
      </button>
      <button class="pag__page active" type="button">
        <span>1</span>
      </button>
      <button class="pag__page" type="button">
        <span>2</span>
      </button>
      <button class="pag__page" type="button">
        <span>3</span>
      </button>
      <button class="pag__page dis" type="button">
        <span>...</span>
      </button>
      <button class="pag__page" type="button">
        <span>10</span>
      </button>
      <button class="pag__next" type="button">
        <img src="/icons/right.svg" alt="Next" />
      </button>
      <button class="pag__last" type="button">
        <img src="/icons/right-m.svg" alt="Last" />
      </button>
    </section>
  </main>
</body>

</html>