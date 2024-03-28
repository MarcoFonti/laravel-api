/* RECUPERO ELEMENTI */
const placeholder = 'https://marcolanci.it/boolean/assets/placeholder.png';
const urlImage = document.getElementById('image');
const preview = document.getElementById('preview');

/* VARIABILE BLOB */
let blobUrl;

/* EVENTO */
urlImage.addEventListener('input', () => {
    /* SRC DELL'IMMAGINE */
    if(urlImage.files && urlImage.files[0]){

        /* CREO IN MODO TEMPORANIO UN BLOB */
        blobUrl = URL.createObjectURL(urlImage.files[0]);
        /* INSERISCO IL BLOB  */
        preview.src = blobUrl;
    }else {

        /* SE NON CE UN FILE METTI */
        preview.src = placeholder;
    }
});

/* EVENTO PRIMA DI LASCIARE LA PAGINA */
window.addEventListener('beforeunload', () => {
    /* SE CE UN BLOB RIMUOVILO */
    if(blobUrl){
        URL.revokeObjectURL(blobUrl);
    }
});
