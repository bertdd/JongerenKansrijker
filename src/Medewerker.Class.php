<?php

require_once 'Person.Class.php';
require_once 'DbConnect.Class.php';

/**
 * Medewerker object
 */
class Medewerker extends Person
{
  public string $role;
  public DateTime $inservice;

  /**
   * The table name for this object
   * @var string
   */
  static string $tableName = "medewerkers";

  public function __construct(PDO $pdo, ?array $data)
  {
    $this->mypdo = $pdo;
    if ($data != null) {
      $this->id = isset($data['id']) ? intval($data['id']) : 0;
      $this->firstname = $data['firstname'];
      $this->lastname = $data['lastname'];
      $this->birthdate = DateTime::createFromFormat("Y-m-d", $data['birthdate']);
      $this->role = $data['role'];
      $this->inservice = DateTime::createFromFormat("Y-m-d", $data['inservice']);
    }
  }

  //Functie om gegevens toe te voegen / wijzigen
  /*
  public function Save(): void
  {
    if ($this->id > 0) {
      $statement = $this->mypdo->prepare("UPDATE " . self::$tableName . " SET firstName = :firstName, lastName = :lastName, birthDate = :birthDate , role = :role, inService = :inService WHERE id = :id");
      $statement->execute([':id' => $this->id, ':firstName' => $this->firstname, ':lastName' => $this->lastname, ':birthDate' => $this->birthdate, ':role' => $this->role, ':inService' => $this->inservice]);
    } else {
      $statement = $this->mypdo->prepare("INSERT INTO " . self::$tableName . " (id, firstName, lastName, birthDate, role, inService) VALUES (:id, :firstName, :lastName, :birthDate, :role, :inService)");
      $statement->execute([':id' => $this->id, ':firstName' => $this->firstname, ':lastName' => $this->lastname, ':birthDate' => $this->birthdate, ':role' => $this->role, ':inService' => $this->inservice]);
    }
  }
  */

  /**
   * Functie om gegevens toe te voegen / wijzigen
   * @return void
   */
  public static function Save(PDO $pdo, array $data): void
  {
    $medewerker = new Medewerker($pdo, $_POST);

    $sql = $medewerker->id > 0 ?
      "UPDATE " . self::$tableName . " SET firstName = :firstName, lastName = :lastName, birthDate = :birthDate WHERE id = :id" :
      "INSERT INTO " . self::$tableName . " (id, firstName, lastName, birthDate) VALUES (:id, :firstName, :lastName, :birthDate)";

    $statement = $pdo->prepare($sql);
    $statement->execute([
      ':id' => $medewerker->id,
      ':firstName' => $medewerker->firstname,
      ':lastName' => $medewerker->lastname,
      ':birthDate' => $medewerker->birthdate->format('Y-m-d')
    ]);
  }

  //Functie om medewerker te verwijderen
  public function Delete(): void
  {
    $statement = $this->mypdo->prepare("DELETE FROM " . self::$tableName . " WHERE id = :id");
    $statement->execute([':id' => $this->id]);
  }

  //Functie om medewerkers uit database op te halen en te sorteren op achternaam
  public static function getMedewerkers(PDO $pdo): array
  {
    return self::GetPersons($pdo, self::$tableName);
  }


  //Functie om medewerkers weer te geven in tabel
  public static function DisplayMedewerkers(PDO $pdo): string
  {
    $result = self::getMedewerkers($pdo);

    $html = '';

    foreach ($result as $row) {
      $formattedBirthDate = date('d-m-Y', strtotime($row["birthDate"]));
      $formattedInServiceDate = date('d-m-Y', strtotime($row["inService"]));

      $html .= '<tr>';
      $html .= '<td>' . $row["id"] . '</td>';
      $html .= '<td>' . $row["lastName"] . '</td>';
      $html .= '<td>' . $row["firstName"] . '</td>';
      $html .= '<td>' . $formattedBirthDate . '</td>';
      $html .= '<td>' . $row["role"] . '</td>';
      $html .= '<td>' . $formattedInServiceDate . '</td>';
      $html .= '<td>';
      $html .= '<a href="edit.php?id=' . $row["id"] . '">Wijzigen</a> | ';
      $html .= '<a href="../../src/medewerkers/process.php?id=' . $row["id"] . '">Verwijderen</a>';
      $html .= '</td>';
      $html .= '</tr>';
    }

    return $html;
  }
}

?>