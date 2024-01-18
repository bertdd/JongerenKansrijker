<?php

require_once '../Jongere.class.php';

if (isset($_POST["submit"]) == "POST")
{
  Jongere::Save($pdo, $_POST);
}
else 
{
  if (isset($_GET['id']))
  {
    Jongere::Delete($pdo, $_GET['id']);
  }
}

header("Location: ../../pages/jongeren/jongeren.php");
exit();
