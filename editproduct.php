<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка дали формата е изпратена

    // Връзка с базата данни
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

    // Приемане на данните от формата
    $id = $_GET['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Обработка на качената снимка, ако е била променена
    if ($_FILES["image"]["size"] > 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowed_extensions)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit(); // Излизаме от скрипта, ако качването на снимката не е успешно
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit(); // Излизаме от скрипта, ако формата на снимката не е разрешена
        }
    }

    // Актуализиране на данните в базата данни
    $sql = "UPDATE products SET name='$name', price='$price', description='$description'";
    if (isset($image)) {
        $sql .= ", image='$image'";
    }
    $sql .= " WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: adminpage.php"); // Пренасочване към административната страница след успешно запазване
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Затваряне на връзката с базата данни
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="design.css">
  <title>Edit Product</title>
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
</nav>
<section class="section__container">
    <div class="admin__container">
        <h2>Редакция на продукт</h2>
        <?php
        // Връзка с базата данни
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "diplomen";

        // Създаване на връзка
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Проверка на връзката
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Извличане на информацията за продукта от базата данни
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>

            <label for="price">Price:</label><br>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo $row['price']; ?>" required><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required><?php echo $row['description']; ?></textarea><br><br>

            <label for="image">Image:</label><br>
            <img src="<?php echo $row['image']; ?>" alt="Product Image" style="max-width: 100px;"><br><br>
            <input type="file" id="image" name="image" accept="image/*"><br><br>

            <button type="submit" name="submit">Запази промените</button>
        </form>
        <?php
        } else {
            echo "Няма намерен продукт.";
        }

        // Затваряне на връзката с базата данни
        $conn->close();
        ?>
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
