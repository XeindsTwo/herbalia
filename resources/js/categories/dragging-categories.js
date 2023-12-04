import Sortable from 'sortablejs';

export async function updateSortableList() {
    const sortableList = document.querySelector('.admin-category__list');
    new Sortable(sortableList, {
        animation: 500,
        onUpdate: async function (event) {
            const items = event.from.children;
            const categoriesItems = Array.from(items).map((item) => item.dataset.categoryId);
            try {
                const response = await fetch('/admin/categories/updateOrder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({categoriesItems}),
                });
                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.error);
                }

                const responseData = await response.json();
                if (responseData && responseData.message === 'Порядок категорий успешно обновлен') {
                    const categoryElements = sortableList.querySelectorAll('.admin-category__item');
                    categoryElements.forEach((categoryElement, index) => {
                        const indexSpan = categoryElement.querySelector('.admin-category__index');
                        if (indexSpan) {
                            indexSpan.textContent = `Номер в порядке - ${index + 1}`;
                        }
                    });
                }
            } catch (error) {
                console.log('Ошибка: ', error);
            }
        }
    });
}