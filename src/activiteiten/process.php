<?php

require_once 'activiteiten.php';

if (isset($_POST["submit"]) == "POST") {
    $activiteit = new Activiteit($pdo);

    if (isset($_POST['id'])) {
        $activiteit->id = intval($_POST['id']);
    }

    $activiteit->activity = $_POST['activity'];
    $activiteit->date = $_POST['date'];
    $activiteit->time = $_POST['time'];

    $activiteit->Save();
}else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $activiteit = new Activiteit($pdo);
    
    $activiteit->id = $id;

    $activiteit->Delete();
} 

header("Location: ../../pages/activiteiten/activiteiten.php");
exit();