<?php
  foreach($hotels as $hotel){
    echo "<div>
        <div class=\"left\">
            <label>Anreise</label>
            <p>$hotel->start_date</p>
        </div>

        <div class=\"left\">
            <label>Abreise</label>
            <p>$hotel->end_date</p>
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
            <p>  <?php
                $length = count($essen);
                for ($i = 0; $i < $length; $i++) { echo $essen[$i]."<br>"; } ?></p>
        </div>

        <div class=\"left\">
            <label>Buchungssumme</label>
            <p> $preis CHF</p>
        </div>
        <br>
        <br>
    </div>";
  }
