
    <?php foreach ($hotels as $hotel) : ?>
        <div class="hotel-entry">

            <div class="hotel" style="background-image: url('<?= $hotel->image ?>')"></div>

            <div id="info" class="left">
                <h3> <?= $hotel->name; ?> </h3><br>
                <p> <?php for ($x = 0; $x < $hotel->stars; $x++) : ?>&#9733<?php endfor; ?> </p><br>
                <button type="button" class="btn btn-info">Buchen</button>
            </div>

            <div class="right">
                <h4>Eigenschaft</h4>
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