<?php
require '../../src/dbconnect.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$statement = $pdo->prepare("SELECT * FROM medewerkers WHERE id = :id");
$statement->execute([':id' => $id]);

$medewerker = $statement->fetch(PDO::FETCH_ASSOC);
?>

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
            <a href="medewerkers.php">Medewerkers</a>
            <a href="../jongeren/jongeren.php">Jongeren</a>
            <a href="../activiteiten/activiteiten.php">Activiteiten</a>
            <a href="../instituten/instituten.php">Instituten</a>
            <a id="log" href="#">Inloggen / Uitloggen</a>
        </div>
    </nav>


    <h2><?php echo "Gegevens van " . $medewerker["firstName"] . " " . $medewerker["lastName"] . " bewerken" ?></h2>

    <form action="../../src/medewerkers/process.php?" method="post">
        <div class="input-group">

            <input type="hidden" name="id" value="<?php echo $id ?>">

            <div class="input-field">
                <label for="activityInput">Voornaam:</label>
                <input type="text" id="firstNameInput" name="firstName" value="<?php echo $medewerker["firstName"]; ?>" required>
            </div>

            <div class="input-field">
                <label for="lastNameInput">Achternaam:</label>
                <input type="text" id="lastNameInput" name="lastName" value="<?php echo $medewerker["lastName"]; ?>" required>
            </div>

            <div class="input-field">
                <label for="birthInput">Geboortedatum:</label>
                <input type="date" id="birthInput" name="birthDate" value="<?php echo $medewerker["birthDate"]; ?>" required>
            </div>

            <div class="input-field">
                <label for="roleInput">functie:</label>
                <input type="text" id="roleInput" name="role" value="<?php echo $medewerker["role"]; ?>" required>
            </div>

            <div class="input-field">
                <label for="inServiceInput">Ingang dienst:</label>
                <input type="date" id="inServiceInput" name="inService" value="<?php echo $medewerker["inService"]; ?>" required>
            </div>

            <button name="submit">Wijzig</button>
        </div>
    </form>

</body>

</html>