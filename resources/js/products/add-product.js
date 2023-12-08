import {createImageUploader} from "../components/custom-file.js";

createImageUploader(4);

const form = document.querySelector('.admin-add__form');

const nameInput = document.getElementById('name');
const priceInput = document.getElementById('price');

const errorName = document.getElementById('errorName');
const errorMaxPrice = document.getElementById('errorMaxPrice');
const errorMinPrice = document.getElementById('errorMinPrice');

nameInput.addEventListener('blur', validateOnBlur);
priceInput.addEventListener('blur', validateOnBlur);

form.addEventListener('submit', function (event) {
    if (!isNameValid() || !isPriceValid()) {
        event.preventDefault();
        scrollToError();
    }
});

function validateOnBlur() {
    isNameValid();
    isPriceValid();
}

function isNameValid() {
    const name = nameInput.value.trim();
    if (name.length > 240) {
        errorName.classList.add('error--active');
        return false;
    } else {
        errorName.classList.remove('error--active');
        return true;
    }
}

function isPriceValid() {
    const price = parseFloat(priceInput.value);
    if (price < 1700 || price > 1000000) {
        if (price < 1700) {
            errorMinPrice.classList.add('error--active');
        } else {
            errorMinPrice.classList.remove('error--active');
        }
        if (price > 1000000) {
            errorMaxPrice.classList.add('error--active');
        } else {
            errorMaxPrice.classList.remove('error--active');
        }
        return false;
    } else {
        errorMinPrice.classList.remove('error--active');
        errorMaxPrice.classList.remove('error--active');
        return true;
    }
}

function scrollToError() {
    const activeError = document.querySelector('.error--active');
    if (activeError) {
        activeError.scrollIntoView({behavior: 'smooth', block: 'start'});
    }
}

document.addEventListener("DOMContentLoaded", function () {
    let index = 2;

    const addButton = document.querySelector('.admin-add__plus');
    const compositionContainer = document.getElementById('compositionContainer');
    const hiddenComposition = document.getElementById('hiddenComposition');

    addButton.addEventListener('click', function () {
        const rowCount = compositionContainer.querySelectorAll('.admin-add__row').length;

        if (rowCount >= 8) {
            addButton.style.display = 'none';
            return;
        }

        const newRow = createNewRow(index);
        compositionContainer.appendChild(newRow);
        index++;
        addButton.style.display = index >= 8 ? 'none' : 'block';
    });

    compositionContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('admin-add__delete')) {
            const rowToRemove = event.target.closest('.admin-add__row');
            rowToRemove.remove();
            addButton.style.display = 'block';
            updateIndexes();
        }
    });

    function createNewRow(index) {
        const newRow = document.createElement('li');
        newRow.classList.add('admin-add__row');
        newRow.innerHTML = `
        <div class="admin-add__errors">
            <span class="error">Макс. количество символов - 240</span>
            <span class="error">Мин. число - 1</span>
            <span class="error">Макс. число - 1000</span>
        </div>
        <button class="admin-add__delete" type="button">Удалить</button>
        <div class="admin-add__row-content">
           <div class="admin-add__column">
                <label for="elementName_${index}">Название</label>
                <input class="input" type="text" id="elementName_${index}" placeholder="Элемент состава" required>
           </div>
           <div class="admin-add__column admin-add__column--quantity">
                <label for="elementQuantity_${index}">Кол-во</label>
                <input class="admin-add__quantity input" type="number" id="elementQuantity_${index}" required value="1" placeholder="Кол-во">
            </div>
        </div>
    `;

        compositionContainer.appendChild(newRow);
        index++;
        addButton.style.display = index >= 8 ? 'none' : 'block';
        updateIndexes();
        console.log(hiddenComposition.value);

        return newRow;
    }

    function updateIndexes() {
        const rows = compositionContainer.querySelectorAll('.admin-add__row');
        rows.forEach((row, i) => {
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => {
                input.id = `elementName_${i + 1}`;
                input.setAttribute('placeholder', `Элемент состава ${i + 1}`);
            });
            const labels = row.querySelectorAll('label');
            labels.forEach(label => {
                label.setAttribute('for', `elementName_${i + 1}`);
            });
        });

        const compositionData = Array.from(rows).map(row => {
            const name = row.querySelector('input[type="text"]').value;
            const quantity = row.querySelector('input[type="number"]').value;
            return {name, quantity};
        });

        hiddenComposition.value = JSON.stringify(compositionData);
    }
});