<?php
session_start();
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

