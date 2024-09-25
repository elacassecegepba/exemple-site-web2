<!doctype html>
<html lang="fr">

<head>
  <title><?php echo $titreOnglet ?></title>
  <meta charset="utf-8">
  <!-- Pour cellulaire -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Favicon -->
  <link rel="icon" href="public/image/logo-64x64.png" type="image/jpg">
  <!-- CSS Maison (on en fait seulement si Bootstrap ne le permet pas) -->
  <link href="public/style/index.css" rel="stylesheet">
</head>

<body class="d-flex flex-column vh-100 bg-light bg-gradient">
  <header class="bg-dark"><?php require_once 'vue/menu.php'; ?></header>
  <main class="container pt-2 flex-fill"><?php echo $contenu ?></main>
  <footer><?php require_once 'vue/pied.php'; ?></footer>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <!-- Activation de la validation Bootstrap des formualires -->
  <script src="public/js/formValidation.js"></script>
  <!-- Activation des popover de Bootstrap -->
  <script src="public/js/enablePopover.js"></script>
</body>

</html>