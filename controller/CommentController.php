<?php

require_once '../repository/HotelRepository.php';
require_once '../repository/CommentRepository.php';
require_once '../lib/Validation.php';

/**
 *
 */
class CommentController
{

  /**
      *Beim aufrufen der Funktion showhotels werden alle Hotels angazeigt und der User kann auswählen wo er einen Komentar abgeben möchte.
  **/

  public function showhotels(){
    {
        $view = new View('comment_hotel');
        $view->title = 'Bewertung';
        $view->heading = 'Bewertung';

        $hotelRepo = new HotelRepository();

        $hotels = $hotelRepo->readAllWithProperties();
        $view->hotels = $hotels;

        $view->display();
    }
  }

  /**
      *Beim aufrufen der Funktion rate wird das ausgewählte Hotel angezeigt so wie ein Bereich wo der User seinen Kommentar da lassen kann.
      * @param $fault wird dazu verwendet falls ein Fehler auftaucht diesen auszugeben
      * @param $comment Wird dazu verwendet, das wenn ein fehler auftaucht der komentar nicht neu geschrieben werden muss sondern übergeben werden kann.
  **/

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

  /**
      *Beim aufrufen der Funktion sendcomment wird geprüft ob der neue Kommentar valied ist. Wenn ja wird er in die DB gespeichert und der User ladet auf der azeige aller Kommentare.
      *Wenn nein wir der User wieder auf die Seite zurückgeschickt auf welcher er den Kommentar erfasst hat und er erhält eine fehlermeldung.
  **/

  public function sendcomment(){
    $validator = new Validation();
    $comentrepo = new CommentRepository();

    $hotel_id = $_GET['hotel'];
    $content = $_POST['content'];
    $user_id = $_SESSION['Userid'];


    if(!empty($content) && is_string($content) && $validator->maxlengthchecker($content, 400)){
        $content = htmlspecialchars($content);
        $comentrepo->insert($user_id, $hotel_id, $content);
        header("Location: /hotel/showcomments?hotel=$hotel_id");
      } else {
        $fault = 'Bei der Übermitlung ist ein fehler pasiert bitte senden sie den Kommentar erneut.';
        $this->rate($content, $fault);
      }
  }

  public function update($comment = '', $fault = ''){
    $hotelRepo = new HotelRepository();
    $hotel = $hotelRepo->readById($_GET['hotel']);

    if($comment == ''){
      $commentReop = new CommentRepository();
      $comment = $commentReop->readById($_GET['id']);
    }

    $view = new View('comment_update');
    $view->title = 'Bewertung ändern';
    $view->heading = 'Bewertung ändern';
    $view->hotel = $hotel;
    $view->comment = $comment;
    $view->fault = $fault;
    $view->display();

  }

  public function doupdate(){
    $validator = new Validation();
    $comentrepo = new CommentRepository();

    $hotel_id = $_GET['hotel'];
    $comment_id = $_GET['comment'];
    $content = $_POST['content'];
    $user_id = $_SESSION['Userid'];


    if(!empty($content) && is_string($content) && $validator->maxlengthchecker($content, 400)){
        $content = htmlspecialchars($content);
        $comentrepo->update($comment_id, $content);
        header("Location: /hotel/showcomments?hotel=$hotel_id");
      } else {
        $fault = 'Bei der Übermitlung ist ein fehler pasiert bitte senden sie den Kommentar erneut.';
        $this->rate($content, $fault);
      }
  }
}
