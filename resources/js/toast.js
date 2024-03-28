/* RECUPERO ELEMENTO */
const toast = document.getElementById('liveToast');

/* SE ESISTE ELEMENTO DOPO TOT SECONDI SPARISCE */
if(toast) {
    setTimeout(() => {
        toast.classList.remove('show');
    }, 4000);
}