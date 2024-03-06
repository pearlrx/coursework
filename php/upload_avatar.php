<?php
session_start();
require_once('db_config.php');

$response = array(); 

if (isset($_SESSION['username']) && isset($_FILES['avatar'])) {
    
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id']; 

    
    $uploadDirectory = 'uploads/'; 
    $allowedExtensions = array('jpg', 'jpeg', 'png'); 
    $maxFileSize = 64 * 1024; 

    $avatar = $_FILES['avatar'];

    $fileName = $avatar['name'];
    $fileTmpName = $avatar['tmp_name'];
    $fileSize = $avatar['size'];
    $fileError = $avatar['error'];

    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    
    if ($fileSize > $maxFileSize) {
        $response['success'] = false;
        $response['message'] = "Ошибка: Размер файла превышает максимально допустимый размер (64 КиБ).";
    } elseif (in_array($fileExtension, $allowedExtensions)) {
        
        $avatarData = file_get_contents($fileTmpName);
        
        
        $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        if ($stmt->execute([$avatarData, $user_id])) { 
            
            $avatarUrl = 'data:image/' . $fileExtension . ';base64,' . base64_encode($avatarData);
            $response['success'] = true;
            $response['message'] = "Аватар успешно загружен";
            $response['avatarUrl'] = $avatarUrl; 
        } else {
            $response['success'] = false;
            $response['message'] = "Ошибка при обновлении аватара";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Недопустимый формат файла. Пожалуйста, загрузите изображение в форматах JPG, JPEG или PNG.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Ошибка: Не удалось загрузить аватар. Пользователь не аутентифицирован или файл не был передан.";
}


header('Content-Type: application/json');
echo json_encode($response);
?>
