function initialiser() {
  document.getElementById('btnAutresMessages')
    .addEventListener('click', obtenirAutresMessages);
  document.getElementById('btnErreur')
    .addEventListener('click', erreurAjax);
}

async function obtenirAutresMessages(event) {
  const btn = event.currentTarget;
  const plusIcon = btn.querySelector('.fa-plus');
  const spinner = btn.querySelector('.spinner-border');

  // Désactive le bouton et affiche le spinner
  btn.disabled = true;
  plusIcon.classList.add('d-none');
  spinner.classList.remove('d-none');

  const formData = new FormData();
  formData.append('nbMessages', 5);

  try {
    const reponse = await fetch('index.php?ressource=/autres-messages&methode=GET', {
      method: 'POST',
      body: formData
    });

    // Récupération de la réponse du serveur sous forme de texte
    const donnees = await reponse.text();

    // Vérifie si le serveur indique que la requête a été effectuée avec succès (200-299)
    if (!reponse.ok) {
      throw new Error(`${reponse.status} : ${donnees}`);
    }

    // Ajoute les nouveaux messages à l'élément #messages
    document.querySelector("#messages").innerHTML += donnees;

  } catch (erreur) {
    // Affiche l'erreur
    console.error('Erreur :', erreur);
    const erreurElement = document.querySelector("#erreur");
    erreurElement.classList.remove('d-none');
    erreurElement.innerHTML = `
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${erreur.message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;
  }

  // Réactive le bouton et masque le spinner
  btn.disabled = false;
  plusIcon.classList.remove('d-none');
  spinner.classList.add('d-none');
}

async function erreurAjax(event) {

  try {
    const reponse = await fetch('index.php?ressource=/autres-messages&methode=GET', {
      method: 'POST'
    });

    // Récupération de la réponse du serveur sous forme de texte
    const donnees = await reponse.text();

    // Vérifie si le serveur indique que la requête a été effectuée avec succès (200-299)
    if (!reponse.ok) {
      throw new Error(`${reponse.status} : ${donnees}`);
    }

    // Ajoute les nouveaux messages à l'élément #messages
    document.querySelector("#messages").innerHTML += donnees;

  } catch (erreur) {
    // Affiche l'erreur
    console.error('Erreur :', erreur);
    const erreurElement = document.querySelector("#erreur");
    erreurElement.classList.remove('d-none');
    erreurElement.innerHTML = `
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${erreur.message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;
  }
}

document.addEventListener('DOMContentLoaded', initialiser);