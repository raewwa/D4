


<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="design.css">
  <title>Количка - Trendy Raeva</title>
  <style>
    /* Стилизация за количката */
    .cart__container {
      padding: 20px;
      margin: auto;
      max-width: 800px;
    }

    .cart__item {
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 20px;
      padding: 20px;
    }

    .cart__item img {
      max-width: 100px;
      margin-right: 20px;
    }

    .cart__item h3 {
      margin-top: 0;
    }

    .cart__item p {
      margin-bottom: 10px;
    }

    .cart__item a {
      color: #6eadd4;
      text-decoration: none;
    }

    .cart__item a:hover {
      text-decoration: underline;
    }

    .cart__total {
      margin-top: 20px;
      font-weight: bold;
    }
    .btn-buy {
      background-color: #6eadd4;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .btn-buy:hover {
      background-color: #5498b8;
  </style>
</head>
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

  <div class="cart__container">
    <?php
    session_start();

    // Проверка дали сесията за количката е стартирана
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
      // Ако няма продукти в количката, извеждаме съобщение за празна количка
      echo "<h2>Вашата количка е празна.</h2>";
    } else {
      // Ако има продукти в количката, извличаме данните за тях от базата данни (тук ще имате вашата логика за извличане на продуктите)
      // За сега просто показваме идентификаторите на продуктите

      // Свързване с базата данни
      $servername = "sql208.byetcluster.com"; // Име на сървъра
      $db_username = "if0_36400610"; // Потребителско име за достъп до базата данни
      $db_password = "z6DMEhQme3v"; // Парола за достъп до базата данни
      $dbname = "if0_36400610_diplomen"; // Име на базата данни

      // Създаване на връзка
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Проверка на връзката
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Създаване на празен масив, в който ще съхраняваме данните за продуктите от количката
      $cart_products = array();

      // Извличане на данните за продуктите от количката
      foreach ($_SESSION['cart'] as $product_id) {
        // Заявка към базата данни за извличане на данни за продукта по идентификатор
        $sql = "SELECT * FROM products WHERE id = '$product_id'";
        // Изпълнение на заявката
        $result = $conn->query($sql);

        // Проверка за успешно изпълнение на заявката
        if ($result->num_rows > 0) {
          // Извличане на данните за продукта
          $row = $result->fetch_assoc();
          // Добавяне на данните за продукта към масива $cart_products
          $cart_products[] = $row;
        }
      }

      // Показване на продуктите от количката
      foreach ($cart_products as $product) {
        echo '<div class="cart__item">';
        echo '<img src="' . $product["image"] . '" alt="' . $product["name"] . '">';
        echo '<div>';
        echo '<h3>' . $product["name"] . '</h3>';
        echo '<p>Цена: ' . $product["price"] . ' лв.</p>';
        echo '<a href="remove_from_cart.php?id=' . $product["id"] . '">Премахни от количката</a>';
        echo '</div>';
        echo '</div>';
      }

      // Изчисляване на общата сума на продуктите в количката
      $total_price = 0;
      foreach ($cart_products as $product) {
        $total_price += $product['price'];
      }

          // Извеждане на общата сума
          echo '<div class="cart__total">';
          echo '<h3>Обща сума: ' . $total_price . ' лв.</h3>';
          echo '</div>';
    // Бутон "Купи" и препращане към страницата за checkout.php
echo '<form action="checkout.php" method="post">';
echo '<button class="btn-buy" type="submit">Купи</button>';
echo '</form>';

// Затваряне на връзката с базата данни
$conn->close();
        }
        ?>
      </div>
    
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
    