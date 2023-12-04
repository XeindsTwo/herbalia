export function setupSearchFromSearchJS(inputSelector, resultContainerSelector, endpoint) {
    let timerId;

    const input = document.querySelector(inputSelector);
    const resultContainer = document.querySelector(resultContainerSelector);

    input.addEventListener('input', function () {
        clearTimeout(timerId);
        const searchText = this.value.trim();

        timerId = setTimeout(() => {
            fetch(`${endpoint}?query=${searchText}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const { products, currentCategory, categories } = data;

                    if (searchText === '') {
                        resultContainer.innerHTML = '';
                        displayProducts(products, resultContainer);
                    } else if (products.length === 0) {
                        resultContainer.innerHTML = `<p class="${resultContainerSelector.substring(1)}-not-found">Ничего не найдено ¯\\_(ツ)_/¯</p>`;
                    } else {
                        displayProducts(products, resultContainer);
                    }
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                    resultContainer.innerHTML = `<p class="${resultContainerSelector.substring(1)}-error">Что-то пошло не так при загрузке данных</p>`;
                });
        }, 1000);
    });

    function displayProducts(products, container) {
        const newContent = products.map(product => `
            <li class="admin-products__card">
                <img class="admin-products__img" src="${product.image_path}" height="360" alt="${product.name}">
                <h3 class="admin-products__title">${product.name}</h3>
                <p class="admin-products__article">Артикул - ${product.article}</p>
                <p class="admin-products__price">Цена: ${product.price} ₽</p>
                <p>${product.description}</p>
            </li>
        `).join('');

        container.innerHTML = `<ul class="${resultContainerSelector.substring(1)}">${newContent}</ul>`;
    }
}