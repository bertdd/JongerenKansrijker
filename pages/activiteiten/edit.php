<?php
require '../../src/dbconnect.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$statement = $pdo->prepare("SELECT * FROM activiteiten WHERE id = :id" );
$statement->execute([':id' => $id]);

$activiteit = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/jongeren.css">
    <link rel="stylesheet" href="../../assets/css/nav.css">
    <title>Activiteiten bewerken</title>
</head>

<body>

    <nav>
        <div class="logo">
            <a href="#">Jongeren Kansrijker</a>
        </div>
        <div class="menu">
            <a href="../medewerkers/medewerkers.php">Medewerkers</a>
            <a href="../jongeren.php">Jongeren</a>
            <a href="activiteiten.php">Activiteiten</a>
            <a href="../instituten/instituten.php">Instituten</a>
            <a id="log" href="#">Inloggen / Uitloggen</a>
        </div>
    </nav>

    <h2><?php echo "Activiteit " . $activiteit["activity"] . " bewerken" ?></h2>

    <form action="../../src/activiteiten/process.php" method="post">
        <div class="input-group">
            
            <input type="hidden" name="id" value="<?php echo $id ?>">
            
            <div class="input-field">
                <label for="activityInput">Activiteit:</label>
                <input type="text" id="activityInput" name="activity" value="<?php echo $activiteit["activity"] ?>" required>
            </div>

            <div class="input-field">
                <label for="dateInput">Datum:</label>
                <input type="date" id="dateInput" name="date" value="<?php echo $activiteit["date"] ?>" required>
            </div>

            <div class="input-field">
                <label for="timeInput">Tijd:</label>
                <input type="time" id="timeInput" name="time" value="<?php echo $activiteit["time"] ?>" required>
            </div>

            <button name="submit">Wijzig</button>
        </div>
    </form>

</body>

</html>