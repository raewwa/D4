<?php
session_start();

// Проверка дали е подаден идентификатор на продукта за премахване
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Идентификаторът на продукта за премахване
    $product_id = $_GET['id'];

    // Проверка дали продуктът със зададения идентификатор се намира в количката
    if(in_array($product_id, $_SESSION['cart'])) {
        // Намираме индекса на продукта в масива на количката и го премахваме
        $index = array_search($product_id, $_SESSION['cart']);
        unset($_SESSION['cart'][$index]);

        // Пренасочване към страницата на количката след премахването на продукта
        header("Location: cart.php");
        exit();
    }
}
?>
