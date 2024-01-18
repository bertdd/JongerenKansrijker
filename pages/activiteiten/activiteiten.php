<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/jongeren.css">
  <link rel="stylesheet" href="../../assets/css/nav.css">
  <title>Jongeren</title>
</head>

<body>

  <nav>
    <div class="logo">
      <a href="#">Jongeren Kansrijker</a>
    </div>
    <div class="menu">
      <a href="../medewerkers/medewerkers.php">Medewerkers</a>
      <a href="../jongeren/jongeren.php">Jongeren</a>
      <a href="activiteiten.php">Activiteiten</a>
      <a href="../instituten/instituten.php">Instituten</a>
      <a id="log" href="#">Inloggen / Uitloggen</a>
    </div>
  </nav>

  <h2>Jongeren</h2>

  <form action="../../src/activiteiten/process.php" method="post">
    <div class="input-group">
      <div class="input-field">
        <label for="activityInput">Activiteit:</label>
        <input type="text" id="activityInput" name="activity" required>
      </div>

      <div class="input-field">
        <label for="dateInput">Datum:</label>
        <input type="date" id="dateInput" name="date" required>
      </div>

      <div class="input-field">
        <label for="timeInput">Tijd:</label>
        <input type="time" id="timeInput" name="time" required>
      </div>

      <button name="submit">Toevoegen</button>
    </div>
  </form>

  <table id="activityTable">
    <thead>
      <tr>
        <th>Activiteit</th>
        <th>Date</th>
        <th>Time</th>
        <th>Actie</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once '../../src/activiteiten/activiteiten.php';
      echo Activiteit::DisplayActiviteiten($pdo)
      ?>
    </tbody>
  </table>

</body>

</html>