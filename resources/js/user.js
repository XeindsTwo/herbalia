import {openModal, closeModal, handleModalClose} from './components/modal-functions.js';

const createUserBtn = document.getElementById('createUserBtn');
const modalCreate = document.getElementById('modalAddUser');
const createBtnUser = document.getElementById('createBtnUser');

createUserBtn.addEventListener('click', () => {
    openModal(modalCreate);
});

createBtnUser.addEventListener('click', async (e) => {
    e.preventDefault();
    const formData = new FormData(document.getElementById('userForm'));

    try {
        const response = await fetch(`/admin/users/`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        if (!response.ok) {
            const errorData = await response.json();
            console.error(errorData.message); // Покажем сообщение об ошибке в консоли
        } else {
            const successData = await response.json();
            console.log(successData.message); // Покажем сообщение об успехе в консоли
            closeModal(modalCreate); // Закрываем модальное окно после успешного создания пользователя
        }
    } catch (error) {
        console.error('Ошибка при отправке запроса:', error);
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.admin-users__action--delete');
    const loginDeleteUser = document.getElementById('loginDeleteUser');
    const modalDelete = document.getElementById('modalDeleteUser');
    const modalCloseDeleteBtn = document.getElementById('modalCloseDeleteUser');
    const modalCancelDeleteBtn = document.getElementById('modalCancelDeleteUser');
    const confirmDeleteUserBtn = document.getElementById('confirmDeleteUser');

    deleteButtons.forEach(button => {
        button.addEventListener('click', event => {
            const userId = event.currentTarget.dataset.userId;
            console.log('User Id: ', userId);
            if (userId) {
                loginDeleteUser.textContent = event.currentTarget.closest('.admin-users__item').querySelector('.admin-users__login').textContent;
                modalDelete.dataset.userId = userId;
                openModal(modalDelete);
            } else {
                console.error('Ошибка: ID юзера не найден');
            }
        });
    });

    modalCloseDeleteBtn.addEventListener('click', () => {
        closeModal(modalDelete);
    });

    modalCancelDeleteBtn.addEventListener('click', () => {
        closeModal(modalDelete);
    });

    handleModalClose(modalDelete);

    confirmDeleteUserBtn.addEventListener('click', async () => {
        const userId = modalDelete.dataset.userId;
        try {
            const response = await fetch(`/admin/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            if (response.ok) {
                const userItem = document.querySelector(`.admin-users__item[data-user-id="${userId}"]`);
                if (userItem) {
                    userItem.remove();
                    closeModal(modalDelete);
                }
            } else {
                console.error('Ошибка удаления, пользователь не был найден');
            }
        } catch (error) {
            console.error('Произошла ошибка: ', error);
        }
    });
});