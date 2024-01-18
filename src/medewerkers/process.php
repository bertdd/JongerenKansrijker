<?php

require_once '../Medewerker.class.php';

if (isset($_POST["submit"]) == "POST")
{
  Medewerker::Save($pdo, $_POST);
}
else
{
  if (isset($_GET['id']))
  {
    Medewerker::Delete($pdo, $_GET['id']);
  }
}

header("Location: ../../pages/medewerkers/medewerkers.php");
exit();
