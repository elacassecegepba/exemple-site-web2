let heures = 0;
let minutes = 0;
let secondes = 0;
let millisecondes = 0;
let interval;

const elements = {};

function initialiser() {
  elements['boutons'] = {
    'demarrer': document.getElementById('demarrer'),
    'arreter': document.getElementById('arreter'),
    'reinitialiser': document.getElementById('reinitialiser')
  };
  elements['chronometre'] = document.getElementById('chronometre');

  elements['boutons']['demarrer'].addEventListener('click', demarrerChronometre);
  elements['boutons']['arreter'].addEventListener('click', arreterChronometre);
  elements['boutons']['reinitialiser'].addEventListener('click', reinitialiserChronometre);
}

function demarrerChronometre() {
  interval = setInterval(() => {
    millisecondes += 100;
    if (millisecondes === 1000) {
      millisecondes = 0;
      secondes++;
    }
    if (secondes === 60) {
      secondes = 0;
      minutes++;
    }
    if (minutes === 60) {
      minutes = 0;
      heures++;
    }
    afficherChronometre();
  }, 100);

  elements['boutons']['demarrer'].disabled = true;
  elements['boutons']['arreter'].disabled = false;
}

function arreterChronometre() {
  clearInterval(interval);
  elements['boutons']['demarrer'].disabled = false;
  elements['boutons']['arreter'].disabled = true;
}

function reinitialiserChronometre() {
  arreterChronometre();
  heures = 0;
  minutes = 0;
  secondes = 0;
  millisecondes = 0;
  afficherChronometre();
}

function afficherChronometre() {
  const format = (nombre, taille = 2) => nombre.toString().padStart(taille, '0');
  // Notez qu'utiliser textContent au lieu d'innerHTML serait plus approprié
  elements['chronometre'].innerHTML =
    `${format(heures)}:${format(minutes)}:${format(secondes)}.${format(millisecondes / 100, 1)}`;
}

document.addEventListener('DOMContentLoaded', initialiser);