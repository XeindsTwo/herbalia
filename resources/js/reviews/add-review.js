import {openModal} from "../components/modal-functions.js";
import {validateName} from '../user/validation.js';

document.addEventListener('DOMContentLoaded', function () {
    const reviewForm = document.querySelector('.reviews-form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const commentInput = document.getElementById('comment');

    const errorSymbolsForName = document.getElementById('nameError');
    const errorMinForName = document.getElementById('nameMinError');
    const errorMaxForName = document.getElementById('nameMaxError');

    const errorSymbolsForEmail = document.getElementById('emailErrorParameters');
    const errorLengthForEmail = document.getElementById('emailLengthError');

    reviewForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        let isValid = true;

        if (!validateName(nameInput.value.trim(), errorSymbolsForName, errorMinForName, errorMaxForName)) {
            isValid = false;
        }

        if (!validateEmail(emailInput.value.trim(), errorSymbolsForEmail, errorLengthForEmail)) {
            isValid = false;
        }

        if (commentInput.value.trim().length === 0) {
            isValid = false;
        }

        if (isValid) {
            fetch('/reviews-form', {
                method: 'POST',
                body: new FormData(reviewForm),
            })
                .then(response => {
                    if (response.ok) {
                        openModal(document.getElementById('modalComplete'));
                    } else {
                        console.error('Произошла ошибка при отправке данных в базу');
                    }
                })
                .catch(error => {
                    console.error('Произошла ошибка:', error);
                });
        }
    });

    document.querySelector('.reviews-form__complete').addEventListener('click', function (e) {
        e.preventDefault();
    });
});

export function validateEmail(emailValue, errorSymbols, errorLength) {
    let valid = true;

    const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

    if (!emailRegex.test(emailValue)) {
        errorSymbols.classList.add('error--active');
        valid = false;
    } else {
        errorSymbols.classList.remove('error--active');
    }

    if (emailValue.length > 80) {
        errorLength.classList.add('error--active');
        valid = false;
    } else {
        errorLength.classList.remove('error--active');
    }

    return valid;
}