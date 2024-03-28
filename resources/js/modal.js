/* RECUPERO ELEMENTI */

/* TUTTI I FORM  */
const deleteForm = document.querySelectorAll('.delete-form');
/* MODALE */
const model = document.getElementById('modal');
/* TITOLO */
const modalTitle = document.querySelector('.modal-title');
/* BODY */
const modalBody = document.querySelector('.modal-body');
/* BOTTONE DI CONFERMA */
const confirmationButton = document.getElementById('modal-confirmation-button');
/* VARIAVILE ACTIVEFORM */
let activeForm = null;

/* CICLO SUL SINGOLO FORM */
deleteForm.forEach(form => {
    /* EVENTO AL FORM */
    form.addEventListener('submit', event => {
        /* BLOCCO INVIO AUTOMATICO */
        event.preventDefault();


        /* RIASSEGNO ACTIVEFORM SOLO SE VIENE SCATENATO EVENTO FORM */
        activeForm = form;


        /* INSERISCO CONTENUTI */

        /* TESTO AL BOTTONE */
        confirmationButton.innerText = 'Elimina';
        /* COLORE BOTTONE */
        confirmationButton.className = 'btn btn-danger';
        /* TESTO TITOLO */
        modalTitle.innerText = 'Eliminazione';
        /* TESTO BODY */
        modalBody.innerText = 'Premendo ELIMINA, eliminerai definitivamente';

        
    })
});

/* EVENTO ALLA CONFERMA */
confirmationButton.addEventListener('click', () => {

    /* SE VIENE SCATENATO ACTIVEFORM EVENTO PROGRAMMABILE */
    if (activeForm) activeForm.submit();
});

