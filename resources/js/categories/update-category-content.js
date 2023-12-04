const updateCategoryContent = (remainingCategories) => {
    const infoText = document.querySelector('.admin-category__info');
    const adminWrapper = document.querySelector('.admin__wrapper');

    if (remainingCategories === 0) {
        infoText.textContent = 'Категорий еще нет, но вы можете создать их';
        const warningDiv = document.querySelector('.admin-category__warning');
        if (warningDiv) {
            warningDiv.remove();
        }
    } else {
        infoText.textContent = 'Ваши категории:';
        const warningDiv = document.querySelector('.admin-category__warning');
        if (!warningDiv) {
            const newWarningDiv = document.createElement('div');
            newWarningDiv.classList.add('admin-category__warning');
            newWarningDiv.innerHTML = `
                <span class="admin-category__icon">
                    <img width="26" height="26" src="/static/images/icons/info.svg" alt="предупреждение">
                </span>
                <div>
                    <span class="admin-category__warning-title">Прочтите это</span>
                    Если вы хотите изменить порядок элементов, то просто перетаскивайте их.
                    Изменения вступят в силу сразу после одного перетаскивания
                </div>
            `;

            adminWrapper.insertBefore(newWarningDiv, infoText);
        }
    }
};

export {updateCategoryContent};