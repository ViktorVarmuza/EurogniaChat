document.addEventListener('DOMContentLoaded', function () {


    function showJsError(message) {
       
        const errorAlert = document.getElementById('js-alert-error');

        if (errorAlert) {
            /
            const textSpan = errorAlert.querySelector('.alert-text');
            if (textSpan) {
                textSpan.textContent = message; // vlozeni textu chyby
            }

            // zviditelneni alertu
            errorAlert.classList.remove('d-none');
            errorAlert.classList.add('show');

            
            errorAlert.scrollIntoView({
                behavior: 'smooth', 
                block: 'center'     
            });
        }
    }

    function clearAllAlerts() {
        
        ['js-alert-error', 'js-alert-errors', 'js-alert-success'].forEach(function (id) {
            
            const alertEl = document.getElementById(id);

            // pokud element existuje zavremeho
            if (alertEl) {
                alertEl.classList.add('d-none');    
                alertEl.classList.remove('show');  
            }
        });
    }



    function validateCommon(username, password) {
        if (username === '' || password === '') {
            return 'Prosím, vyplňte všechna povinná pole.';
        }
        if (username.length < 3) {
            return 'Uživatelské jméno musí mít alespoň 3 znaky.';
        }
        if (password.length < 6) {
            return 'Heslo musí mít alespoň 6 znaků.';
        }
        return null; //validace prosla 
    }


    document.addEventListener('submit', function (e) {
        if (!e.target) return;

        // Pouze pokud odesíláme přihlášení nebo registraci
        if (e.target.id === 'form-login' || e.target.id === 'form-register') {
            clearAllAlerts();
        }

        // login formular
        if (e.target.id === 'form-login') {
            const form = e.target;
            const username = form.querySelector('#loginUser').value.trim();
            const password = form.querySelector('#loginPass').value.trim();

            // společna validaci
            const error = validateCommon(username, password);
            if (error) {
                e.preventDefault();
                e.stopPropagation();
                showJsError(error);
                return;
            }
        }

        // registracni formular kontrola
        if (e.target.id === 'form-register') {
            const form = e.target;
            const username = form.querySelector('#regUser').value.trim();
            const password = form.querySelector('#regPass').value.trim();
            const passwordConfirm = form.querySelector('#regPassConfirm').value.trim();

            // spolecna validace dat
            const error = validateCommon(username, password);
            if (error) {
                e.preventDefault();
                e.stopPropagation();
                showJsError(error);
                return;
            }

            // kontrola shody hesla
            if (password !== passwordConfirm) {
                e.preventDefault();
                e.stopPropagation();
                showJsError('Heslo a potvrzení hesla se neshodují.');
                return;
            }
        }
    });
});