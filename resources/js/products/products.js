import {setupSearchFromSearchJS} from "./search-products.js";
import {closeModal, handleModalClose, openModal} from "../components/modal-functions.js";

const form = document.querySelector('.admin-products__search');
const endpoint = form.dataset.searchUrl;
const inputSelector = '.admin-products__search input[name="query"]';
const resultContainerSelector = '.admin-products__list';

setupSearchFromSearchJS(inputSelector, resultContainerSelector, endpoint);

document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.admin-products__action--delete');
    const titleDeleteProduct = document.getElementById('nameDeleteProduct');
    const modalDelete = document.getElementById('modalDeleteProduct');
    const modalCloseBtn = document.getElementById('modalCloseDeleteProduct');
    const modalConfirmCancelBtn = document.getElementById('cancelDeleteProduct');
    const modalConfirmDeleteBtn = document.getElementById('confirmDeleteProduct');

    deleteButtons.forEach(button => {
        button.addEventListener('click', event => {
            const productId = event.currentTarget.dataset.productId;
            console.log('Product ID:', productId);
            if (productId) {
                titleDeleteProduct.textContent = event.currentTarget.closest('.admin-products__card').querySelector('.admin-products__title').textContent;
                modalDelete.dataset.productId = productId;
                openModal(modalDelete);
            } else {
                console.error('Ошибка: ID товара не найден');
            }
        });
    });

    modalCloseBtn.addEventListener('click', () => {
        closeModal(modalDelete);
    });

    modalConfirmCancelBtn.addEventListener('click', () => {
        closeModal(modalDelete);
    });

    handleModalClose(modalDelete);

    modalConfirmDeleteBtn.addEventListener('click', async () => {
        const productId = modalDelete.dataset.productId;
        try {
            const response = await fetch(`/admin/products/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (response.ok) {
                const productCard = document.querySelector(`.admin-products__card[data-product-id="${productId}"]`);
                if (productCard) {
                    productCard.remove();
                    closeModal(modalDelete);
                    const productList = document.querySelector('.admin-products__list');
                    if (!productList || productList.children.length === 0) {
                        const searchForm = document.querySelector('.admin-products__search');
                        if (searchForm) {
                            searchForm.remove();
                        }
                    }
                } else {
                    console.error('Ошибка удаления, товар не был найден');
                }
            } else {
                console.error('Ошибка при удалении товара');
            }
        } catch (error) {
            console.error('Произошла ошибка: ', error);
        }
    });
});