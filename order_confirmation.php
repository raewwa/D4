<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Потвърждение на поръчката</title>
  <link rel="stylesheet" href="design.css">
</head>
<style>
    .confirmation {
  text-align: center;
}

.confirmation h2 {
  font-style: italic;
}

.confirmation hr {
  width: 50%;
  margin: auto;
  margin-bottom: 20px;
}

.error {
  text-align: center;
}
</style>
<body>
<div class="header__bar">Безплатна доставка за поръчки над 70лв</div>
<nav class="section__container nav__container">
    <a href="#" class="nav__logo">Trendy Raeva</a>
    <ul class="nav__links">
    <li class="link"><a href="index.php">Начало</a></li>
        <li class="link"><a href="login.php">Регистрация</a></li>
        <li class="link"><a href="signup.php">Влизане в профил</a></li>

    </ul>
    <div class="nav__icons">
        <a href="cart.html"><span><i class="ri-shopping-bag-2-line"></i></span></a>
    </div>
</nav>
<br>
<br>
<br>
<br>
<br>

  <?php
  // Проверка дали е изпратена формата
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаване на данните от формата
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // Съобщение за потвърждение на поръчката
    echo '<div class="confirmation">';
    echo '<h2><i>Благодарим ви за поръчката!</i></h2>';
    echo '<hr>';
    echo '<p>Вашата поръчка ще бъде доставена на следния адрес:</p><hr>';
    echo '<p>' . $address . '</p>';
    echo '<p>Начин на плащане: ' . $payment_method . '</p>';
    echo '</div>';
  } else {
    // Ако формата не е изпратена, изведи съобщение за грешка
    echo '<div class="error">';
    echo '<p>Възникна грешка при обработката на поръчката. Моля, опитайте отново по-късно.</p>';
    echo '</div>';
  }
  ?>
  <br>
  <br>
  <br>
  <br>
  <br>

  <footer class="section__container footer__container">
    <div class="footer__col">
      <h4 class="footer__heading">Контакти</h4>
      <p>
        <i class="ri-map-pin-2-fill"></i> ПГЕЕ Пловдив
      </p>
      <p><i class="ri-mail-fill"></i> vanqraeva@gmail.com</p>
      <p><i class="ri-phone-fill"></i> 0877 399 226</p>
    </div>
    <div class="footer__col">
      <h4 class="footer__heading">За нас</h4>
      <p>Начало</p>
    </div>

  </footer>

  <div class="section__container footer__bar">
    <div class="copyright">
      Copyright © 2023 Web Design Mastery. All rights reserved.
    </div>
    <div class="footer__form">
      <form>
        <input type="text" placeholder="ENTER YOUR EMAIL" />
        <button class="btn" type="submit">SUBSCRIBE</button>
      </form>
    </div>
  </div>
</body>
</html>
