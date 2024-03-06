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
    <link rel="stylesheet" href="css/lessons.css">
    <link rel="shortcut icon" href="img/guitar_music_6159.ico" type="image/x-icon">
    
    <script src="js/modal.js" defer></script>
    <script src="js/lesson.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.10/SmoothScroll.min.js" integrity="sha256-huW7yWl7tNfP7lGk46XE+Sp0nCotjzYodhVKlwaNeco=" crossorigin="anonymous" defer></script>
    <script src="js/scroll.js" defer></script>
    <style>
    .user-container {
    position: absolute;
    top: 50%; 
    right: 20px; 
    transform: translateY(-50%); 
    
    
    padding: 10px 20px; 
    border: none; 
    border-radius: 5px; 
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
    </style>
    
</head>
<body>
    <header>
        <nav>
            <div class="menu-container">
                <ul class="menu">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="#">Уроки</a></li>
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
                <button id="registerBtnLesson" class="btn-reg">Регистрация/Вход</button>
            <?php endif; ?>
        </div>
        </nav>
    </header>
    <div id="главная">
        <h1>Выбери инструмент</h1>
        <p>И начинай обучаться у профессионалов уже сейчас</p>
    </div>
    <div id="instruments-wrapper">
        <section class="section-inst" id="acoustic-guitar">
            <a href="#" class="instrument-link" data-instrument="acoustic-guitar">
                <p>Уроки</p>
                <h2>Акустической гитары</h2>
                <img src="img/acoustic-guitar.png" alt="Acoustic guitar">
            </a>
        </section>
        <section class="section-inst" id="electric-guitar">
            <a href="#" class="instrument-link" data-instrument="electric-guitar">
                <p>Уроки</p>
                <h2>Электрогитары</h2>
                <img src="img/electro-guitar.png" alt="Electric guitar">
            </a>
        </section>
        <section class="section-inst" id="bass-guitar">
            <a href="#" class="instrument-link" data-instrument="bass-guitar">
                <p>Уроки</p>
                <h2>Бас-гитары</h2>
                <img src="img/bass-guitar.png" alt="Bass guitar">
            </a>
        </section>
        <section class="section-inst" id="ukulele">
            <a href="#" class="instrument-link" data-instrument="ukulele">
                <p>Уроки</p>
                <h2>Укулеле</h2>
                <img src="img/ukulele.png" alt="Ukulele">
            </a>
        </section>
    </div>
    
    <div id="lessons-wrapper"> 
    </div> 
        
    <div class="courses-container">
    <section class="course">
        <h2>Базовый курс</h2>
        <p>Основные принципы игры на гитаре.</p>
        <p class="price">1500 р/месяц</p>
        <a href="courses.php">Купить курс</a>
    </section>
    <section class="course">
        <h2>Средний курс</h2>
        <p>Расширенные техники игры на гитаре.</p>
        <p class="price">3000 р/месяц</p>
        <a href="courses.php">Купить курс</a>
    </section>
    <section class="course">
        <h2>Углубленный курс</h2>
        <p>Продвинутые темы и тренировки для опытных гитаристов.</p>
        <p class="price">4500 р/месяц</p>
        <a href="courses.php">Купить курс</a>
    </section>
</div>

    <section id="контакты">
        <h2>Контакты</h2>
        <p>Если у вас есть какие-либо вопросы или предложения, свяжитесь с нами:</p>
        <div class="contacts-container">  
            <div class="contact-item">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1998.6037872533248!2d30.320858716096975!3d59.93871648187822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4696310fca145cc1%3A0x406c578330d04ee8!2z0L_Quy4g0KPRgNCw0LrQuNC5INCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCz!5e0!3m2!1sru!2sru!4v1603996830364!5m2!1sru!2sru" 
                    width="300" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <ul>
                    <li>Телефон: +7 123 456 789</li>
                    <li>Email: info@example.com</li>
                </ul>
            </div>
            <div class="contact-item">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3895.1079407686307!2d37.57918206141373!3d55.66966014131359!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54cc905323947%3A0xc7022e51723732d5!2z0KbQtdC90YLRgCDQtNC40LfQsNC50L3QsCDQuCDQuNC90YLQtdGA0YzQtdGA0LAgRXhwb3N0cm95!5e0!3m2!1sru!2sru!4v1699640521015!5m2!1sru!2sru"
                    width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <ul>
                    <li>Телефон: +7 154 455 786</li>
                    <li>Email: info@example.com</li>
                </ul>
                
            </div>
            <div class="contact-item">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1429.145904583548!2d37.49565658556074!3d55.72562706454356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54c046f98873b%3A0xa102c018bbde450d!2z0JbQuNC70L7QuSDQutC-0LzQv9C70LXQutGBIFdlc3RTaWRl!5e0!3m2!1sru!2sru!4v1699640609093!5m2!1sru!2sru"
                    width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <ul>
                    <li>Телефон: +7 987 556 889</li>
                    <li>Email: info@example.com</li>
                </ul>
                
            </div>
        </div>
    </section>

    <footer>
       <p>© 2023 Уроки по гитаре. Все права защищены.</p>
    </footer>
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
            <div id="loginForm" style="display:none;">
                
                <form action="php/login.php" id="loginForm" method="post">
                    <input type="email" placeholder="Email" name="email" required><br>
                    <input type="password" placeholder="Пароль" name="password" required><br>
                    <button class="log-butt" type="submit">Войти</button><br>
                </form>
            </div>
            
        </div>
    </div>
    </div>
</body>
</html>
