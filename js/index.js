<<<<<<< HEAD
document.addEventListener('DOMContentLoaded', function() {
    
    
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/register.php', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        
                        window.location.reload();
                    } else {
                        document.getElementById('error-message').innerText = response.message;
                    }
                } else {
                    console.error('Ошибка запроса: ' + xhr.status);
                }
            }
        };
        

        xhr.send(formData);
        
    
    });
    
});


const loginForm = document.getElementById('loginModalForm');

loginForm.addEventListener('submit', function(event) {
    event.preventDefault(); 
    var formData = new FormData(event.target);
    var xhr = new XMLHttpRequest(); 
    xhr.open('POST', 'php/login.php', true); 
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    window.location.reload();
                } else {
                    document.getElementById('login-error-message').innerText = response.message; 
                }
            } else {
                console.error('Ошибка запроса: ' + xhr.status);
            }
            
        }
    };
    xhr.send(formData);
});




=======
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
document.getElementById('switchToRegistration').addEventListener('click', function() {
document.getElementById('loginForm').style.display = 'none';
document.getElementById('registrationForm').style.display = 'block';
});

document.getElementById('switchToLogin').addEventListener('click', function() {
document.getElementById('registrationForm').style.display = 'none';
document.getElementById('loginForm').style.display = 'block';
});
});
const registerLink = document.getElementById('registerLink');
const loginLink = document.getElementById('loginLink');
const registerForm = document.getElementById('registerForm');
const loginForm = document.getElementById('loginForm');

registerLink.addEventListener('click', function(event) {
    event.preventDefault();
    registerLink.classList.add('active');
    loginLink.classList.remove('active');
    registerForm.style.display = 'block';
    loginForm.style.display = 'none';
});

loginLink.addEventListener('click', function(event) {
    event.preventDefault();
    loginLink.classList.add('active');
    registerLink.classList.remove('active');
    loginForm.style.display = 'block';
    registerForm.style.display = 'none';
});
document.querySelector('.close').addEventListener('click', function() {
document.getElementById('registerModal').classList.remove('active');
document.getElementById('registerModal').classList.add('inactive');
});

window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('registerModal')) {
        document.getElementById('registerModal').classList.remove('active');
        document.getElementById('registerModal').classList.add('inactive');
    }
});
registrationForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Предотвращаем отправку формы по умолчанию
    
    // Создаем объект FormData для передачи данных формы
    const formData = new FormData(registrationForm);
    
    // Отправляем запрос на сервер с помощью Fetch API
    fetch('register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Проверяем ответ от сервера
        if (data === 'success') {
            // Если регистрация прошла успешно, закрываем модальное окно
            closeModal();
            
            // Получаем элемент кнопки "Регистрация/Вход"
            const registerBtn = document.getElementById('registerBtn');
            
            // Получаем имя пользователя из формы
            const userName = formData.get('name');
            
            // Создаем новый элемент с именем пользователя
            const userNameElement = document.createElement('span');
            userNameElement.textContent = userName;
            
            // Удаляем кнопку "Регистрация/Вход" и добавляем имя пользователя
            registerBtn.parentNode.replaceChild(userNameElement, registerBtn);
        } else {
            // Если произошла ошибка при регистрации, выводим сообщение об ошибке
            alert(data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Функция закрытия модального окна
function closeModal() {
    const modal = document.getElementById('registerModal');
    modal.style.display = 'none';
}

document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Предотвращаем отправку формы по умолчанию

    // Получаем данные из формы
    var formData = new FormData(this);

    // Создаем новый объект XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Настройка запроса
    xhr.open('POST', 'php/register.php', true);

    // Отправка данных на сервер
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Если запрос успешно завершен

            // Проверяем ответ сервера
            if (xhr.responseText === 'success') {
                // Регистрация прошла успешно
                closeModal(); // Закрываем модальное окно
                var registerBtn = document.getElementById('registerBtn');
                var userName = formData.get('name');
                var userNameElement = document.createElement('span');
                userNameElement.textContent = userName;
                registerBtn.parentNode.replaceChild(userNameElement, registerBtn);
            } else {
                // Выводим сообщение об ошибке
                alert(xhr.responseText);
            }
        } else {
            // Выводим сообщение об ошибке
            alert('Произошла ошибка при отправке запроса');
        }
    };

    // Отправляем запрос на сервер
    xhr.send(formData);
});
>>>>>>> dd64a0b6aa1b53727bc286561deadb4b860cdbbd
