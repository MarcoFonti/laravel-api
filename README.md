Esercizio di oggi:
Laravel Boolfolio - API

Ciao ragazzi,
- continuiamo a lavorare sul codice dei giorni scorsi, ma in una nuova repo.
- L’esercizio di oggi è suddiviso in milestone ed è importante che ne seguiate l’ordine.

Milestone 1
- nome repo 1: laravel-api
- Aggiungiamo al nostro progetto Laravel una nuovo Api/ProjectController.
- Questo controller risponderà a delle richieste via API e si occuperà di restituire la lista dei progetti presenti nel database in formato json.

Milestone 2
- Testiamo la chiamata API tramite Postman e assicuriamoci di ricevere i dati correttamente.

Milestone 3
- nome repo 2: vite-boolfolio
- Iniziamo ad occuparci della parte front-office della nostra applicazione: creiamo un nuovo progetto Vue 3 con Vite e installiamo axios.
- Colleghiamo questo progetto ad una repo separata.

Milestone 4
- Nel componente principale della nostra Vue App facciamo una chiamata API all’endpoint costruito nel progetto Laravel (milestone 1) e recuperiamo tutti i progetti dal nostro back-end.
- Stampiamo in console i risultati e verifichiamo di ricevere i dati correttamente.

Milestone 5
- Creiamo un nuovo componente ProjectCard, che corrisponde ad una card per visualizzare un progetto. 
- Utilizziamo questo componente per visualizzare tutti i progetti ricevuti tramite API.

Bonus:
- Gestire la paginazione dei risultati

---

Ciao ragazzi,

Esercizio di oggi: Laravel Boolfolio - API
- Nome repo: vite-boolfolio e laravel-api

continuiamo a lavorare sul codice dei giorni scorsi, aggiungendo le seguenti funzionalità:

Milestone 1
- repo: laravel-api
- Creiamo una rotta per avere il dettaglio del progetto

Milestone 2
- Testiamo la chiamata API tramite Postman e assicuriamoci di - - ricevere i dati correttamente.

Milestone 3
- repo : vite-boolfolio
- Installiamo vue-router (npm i vue-router@4) e creiamo un file per il router che conterrà le nostre rotte

Milestone 4
- repo : vite-boolfolio
- Creiamo dei componenti che facciano da pagine per l'applicazione Vue, tra cui la home che conterrà la lista dei progetti e la pagina di dettaglio di un singolo progetto

Bonus:
- Gestire una pagina 404
- Gestire dinamicamente la classe active

---

Esercizio di Oggi: Laravel Mail
- repo: le stesse di ieri
- Lavorate sul vostro progetto personale e implementate l'invio di una mail.
- Ricordate di fare un account su Mailtrap.io  e configurare il vostro .env

DESCRIZIONE:
- Creiamo un form di contatto sulla repo Vue
- Prepariamo un' API per ricevere i dati dal form
- Coi dati provenienti dal form, inviare una mail all'amministratore del sito (voi stessi)
- Validazione, Alert, Loader ecc. sono tutti considerati BONUS.
- Portate dunque a casa il risultato base ed espandete a vostro piacimento!