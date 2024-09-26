<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Province</th>
      <th scope="col" class="d-none d-md-table-cell">Population</th>
      <th scope="col" class="d-none d-md-table-cell">Superficie</th>
      <th scope="col" class="d-none d-sm-table-cell">Capitale</th>
      <th scope="col">Pays</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($province = $requeteProvinces->fetch()) { ?>
      <tr>
        <td><?php echo $province["nom"]; ?></td>
        <td class="d-none d-md-table-cell"><?php echo $province["population"]; ?></td>
        <td class="d-none d-md-table-cell"><?php echo $province["superficie"]; ?></td>
        <td class="d-none d-sm-table-cell"><?php echo $province["capitale_nom"]; ?></td>
        <td><?php echo $province["pays_nom"]; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>