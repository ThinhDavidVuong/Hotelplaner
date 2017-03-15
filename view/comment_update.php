<div class="hotel-entry">
    <div class="hotel" style="background-image: url('<?= $hotel->image ?>')"></div>

    <div id="info" class="left">
        <h3 name="hotelname"> <?= $hotel->name; ?> </h3><br>
        <p name="stars"> <?php for ($x = 0; $x < $hotel->stars; $x++) : ?>&#9733<?php endfor; ?> </p><br>
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
<?php


  $form = new Form("/comment/doupdate?hotel=$hotel->id&comment=$comment->id");

  echo $form->fault()->message($fault);
  echo $form->textarea()->label('Kommentar')->name('content')->value($comment->content);
  echo $form->submit()->label('Kommentar absenden')->name('send');

  $form->end();
