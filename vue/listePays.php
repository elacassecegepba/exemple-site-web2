<ul class="navbar-nav text-primary">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <?php if(isset($pays)) {
        echo $pays['nom'];
      } else {
        echo 'Pays';
      } ?>
    </a>
    <ul class="dropdown-menu overflow-y-auto" style="max-height: 12rem;">
      <?php while ($paysCourant = $requetePays->fetch()) { ?>
        <li>
          <a
            class="dropdown-item <?php paysActif($paysCourant["code"]); ?>"
            href="index.php?ressource=/pays/{code_pays}/provinces&code_pays=<?php echo $paysCourant["code"]; ?>">
            <?php echo $paysCourant["nom"]; ?>
          </a>
        </li>
      <?php } ?>
    </ul>
  </li>
</ul>

<?php 
function paysActif($code_pays) {
  if (isset($_GET["code_pays"]) && $code_pays === $_GET["code_pays"]) {
    echo "active";
  }
}
?>