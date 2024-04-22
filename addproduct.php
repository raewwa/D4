<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
<section class="section__container">
    <div class="registration__form">
        <h2>Добави продукт:
        </h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="name">Име на продукт:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="price">Цена:</label><br>
            <input type="number" id="price" name="price" step="0.01" required><br><br>

            <label for="description">Описание:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

            <label for="gender">Пол:</label><br>
            <select id="gender" name="gender" required>
                <option value="male">Мъжко</option>
                <option value="female">Женско</option>
            </select><br><br>

            <label for="image">Image:</label><br>
            <input type="file" id="image" name="image" accept="image/*" required><br><br>

            <button type="submit" name="submit">Add Product</button>
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "sql208.byetcluster.com"; // Име на сървъра
   $db_username = "if0_36400610"; // Потребителско име за достъп до базата данни
   $db_password = "z6DMEhQme3v"; // Парола за достъп до базата данни
   $dbname = "if0_36400610_diplomen"; // Име на базата данни

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $gender = $_POST['gender'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $allowed_extensions)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO products (name, price, description, image, gender) VALUES ('$name', '$price', '$description', '$target_file', '$gender')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    $conn->close();
}
?>
</body>
</html>
