<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class SexRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'sex';

    public function getIdByName($sex)
    {

        $query = "SELECT id FROM {$this->tableName} WHERE sex=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $sex);

        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
          throw new Exception($statement->error);
        }

        //return $resault->fetch_array();
        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;
    }
}
