
    <?php foreach ($hotels as $hotel) : ?>
        <div class="hotel-entry">
            <div class="hotel" style="background-image: url('<?= $hotel->image ?>')"></div>

            <div id="info" class="left">
                <h3 name="hotelname"> <?= $hotel->name; ?> </h3><br>
                <p name="stars"> <?php for ($x = 0; $x < $hotel->stars; $x++) : ?>&#9733<?php endfor; ?> </p><br>
                <a href="/hotel/reserve?hotel=<?= $hotel->id ?>" class="btn btn-info">Buchen</a>
            </div>

            <div class="right">
                <h4>Hotelaustattung</h4>
                <div class="description-box"><?php foreach ($hotel->properties as $prop) { echo " - ". $prop->property . "<br>"; } ?></div>
            </div>

            <div class="right">
                <h4>Beschreibung</h4>
                <div class="description-box"><?= $hotel->description; ?></div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>