/* RECUPERO ELEMENTI */
const titleField = document.getElementById('title');
const slugField = document.getElementById('slug');

titleField.addEventListener('blur', () => {
    /* SLUG TITTOLO */
    slugField.value = titleField.value.trim().toLowerCase().split(' ').join('-');
})