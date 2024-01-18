<?php

require_once 'DbConnect.Class.php';
require_once 'Person.Class.php';

class Jongere extends Person
{
  /**
   * The table name for this object
   * @var string
   */
  static string $tableName = "jongeren";

  /**
   * Contructor, inject pdo and data
   * @param PDO $pdo
   * @param array|null $data
   */
  public function __construct(PDO $pdo, ?array $data)
  {
    $this->mypdo = $pdo;
    if ($data != null)
    {
      $this->id = isset($data['id']) ? intval($data['id']) : 0;
      $this->firstname = $data['firstname'];
      $this->lastname = $data['lastname'];
      $this->birthdate = DateTime::createFromFormat("Y-m-d", $data['birthdate']);
    }
  }

  /**
   * Functie om gegevens toe te voegen / wijzigen
   * @return void
   */
  public static function Save(PDO $pdo, array $data) : void
  {
    $jongere = new Jongere($pdo, $_POST);

    $sql = $jongere->id > 0 ?
      "UPDATE " . self::$tableName . " SET firstName = :firstName, lastName = :lastName, birthDate = :birthDate WHERE id = :id" :
      "INSERT INTO " . self::$tableName . " (id, firstName, lastName, birthDate) VALUES (:id, :firstName, :lastName, :birthDate)";

    $statement = $pdo->prepare($sql);
    $statement->execute([
                           ':id' => $jongere->id,
                           ':firstName' => $jongere->firstname,
                           ':lastName' => $jongere->lastname,
                           ':birthDate' => $jongere->birthdate->format('Y-m-d')
                        ]);
  }

  /**
   * Functie om jongere te verwijderen
   * @return void
   */
  public static function Delete(PDO $pdo, int $id) : void
  {
    $sql = "DELETE FROM " . self::$tableName . " WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([':id' => $id]);
  }

  /**
   * Functie om jongeren uit database op te halen en te sorteren op achternaam
   * @param PDO $pdo
   * @return array
   */
  public static function GetJongeren(PDO $pdo) : array
  {
    return self::GetPersons($pdo, self::$tableName);
  }

  public static function Find(PDO $pdo, int $id)
  {
    $sql = "SELECT * FROM " . self::$tableName . " WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([':id' => $id]);
    return $statement->fetch(PDO::FETCH_OBJ);
  }
}

?>
