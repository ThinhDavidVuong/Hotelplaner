<?php

require_once '../repository/UserRepository.php';
require_once '../repository/SexRepository.php';
require_once '../lib/Validation.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class LoginController
{
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('user_index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->users = $userRepository->readAll();
        $view->display();
    }

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

    public function login($fault = '')
    {
      $view = new View('user_login');
      $view->title = 'Login';
      $view->heading = 'Login';
      $view->fault = $fault;
      $view->display();
    }

    public function doCreate()
    {
        $validator = new Validation();

        if ($_POST['send']) {
            $sex = $_POST['sex'];
            $firstName = $_POST['firstName'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password  = $_POST['password'];
            $passwordrepeat = $_POST['passwordrepeat'];

            $checkString = '';
            /*
            if (isset($_POST['sex']) && isset($_POST['firstName']) && isset($_POST['name'])){
              $checkString = 'Die Felder Geschlecht, Vorname und Nachname müssen ausgefühlt sein <br/>';
            }*/

            if (!$validator->isemail($email)){
              $checkString .= 'Es muss eine gültige Emailadresse angegeben werden <br/>';
            }

            if (!$validator->minlengthchecker($password, 8)){
              $checkString .= 'Das Passwort muss mindestens 8 Zeichen lang sein <br/>';
            }

            if ($password!=$passwordrepeat){
              $checkString .= 'die Passwörter müssen übereinstimmen';
            }

            if (strlen($checkString) > 0){
              $this->registery($checkString);
            } else {
            $sexRepo = new SexRepository();
            $sex_id = $sexRepo->getIdByName($sex);

            $userRepository = new UserRepository();
            $userRepository->create($sex_id, $firstName, $name, $password, $email);
            //$_SESSION['Userid'] = $userRepository->getIdByEmail($email);
            $this->dologin();
            header('Location: /');
          }
        }

    }

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

    public function logout(){
      unset($_SESSION['Userid']);
      unset($_SESSION['session_id']);
      session_destroy();
      header('Location: /');
    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
