document.addEventListener('DOMContentLoaded', function () {

    
    function showJsError(message) {
        const errorAlert = document.getElementById('js-alert-error');
        if (errorAlert) {
            const textSpan = errorAlert.querySelector('.alert-text');
            if (textSpan) {
                textSpan.textContent = message;
            }
            errorAlert.classList.remove('d-none');
            errorAlert.classList.add('show');

            // Hladký posun k chybě
            errorAlert.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    }

  
    function clearAllAlerts() {
        ['js-alert-error', 'js-alert-errors', 'js-alert-success'].forEach(function (id) {
            const alertEl = document.getElementById(id);
            if (alertEl) {
                alertEl.classList.add('d-none');
                alertEl.classList.remove('show');
            }
        });
    }

  
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('close-alert-btn')) {
            const alertBox = e.target.closest('.alert');
            if (alertBox) {
                alertBox.classList.add('d-none');
                alertBox.classList.remove('show');
            }
        }
    });

  
    document.addEventListener('submit', function (e) {

        // Pouze pokud odesíláme přihlášení nebo registraci
        if (e.target && (e.target.id === 'form-login' || e.target.id === 'form-register')) {
            // Smažeme předchozí zobrazené chyby (jak z JS, tak z minulé session)
            clearAllAlerts();
        }

        // 1. Ošetření Login formuláře
        if (e.target && e.target.id === 'form-login') {
            const form = e.target;
            const username = form.querySelector('#loginUser').value.trim();
            const password = form.querySelector('#loginPass').value.trim();

            if (username === '' || password === '') {
                e.preventDefault();
                e.stopPropagation();
                showJsError('Prosím, vyplňte uživatelské jméno i heslo.');
            }
        }

        // 2. Ošetření Registračního formuláře
        if (e.target && e.target.id === 'form-register') {
            const form = e.target;
            const username = form.querySelector('#regUser').value.trim();
            const password = form.querySelector('#regPass').value.trim();
            const passwordConfirm = form.querySelector('#regPassConfirm').value.trim();

            // Kontrola prázdných polí
            if (username === '' || password === '' || passwordConfirm === '') {
                e.preventDefault();
                e.stopPropagation();
                showJsError('Prosím, vyplňte všechna pole.');
                return;
            }

            // Kontrola délky hesla
            if (password.length < 6) {
                e.preventDefault();
                e.stopPropagation();
                showJsError('Heslo musí mít alespoň 6 znaků.');
                return;
            }

            // Kontrola shody hesel
            if (password !== passwordConfirm) {
                e.preventDefault();
                e.stopPropagation();
                showJsError('Heslo a potvrzení hesla se neshodují.');
                return;
            }
        }
    });

});