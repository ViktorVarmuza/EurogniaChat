    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('close-alert-btn')) {
            const alertBox = e.target.closest('.alert');
            if (alertBox) {
                alertBox.classList.add('d-none');
                alertBox.classList.remove('show');
            }
        }
    });

    //zavirani alertu 