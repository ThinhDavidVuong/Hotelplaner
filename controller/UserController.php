<?php

require_once '../repository/UserRepository.php';
require_once '../repository/SexRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
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

    public function registery()
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
        $view->sexarray = $sexarray;
        $view->display();
    }

    public function login()
    {
      $view = new View('user_login');
      $view->title = 'Login';
      $view->heading = 'Login';
      $view->display();
    }

    public function doCreate()
    {

        if ($_POST['send']) {
            $sex = $_POST['sex'];
            $firstName = $_POST['firstName'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password  = $_POST['password'];
            $passwordrepeat = $_POST['passwordrepeat'];

            $sexRepo = new SexRepository();
            $sex_id = $sexRepo->getNameById($sex);

            $userRepository = new UserRepository();
            $userRepository->create($sex_id, $firstName, $name, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public funktion dologin()
    {
      if ($_POST['send']){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
      }
    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
