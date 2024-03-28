/* RECUPERO ELEMENTI */
const placeholder = 'https://marcolanci.it/boolean/assets/placeholder.png';
const urlImage = document.getElementById('image');
const changeButton = document.getElementById('button-change');
const containerButton = document.getElementById('container-change-image');
const preview = document.getElementById('preview');

/* EVENTO AL BOTTONE CAMBIA FILE */
changeButton.addEventListener('click', () =>{
    /* CONTENITORE BOTTONE IN D-NONE */
    containerButton.classList.add('d-none');
    /* INPUT FILE RIMUOVO IL D-NONE */
    urlImage.classList.remove('d-none');
    /* FACCIO VEDERE IL PLACEHOLDER */
    preview.src = placeholder;
    /* CLICK PROGRAMMABILE */
    urlImage.click();
});