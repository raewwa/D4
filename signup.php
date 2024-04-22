<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в профила</title>
    <link rel="stylesheet" href="design.css">
    <style>
        /* Стилове на формата за регистрация */
        .registration__form {
            width: 60%;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .registration__form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .registration__form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .registration__form input[type="text"],
        .registration__form input[type="email"],
        .registration__form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .registration__form button[type="submit"] {
            background-color: #6eadd4;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .registration__form button[type="submit"]:hover {
            background-color: #6eadd4;
        }
    </style>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Валидация на имейла и паролата
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Връзка с базата данни
    $servername = "sql208.byetcluster.com"; // Име на сървъра
    $db_username = "if0_36400610"; // Потребителско име за достъп до базата данни
    $db_password = "z6DMEhQme3v"; // Парола за достъп до базата данни
    $dbname = "if0_36400610_diplomen"; // Име на базата данни
    // Създаване на връзка
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Проверка на връзката
    if ($conn->connect_error) {
        die("Връзката неуспешна: " . $conn->connect_error);
    }

    // Запитване към базата данни за потребителя по имейл
    $sql = "SELECT * FROM accounts WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Имейлът съществува, проверяваме паролата
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Паролата е верна, потребителят е успешно влезнал в профила
            echo "Успешно влизане в профила.";
            // Проверка дали потребителят е администратор
            if ($row['isAdmin'] == 1) {
                // Потребителят е администратор, пренасочваме го към страницата за добавяне на продукт
                header("Location: adminpage.php");
                exit; // Завършване на изпълнението на скрипта, за да се избегнат допълнителни изчаквания
            }
        } else {
            // Грешна парола
            echo "Грешен имейл или парола.";
        }
    } else {
        // Потребителският имейл не съществува
        echo "Грешен имейл или парола.";
    }

    $_SESSION['name'] = $row['name'];

    // Затваряне на връзката с базата данни
    $conn->close();
}
?>

<!-- Останалата част от HTML страницата -->

<div class="header__bar">Безплатна доставка за поръчки над 70лв</div>
<nav class="section__container nav__container">
    <a href="#" class="nav__logo">Raeva</a>
    <ul class="nav__links">
        <li class="link"><a href="index.php">Начало</a></li>
        <li class="link"><a href="login.php">Регистрация</a></li>
        <li class="link"><a href="signup.php">Влизане в профил</a></li>
        <li class="link"><a href="addproduct.php">Добавяне на продукт</a></li>
    </ul>
    <div class="nav__icons">
        <a href="cart.html"><span><i class="ri-shopping-bag-2-line"></i></span></a>
    </div>
</nav>

<section class="section__container">
    <div class="registration__form">
        <h2>Вход в профила</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Имейл:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Парола:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Влез</button>
        </form>
    </div>
</section>

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
    <div class="footer__col">
        <h4 class="footer__heading">Полезни линкове</h4>
        <p>Мъже</p>
        <p>Жени</p>
        <p>Обувки</p>
    </div>
</footer>
</body>
</html>
