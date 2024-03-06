<?php
session_start();
require_once('db_config.php');

if(isset($_POST['newUsername'])) {
    $newUsername = $_POST['newUsername'];
    $userId = $_SESSION['user_id']; 

    try {
        $stmt = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
        $stmt->execute([$newUsername, $userId]);

        
        if ($stmt->rowCount() > 0) {
            $_SESSION['username'] = $newUsername;
            $response = array('success' => true, 'message' => 'Имя пользователя успешно обновлено');
        } else {
            $response = array('success' => false, 'message' => 'Не удалось обновить имя пользователя');
        }
    } catch (PDOException $e) {
        $response = array('success' => false, 'message' => 'Ошибка при выполнении запроса к базе данных');
    }

    
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    
    $response = array('success' => false, 'message' => 'Не удалось получить новое имя пользователя');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

