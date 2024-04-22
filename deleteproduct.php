<?php
// Проверка дали е подаден идентификатор на продукта
if (isset($_GET['id'])) {
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

    // Подготовка на SQL заявката за изтриване на продукта
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id=$id";

    // Изпълнение на SQL заявката
    if ($conn->query($sql) === TRUE) {
        // Пренасочване към административната страница след успешно изтриване
        header("Location: adminpage.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Затваряне на връзката с базата данни
    $conn->close();
} else {
    // Ако не е подаден идентификатор на продукта, пренасочване към административната страница
    header("Location: adminpage.php");
    exit();
}
?>
