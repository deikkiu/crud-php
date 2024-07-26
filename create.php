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

        <h1 class="form__title">Создать аккаунт</h1>
      </div>

      <form action="vendor/create.php" method="post">
        <div class="form__block">
          <label for="name">Имя</label>
          <input id="name" type="text" name="name" required placeholder="Введите имя*" />
        </div>

        <div class="form__block">
          <label for="surname">Фамилия</label>
          <input id="surname" type="text" name="surname" required placeholder="Введите фамилия*" />
        </div>

        <div class="form__block">
          <label for="mail">Email</label>
          <input id="mail" type="email" name="mail" required placeholder="Введите email*" />
        </div>

        <div class="form__block">
          <label for="company">Компания</label>
          <input id="company" type="text" name="company" placeholder="Введите название компании" />
        </div>

        <div class="form__block">
          <label for="position">Должность</label>
          <input id="position" type="text" name="position" placeholder="Введите должность" />
        </div>

        <div class="form__block">
          <label for="tel">Телефон</label>
          <input id="tel1" type="tel" name="tel1" placeholder="Введите номер телефона" />
          <input id="tel2" type="tel" name="tel2" placeholder="Введите доп. номер телефона" />
          <input id="tel3" type="tel" name="tel3" placeholder="Введите доп. номер телефона" />
        </div>

        <div class="form__btns">
          <button class="button form__button form__button-reset" type="reset">
            Очистить
          </button>
          <button class="button form__button form__button-add" type="submit">
            Добавить
          </button>
        </div>
      </form>
    </section>
  </main>
</body>

</html>