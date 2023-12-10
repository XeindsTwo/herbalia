import {deleteReview} from "./delete-review.js";

deleteReview();

const approveButtons = document.querySelectorAll('.approve-btn');

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

const approveReview = async (reviewId) => {
    try {
        const response = await fetch(`/admin/reviews/approve/${reviewId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        if (!response.ok) {
            throw new Error('Не удалось одобрить отзыв');
        }
        removeReviewCard(reviewId);
    } catch (error) {
        console.error(error.message);
    }
};

approveButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const reviewId = event.target.dataset.reviewId;
        approveReview(reviewId);
    });
});