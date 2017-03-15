<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class Reservation_has_MealsRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'reservation_has_meals';

    public function insert($reservation_id, $meal_id) {

        $query = "INSERT INTO {$this->tableName} (reservation_id, meal_id)
        VALUES (?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $reservation_id, $meal_id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    /**
     * Diese Funktion löscht den Datensatz mit der gegebenen reservation_id.
     *
     * @param $id id des zu löschenden Datensatzes
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function deleteById($reservation_id)
    {
        $query = "DELETE FROM {$this->tableName} WHERE reservation_id=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $reservation_id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

}
