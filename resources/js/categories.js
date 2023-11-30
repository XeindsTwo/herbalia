const body = document.body;
const addBtnCategory = document.getElementById('addBtnCategory');
const addModalCategory = document.getElementById('modalAddCategory');
const closeBtnAddCategory = document.getElementById('modalCloseAddCategory');
const categoryList = document.querySelector('.admin-category__list');

function closeModal() {
    body.classList.remove('body--active');
    addModalCategory.classList.remove('modal--active');
}

addBtnCategory.addEventListener('click', function () {
    body.classList.add('body--active');
    addModalCategory.classList.add('modal--active');
});

document.addEventListener('click', function (e) {
    if (!addModalCategory.contains(e.target) && e.target !== addBtnCategory) {
        closeModal();
    }
});

document.addEventListener('keyup', function (e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

closeBtnAddCategory.addEventListener('click', closeModal);

const form = document.querySelector('form');
form.addEventListener('submit', async function (e) {
    e.preventDefault();
    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: form.method,
            body: formData
        });

        if (response.ok) {
            closeModal();
            const responseData = await response.json();
            console.log(responseData);
            const newCategory = document.createElement('li');
            newCategory.classList.add('admin-category__item');
            newCategory.innerHTML = `
            <h3>${responseData.category.name}</h3>
            ${responseData.category.subtitle ? `<p>${responseData.category.subtitle}</p>` : ''}
            `;
            categoryList.appendChild(newCategory);
            form.reset();
        } else {
            console.error('Ошибка при добавлении категории');
        }
    } catch (error) {
        console.error('Ошибка при выполнении запроса:', error);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.admin-category__btn');
    const modalDeleteCategory = document.getElementById('modalDeleteCategory');
    const modalCloseDeleteCategory = document.getElementById('modalCloseDeleteCategory');
    const cancelDeleteCategory = document.getElementById('cancelDeleteCategory');
    const body = document.body;

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            console.log('Button clicked');
            const categoryName = button.previousElementSibling.textContent;
            const categoryId = button.dataset.categoryId;

            modalDeleteCategory.querySelector('span').textContent = categoryName;
            modalDeleteCategory.classList.add('modal--active');
            body.classList.add('body--active');

            const confirmDeleteBtn = document.getElementById('confirmDeleteCategory');
            confirmDeleteBtn.dataset.categoryId = categoryId;
        });
    });

    modalCloseDeleteCategory.addEventListener('click', function () {
        console.log('Close modal clicked');
        modalDeleteCategory.classList.remove('modal--active');
        body.classList.remove('body--active');
    });

    cancelDeleteCategory.addEventListener('click', function () {
        console.log('Cancel delete clicked');
        modalDeleteCategory.classList.remove('modal--active');
        body.classList.remove('body--active');
    });

    const confirmDeleteBtn = document.getElementById('confirmDeleteCategory');

    confirmDeleteBtn.addEventListener('click', async function () {
        console.log('Confirm delete clicked');
        const categoryId = this.dataset.categoryId;

        try {
            const response = await fetch(`/admin/categories/${categoryId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
            });

            if (response.ok) {
                const categoryItemToDelete = document.querySelector(`.admin-category__btn[data-category-id="${categoryId}"]`).closest('.admin-category__item');
                if (categoryItemToDelete) {
                    categoryItemToDelete.remove();
                }

                modalDeleteCategory.classList.remove('modal--active');
                body.classList.remove('body--active');
            } else {
                console.error('Ошибка при удалении категории');
            }
        } catch (error) {
            console.error('Ошибка при выполнении запроса:', error);
        }
    });
});