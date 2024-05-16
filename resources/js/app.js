import './bootstrap';

document.addEventListener('alpine:init', () => {

    Alpine.directive('uppercase', (el, { expression }, { evaluate }) => {
        el.textContent = el.textContent.toUpperCase()
    })
});
