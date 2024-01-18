<?php

/**
 * Person short summary.
 *
 * Person description.
 *
 * @version 1.0
 * @author Bert
 */
class Person
{
  /**
   * Identifier
   * @var int
   */
  public int $id;

  /**
   * First Name
   * @var string
   */
  public string $firstname;

  /**
   * Last Name
   * @var string
   */
  public string $lastname;

  /**
   * Date of birth
   * @var DateTime
   */
  public DateTime $birthdate;

  /**
   * Database connection
   * @var PDO
   */
  protected PDO $mypdo;

  /**
   * Functie om personen uit database op te halen en te sorteren op achternaam
   * @param PDO $pdo
   * @param string $table
   * @return array
   */
  public static function GetPersons(PDO $pdo, string $table): array
  {
    $sql = "SELECT * FROM $table ORDER BY lastName";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_OBJ);
  }
}