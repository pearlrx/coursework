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
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registrationForm').style.display = 'block';
    });
    
    document.getElementById('switchToLogin').addEventListener('click', function() {
        document.getElementById('registrationForm').style.display = 'none';
        document.getElementById('loginForm').style.display = 'block';
    });
});