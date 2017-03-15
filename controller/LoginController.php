<?php

require_once '../repository/UserRepository.php';
require_once '../repository/SexRepository.php';
require_once '../lib/Validation.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class LoginController
{
/**
    *Die Funktion registery wir dazu verwendet die Seite Aufzubauen auf welcher ma sich registrieren kann.
    * @param $fault wird dazu verwendet falls ein Fehler auftaucht diesen auszugeben
**/

    public function registery($fault = '')
    {
        $sexRepo = new SexRepository();
        $sexEntries = $sexRepo->readAll();

        $sexarray = array();
        foreach ($sexEntries as $sex)
        {
            $sexarray[] = $sex->sex;
        }

        $view = new View('user_registery');
        $view->title = 'Registrieren';
        $view->heading = 'Registrieren';
        $view->fault = $fault;
        $view->sexarray = $sexarray;
        $view->display();
    }
    /**
        *Die Funktion login wir dazu verwendet die Seite Aufzubauen auf welcher ma sich einlogen kann.
        * @param $fault wird dazu verwendet falls ein Fehler auftaucht diesen auszugeben
    **/

    public function login($fault = '')
    {
      $view = new View('user_login');
      $view->title = 'Login';
      $view->heading = 'Login';
      $view->fault = $fault;
      $view->display();
    }
    /**
        *Die Funktion doCreate wir dazu verwendet um die Registrationsdaten anzunehmen, zu validieren und zu speichern.
    **/
    public function doCreate()
    {
        $validator = new Validation();
        $userRepository = new UserRepository();
        $sexRepo = new SexRepository();

        if ($_POST['send']) {
            $sex = $_POST['sex'];
            $firstName = $_POST['firstName'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password  = $_POST['password'];
            $passwordrepeat = $_POST['passwordrepeat'];

            //Hier fängt die Validation an
            $checkString = '';
            $emailcounter = 0;
            $emails = $userRepository->getallEmails();
            foreach ($emails as $emailDB) {
              if($email == $emailDB->email){
                $emailcounter ++;
              }
            }

            if (empty($firstName) && empty($name)){
              $checkString .= 'Vorname und Name müssen angegeben sein <br/>';
            }

            if ($emailcounter > 0){
              $checkString .= 'Die Emailadresse ist bereis vergeben <br/>';
            }

            if (!$validator->isemail($email)){
              $checkString .= 'Es muss eine gültige Emailadresse angegeben werden <br/>';
            }

            if (!$validator->minlengthchecker($password, 8)){
              $checkString .= 'Das Passwort muss mindestens 8 Zeichen lang sein <br/>';
            }

            if ($password!=$passwordrepeat){
              $checkString .= 'die Passwörter müssen übereinstimmen';
            }

            //ist alles korrekt so ist auch der $checkString lehr und die daten können in die DB gespeichert werden.
            //Andern Falls wird der Fehler ausgegeben.
            if (strlen($checkString) > 0){
              $this->registery($checkString);
            } else {
            $sex_id = $sexRepo->getIdByName($sex);

            $userRepository->create($sex_id, $firstName, $name, $password, $email);
            $this->dologin();
            header('Location: /');
          }
        }

    }

    /**
        *Die Funktion dologin prüft ob die eingegebene email und password übereinstimmen.
    **/

    public function dologin()
    {
      if ($_POST['send']){
        $userRepository = new UserRepository();
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($userRepository->check($email, $password)){
          $_SESSION['Userid'] = $userRepository->getIdByEmail($email);
          echo $_SESSION['Userid'];
          header('Location: /');
        } else {
          $fault = 'Die E-Mail Adresse oder das Passwort ist falsch';
          $this->login($fault);
        }
      }
    }

    /**
        *Über die Funktion logout wird die session beendet und man ist ausgelogt.
    **/


    public function logout(){
      unset($_SESSION['Userid']);
      unset($_SESSION['session_id']);
      session_destroy();
      header('Location: /');
    }
}
