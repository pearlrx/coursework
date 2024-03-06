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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Уроки по гитаре</title>
    <link rel="stylesheet" href="css/courses.css">
    <link rel="shortcut icon" href="img/guitar_music_6159.ico" type="image/x-icon">
    <script src="js/lesson.js" defer></script>
    <script src="https:
    <script src="js/scroll.js" defer></script>
    <script src="js/index.js" defer></script>
    <script src="js/modal-bank.js" data-isloggedin="<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>" defer></script>
    <link rel="stylesheet" href="css/courses.css">
    <style>
        #link-bio{
    text-decoration: none;
    outline: none;
    color: black;
    transition: color 0.3s ease;
}

#link-bio:hover{
    color: #fc4747;
}

.logout-btn{
    text-decoration: none;
  background-image: linear-gradient(currentColor, currentColor);
  background-position: 0% 100%;
  background-repeat: no-repeat;
  background-size: 0% 2px;
  transition: background-size .3s;
  color: black;
}

.logout-btn:hover{
        background-size: 100% 2px;
      
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
                    <li><a href="#контакты">Контакты</a></li>
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
                <button id="registerBtn" class="btn-reg">Регистрация/Вход</button>
            <?php endif; ?>
            </div>
            
        </nav>
        <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('registerBtn').addEventListener('click', function() {
                document.getElementById('registerModal').style.display = 'block';
            });

            document.querySelector('.close').addEventListener('click', function() {
                document.getElementById('registerModal').style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target == document.getElementById('registerModal')) {
                    document.getElementById('registerModal').style.display = 'none';
                }
            });

            document.getElementById('switchToRegistration').addEventListener('click', function() {
                document.getElementById('loginModalForm').style.display = 'none';
                document.getElementById('registrationForm').style.display = 'block';
            });
            
            document.getElementById('switchToLogin').addEventListener('click', function() {
                document.getElementById('registrationForm').style.display = 'none';
                document.getElementById('loginModalForm').style.display = 'block';
            });
        });
    </script>
    </header>
        <main>
    <div class="course-container">
        <h2>Базовый курс</h2>
        <p>Основные принципы игры на гитаре</p>
        <p class="price">1500 р/месяц</p>
        <a href="#" class="buy-course" data-course-id="1">Купить курс</a>
    </div>
    <div class="course-container">
        <h2>Средний курс</h2>
        <p>Расширенные техники игры на гитаре</p>
        <p class="price">3000 р/месяц</p>
        <a href="#" class="buy-course" data-course-id="2">Купить курс</a>
    </div>
    <div class="course-container">
        <h2>Углубленный курс</h2>
        <p>Продвинутые темы и тренировки для опытных гитаристов</p>
        <p class="price">4500 р/месяц</p>
        <a href="#" class="buy-course" data-course-id="3">Купить курс</a>
    </div>
        </main>
    

    <footer>
        <p>© 2023 Уроки по гитаре. Все права защищены.</p>
    </footer>


    <div id="myModal" class="modal-bank">
    <div class="modal-content-bank">
        
        <h2>Введите банковские данные</h2>
        <form action="php/purchase_course.php" id="paymentForm" method="post">
    <label for="cardNumber">Номер карты:</label><br>
    <input type="text" id="cardNumber" name="cardNumber"><br>
    <label for="expirationDate">Срок действия:</label><br>
    <input type="text" id="expirationDate" name="expirationDate"><br>
    <label for="cvv">CVV:</label><br>
    <input type="text" id="cvv" name="cvv"><br><br>
    <button type="submit" id="purchaseButton" data-course-id="">Оплатить</button> <!-- Добавлен data-course-id -->
        </form>
        <button id="closeModalBtn">Закрыть</button>
        <div id="errorModal"><div id="errorModalMessage"></div></div>
    </div>
    
    </div>
    <div id="registerModal" class="modal">
        <div class="modal-content">
            
            <div class="switcher">
                <a href="#" id="switchToRegistration" class="nav-link">Зарегистрируйтесь</a></p>
                <span class="separator">или</span>
                <a href="#" id="switchToLogin" class="nav-link">Войдите</a></p>
                <span class="close">&times;</span>
            </div>
            
            
            <div id="registerForm">
                
                <form action="php/register.php" id="registrationForm" method="post">
                    <input type="text" placeholder="Имя" name="name" required><br>
                    <input type="text" placeholder="Email" name="email" required><br>
                    <input type="password" placeholder="Пароль" name="password" required><br>
                    <button class="reg-butt" type="submit">Зарегистрироваться</button><br>
                </form>
                <div id="error-message" style="
                color: red; margin-top: 10px;
                font-size: 25;
                font-weight: 600;
                "></div>
            </div>
            <div id="loginModalForm" style="display:none;">
                
                <form action="php/login.php" id="loginForm" method="post">
                    <input type="email" placeholder="Email" name="email" required><br>
                    <input type="password" placeholder="Пароль" name="password" required><br>
                    <button class="log-butt" type="submit">Войти</button><br>
                </form>
                <div id="login-error-message" style="
            color: red; margin-top: 10px;
            font-size: 25;
            font-weight: 600;
            "></div>
            </div>
            
        </div>
    </div>
    <div id="errorContainer" class="error-container"></div>
    <div id="successPopup"><div id="successPopupMessage"></div></div>
    
</body>
</html>