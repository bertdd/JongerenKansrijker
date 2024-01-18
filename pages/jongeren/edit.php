<?php
require_once '../../src/DbConnect.Class.php';
require_once '../../src/Jongere.Class.php';
require_once '../../src/Common.php';

$jongere = Jongere::Find($pdo, isset($_GET['id']) ? intval($_GET['id']) : 0);

?>
<!DOCTYPE html>
<html lang="en">

<?php title("Jongeren bewerken") ?>

<body>
  <?php navbar(); ?>

  <h2><?php echo "Gegevens van $jongere->firstname  $jongere->lastname bewerken" ?></h2>

  <form action="../../src/jongeren/process.php" method="post">
    <div class="input-group">

      <?php
      echo "<input type='hidden' name='id' value='$jongere->id'";

      inputField("text", "firstname", "Voornaam", $jongere->firstname);
      inputField("text", "lastname", "Achternaam", $jongere->lastname);
      inputField("date", "birthdate", "Geboortedatum", $jongere->birthdate);
      ?>

      <button name="submit">Opslaan</button>
    </div>
  </form>
</body>

</html>
