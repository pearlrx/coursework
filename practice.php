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

    $stmtCourse = $pdo->prepare("SELECT course_id FROM users WHERE id = ?");
    $stmtCourse->execute([$user_id]);
    $userCourse = $stmtCourse->fetch(PDO::FETCH_ASSOC);

    $stmtLessons = $pdo->prepare("SELECT * FROM lessons WHERE course_id = ?");
    $stmtLessons->execute([$userCourse['course_id']]);
    $lessons = $stmtLessons->fetchAll(PDO::FETCH_ASSOC);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Уроки по гитаре</title>
    <link rel="stylesheet" href="css/index.css"> 
    
    <link rel="shortcut icon" href="img/guitar_music_6159.ico" type="image/x-icon">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.10/SmoothScroll.min.js" integrity="sha256-huW7yWl7tNfP7lGk46XE+Sp0nCotjzYodhVKlwaNeco=" crossorigin="anonymous" defer></script>

    <script src="js/scroll.js" defer></script>

    
    <script src="js/index.js" defer></script>
    <style>
    .user-container {
    position: absolute;

    top: 50%;
    right: 20px;
    transform: translateY(-50%);

    top: 50%; 
    right: 20px; 
    transform: translateY(-50%); 
    

    
    padding: 10px 20px; 
    border: none; 
    border-radius: 5px; 

    
    font-size: 16px;

    cursor: pointer; 
    font-size: 16px;
    

}

.user-profile {
    display: flex;
    align-items: center;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.user-name {
    font-size: 24px;
    font-weight: bold;
    margin-right: 5px;
}

        .lesson-container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f0f0f0;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .lesson-container h2 {
            margin-top: 0;
            font-size: 24px;
        }
        .lesson-container .lesson-video-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            margin-top: 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .lesson-container .lesson-video-link:hover {
            background-color: #2980b9;
        }
    
    </style>


</head>
<body>
<header>
    <nav>
        <div class="menu-container">
            <ul class="menu">
                <li><a href="index.php">Главная</a></li>
                <li><a href="lessons.php">Уроки</a></li>
            </ul>
        </div>
        <div class="user-container">
            <?php if(isset($_SESSION['username'])): ?>
                <div class="user-profile">
                <a id="link-bio" href="profile.php"><span class="user-name"><?php echo $username; ?></span></a>
                    <img class="user-avatar" src="<?php echo $avatar; ?>">
                </div>
                <a href="php/logout.php" class="logout-btn">Выход</a>
            <?php else: ?>
                <button id="registerBtnLesson" class="btn-reg">Регистрация/Вход</button>
            <?php endif; ?>
        </div>
        
    </nav>
</header>
        <main>
        <?php foreach ($lessons as $lesson): ?>
            <div class="lesson-container">
                <h2><?php echo $lesson['lesson_title']; ?></h2>
                <!-- Ссылка, которая открывает модальное окно с видео урока -->
                <a href="#" class="lesson-video-link" data-video="<?php echo $lesson['lesson_video_link']; ?>">Просмотреть урок</a>
            </div>
        <?php endforeach; ?>
        </main>
    
</body>
</html>