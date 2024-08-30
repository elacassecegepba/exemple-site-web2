document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('motDePasse')
    .addEventListener('input', afficherValidationMotDePasse);
});

function afficherValidationMotDePasse(event) {
  const validation = {
    "auMoins8Caractere": /.{8,}/,
    "auMoinsUneLettreMajuscule": /(?=.*[A-Z])/,
    "auMoinsUneLettreMinuscule": /(?=.*[a-z])/,
    "auMoinsUnChiffre": /(?=.*\d)/,
    "auMoinsUnCaractereSpecial": /(?=.*\W)/u,
  };

  const motDePasse = event.target.value;

  for (const id in validation) {
    const regex = validation[id];
    if (!regex.test(motDePasse)) {
      document.getElementById(id).classList.remove('text-success');
      document.getElementById(id).classList.add('text-danger');
    } else {
      document.getElementById(id).classList.remove('text-danger');
      document.getElementById(id).classList.add('text-success');
    }
  }
}