<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class ReservationRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'reservation';

    public function insertReservation($user_id, $hotel_id, $roomtype_id, $date_start, $date_end, $price, $persons) {

        $query = "INSERT INTO {$this->tableName} (user_id, hotel_id, roomtype_id, date_start, date_end, price, persons)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('iiissii', $user_id, $hotel_id, $roomtype_id, $date_start, $date_end, $price, $persons);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function readAllByUser($user_id) {

        $query = "SELECT r.id as id, hotel_id, date_start, date_end, roomtype, r.price as price, persons FROM {$this->tableName} as r join hotel as h on r.hotel_id=h.id join roomtype as ro on r.roomtype_id=ro.id  WHERE r.user_id = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $user_id);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $row->meals = $this->readAllMealsOfAReservation($row->id);
            $rows[] = $row;
        }

        return $rows;

    }


    /**
     * Diese Funktion prüft ob die Email und das Passwort zusammengehören.
     *
     * @param id Die id der reservation
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return Ein Array mit allen meals die gefunden wurden.
     **/
    public function readAllMealsOfAReservation($id){

          $query = "SELECT r.id as id, m.meal as meal FROM {$this->tableName} as r join reservation_has_meals as rm on r.id = rm.reservation_id join meal as m on rm.meal_id=m.id WHERE r.id = ?";

          $statement = ConnectionHandler::getConnection()->prepare($query);
          $statement->bind_param('i', $id);
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

    /**
     * Diese Funktion gibt den Datensatz mit der gegebenen id zurück.
     * Diese Funktion gibt ausserdem noch alle dazugehörigen Mahlzeiten zurück.
     *
     * @param $id id des gesuchten Datensatzes
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     * @return Der gesuchte Datensatz oder null, sollte dieser nicht existieren.
     */
    public function readById($id)
    {
        // Query erstellen
        $query = "SELECT r.id as id, hotel_id, date_start, date_end, roomtype, r.price as price, persons FROM {$this->tableName} as r join hotel as h on r.hotel_id=h.id join roomtype as ro on r.roomtype_id=ro.id  WHERE r.id = ?";

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

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Damit werden die Mahlzeiten angehängt.
        $row->meals = $this->readAllMealsOfAReservation($row->id);

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;
    }
}
