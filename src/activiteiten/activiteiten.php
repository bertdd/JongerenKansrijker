<?php

require_once __DIR__ . '/../dbconnect.php';

class Activiteit
{
    //Properties van activiteit object
    public $id;
    public $activity;
    public $date;
    public $time;
    
    private PDO $mypdo;
    
    static $tableName = "activiteiten";

    public function __construct(PDO $pdo)
    {
        $this->mypdo = $pdo;
    }

    //Functie om gegevens toe te voegen / wijzigen
    public function Save(): void
    {
        if($this->id > 0) {
            $statement = $this->mypdo->prepare("UPDATE " . self::$tableName . " SET activity = :activity, date = :date, time = :time WHERE id = :id");
            $statement->execute([':id' => $this->id, ':activity' => $this->activity, ':date' => $this->date, ':time' => $this->time]);
        } else {
            $statement = $this->mypdo->prepare("INSERT INTO " . self::$tableName . " (id, activity, date, time) VALUES (:id, :activity, :date, :time)");
            $statement->execute([':id' => $this->id, ':activity' => $this->activity, ':date' => $this->date, ':time' => $this->time]);
        }
    }
        
    //Functie om activiteit te verwijderen
    public function Delete(): void
    {
        $statement = $this->mypdo->prepare("DELETE FROM " . self::$tableName . " WHERE id = :id");
        $statement->execute([':id' => $this->id]);
    }

    //Functie om jongeren uit database op te halen en te sorteren op achternaam
    public static function GetActiviteiten(PDO $pdo): array
    {
        $statement = $pdo->prepare("SELECT * FROM " . self::$tableName . " ORDER BY date ASC, time ASC");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    //Functie om activiteiten weer te geven in tabel
    public static function DisplayActiviteiten(PDO $pdo) : string
    {
        $result = self::GetActiviteiten($pdo);

        $html = '';

        foreach ($result as $row)
        {
            $formattedDate = date('d-m-Y', strtotime($row["date"]));
            $formattedTime = date('H:i', strtotime($row["time"]));

            $html .= '<tr>';
            $html .= '<td>' . $row["activity"] . '</td>';
            $html .= '<td>' . $formattedDate . '</td>';
            $html .= '<td>' . $formattedTime . '</td>';
            $html .= '<td>';
            $html .= '<a href="edit.php?id=' . $row["id"] . '">Wijzigen</a> | ';
            $html .= '<a href="../../src/activiteiten/process.php?id=' . $row["id"] . '">Verwijderen</a>';
            $html .= '</td>';
            $html .= '</tr>';
        }
            
        return $html;
    }
}

?>
