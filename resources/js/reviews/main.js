import {openModal, closeModal, handleModalClose} from '../components/modal-functions.js';

const btnRules = document.getElementById('btnRules');
const modalRules = document.getElementById('modalRules');
const modalRulesCloseBtn = document.getElementById('modalCloseRules');

btnRules.addEventListener('click', () => {
    openModal(modalRules);
});

modalRulesCloseBtn.addEventListener('click', () => {
   closeModal(modalRules);
});

handleModalClose(modalRules);