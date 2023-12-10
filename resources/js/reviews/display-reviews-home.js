document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll('.custom-checkbox__input');
    const saveButton = document.querySelector('.admin-reviews__save');

    saveButton.style.opacity = '0';
    saveButton.style.pointerEvents = 'none';

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            checkIfAnyCheckboxChecked();
        });
    });

    function checkIfAnyCheckboxChecked() {
        const anyChecked = [...checkboxes].some(checkbox => checkbox.checked);
        if (!anyChecked) {
            saveButton.style.opacity = '0';
            saveButton.style.pointerEvents = 'none';
        } else {
            saveButton.style.opacity = '1';
            saveButton.style.pointerEvents = 'all';
        }
    }

    function updateDisplayOnHomepage() {
        const checkedReviews = [...checkboxes]
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.getAttribute('data-review-id'));

        fetch('/admin/reviews/update-display-on-homepage', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({checkedReviews}),
        })
            .then(response => {
                if (response.ok) {
                    alert('Статусы отзывов для главной страницы обновлены');
                } else {
                    throw new Error('Произошла ошибка');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
    }

    saveButton.addEventListener('click', updateDisplayOnHomepage);
});