<?php
require_once '../../src/Jongere.Class.php';
require_once '../../src/Common.php';
?>
<!DOCTYPE html>
<html lang="en">

<?php title("Jongeren") ?>

<body>

  <?php navbar() ?>

  <h2>Jongeren</h2>

  <form action="../../src/jongeren/process.php" method="post">
    <div class="input-group">
      <?php
      inputField("text", "firstname", "Voornaam", "");
      inputField("text", "lastname", "Achternaam", "");
      inputField("date", "birthdate", "Geboortedatum", "");
      ?>
      <button name="submit">Toevoegen</button>
    </div>
  </form>

  <table id="jongerenTable">
    <thead>
      <tr>
        <th>id</th>
        <th>Achternaam</th>
        <th>Voornaam</th>
        <th>Geboortedatum</th>
        <th>Actie</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = Jongere::GetJongeren($pdo);

      foreach ($result as $row) {
        echo "<tr>";
        echo "<td>$row->id</td>";
        echo "<td>$row->lastname</td>";
        echo "<td>$row->firstname</td>";
        $birthDate = DateTime::createFromFormat('Y-m-d H:i:s', $row->birthdate)->format('Y-m-d');
        echo "<td>$birthDate</td>";
        echo "<td>";
        echo "<a href='edit.php?id=$row->id'>Wijzigen</a>";
        echo " | ";
        echo "<a href='../../src/jongeren/process.php?id=$row->id'>Verwijderen</a>";
        echo "</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</body>

</html>