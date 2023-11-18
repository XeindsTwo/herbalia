import './bootstrap';

const helpBtn = document.getElementById('helpBtn');
const headerNav = document.querySelector('.header__nav');

helpBtn.addEventListener('click', () => {
    helpBtn.classList.toggle('active');
    helpBtn.blur();
    headerNav.classList.toggle('active');
});

document.addEventListener('click', (event) => {
    const isClickInsideNav = headerNav.contains(event.target);
    const isClickOnHelpBtn = helpBtn.contains(event.target);

    if (!isClickInsideNav && !isClickOnHelpBtn) {
        helpBtn.classList.remove('active');
        headerNav.classList.remove('active');
    }
});