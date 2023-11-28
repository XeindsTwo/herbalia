$(document).ready(function () {
    $('#email').on('blur', function () {
        const email = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/check-email',
            data: {
                email: email
            },
            success: function (response) {
                if (response.exists) {
                    $('#emailError').addClass('error--active');
                } else {
                    $('#emailError').removeClass('error--active');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

$(document).ready(function () {
    const nameInput = $('#name');
    const emailInput = $('#email');
    const passwordInput = $('#password');
    const passwordConfirmInput = $('#password_confirmation');
    const registerButton = $('.auth__btn');

    function validateName() {
        const nameValue = nameInput.val().trim();
        const nameError = $('#nameError');
        const nameMinError = $('#nameMinError');
        const nameMaxError = $('#nameMaxError');
        const nameRegex = /^[A-Za-zА-яЁё\-]+$/;

        if (nameValue.length < 2) {
            nameMinError.addClass('error--active');
        } else {
            nameMinError.removeClass('error--active');
        }

        if (nameValue.length > 255) {
            nameMaxError.addClass('error--active');
        } else {
            nameMaxError.removeClass('error--active');
        }

        if (!nameRegex.test(nameValue)) {
            nameError.addClass('error--active');
        } else {
            nameError.removeClass('error--active');
        }
    }

    function validateEmail() {
        const emailValue = emailInput.val().trim();
        const emailErrorParameters = $('#emailErrorParameters');
        const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

        if (!emailRegex.test(emailValue)) {
            emailErrorParameters.addClass('error--active');
        } else {
            emailErrorParameters.removeClass('error--active');
        }
    }

    function validatePassword() {
        const passwordValue = passwordInput.val().trim();
        const passwordError = $('#passwordError');
        const passwordMinError = $('#passwordMinError');
        const passwordRegex = /^[^\u0400-\u04FF\s]{8,}$/;

        if (passwordValue.length < 8) {
            passwordMinError.addClass('error--active');
        } else {
            passwordMinError.removeClass('error--active');
        }

        if (!passwordRegex.test(passwordValue)) {
            passwordError.addClass('error--active');
        } else {
            passwordError.removeClass('error--active');
        }
    }

    function validatePasswordConfirmation() {
        const passwordValue = passwordInput.val().trim();
        const passwordConfirmValue = passwordConfirmInput.val().trim();
        const passwordConfirmError = $('#passwordConfirmError');

        if (passwordValue !== passwordConfirmValue) {
            passwordConfirmError.addClass('error--active');
        } else {
            passwordConfirmError.removeClass('error--active');
        }
    }

    function validateForm() {
        validateName();
        validateEmail();
        validatePassword();
        validatePasswordConfirmation();

        const hasErrors = $('.error--active').length > 0;

        if (hasErrors) {
            registerButton.removeClass('auth__btn--active');
            registerButton.prop('disabled', true);
        } else {
            registerButton.addClass('auth__btn--active');
            registerButton.prop('disabled', false);
        }
    }

    nameInput.on('blur input', validateName);
    emailInput.on('blur input', validateEmail);
    passwordInput.on('blur input', validatePassword);
    passwordConfirmInput.on('blur input', validatePasswordConfirmation);
    nameInput.on('input', validateForm);
    emailInput.on('input', validateForm);
    passwordInput.on('input', validateForm);
    passwordConfirmInput.on('input', validateForm);
});