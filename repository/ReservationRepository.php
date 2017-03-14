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
}
