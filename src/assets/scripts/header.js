// Nav toggle
const nav = document.querySelector('.js-nav');
const navOpenedClass = 'header__nav--opened';
const hamburger = document.querySelector('.js-nav-toggle');
const hamburgerOpenedClass = 'header__hamburger--opened';

hamburger.addEventListener('click', () => {
  nav.classList.toggle(navOpenedClass);
  hamburger.classList.toggle(hamburgerOpenedClass);
})
