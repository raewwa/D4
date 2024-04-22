<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="design.css">
    <style>
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
    $servername = "sql208.byetcluster.com"; // Име на сървъра
    $db_username = "if0_36400610"; // Потребителско име за достъп до базата данни
    $db_password = "z6DMEhQme3v"; // Парола за достъп до базата данни
    $dbname = "if0_36400610_diplomen"; // Име на базата данни

    // Създаване на връзка
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка на връзката
    if ($conn->connect_error) {
        die("Връзката неуспешна: " . $conn->connect_error);
    }

  
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $isAdmin = isset($_POST['isAdmin']) ? true : false;

    // Проверка за съвпадение на паролите
    if ($password != $confirm_password) {
        echo "Паролите не съвпадат. Моля, опитайте отново.";
    } else {
        // Хеширане на паролата
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Вмъкване на данните в базата данни
        $sql = "INSERT INTO accounts (name, lname, email, password, isAdmin) VALUES ('$name', '$lname', '$email', '$hashed_password', '$isAdmin')";

        if ($conn->query($sql) === TRUE) {
            echo "Регистрацията е успешна.";
            // Проверка дали потребителят е администратор и пренасочване към addproduct.php
            if ($isAdmin) {
                header("Location: adminpage.php");
                exit; // Завършване на изпълнението на скрипта, за да се избегнат допълнителни изчаквания
            }
        } else {
            echo "Грешка: " . $sql . "<br>" . $conn->error;
        }
    }

    // Затваряне на връзката с базата данни
    $conn->close();
}
?>
<!-- Останалата част от HTML страницата -->

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

<header>
    <div class="section__container header__container">
        <div class="header__content">
            <h1>Регистрация</h1>
        </div>
    </div>
</header>

<section class="section__container">
    <div class="registration__form">
        <h2>Регистрационна форма</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Име:</label>
            <input type="text" id="name" name="name" required>

            <label for="lname">Фамилия:</label>
            <input type="text" id="lname" name="lname" required>

            <label for="email">Имейл:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Парола:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Потвърди паролата:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="isAdmin">Администратор:</label>
            <input type="checkbox" id="isAdmin" name="isAdmin" value="true">

            <button type="submit">Регистрирай се</button>
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
</footer>

</body>
</html>
