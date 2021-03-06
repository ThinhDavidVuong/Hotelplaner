<?php

require_once '../lib/Repository.php';
require_once 'PropertyRepository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class HotelRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'hotel';

    /**
     * Diese Funktion gibt ein array mit allen Datensätzen aus der Tabelle
     * zurück, inklusive dazugehöriger Properties aus der Propertie-Tabelle.
     *
     * @param $max Wie viele Datensätze höchstens zurückgegeben werden sollen
     *               (optional. standard 100)
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return Ein array mit den gefundenen Datensätzen.
     */
    public function readAllWithProperties($max = 100)
    {
        $query = "SELECT * FROM {$this->tableName} LIMIT 0, $max";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        $propertyRepo = new PropertyRepository();

        while ($row = $result->fetch_object()) {
            $row->properties = $propertyRepo->readAllByHotelID($row->id);
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * Überschriebt die Funktion readById der Repository-Klasse. Gibt ein Objekt inklusive dessen Properties zurück.
     *
     * @param $id Gibt an welches Hotel zurückgegeben werden soll.
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return Ein Objekt mit dem gefundenen Datensatz.
     */
    public function readById($id)
    {
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE id=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $propertyRepo = new PropertyRepository();
        $row = $result->fetch_object();
        $row->properties = $propertyRepo->readAllByHotelID($row->id);

        return $row;
    }

}
