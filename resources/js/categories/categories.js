import {closeModal, openModal, handleModalClose} from '../components/modal-functions.js';
import {validateNameAddCategory, validateNameEditCategory} from './validate-name.js';
import {updateCategoryContent} from "./update-category-content.js";
import {updateSortableList} from "./dragging-categories.js";

const elements = {
    addBtnCategory: document.getElementById('addBtnCategory'),
    addModalCategory: document.getElementById('modalAddCategory'),
    closeBtnAddCategory: document.getElementById('modalCloseAddCategory'),
    categoryList: document.querySelector('.admin-category__list'),
    modalDeleteCategory: document.getElementById('modalDeleteCategory'),
    modalCloseDeleteCategory: document.getElementById('modalCloseDeleteCategory'),
    modalEditCategory: document.getElementById('modalEditCategory'),
    modalCloseEditCategory: document.getElementById('modalCloseEditCategory'),
    cancelDeleteCategory: document.getElementById('cancelDeleteCategory'),
    confirmDeleteBtn: document.getElementById('confirmDeleteCategory'),
    deleteButtons: document.querySelectorAll('.admin-category__delete'),
    editButtons: document.querySelectorAll('.admin-category__edit'),
    nameInput: document.getElementById('name'),
    nameUniqueError: document.getElementById('nameUniqueError'),
    nameMaxError: document.getElementById('nameMaxError'),
};

const deleteCategory = async (categoryId) => {
    try {
        const response = await fetch(`/admin/categories/${categoryId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        });

        if (response.ok) {
            const categoryItemToDelete = document.querySelector(`.admin-category__delete[data-category-id="${categoryId}"]`).closest('.admin-category__item');
            if (categoryItemToDelete) {
                categoryItemToDelete.remove();
            }

            closeModal(elements.modalDeleteCategory);
            const remainingCategories = document.querySelectorAll('.admin-category__item').length;
            updateCategoryContent(remainingCategories);
        }
    } catch (error) {
        console.error('Error: ', error);
    }
};

elements.addBtnCategory.addEventListener('click', () => {
    openModal(elements.addModalCategory);
});
elements.closeBtnAddCategory.addEventListener('click', () => {
    closeModal(elements.addModalCategory);
});

elements.modalCloseEditCategory.addEventListener('click', () => {
    closeModal(elements.modalEditCategory);
});

handleModalClose(elements.addModalCategory);
handleModalClose(elements.modalEditCategory);

const form = document.querySelector('form');
form.addEventListener('submit', async function (e) {
    e.preventDefault();
    if (await validateNameAddCategory()) {
        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: form.method,
                body: formData
            });

            if (response.ok) {
                closeModal(elements.addModalCategory);
                const responseData = await response.json();
                console.log(responseData);
                createCategoryElement(responseData.category);
                form.reset();
            }
        } catch (error) {
            console.error('Error: ', error);
        }
    }
});

function createCategoryElement(categoryData) {
    let categoryList = document.querySelector('.admin-category__list');

    const newCategory = document.createElement('li');
    newCategory.classList.add('admin-category__item');

    const categoryContent = document.createElement('div');
    categoryContent.classList.add('admin-category__content');

    const categoryIndex = document.createElement('span');
    categoryIndex.classList.add('admin-category__index');
    categoryIndex.textContent = `Номер в порядке - ${categoryData.order_index}`;
    categoryContent.appendChild(categoryIndex);

    const categoryName = document.createElement('h3');
    categoryName.classList.add('admin-category__name');
    categoryName.textContent = categoryData.name;
    categoryContent.appendChild(categoryName);

    if (categoryData.subtitle) {
        const categorySubtitle = document.createElement('p');
        categorySubtitle.classList.add('admin-category__text');
        categorySubtitle.textContent = categoryData.subtitle;
        categoryContent.appendChild(categorySubtitle);
    }

    newCategory.appendChild(categoryContent);

    const categoryActions = document.createElement('div');
    categoryActions.classList.add('admin-category__actions');

    const deleteButton = document.createElement('button');
    deleteButton.classList.add('admin-category__action', 'admin-category__delete');
    deleteButton.dataset.categoryId = categoryData.id;
    deleteButton.addEventListener('click', function () {
        openModal(elements.modalDeleteCategory);
        handleModalClose(elements.modalDeleteCategory);
        elements.modalDeleteCategory.querySelector('span').textContent = categoryData.name;
        elements.confirmDeleteBtn.dataset.categoryId = categoryData.id;

        elements.confirmDeleteBtn.addEventListener('click', async function () {
            const categoryIdToDelete = this.dataset.categoryId;
            await deleteCategory(categoryIdToDelete);
            closeModal(elements.modalDeleteCategory);
            newCategory.remove();
        });
    });

    categoryActions.appendChild(deleteButton);
    newCategory.appendChild(categoryActions);

    if (!categoryList) {
        categoryList = document.createElement('ul');
        categoryList.classList.add('admin-category__list');
        categoryList.id = 'sortableList';
        document.querySelector('.admin__wrapper').appendChild(categoryList);
        updateSortableList();
    }

    categoryList.appendChild(newCategory);
    updateCategoryContent();
}

elements.deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
        const categoryName = button.closest('.admin-category__item').querySelector('.admin-category__name').textContent;
        const categoryId = button.dataset.categoryId;

        openModal(elements.modalDeleteCategory);
        handleModalClose(elements.modalDeleteCategory);
        elements.modalDeleteCategory.querySelector('span').textContent = categoryName;
        elements.confirmDeleteBtn.dataset.categoryId = categoryId;
    });
});
elements.modalCloseDeleteCategory.addEventListener('click', () => closeModal(elements.modalDeleteCategory));
elements.cancelDeleteCategory.addEventListener('click', () => closeModal(elements.modalDeleteCategory));
elements.confirmDeleteBtn.addEventListener('click', async function () {
    const categoryId = this.dataset.categoryId;
    await deleteCategory(categoryId);
    closeModal(elements.modalDeleteCategory);
});

elements.editButtons.forEach(button => {
    const editBtnClickHandler = async () => {
        try {
            const categoryId = button.dataset.categoryId;
            const categoryName = button.dataset.categoryName;
            const categorySubtitle = button.dataset.categorySubtitle;

            const modalEditCategory = document.getElementById('modalEditCategory');
            const nameInput = modalEditCategory.querySelector('#nameEdit');
            const subtitleInput = modalEditCategory.querySelector('#subtitleEdit');
            const editBtn = modalEditCategory.querySelector('#editBtn');

            const form = modalEditCategory.querySelector('form');
            form.action = `/admin/categories/${categoryId}`;
            form.method = 'PUT';
            editBtn.setAttribute('data-current-category-id', categoryId);

            openModal(modalEditCategory);
            nameInput.value = button.getAttribute('data-current-name') || categoryName;
            subtitleInput.value = button.getAttribute('data-current-subtitle') || categorySubtitle;

            const editButtonClickHandler = async (e) => {
                try {
                    e.preventDefault();
                    const currentCategoryId = editBtn.getAttribute('data-current-category-id');

                    if (await validateNameEditCategory(currentCategoryId)) {
                        const response = await fetch(form.action, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                name: nameInput.value,
                                subtitle: subtitleInput.value
                            })
                        });

                        if (response.ok) {
                            button.setAttribute('data-current-name', nameInput.value);
                            button.setAttribute('data-current-subtitle', subtitleInput.value);

                            closeModal(modalEditCategory);
                            const categoryItem = button.closest('.admin-category__item');
                            if (categoryItem) {
                                const updatedName = nameInput.value;
                                const updatedSubtitle = subtitleInput.value;
                                categoryItem.querySelector('.admin-category__name').textContent = updatedName;
                                categoryItem.querySelector('.admin-category__text').textContent = updatedSubtitle || '';
                            }

                            editBtn.removeEventListener('click', editButtonClickHandler);
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            };

            editBtn.addEventListener('click', editButtonClickHandler);
        } catch (error) {
            console.error('Error:', error);
        }
    };

    button.addEventListener('click', editBtnClickHandler);
});

updateSortableList();