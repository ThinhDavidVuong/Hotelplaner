<?php

  foreach($hotels as $hotel){
    $essenout = '';
    foreach ($hotel->meals as $meal) {
      $essenout .= $meal->meal."<br>";
    }
    echo "<div>
        <div class=\"left\">
            <label>Anreise</label>
            <p>$hotel->date_start</p>
        </div>

        <div class=\"left\">
            <label>Abreise</label>
            <p>$hotel->date_end</p>
        </div>

        <div class=\"left\">
            <label>Zimmertyp</label>
            <p>$hotel->roomtype</p>
        </div>

        <div class=\"left\">
            <label>Anzahl Personen</label>
            <p>$hotel->persons</p>
        </div>

        <div class=\"left\">
            <label>Mahlzeiten</label>
            <p>$essenout</p>
        </div>

        <div class=\"left\">
            <label>Buchungssumme</label>
            <p> $hotel->price CHF</p>
        </div>
        <br>
        <br>
    </div>
    <br/>";
  }
