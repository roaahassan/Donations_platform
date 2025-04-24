import * as bootstrap from 'bootstrap';
import './bootstrap';

window.openReviewModal = function (donationId) {
    const modalElement = document.getElementById('reviewModal' + donationId);
    if (!modalElement) {
        console.error(`Modal with ID reviewModal${donationId} not found.`);
        return;
    }

    // Ensure the modal is properly initialized
    const modal = new bootstrap.Modal(modalElement);
    modalElement.setAttribute('aria-hidden', 'false'); // Ensure aria-hidden is updated
    modal.show();
};

window.openRejectModal = function (id) {
    const modal = new bootstrap.Modal(document.getElementById('rejectModal' + id));
    modal.show(); 
};

