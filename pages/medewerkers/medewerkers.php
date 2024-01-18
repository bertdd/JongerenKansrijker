<?php
require_once '../../src/medewerker.Class.php';
require_once '../../src/Common.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php title("Medewerkers") ?>

<body>

  <?php navbar(); ?>

  <h2>Medewerkers</h2>

  <form action="../../src/medewerkers/process.php" method="post">
    <div class="input-group">
      <?php
        inputField("text", "firstname", "Voornaam", null);
        inputField("text", "lastname", "Achternaam", null);
        inputField("date", "birthdate", "Geboortedatum", null);
        inputField("text", "role", "Functie", null);
        inputField("date", "inservice", "Datum in dienst", null);
      ?>

      <button name="submit">Toevoegen</button>
    </div>
  </form>

  <table id="medewerkersTable">
    <thead>
      <tr>
        <th id="smallHeader">id</th>
        <th>Achternaam</th>
        <th>Voornaam</th>
        <th>Geboortedatum</th>
        <th>Functie</th>
        <th>In dienst sinds</th>
        <th>Actie</th>
      </tr>
    </thead>
    <tbody>
      <?php echo Medewerker::DisplayMedewerkers($pdo) ?>
    </tbody>
  </table>

</body>

</html>
