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
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('registerBtnLesson').addEventListener('click', function() {
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


</head>
<body>
<header>
    <nav>
        <div class="menu-container">
            <ul class="menu">
                <li><a href="#">Главная</a></li>
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
                <button id="registerBtnLesson" class="btn-reg">Регистрация/Вход</button>
            <?php endif; ?>
        </div>
        
    </nav>
</header>


    <section id="главная">
        <h1>Уроки по гитаре</h1>
        <p>Добро пожаловать на сайт с уроками по игре на гитаре! Наш сайт предлагает широкий спектр уроков для начинающих и опытных гитаристов.</p>
        <a href="lessons.php" class="btn">Перейти к урокам</a>
    </section>

    <section id="уроки">
        <h2 style="text-align: center;">Уроки</h2>
        <ul>
            
                <li class="lessons-content">
                <img src="img/guitar02.jpg" alt="">
                <h3>Введение в игру на гитаре</h3>
                <p>Основы игры на гитаре, аккорды, звуки струн и простые мелодии.</p>
            </li>
            <li class="lessons-content">
                <img src="img/123-1536x1022.jpg" alt="">
                <h3>Техника игры на гитаре</h3>
                <p>Различные техники игры на гитаре, включая бой, арпеджио, легато и другие.</p>
            </li>
            <li class="lessons-content">
                <img src="img/027.jpg" alt="">
                <h3>Аккорды и аккомпанемент</h3>
                <p>Изучение различных аккордов и практика игры аккомпанемента.</p>
            </li>
            
        </ul>
    </section>
    <section id="отзывы">
        <h2 class="отзывы-h2">Отзывы наших студентов</h2>
        <div class="reviews-container">
            <div class="review-card">
                <img class="review-img" src="img/pavel.jpg" alt="Person Image">
                <h3>Павел</h3>
                <p>"Крутые уроки! Рекомендую всем новичкам."</p>
            </div>
            <div class="review-card">
                <img class="review-img" src="img/dmitrii.jpg" alt="Person Image">
                <h3>Дмитрий</h3>
                <p>"Преподаватель объясняет все очень понятно и доступно."</p>
            </div>
            <div class="review-card">
                <img class="review-img" src="img/girl_happy.jpg" alt="Person Image">
                <h3>София</h3>
                <p>"После этих уроков начала выступать в баре у себя в городе."</p>
            </div>
        </div>
    </section>
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
        <div id="loginModalForm" style="display:none;">
            
            <form action="php/login.php" id="loginForm" method="post">
                <input type="text" placeholder="Email" name="email" required><br>
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


        

    
</body>
</html>
