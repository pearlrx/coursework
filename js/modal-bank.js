var errorTimer; 

function showError(message) {
    var errorContainer = document.getElementById('errorContainer');
    errorContainer.textContent = message;
    errorContainer.classList.add('show'); 
    clearTimeout(errorTimer); 
    errorTimer = setTimeout(function() {
        errorContainer.classList.remove('show');
    }, 5000); 

    
    errorContainer.addEventListener('click', function() {
        errorContainer.classList.remove('show');
    });
}

document.getElementById('cardNumber').addEventListener('keyup', function(event) {
    
    this.value = this.value.replace(/[^\d\s]/g, '');

  
    this.value = this.value.replace(/\s+/g, ' ');

    
    this.value = this.value.trim();

  
    if (this.value.length > 19) {
        this.value = this.value.slice(0, 19);
    }

    
    if (this.value.length > 4 && this.value.length % 5 === 0) {
        var currentValue = this.value.replace(/\s/g, ''); 
        var newValue = '';
        for (var i = 0; i < currentValue.length; i++) {
            if (i > 0 && i % 4 === 0) {
                newValue += ' ' + currentValue[i];
            } else {
                newValue += currentValue[i];
            }
        }
        this.value = newValue;
    }
});

document.getElementById('cvv').addEventListener('input', function(event) {
    
    var cleanedValue = this.value.replace(/\D/g, '');

    
    cleanedValue = cleanedValue.slice(0, 3);

   
    this.value = cleanedValue;
});

document.getElementById('expirationDate').addEventListener('input', function(event) {
    
    var cleanedValue = this.value.replace(/[^\d/]/g, '');

    
    var firstSlashIndex = cleanedValue.indexOf('/');
    if (firstSlashIndex !== -1) {
        cleanedValue = cleanedValue.slice(0, firstSlashIndex + 1) + cleanedValue.slice(firstSlashIndex + 1).replace(/\//g, '');
    }

    
    cleanedValue = cleanedValue.slice(0, 5);

    
    if (cleanedValue.length === 2 && event.data !== '/' && event.inputType !== 'deleteContentBackward') {
        cleanedValue += '/';
    }

    
    this.value = cleanedValue;
});

document.addEventListener('DOMContentLoaded', function() {
    var errorContainer = document.getElementById('errorContainer');
    var isLoggedIn = (document.querySelector('script[src="js/modal-bank.js"]').getAttribute('data-isloggedin') === 'true');
    var buyLinks = document.querySelectorAll('.buy-course');
    var modalBank = document.getElementById('myModal');
    var closeModalBtn = document.getElementById('closeModalBtn'); 

    buyLinks.forEach(function(buyLink) {
        buyLink.addEventListener('click', function(event) {
            event.preventDefault(); 

            if (!isLoggedIn) {
                showError('Пожалуйста, войдите в свой аккаунт, чтобы продолжить.');
            } else {
                modalBank.classList.remove('hide'); 
                modalBank.classList.add('show'); 
            }
        });
    });

    
    closeModalBtn.addEventListener('click', function() {
        modalBank.classList.remove('show'); 
        modalBank.classList.add('hide');
    });
    
    
    window.addEventListener('click', function(event) {
        if (event.target == modalBank) {
            modalBank.classList.remove('show'); 
            modalBank.classList.add('hide');
        }
    });

   
    modalBank.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});


document.querySelectorAll('.buy-course').forEach(function(buyLink) {
    buyLink.addEventListener('click', function(event) {
        event.preventDefault(); 

        var courseId = this.dataset.courseId; 
        document.getElementById('purchaseButton').dataset.courseId = courseId; 
    });
});



document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    
    var cardNumber = document.getElementById('cardNumber').value.trim();
    var expirationDate = document.getElementById('expirationDate').value.trim();
    var cvv = document.getElementById('cvv').value.trim();
    
    if (cardNumber === '' || expirationDate === '' || cvv === '') {
        showErrorModal('Пожалуйста, заполните все поля для оплаты.');
    } else if (cardNumber.length < 16) {
        showErrorModal('Пожалуйста, введите корректный номер карты.');
    } else if (expirationDate.length < 5 || expirationDate.indexOf('/') === -1) {
        showErrorModal('Пожалуйста, введите дату истечения карты в формате ММ/ГГ.');
    } else if (cvv.length < 3) {
        showErrorModal('Пожалуйста, введите корректный CVV.');
    } else {
        var formData = new FormData(this);
        var courseId = document.getElementById('purchaseButton').dataset.courseId;
        formData.append('courseId', courseId);
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/purchase_course.php', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        console.log(xhr.responseText);
                        showSuccessPopup('Курс успешно куплен!');
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    } else {
                        console.log(xhr.responseText);
                        showErrorModal(response.message);
                    }
                } else {
                    console.log(xhr.responseText);
                    console.error('Ошибка запроса: ' + xhr.status);
                }
            }
        };
    
        xhr.send(formData);
    }
});



function showErrorModal(message) {
    var errorModal = document.getElementById('errorModal');
    var errorModalMessage = document.getElementById('errorModalMessage');
    
    errorModalMessage.textContent = message; 
    
    errorModal.classList.add('show');
    
    var closeModalBtn = document.getElementById('closeModalBtn');
    
    
    closeModalBtn.removeEventListener('click', closeModal);

    
    closeModalBtn.addEventListener('click', closeModal);

    function closeModal() {
        errorModal.classList.remove('show');
        errorModalMessage.textContent = '';
        
        closeModalBtn.removeEventListener('click', closeModal);
    }
}



function showSuccessPopup(message) {
    var successPopup = document.getElementById('successPopup');
    var successPopupMessage = document.getElementById('successPopupMessage');
    
    successPopupMessage.textContent = message; 
    
   
    successPopup.classList.add('show');
}










