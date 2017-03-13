<?php

require_once '../lib/Repository.php';
require_once 'UserRepository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class CommentRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'comment';

    public function readByHotelid($hotelid)
        {
            // Query erstellen
            $query = "SELECT * FROM {$this->tableName} WHERE hotel_id=?";

            // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
            // und die Parameter "binden"
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('i', $hotelid);

            // Das Statement absetzen
            $statement->execute();

            // Resultat der Abfrage holen
            $result = $statement->get_result();
            if (!$result) {
                throw new Exception($statement->error);
            }

            $userRepo = new UserRepository();

            // Datensätze aus dem Resultat holen und in das Array $rows speichern
            $rows = array();
            while ($row = $result->fetch_object()) {
                $row->user = $userRepo->readById($row->user_id);
                $rows[] = $row;
            }

            return $rows;
        }


}
