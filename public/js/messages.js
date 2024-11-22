// Ajoute un écouteur d'événement qui exécute la fonction 'initialiser' lorsque le DOM est entièrement chargé
document.addEventListener('DOMContentLoaded', initialiser);

let idTimeout;
let derniereListeDeMessages;

// Fonction d'initialisation
function initialiser() {
  // Ajoute un écouteur d'événement au formulaire pour gérer la soumission
  document.querySelector("#formulaireAjoutMessage").addEventListener("submit", gererSoumissionFormulaireAjoutMessage)
  // Synchronise les messages avec le serveur dès le début
  synchroniserMessagesAvecServeur();
}

// Fonction pour gérer la soumission du formulaire de message
async function gererSoumissionFormulaireAjoutMessage(event) {
  const formulaire = event.currentTarget; // Référence au formulaire soumis
  const conteneurMessageServeur = document.querySelector("#messageServeurFormulaireAjoutMessage");
  const placeHolderFormulaire = document.querySelector("#placeholderFormulaireAjoutMessage");

  event.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire
  event.stopPropagation(); // Empêche la propagation de l'événement dans le DOM

  // Vérifie la validité du formulaire
  if (!formulaire.checkValidity()) {
    return; // Si le formulaire n'est pas valide, arrête l'exécution de la fonction
  }

  conteneurMessageServeur.innerHTML = ""; // Réinitialise le conteneur des messages serveur
  const formData = new FormData(formulaire); // Crée un nouvel objet FormData à partir du formulaire

  formulaire.classList.toggle('d-none');
  placeHolderFormulaire.classList.toggle('d-none');

  try {
    // Envoie les données du formulaire au serveur
    const reponse = await fetch('index.php?ressource=/messages&methode=POST', {
      method: "POST",
      body: formData,
    });

    const donneesReponse = await reponse.text(); // Lit la réponse du serveur

    // Vérifie si la réponse est correcte
    if (!reponse.ok) {
      throw new Error(`${reponse.status} : ${donneesReponse}`); // Lance une erreur si la réponse n'est pas correcte
    }

    formulaire.reset(); // Réinitialise le formulaire
    synchroniserMessagesAvecServeur(); // Synchronise à nouveau les messages avec le serveur

  } catch (erreur) {
    console.error('Erreur :', erreur); // Affiche l'erreur dans la console
    // Affiche un message d'erreur dans l'interface utilisateur
    conteneurMessageServeur.innerHTML = `
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${erreur.message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;
  } finally {
    formulaire.classList.toggle('d-none');
    placeHolderFormulaire.classList.toggle('d-none');
  }
}

// Fonction pour synchroniser les messages avec le serveur
async function synchroniserMessagesAvecServeur() {
  // Par souci de simplicité, on récupère tous les messages du serveur.
  // Si on souhaitait une solution plus optimale, on utiliserait un système de pagination pour demander seulement les messages manquants.
  
  clearTimeout(idTimeout); // Annule timeout en cours

  try {
    // Envoie une requête pour obtenir les messages du serveur
    const reponse = await fetch('index.php?ressource=/messages&methode=GET', {
      method: "POST",
    });

    const donneesReponse = await reponse.text(); // Lit la réponse du serveur

    // Vérifie si la réponse est correcte
    if (!reponse.ok) {
      throw new Error(`${reponse.status} : ${donneesReponse}`); // Lance une erreur si la réponse n'est pas correcte
    }

    // Met à jour le contenu seulement si la liste de messages a changé
    if (derniereListeDeMessages != donneesReponse) {
      const conteneurMessages = document.querySelector("#messages");
      conteneurMessages.innerHTML = donneesReponse; // Affiche les messages récupérés dans le conteneur
      derniereListeDeMessages = donneesReponse; // Met à jour la variable avec la nouvelle liste de messages
    }

  } catch (erreur) {
    console.error('Erreur :', erreur); // Affiche l'erreur dans la console
  }

  // Relance la synchronisation des messages avec le serveur après 1 seconde
  idTimeout = setTimeout(() => {
    synchroniserMessagesAvecServeur();
  }, 1000);
}
