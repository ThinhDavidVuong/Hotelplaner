<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class PropertyRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'property';

    /**
     * Diese Funktion gibt ein array mit allen Datensätzen aus der Tabelle
     * zurück.
     *
     * @param $max Wie viele Datensätze höchstens zurückgegeben werden sollen
     *               (optional. standard 100)
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return Ein array mit den gefundenen Datensätzen.
     */
    public function readAllByHotelID($hotel_id, $max = 100)
    {
        $query = "SELECT * FROM {$this->tableName} JOIN hotel_has_properties AS hhp ON hhp.property_id = {$this->tableName}.id WHERE hhp.hotel_id = ? LIMIT 0, $max";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $hotel_id);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
    }

}
