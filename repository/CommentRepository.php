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

    /**
    *Wird dazu verwerdet um alle Kommentare zu einem Hotel aus der DB zu holen
    * @param $hotelid Id des Hotel zu welchem alle Kommentare augegeben werden sollen.
    *
    * @throws Exception falls das Ausführen des Statements fehlschlägt
    *
    * @return Ein array mit den gefundenen Datensätzen.
    **/
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

        /**
        *Wird dazu verwerdet um einen Kommentar in die DB einzuspeichern.
        * @param $user_id Id des Users der den Kommentar erfasst hat.
        * @param $hotel_id Id des Hotels zu welchem der Komentar erfasst werden soll.
        * @param $content Inhalt des Kommentars.
        *
        * @throws Exception falls das Ausführen des Statements fehlschlägt
        *
        * @return Ein array mit den gefundenen Datensätzen.
        **/
    public function insert($user_id, $hotel_id, $content)
      {

          $query = "INSERT INTO $this->tableName (user_id, hotel_id, content) VALUES (?, ?, ?)";

          $statement = ConnectionHandler::getConnection()->prepare($query);
          $statement->bind_param('iis', $user_id, $hotel_id, $content);

          if (!$statement->execute()) {
              throw new Exception($statement->error);
          }

          return $statement->insert_id;
    }


}
