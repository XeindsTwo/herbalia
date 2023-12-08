import {closeModal, handleModalClose, openModal} from "../components/modal-functions.js";

document.addEventListener('DOMContentLoaded', () => {
    const modalDelete = document.getElementById('modalDeleteProduct');
    const modalCloseBtn = document.getElementById('modalCloseDeleteProduct');
    const modalConfirmDeleteBtn = document.getElementById('confirmDeleteProduct');

    function bindDeleteButtons() {
        const deleteButtons = document.querySelectorAll('.admin-products__action--delete');
        const titleDeleteProduct = document.getElementById('nameDeleteProduct');
        const modalConfirmCancelBtn = document.getElementById('cancelDeleteProduct');

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
    }

    bindDeleteButtons(); // Привязываем обработчики кнопок удаления

    const form = document.querySelector('.admin-products__search');
    if (form) {
        form.addEventListener('input', function () {
            let searchTimer;

            clearTimeout(searchTimer);
            searchTimer = setTimeout(async () => {
                const formData = new FormData(this);
                const searchText = formData.get('query').trim();
                const categoryId = getCategoryFromURL();

                try {
                    let response;
                    if (!searchText) {
                        response = await fetch(`/admin/products/category/${categoryId || 0}/all`);
                    } else {
                        response = await fetch(`/admin/products/category/${categoryId || 0}/search?${new URLSearchParams(formData).toString()}`);
                    }

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    displayProducts(data.products);
                    if (data.products.length === 0) {
                        showNoResultsMessage(document.getElementById('productsListContainer'));
                    }

                    bindDeleteButtons(); // При каждом обновлении результатов поиска привязываем кнопки удаления
                } catch (error) {
                    handleFetchError();
                }
            }, 600);
        });
    }
});

function displayProducts(products) {
    const productListContainer = document.getElementById('productsListContainer');
    if (!productListContainer) {
        console.error('Container not found');
        return;
    }

    if (products.length === 0) {
        showNoResultsMessage(productListContainer);
        return;
    }

    productListContainer.innerHTML = products.map(product => buildProductCard(product)).join('');
}

function buildProductCard(product) {
    const baseUrl = 'http://127.0.0.1:8000';
    const imageSrc = `${baseUrl}/storage/${product.image_path}`;
    console.log(imageSrc);

    return `
        <li class="admin-products__card" data-product-id="${product.id}">
            <div class="admin-products__head">
                <div class="admin-products__actions">
                    <a class="admin-products__action admin-products__action--view"
                       href="/catalog/${product.id}" target="_blank">
                    </a>
                    <button class="admin-products__action admin-products__action--delete"
                            data-product-id="${product.id}"></button>
                </div>
                <img class="admin-products__img" src="${imageSrc}" height="360" alt="${product.name}" data-image-path="${product.image_path}">
            </div>
            <p class="admin-products__price">
                Цена: ${Number(product.price).toLocaleString()} ₽
            </p>
            <h3 class="admin-products__title">${product.name}</h3>
            <p class="admin-products__article">Артикул - ${product.article}</p>
            <p>Описание: <br>${product.description}</p>
        </li>`;
}

function showNoResultsMessage(container) {
    if (!container) {
        console.error('Container not found');
        return;
    }

    container.innerHTML = `<p class="no-results-message">¯\\_(ツ)_/¯ Ничего не было найдено</p>`;
}

function getCategoryFromURL() {
    const url = window.location.href;
    const categoryIndex = url.indexOf('/category/') + '/category/'.length;
    return parseInt(url.substring(categoryIndex));
}

function handleFetchError() {
    const productListContainer = document.getElementById('productsListContainer');
    if (!productListContainer) {
        console.error('Container not found');
        return;
    }

    productListContainer.innerHTML = `<p class="error">Что-то пошло не так при загрузке данных</p>`;
}