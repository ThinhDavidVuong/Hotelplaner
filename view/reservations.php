<script src="/js/reserve.js"></script>

<div>
    <div class="left">
        <label>Anreise</label>
        <p><?php echo $dayStart.".".$monthStart.".".$yearStart; ?></p>
    </div>

    <div class="left">
        <label>Abreise</label>
        <p><?php echo $dayEnd.".".$monthEnd.".".$yearEnd; ?></p>
    </div>

    <div class="left">
        <label>Zimmertyp</label>
        <p><?= $zimmer ?></p>
    </div>

    <div class="left">
        <label>Anzahl Personen</label>
        <p><?= $anzahlPersonen ?></p>
    </div>

    <div class="left">
        <label>Mahlzeiten</label>
        <p>  <?php
            $length = count($essen);
            for ($i = 0; $i < $length; $i++) { echo $essen[$i]."<br>"; } ?></p>
    </div>

    <div class="left">
        <label>Buchungssumme</label>
        <p><?= $preis ?> CHF</p>
    </div>

    <div class="left">
        <a href="/reservation/commit" class="btn btn-info btn-md">
            <span class="glyphicon glyphicon-cog"></span> Ändern
        </a>
    </div>
    <br>
    <br>
</div>






