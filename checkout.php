<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="design.css">
    <title>Checkout - Trendy Raeva</title>
    <style>
        /* Стилизация за checkout страницата */
        .checkout__container {
            padding: 20px;
            margin: auto;
            max-width: 800px;
        }

        .checkout__container h2 {
            margin-bottom: 20px;
        }

        .checkout__container ul {
            list-style-type: none;
            padding: 0;
        }

        .checkout__container li {
            margin-bottom: 10px;
        }

        .checkout__container input[type="checkbox"] {
            margin-right: 10px;
        }

        .checkout__container label {
            font-size: 16px;
        }

        .checkout__container label:hover {
            cursor: pointer;
        }

        .checkout__container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .checkout__container input[type="text"]:focus {
            outline: none;
            border-color: #6eadd4;
        }

        .checkout__container .card__details {
            display: none;
            margin-top: 20px;
        }

        .checkout__container .card__details label {
            display: block;
            margin-bottom: 10px;
        }

        .checkout__container .card__details input[type="text"] {
            width: calc(50% - 10px);
            display: inline-block;
            margin-right: 10px;
        }

        .checkout__container .card__details input[type="text"]:last-child {
            margin-right: 0;
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

<div class="checkout__container">
    <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $servername = "sql208.byetcluster.com"; // Име на сървъра
        $db_username = "if0_36400610"; // Потребителско име за достъп до базата данни
        $db_password = "z6DMEhQme3v"; // Парола за достъп до базата данни
        $dbname = "if0_36400610_diplomen"; // Име на базата данни
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT name, lname FROM accounts WHERE id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $lname = $row['lname'];
        }

        $conn->close();
    }
    ?>

    <?php
    if (isset($name) && isset($lname)) {
        echo '<h2>Благодаря, ' . $name . ' ' . $lname . ', за поръчката!</h2>';
    } else {
        echo '<h2>Благодаря за поръчката!</h2>';
    }
    ?>
    <h3>Начини на плащане:</h3>
    <form action="order_confirmation.php" method="post" onsubmit="return validateForm()">
        <ul>
            <li>
                <input type="radio" id="cash" name="payment_method" value="cash" checked>
                <label for="cash">Плащане при доставка (наложен платеж)</label>
            </li>
           
            <li>
                <input type="radio" id="credit_card" name="payment_method" value="credit_card">
                <label for="credit_card">Кредитна/Дебитна карта</label>
            </li>
        </ul>

        <label for="address">Адрес за доставка:</label>
        <input type="text" id="address" name="address" placeholder="Въведете адреса си за доставка" required>

        <div class="card__details" id="cardDetails">
            <label for="card_number">Номер на карта:</label>
            <input type="text" id="card_number" name="card_number" placeholder="XXXX-XXXX-XXXX-XXXX" maxlength="19">

            <label for="expiry_date">Срок на годност:</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" maxlength="5">

            <label for="cvv">CVV код:</label>
            <input type="text" id="cvv" name="cvv" placeholder="XXX" maxlength="3">
        </div>

        <button type="submit">Потвърди поръчката</button>
    </form>
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

<script>
    document.getElementById('cash').addEventListener('change', function() {
        document.getElementById('cardDetails').style.display = 'none';
    });

    document.getElementById('credit_card').addEventListener('change', function() {
        document.getElementById('cardDetails').style.display = 'block';
    });
    function validateForm() {
        var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        if (paymentMethod === 'credit_card') {
            var cardNumber = document.getElementById('card_number').value;
            var expiryDate = document.getElementById('expiry_date').value;
            var cvv = document.getElementById('cvv').value;
            
            // Check if card number, expiry date, and CVV are valid
            var cardNumberPattern = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
            var expiryDatePattern = /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/;
            var cvvPattern = /^\d{3}$/;
            
            if (!cardNumber.match(cardNumberPattern)) {
                alert("Моля, въведете валиден номер на кредитната/дебитната карта.");
                return false;
            }
            
            if (!expiryDate.match(expiryDatePattern)) {
                alert("Моля, въведете валидна дата на валидност.");
                return false;
            }
            
            if (!cvv.match(cvvPattern)) {
                alert("Моля, въведете валиден CVV код.");
                return false;
            }
        }
        return true;
    }
</script>

</body>
</html>

