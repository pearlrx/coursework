const lessonsWrapper = document.getElementById('lessons-wrapper');
const lessonsLink = document.getElementById('lessonsLink');

const instrumentLinks = document.querySelectorAll('.instrument-link');
instrumentLinks.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        const instrument = link.dataset.instrument;
        loadLessons(instrument);
    });
});

let isLessonBlockOpen = false; 

function loadLessons(instrument) {
    let lessonsHTML = '';
    switch (instrument) {
        case 'acoustic-guitar':
            lessonsHTML = `
            <div class="lesson" data-instrument="acoustic-guitar">
                    <img class="" src="img/guitar02.jpg" alt="Урок1">
                    <div class="lesson-text">
                        <h2>Акустическая гитара</h2>
                        <p>Основы игры на акустической гитаре, аккорды,<br> звуки струн и простые мелодии.</p>
                    </div>
<<<<<<< HEAD
            </div>
=======
                </div>
>>>>>>> dd64a0b6aa1b53727bc286561deadb4b860cdbbd
            `;
            break;
        case 'electric-guitar':
            lessonsHTML = `
            <div class="lesson" data-instrument="electric-guitar">
                    <img src="img/123-1536x1022.jpg" alt="Урок2">
                    <div class="lesson-text">
                        <h2>Техника игры на электрогитаре</h2>
                        <p>Различные техники игры на электрогитаре,<br> включая бой, арпеджио, легато и другие.</p>
                    </div>
<<<<<<< HEAD
            </div>
=======
                </div>
>>>>>>> dd64a0b6aa1b53727bc286561deadb4b860cdbbd
            `;
            break;
        case 'bass-guitar':
            lessonsHTML = `
            <div class="lesson" data-instrument="bass-guitar">
                    <img src="img/postan.jpg" alt="Урок3">
                    <div class="lesson-text">
                        <h2>Уроки по бас-гитаре</h2>
                        <p>Изучение различных аккордов и практика игры<br> аккомпанемента на бас-гитаре.</p>
                    </div>
<<<<<<< HEAD
            </div>
=======
                </div>
>>>>>>> dd64a0b6aa1b53727bc286561deadb4b860cdbbd
            `;
            break;
        case 'ukulele':
            lessonsHTML = `
            <div class="lesson" data-instrument="ukulele">
                    <img src="img/ukulele.jpg" alt="Урок4">
                    <div class="lesson-text">
                        <h2>Уроки по игре на укулеле</h2>
                        <p>Основы игры на укулеле, техника,<br> аккорды и песни для практики.</p>
                    </div>
<<<<<<< HEAD
            </div>
=======
                </div>
>>>>>>> dd64a0b6aa1b53727bc286561deadb4b860cdbbd
            `;
            break;
        default:
            lessonsHTML = '<p>Выберите инструмент для просмотра уроков.</p>';
    }
    lessonsWrapper.innerHTML = lessonsHTML;
}

function closeLessons() {
    lessonsWrapper.innerHTML = ''; 
    lessonsWrapper.classList.remove('lessons-shown'); 
}
<<<<<<< HEAD
        


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
>>>>>>> dd64a0b6aa1b53727bc286561deadb4b860cdbbd
