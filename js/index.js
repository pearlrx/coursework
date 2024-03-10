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




