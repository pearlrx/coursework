<?php

session_start(); 


session_destroy();


header("Location: ../index.php"); 

exit; 

session_start(); // начинаем сессию

// Уничтожаем сессию
session_destroy();

// Перенаправляем пользователя на главную страницу или на другую страницу, если необходимо
header("Location: ../index.php"); // Замените "index.php" на путь к вашей главной странице

exit; // Прерываем выполнение скрипта

?>

