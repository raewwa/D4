<?php
  session_start();
  // Унищожаване на сесията
  session_destroy();
  // Пренасочване към началната страница
  header("Location: index.php");
  exit;
?>
