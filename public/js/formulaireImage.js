function initialiser() {
  document.getElementById('nonSecuritaire')
    .addEventListener('change', gererChangementCheckboxNonSecuritaire);
}

async function gererChangementCheckboxNonSecuritaire(event) {
  const checkbox = event.currentTarget;
  /** @type {HTMLInputElement} */
  const inputTitre = document.querySelector('#titre');
  const inputImage = document.querySelector('#image');

  if (checkbox.checked) {
    inputTitre.removeAttribute('maxLength');
    inputTitre.removeAttribute('minLength');
    inputTitre.removeAttribute('required');

    inputImage.removeAttribute('accept');
    inputImage.removeAttribute('required');
  } else {
    inputTitre.maxLength = 255;
    inputTitre.minLength = 3;
    inputTitre.required = true;

    inputImage.accept = "image/png, image/jpeg";
    inputImage.required = true;
  }
}

document.addEventListener('DOMContentLoaded', initialiser);