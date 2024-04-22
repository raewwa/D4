<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="design.css">
  <title>Административен панел</title>
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
       
        <li class="link"><a href="addproduct.php">Добавяне на продукт</a></li>
        <?php
        // Проверка дали потребителят е влязъл в администраторския профил
        if (isset($_SESSION['name'])) {
            echo '<li class="link"><a href="logout.php">Изход</a></li>';
        }
        ?>
    </ul>
</nav>

<section class="section__container">
    <div class="admin__container">
      
 
        <h3>Списък с продукти:</h3>
        <table>
            <thead>
                <tr>
                    <th>Име</th>
                    <th>Цена</th>
                    <th>Описание</th>
                    <th>Снимка</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                // Заявка към базата данни за всички продукти
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                // Проверка дали има резултати
                if ($result->num_rows > 0) {
                    // Извеждане на данните за всеки продукт
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td><img src='" . $row["image"] . "' alt='Product Image' style='max-width: 100px;'></td>";
                        echo "<td><a href='editproduct.php?id=" . $row["id"] . "'>Редакция</a> | <a href='deleteproduct.php?id=" . $row["id"] . "'>Изтриване</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Няма намерени продукти.</td></tr>";
                }

                // Затваряне на връзката с базата данни
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
