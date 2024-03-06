<?php
<<<<<<< HEAD
session_start(); 


session_destroy();


header("Location: ../index.php"); 

exit; 
=======
session_start(); // начинаем сессию

// Уничтожаем сессию
session_destroy();

// Перенаправляем пользователя на главную страницу или на другую страницу, если необходимо
header("Location: ../index.php"); // Замените "index.php" на путь к вашей главной странице

exit; // Прерываем выполнение скрипта
>>>>>>> dd64a0b6aa1b53727bc286561deadb4b860cdbbd
?>

