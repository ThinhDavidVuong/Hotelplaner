<?php

require_once '../repository/HotelRepository.php';
require_once '../repository/CommentRepository.php';
require_once '../repository/MealRepository.php';
require_once '../repository/RoomTypeRepository.php';

/**
 * Der Controller ist der Ort an dem es für jede Seite, welche der Benutzer
 * anfordern kann eine Methode gibt, welche die dazugehörende Businesslogik
 * beherbergt.
 *
 * Welche Controller und Funktionen muss ich erstellen?
 *   Es macht sinn, zusammengehörende Funktionen (z.B: User anzeigen, erstellen,
 *   bearbeiten & löschen) gemeinsam in einem passend benannten Controller (z.B:
 *   UserController) zu implementieren. Nicht zusammengehörende Features sollten
 *   jeweils auf unterschiedliche Controller aufgeteilt werden.
 *
 * Was passiert in einer Controllerfunktion?
 *   Die Anforderungen an die einzelnen Funktionen sind sehr unterschiedlich.
 *   Folgend die gängigsten:
 *     - Dafür sorgen, dass dem Benutzer eine View (HTML, CSS & JavaScript)
 *         gesendet wird.
 *     - Daten von einem Model (Verbindungsstück zur Datenbank) anfordern und
 *         der View übergeben, damit diese Daten dann für den Benutzer in HTML
 *         Code umgewandelt werden können.
 *     - Daten welche z.B. von einem Formular kommen validieren und dem Model
 *         übergeben, damit sie in der Datenbank persistiert werden können.
 */
class HotelController
{
    /**
     * Die index Funktion des DefaultControllers sollte in jedem Projekt
     * existieren, da diese ausgeführt wird, falls die URI des Requests leer
     * ist. (z.B. http://my-project.local/). Weshalb das so ist, ist und wann
     * welcher Controller und welche Methode aufgerufen wird, ist im Dispatcher
     * beschrieben.
     */
    public function index()
    {
        // In diesem Fall möchten wir dem Benutzer die View mit dem Namen
        //   "default_index" rendern. Wie das genau funktioniert, ist in der
        //   View Klasse beschrieben.
        $view = new View('hotel_index');
        $view->title = 'Startseite';
        $view->heading = 'Startseite';

        $hotelRepo = new HotelRepository();

        $hotels = $hotelRepo->readAllWithProperties();
        $view->hotels = $hotels;

        $view->display();
    }

    /**
        *Beim aufrufen der Funktion reserve wird eine neue Seite generiert auf welcher der User zusäzliche angeben zu seiner Buchung machen kann.
    **/
    public function reserve() {
        if (isset($_GET['hotel']) && is_numeric($_GET['hotel'])) {
            $hotel_id = $_GET['hotel'];

            $hotelRepo = new HotelRepository();
            $hotel = $hotelRepo->readById($hotel_id);

            $mealRepo = new MealRepository();
            $meals = $mealRepo->readAll();

            $roomTypeRepo = new RoomTypeRepository();
            $roomTypes = $roomTypeRepo->readAll();

            $view = new View('hotel_reserve');
            $view->title = 'Startseite';
            $view->heading = 'Startseite';
            $view->hotel = $hotel;
            $view->meals = $meals;
            $view->roomTypes = $roomTypes;

            $view->display();
        } else {
            header("Location: /");
        }
    }

    /**
        *Beim aufrufen der Funktion showcomments werden alle Kommentare zum ausgewählten Hotel angezeigt.
    **/

    public function showcomments() {
      $hotelRepo = new HotelRepository();
      $hotel = $hotelRepo->readById($_GET['hotel']);

      $commentRepo = new CommentRepository();
      $allComments = $commentRepo->readByHotelid($_GET['hotel']);


      $view = new View('hotel_showcomment');
      $view->title = 'Kommentare';
      $view->heading = 'Kommentare';
      $view->hotel = $hotel;
      $view->comments = $allComments;
      $view->display();
    }
}
