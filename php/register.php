<?php
session_start();
require_once('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!preg_match("/^[A-Za-zА-Яа-яЁё]+$/u", $name)) {
        echo json_encode(array('success' => false, 'message' => 'Имя пользователя может содержать только буквы кириллицы и латиницы'));
        exit();
    }

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        
        echo json_encode(array('success' => false, 'message' => 'Этот email уже зарегистрирован'));
        exit();
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, course_id) VALUES (?, ?, ?, ?)");
    $default_course_id = 4; 
    if ($stmt->execute([$name, $email, $hashed_password, $default_course_id])) {
        
        $user_id = $pdo->lastInsertId();

        
        $_SESSION['username'] = $name; 
        $_SESSION['user_id'] = $user_id; 
       
        
        echo json_encode(array('success' => true, 'username' => $_SESSION['username']));
        exit(); 
    } else {
        
        echo json_encode(array('success' => false, 'message' => 'Произошла ошибка при регистрации'));
        exit();
    }
}
?>
