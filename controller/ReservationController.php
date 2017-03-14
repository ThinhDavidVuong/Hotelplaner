<?php

require_once '../repository/HotelRepository.php';
require_once '../repository/MealRepository.php';
require_once '../repository/ReservationRepository.php';

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
class ReservationController
{
    /**
     * /hotel/reservation
     */
    public function reservation() {
        $_SESSION['buchung'] = array();
        $preis = 0;
        $_SESSION['buchung']['hotel'] = $_POST["hotel_id"];
        $_SESSION['buchung']['zimmer-typ'] = $_POST["zimmer-typ"];
        $_SESSION['buchung']['anzahl-personen'] = $_POST["anzahl-personen"];
        $_SESSION['buchung']['essen'] = $_POST["essen"];
        $_SESSION['buchung']['preis'] = $preis;


        $_SESSION['buchung']['month-start'] = $_POST["month-start"];
        $_SESSION['buchung']['day-start'] = $_POST["day-start"];
        $_SESSION['buchung']['year-start'] = $_POST["year-start"];
        $_SESSION['buchung']['start-date'] = $_POST["year-start"]."-".$_POST["month-start"]."-".$_POST["day-start"];

        $_SESSION['buchung']['month-end'] = $_POST["month-end"];
        $_SESSION['buchung']['day-end'] = $_POST["day-end"];
        $_SESSION['buchung']['year-end'] = $_POST["year-end"];
        $_SESSION['buchung']['end-date'] = $_POST["year-end"]."-".$_POST["month-end"]."-".$_POST["day-end"];


        $mealRepo = new MealRepository();
        $meals = array();

        foreach ($_SESSION['buchung']['essen'] as $essen) {
            $meals[] = $mealRepo->readById($essen)->meal;
        }


        $view = new View('reservation');
        $view->title = 'Startseite';
        $view->heading = 'Startseite';


        $view->zimmer = $_SESSION['buchung']['zimmer-typ'];
        $view->anzahlPersonen = $_SESSION['buchung']['anzahl-personen'];
        $view->essen = $meals;
        $view->preis = $_SESSION['buchung']['preis'];

        $view->monthStart = $_SESSION['buchung']['month-start'];
        $view->dayStart = $_SESSION['buchung']['day-start'];
        $view->yearStart = $_SESSION['buchung']['year-start'];

        $view->monthEnd = $_SESSION['buchung']['month-end'];
        $view->dayEnd = $_SESSION['buchung']['day-end'];
        $view->yearEnd = $_SESSION['buchung']['year-end'];

        $view->display();
    }

    public function commit() {
        $reservationRepo = new ReservationRepository();
        $reservation_id = $reservationRepo->insertReservation($_SESSION['Userid'], $_SESSION['buchung']['hotel'], $_SESSION['buchung']['zimmer-typ'],
            $_SESSION['buchung']['start-date'], $_SESSION['buchung']['end-date'], $_SESSION['buchung']['preis'], $_SESSION['buchung']['anzahl-personen']);
    }
}
