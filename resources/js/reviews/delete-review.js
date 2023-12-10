import {closeModal, handleModalClose, openModal} from "../components/modal-functions.js";

export async function deleteReview() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const modalDeleteReview = document.getElementById('modalDeleteReview');
    const closeDeleteReview = document.getElementById('modalCloseDeleteReview');
    const cancelDeleteReview = document.getElementById('cancelDeleteReview');
    const confirmDeleteReview = document.getElementById('confirmDeleteReview');
    const reviewUserName = document.getElementById('reviewUserName');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const reviewId = event.target.dataset.reviewId;
            const reviewName = event.target.dataset.reviewName;
            console.log('Review Name:', reviewName);
            reviewUserName.textContent = reviewName;
            openModal(modalDeleteReview);
            confirmDeleteReview.dataset.reviewId = reviewId;
        });
    });

    closeDeleteReview.addEventListener('click', () => {
        closeModal(modalDeleteReview);
    });

    cancelDeleteReview.addEventListener('click', () => {
        closeModal(modalDeleteReview);
    });

    confirmDeleteReview.addEventListener('click', async () => {
        try {
            const reviewId = confirmDeleteReview.dataset.reviewId;
            const response = await fetch(`/admin/reviews/delete/${reviewId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            if (!response.ok) {
                throw new Error('Не удалось удалить отзыв');
            }
            removeReviewCard(reviewId);
            closeModal(modalDeleteReview);
        } catch (error) {
            console.error(error.message);
        }
    });

    handleModalClose(modalDeleteReview);
}

const removeReviewCard = (reviewId) => {
    const reviewCard = document.querySelector(`[data-review-id="${reviewId}"]`);
    if (reviewCard) {
        reviewCard.classList.add('fade-out', 'shift-down');
        setTimeout(() => {
            reviewCard.remove();
            shiftOtherCards(reviewCard);
        }, 300);
    }
};

const shiftOtherCards = (removedCard) => {
    const allReviewCards = document.querySelectorAll('.admin-reviews__item[data-review-id]');
    allReviewCards.forEach(card => {
        if (card !== removedCard) {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = `translateY(${removedCard.clientHeight}px)`;
        }
    });
};