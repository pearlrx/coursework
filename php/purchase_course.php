<?php
session_start();
require_once('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!isset($_SESSION['username'])) {
        
        echo json_encode(array('success' => false, 'message' => 'Пожалуйста, войдите в свой аккаунт, чтобы продолжить.'));
        exit();
    }

    
    $courseId = isset($_POST['courseId']) ? intval($_POST['courseId']) : null;

    
    if ($courseId === null || $courseId <= 0) {
        
        echo json_encode(array('success' => false, 'message' => 'Некорректный идентификатор курса.'));
        exit();
    }

    
    $username = $_SESSION['username'];

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ? AND course_id = ?");
    $stmt->execute([$username, $courseId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        
        echo json_encode(array('success' => false, 'message' => 'Вы уже приобрели данный курс.'));
        exit();
    }

    
    $stmt = $pdo->prepare("UPDATE users SET course_id = ? WHERE name = ?");
    if ($stmt->execute([$courseId, $username])) {
        
        ob_clean();
        
        echo json_encode(array('success' => true, 'message' => 'Курс успешно куплен!'));
        exit();
    } else {
        
        echo json_encode(array('success' => false, 'message' => 'Произошла ошибка при покупке курса.'));
        exit();
    }
}
?>
