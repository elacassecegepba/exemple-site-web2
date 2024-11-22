<?php while ($message = $requeteMessages->fetch()) { ?>
  <div class="col-12">
    <p><?php out($message['texte']); ?></p>
  </div>
  <hr>
<?php } ?>