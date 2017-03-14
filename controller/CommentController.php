<?php

require_once '../repository/HotelRepository.php';
require_once '../repository/CommentRepository.php';
require_once '../lib/Validation.php';

/**
 *
 */
class CommentController
{

  public function showhotels(){
    {
        // In diesem Fall möchten wir dem Benutzer die View mit dem Namen
        //   "default_index" rendern. Wie das genau funktioniert, ist in der
        //   View Klasse beschrieben.
        $view = new View('comment_hotel');
        $view->title = 'Bewertung';
        $view->heading = 'Bewertung';

        $hotelRepo = new HotelRepository();

        $hotels = $hotelRepo->readAllWithProperties();
        $view->hotels = $hotels;

        $view->display();
    }
  }

  public function rate($comment = '', $fault = ''){
      $hotelRepo = new HotelRepository();
      $hotel = $hotelRepo->readById($_GET['hotel']);

      $view = new View('comment_rate');
      $view->title = 'Bewertung';
      $view->heading = 'Bewertung';
      $view->hotel = $hotel;
      $view->comment = $comment;
      $view->fault = $fault;
      $view->display();

  }

  public function sendcomment(){
    $validator = new Validation();
    $comentrepo = new CommentRepository();

    $hotel_id = $_GET['hotel'];
    $content = $_POST['content'];
    $user_id = $_SESSION['Userid'];


    if(!empty($content) && is_string($content) && $validator->maxlengthchecker($content, 400)){
      echo 1;
        $content = htmlspecialchars($content);
        $comentrepo->insert($user_id, $hotel_id, $content);
        header("Location: /hotel/showcomments?hotel=$hotel_id");
      } else {
        echo 2;
        $fault = 'Bei der Übermitlung ist ein fehler pasiert bitte senden sie den Kommentar erneut.';
        $this->rate($content, $fault);
      }
      echo 3;
  }
}
