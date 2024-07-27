<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/helpers/pagination.php';

[$accounts, $pages, $page_id, $length] = pagination($_GET['page'] ?? null);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- styles -->
  <link rel="stylesheet" href="public/assets/css/normalize.css" />
  <link rel="stylesheet" href="public/assets/css/font.css" />
  <link rel="stylesheet" href="public/assets/css/style.css" />
  <link rel="stylesheet" href="public/assets/css/media.css" />

  <title>PHP - CRUD App</title>
</head>

<body>
  <main class="main">
    <section class="head">
      <h1 class="head__title">Список аккаунтов</h1>

      <a href="src/views/add.php" class="button head__button">
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
              <a href="src/views/update.php?id=<?= $account['id'] ?>" class="button button__edit">
                <span>Изменить</span>
              </a>
              <a href="src/controllers/delete.php?id=<?= $account['id'] ?>" class="button button__delete">
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
      <section class="pagination">
        <!-- First page -->
        <a href="/" class="pag__first <?php if (!isset($page_id) || (int)$page_id === 1) echo 'dis'; ?>">
          <img src="public/assets/icons/left-m.svg" alt="First" />
        </a>

        <!-- Back page -->
        <a href="?page=<?= $page_id - 1 ?>" class="pag__back <?php if (!isset($page_id) || (int)$page_id === 1) echo 'dis'; ?>">
          <img src="public/assets/icons/left.svg" alt="Back" />
        </a>

        <!-- Links -->
        <?php

        if (!isset($page_id)) {
          echo '<a href="/" class="pag__page active"><span>1</span></a>';
          $count_from = 2;
        } else {
          $count_from = 1;
        }


        for ($num = $count_from; $num <= $pages; $num++) {
          if ($num == $page_id) {
            echo '<a href="?page=' . $num . '" class="pag__page active"><span>' . $num . '</span></a>';
          } else {
            echo '<a href="?page=' . $num . '" class="pag__page"><span>' . $num . '</span></a>';
          }
        }
        ?>

        <!-- Next page -->
        <?php
        if ($page_id < $pages) {
          if (!isset($page_id)) {
            echo '
              <a href="?page=2" class="pag__next ">
                <img src="public/assets/icons/right.svg" alt="Next" />
              </a>
            ';
          } else {
            echo '
              <a href="?page=' . $page_id + 1 . '" class="pag__next ">
                <img src="public/assets/icons/right.svg" alt="Next" />
              </a>
            ';
          }
        } else {
          echo '
            <a href="#" class="pag__next dis">
              <img src="public/assets/icons/right.svg" alt="Next" />
            </a>
          ';
        }
        ?>

        <!-- Last page -->
        <a href="?page=<?= $pages ?>" class="pag__last <?php if ((int)$page_id === (int)$pages) echo 'dis'; ?>" type="button">
          <img src="public/assets/icons/right-m.svg" alt="Last" />
        </a>
      </section>

    <?php
    }
    ?>
  </main>
</body>

</html>