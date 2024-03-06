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
            </div>
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
            </div>
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
            </div>
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
            </div>
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
