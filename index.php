<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="design.css">
  <style>
    /* Стилове за тъмния режим */
    body.dark-mode {
      background-color: grey; /* Цвят на фона на бутона в тъмен режим */
      color: white; /* Цвят на текста на бутона в тъмен режим */
      border: 2px solid #fff; /* Граница на бутона */
      border-radius: 5px; /* Закръгленост на ръбовете */
      padding: 10px 20px; /* Размер на отстъпа вътре в бутона */
      font-size: 16px; /* Големина на шрифта */
      cursor: pointer; /* Промяна на курсора при навлизане върху бутона */
      transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
      text-decoration-color: white;
    }
  </style>
  <title>Trendy Raeva</title>
</head>
<body>
<?php
session_start();
?>

<div class="header__bar">Безплатна доставка за поръчки над 70лв</div>
<nav class="section__container nav__container">
    <a href="#" class="nav__logo">Trendy Raeva</a>
    <ul class="nav__links">
        <li class="link"><a href="index.php">Начало</a></li>
        <li class="link"><a href="login.php">Регистрация</a></li>
        <li class="link"><a href="signup.php">Влизане в профил</a></li>
        <?php
        // Проверка дали потребителят е влязъл в администраторския профил
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            echo '<li class="link"><a href="addproduct.php">Добавяне на продукт</a></li>';
        }
        ?>
    </ul>
    <div class="nav__icons">
        <?php
        // Проверка за съществуваща сесия
        if (isset($_SESSION['name'])) {
            echo '<a href="logout.php"><span>Изход</span></a>';
        } else {
            echo '<a href="cart.php"><span><i class="ri-shopping-bag-2-line"></i></span></a>';
        }
        ?>
    </div>
    <!-- Бутон за тъмен режим -->
    <button id="dark-mode-toggle">Тъмен режим</button>
</nav>

<header>
    <div class="section__container header__container">
        <div class="header__content">
            <p>Допълнителни 50% отстъпка за пролетна промоция</p>
            <h1>Най-новите<br />Най-модерните<br />2024</h1>
        </div>
    </div>
</header>

<?php
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

// Заявка към базата данни за всички мъжки продукти
$sql_male = "SELECT * FROM products WHERE gender='1'";
$result_male = $conn->query($sql_male);

// Проверка дали има мъжки продукти
if ($result_male->num_rows > 0) {
    // Показване на всички мъжки продукти
    echo '<section class="section__container musthave__container">';
    echo '<h2 class="section__title">Мъжки продукти</h2>';
    echo '<div class="musthave__nav">';
    // Допълнителни функционалности като категории могат да бъдат добавени тук
    echo '</div>';
    echo '<div class="musthave__grid">';
    while($row = $result_male->fetch_assoc()) {
        echo '<div class="musthave__card">';
        echo '<a href="product.php?id=' . $row["id"] . '">';
        echo '<img src="' . $row["image"] . '" alt="must have" />';
        echo '</a>';
        echo '<h4>' . $row["name"] . '</h4>';
        echo '<p>' . $row["price"]  . ' лв.</p>';
        echo '</div>';
    }
    echo '</div>';
    echo '</section>';
} else {
    echo "Няма налични мъжки продукти.";
}

// Заявка към базата данни за всички женски продукти
$sql_female = "SELECT * FROM products WHERE gender='0'";
$result_female = $conn->query($sql_female);

// Проверка дали има женски продукти
if ($result_female->num_rows > 0) {
    // Показване на всички женски продукти
    echo '<section class="section__container musthave__container">';
    echo '<h2 class="section__title">Женски продукти</h2>';
    echo '<div class="musthave__nav">';
    // Допълнителни функционалности като категории могат да бъдат добавени тук
    echo '</div>';
    echo '<div class="musthave__grid">';
    while($row = $result_female->fetch_assoc()) {
        echo '<div class="musthave__card">';
        echo '<a href="product.php?id=' . $row["id"] . '">';
        echo '<img src="' . $row["image"] . '" alt="must have" />';
        echo '</a>';
        echo '<h4>' . $row["name"] . '</h4>';
        echo '<p>' . $row["price"]  . ' лв.</p>';
        echo '</div>';
    }
    echo '</div>';
    echo '</section>';
} else {
    echo "Няма налични женски продукти.";
}
$conn->close();
?>

<hr />

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

<script>
  // Функция за превключване на тъмен режим
  function toggleDarkMode() {
    // Превключване на класа на body елемента
    document.body.classList.toggle('dark-mode');

    // Запазване на предпочитанията на потребителя в localStorage
    const isDarkMode = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDarkMode);
  }

  // Изберете бутона за превключване на режима
  const darkModeToggle = document.getElementById('dark-mode-toggle');
  // Добавете слушател на събитие за бутона за превключване на режима
  darkModeToggle.addEventListener('click', toggleDarkMode);

  // Проверете дали потребителят е избрал тъмния режим и го приложете
  const isDarkMode = localStorage.getItem('darkMode') === 'true';
  if (isDarkMode) {
    document.body.classList.add('dark-mode');
  }
</script>

</body>
</html>
