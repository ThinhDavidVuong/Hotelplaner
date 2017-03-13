<?php

require_once '../repository/HotelRepository.php';
require_once '../repository/CommentRepository.php';

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

  public function rate(){
      $hotelRepo = new HotelRepository();
      $hotel = $hotelRepo->readById($_GET['hotel']);

      $view = new View('comment_rate');
      $view->title = 'Bewertung';
      $view->heading = 'Bewertung';
      $view->hotel = $hotel;
      $view->display();

  }
}
