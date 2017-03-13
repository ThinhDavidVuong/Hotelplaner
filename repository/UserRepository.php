<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'users';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($sex_id, $firstName, $name, $password, $email)
    {
        $password = sha1($password);

        $query = "INSERT INTO $this->tableName (sex_id, firstName, name, password, email) VALUES (?, ?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('issss', $sex_id, $firstName, $name, $password, $email);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function check($email, $password)
    {
      $password_hash = sha1($password);

      $query = "SELECT * FROM $this->tableName WHERE email=?";

      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('s', $email);

      if (!$statement->execute()) {
          throw new Exception($statement->error);
      }

      // Resultat der Abfrage holen
      $result = $statement->get_result();
      if (!$result) {
          throw new Exception($statement->error);
      }

      // Ersten Datensatz aus dem Reultat holen
      $row = $result->fetch_object();

      // Datenbankressourcen wieder freigeben
      $result->close();

      if (isset($row)){
        if ($password_hash == $row->password)
        {
          return True;
        } else {
          return False;
        }
    }
  }

    public function getIdByEmail($email)
      {

          $query = "SELECT id FROM {$this->tableName} WHERE email=?";

          $statement = ConnectionHandler::getConnection()->prepare($query);
          $statement->bind_param('s', $email);

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
          return $row->id;

    }
}
