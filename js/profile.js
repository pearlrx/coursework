document.getElementById('changeAvatarBtn').addEventListener('click', function() {
    document.getElementById('avatarInput').click();
});

document.getElementById('avatarInput').addEventListener('change', function() {
    var file = this.files[0];
    var formData = new FormData();
    formData.append('avatar', file);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/upload_avatar.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    console.log(response.message); 
                    console.log('URL изображения:', response.avatarUrl); 
                    console.log(response.avatarUrl)
                    location.reload();
                    
                } else {
                    
                    var errorMessageElement = document.getElementById('error-message');
                    
                    errorMessageElement.textContent = response.message;
                }
            } else {
                console.error('Ошибка запроса:', xhr.status);
            }
        }
    };

    xhr.send(formData);
});



