<?php
session_start();
<<<<<<< HEAD
require_once('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['username'] = $user['name']; 
            
            
            echo json_encode(array('success' => true, 'username' => $user['name']));
            exit();
        } else {
            
            echo json_encode(array('success' => false, 'message' => 'Неверный пароль'));
            exit();
        }
    } else {
        
        echo json_encode(array('success' => false, 'message' => 'Пользователь с таким email не найден'));
        exit();
    }
}
?>

=======

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключаемся к базе данных (замените значения на ваши)
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "kursovaya";
    
    // Устанавливаем соединение
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    // Проверяем соединение
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }
    
    // Получаем введенные пользователем данные
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Шифруем пароль
    $passwordmd = md5($password); // Важно! Лучше использовать более безопасные методы шифрования пароля
    
    // Подготавливаем запрос к базе данных
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$passwordmd'";
    
    // Выполняем запрос
    $result = $conn->query($sql);
    
    // Проверяем, есть ли пользователь с такими данными
    if ($result->num_rows > 0) {
        // Пользователь найден, устанавливаем сессию и перенаправляем на главную страницу
        $_SESSION['email'] = $email;
        header("Location: ../index.php");
    } else {
        // Пользователь не найден, выводим сообщение об ошибке
        echo "Неверный email или пароль";
    }
    
    // Закрываем соединение с базой данных
    $conn->close();
}
?>
>>>>>>> dd64a0b6aa1b53727bc286561deadb4b860cdbbd
