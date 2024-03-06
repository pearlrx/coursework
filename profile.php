<?php
session_start();
require_once('php/db_config.php');

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $stmtAvatar = $pdo->prepare("SELECT avatar FROM users WHERE id = ?");
    $stmtAvatar->execute([$user_id]);
    $userAvatar = $stmtAvatar->fetch(PDO::FETCH_ASSOC);
    
    if ($userAvatar && $userAvatar['avatar']) {
        $avatar = 'data:image/jpeg;base64,' . base64_encode($userAvatar['avatar']); 
    } else {
        $avatar = "path/to/defaultavatar.jpg"; 
    }
    
    $stmtUsername = $pdo->prepare("SELECT name FROM users WHERE id = ?");
    $stmtUsername->execute([$user_id]);
    $userInfo = $stmtUsername->fetch(PDO::FETCH_ASSOC);
    
    if ($userInfo) {
        $username = $userInfo['name'];
    } else {
        $username = "Unknown"; 
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link rel="shortcut icon" href="img/guitar_music_6159.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <header>
    <a id="goback" href="index.php">&#8592Перейти на последнюю посещенную страницу</a>
    
    </header>
    <main>
    <div class="profile-info">
    <h2>Профиль пользователя</h2>
    <div class="user-info">
    <?php if(isset($avatar) && !empty($avatar)): ?>
        <img class="user-avatar" src="<?php echo $avatar; ?>">
    <?php else: ?>
        <img class="user-avatar" src="path/to/defaultavatar.jpg">
    <?php endif; ?>
    <p id="username"><?php echo $username; ?></p>
    <button id="changeAvatarBtn">Изменить аватар</button>
    <br><button id="changeUsernameBtn">Изменить имя</button>
    <input type="file" id="avatarInput" style="display: none;" accept="image/*">
    <div id="error-message"></div>
</div>

</div>

    </main>
    ...
    <footer>
        <p>&copy; 2024 Все права защищены</p>
    </footer>
    <script src="js/profile.js"></script>
    <script>
        document.getElementById('changeUsernameBtn').addEventListener('click', function() {
            var usernameElement = document.getElementById('username');
            var currentUsername = usernameElement.textContent;
            var inputElement = document.createElement('input');
            inputElement.type = 'text';
            inputElement.value = currentUsername;

            var saveButton = document.createElement('button');
            saveButton.textContent = 'Сохранить';

            saveButton.addEventListener('click', function() {
                var newUsername = inputElement.value.trim();
                if (newUsername !== '') {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'php/update_username.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    
                                    usernameElement.textContent = newUsername;
                                    
                                    inputElement.parentNode.removeChild(inputElement);
                                    saveButton.parentNode.removeChild(saveButton);
                                    location.reload();
                                } else {
                                    
                                    alert(response.message);
                                }
                            } else {
                                alert('Ошибка при отправке запроса');
                            }
                        }
                    };
                    xhr.send('newUsername=' + encodeURIComponent(newUsername));
                } else {
                    alert('Введите новое имя пользователя');
                }
            });

           
            usernameElement.parentNode.replaceChild(inputElement, usernameElement);
            inputElement.parentNode.insertBefore(saveButton, inputElement.nextSibling);
        });
    </script>
</body>
</html>

