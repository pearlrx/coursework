// Обработчик клика на
var links = document.querySelectorAll('.lesson-video-link');
var modal = document.getElementsByClassName('modal-lesson')[0]; // Получаем первый элемент из коллекции
var closeButton = document.querySelector('.close-lesson');
var videoFrame = document.getElementById('videoFrame'); // Перемещаем определение в глобальную область

// Функция для отображения модального окна с видео
function openModal(videoLink) {
  videoFrame.src = videoLink;
  modal.style.display = 'block';
}

// Закрытие модального окна при нажатии на крестик
closeButton.onclick = function() {
    stopVideo();
  modal.style.display = 'none';
};

// Закрытие модального окна при клике вне его области
window.onclick = function(event) {
  if (event.target == modal) {
    stopVideo();
    modal.style.display = 'none';
  }
};

// Обработчик клика на каждую из ссылок
links.forEach(function(link) {
  link.addEventListener('click', function(event) {
    event.preventDefault(); // Предотвращаем переход по ссылке
    var videoLink = this.getAttribute('data-video'); // Получаем ссылку на видео
    openModal(videoLink); // Открываем модальное окно с видео
  });
});

function stopVideo() {
    // Проверяем, есть ли iframe с видео
    if (videoFrame) {
      // Устанавливаем пустую ссылку для остановки видео
      videoFrame.src = '';
    }
}
