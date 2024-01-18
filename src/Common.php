<?php

/**
 * function to create an input field on a form
 * @param string $type The type of the field ("text" or "date")
 * @param string $field the column name for the field
 * @param string $label a descriptive label ffor the field
 * @param string|null $data existing data for the file, or null for a new record.
 * @return void
 */
function inputField(string $type, string $field, string $label, ?string $data): void
{
  if ($type == "date" && $data != null) {
    $data = DateTime::createFromFormat('Y-m-d H:i:s', $data)->format('Y-m-d');
  }
  $id = $field . "Input";
  echo "<div class='input-field'>";
  echo "<label for='$id'>$label:</label>";
  echo "<input type='$type' id='$id' name='$field' value='$data' required>";
  echo "</div>";
}

function title(string $title) : void
{
  echo "<head>";
  echo   "<meta charset='UTF-8'>";
  echo   "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
  echo   "<link rel='stylesheet' href='../../assets/css/page.css'>";
  echo   "<link rel='stylesheet' href='../../assets/css/nav.css'>";
  echo   "<title>$title</title>";
  echo "</head>";
}

function navbar() : void
{
   echo "<nav>";
   echo   "<div class='logo'>";
   echo     "<a href='#'>Jongeren Kansrijker</a>";
   echo   "</div>";
   echo   "<div class='menu'>";
   echo     "<a href='../medewerkers/medewerkers.php'>Medewerkers</a>";
   echo     "<a href='../jongeren/jongeren.php'>Jongeren</a>";
   echo     "<a href='../activiteiten/activiteiten.php'>Activiteiten</a>";
   echo     "<a href='../instituten/instituten.php'>Instituten</a>";
   echo     "<a id='log' href='#'>Inloggen / Uitloggen</a>";
   echo   "</div>";
   echo "</nav>";
}
?>
