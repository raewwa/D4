<?php
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

// Име на продукта за извличане от URL параметъра
$product_id = $_GET['id'];

// Защита от SQL инжекции (използвайте подходящи методи за защита)
$product_id_safe = $conn->real_escape_string($product_id);

// Заявка към базата данни за извличане на данни за продукта по име
$sql = "SELECT * FROM products WHERE id = '$product_id_safe'";
$result = $conn->query($sql);

// Проверка за успешно извличане на данните
if ($result->num_rows > 0) {
    // Извличане на данните за продукта
    $row = $result->fetch_assoc();
    $productName = $row["name"];
    $productPrice = $row["price"];
    $productDescription = $row["description"];
    $productImage = $row["image"];

    // Генериране на HTML с данните за продукта
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $productName; ?> - Trendy Raeva</title>
    <link rel="stylesheet" href="design.css" />
</head>
<body>
    <!-- HTML код за продукт страницата -->
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
    <main class="product-details section__container">
        <div class="product__details">
            <div class="product-image">
                <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>">
            </div>
            <div class="product-description">
                <h1 class="section__title"><?php echo $productName; ?></h1>
                <p class="product-price">Цена: <?php echo $productPrice; ?>лв.</p>
                <p class="product-text"><?php echo $productDescription; ?></p>
                <!-- HTML форма за избор на размер -->
                <form id="sizeForm">
                    <label for="size"><b><i>Размер:</i></b></label><br>
                    
                    <hr>
                    <input type="radio" id="xs" name="size" value="XS">
                    <label for="xs">XS</label>
                    <br>
    
                    <input type="radio" id="s" name="size" value="S">
                    <label for="s">S</label>
                    <br>
                    <input type="radio" id="m" name="size" value="M">
                    <label for="m">M</label>
                    <br>
                    <input type="radio" id="l" name="size" value="L">
                    <label for="l">L</label>
                    <br>
                    <input type="radio" id="xl" name="size" value="XL">
                    <label for="xl">XL</label>
                    <br>
                    <input type="radio" id="xxl" name="size" value="XXL">
                    <label for="xxl">XXL</label><br>

                </form>
                <hr>
                <button class="btn" id="buyNowBtn" onclick="addToCart(<?php echo $product_id_safe; ?>)">Купи сега</button>

                <script>
                    function addToCart(productId) {
                        // Вземете стойността на избрания размер
                        var selectedSize = document.querySelector('input[name="size"]:checked');
                        if (selectedSize) {
                            var sizeValue = selectedSize.value;
                            // Пренасочете потребителя към страницата на количката с добавения продукт и избрания размер
                            window.location.href = "add_to_cart.php?id=" + productId + "&size=" + sizeValue;
                        } else {
                            alert("Моля, изберете размер.");
                        }
                    }
                </script>

            </div>
        </div>
    </main>
    <!-- Останалата част от HTML кода -->
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
    <!-- Добавете нужния JavaScript код, ако е необходимо -->
</body>
</html>

<?php
} else {
    echo "0 results";
}

// Затваряне на връзката с базата данни
$conn->close();
?>
