<div id="messageServeurFormulaireAjoutMessage"></div>

<form id="formulaireAjoutMessage" class="row g-3 align-items-center justify-content-center">
  <div class="col-8 col-md-6">
    <label class="visually-hidden" for="texte">Texte :</label>
    <input type="text" class="form-control" id="texte" name="texte" placeholder="Texte">
  </div>

  <div class="col-4 col-md-3 col-lg-2">
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </div>
</form>

<div id="placeholderFormulaireAjoutMessage" class="row g-3 align-items-center justify-content-center d-none">
  <div class="col-8 col-md-6 placeholder-glow">
    <span class="placeholder form-control">Texte</span>
  </div>

  <div class="col-4 col-md-3 col-lg-2 placeholder-glow">
    <a class="btn btn-primary disabled placeholder" aria-disabled="true">Envoyer</a>
  </div>
</div>