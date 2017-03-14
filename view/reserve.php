<?php
if(!isset($_SESSION['Userid'])){
    header("Location: /");
}

$nextDate = strtotime('+1 day');
?>

<div>
    <h3 name="hotelname" class="center"> <?= $hotel->name; ?> </h3>
    <p name="stars" class="center"> <?php for ($x = 0; $x < $hotel->stars; $x++) : ?>&#9733<?php endfor; ?> </p><br>
</div>

<form action="/reservation/reservation" method="post">
    <input type="hidden" name="hotel_id" value="<?= $hotel->id ?>" />
    <div>
        <div class="left">
            <h4 class="list-group-item list-group-item-info">Art der unterbingung</h4><br>
            <select name="zimmer-typ" id="zimmer-typ" required>
                <option>--</option>
                <option value="Einzelzimmer">Einzelzimmer</option>
                <option value="Doppelzimmer">Doppelzimmer</option>
                <option value="Viererzimmer">Viererzimmer</option>
            </select>
        </div>

        <div class="left">
            <h4 class="list-group-item list-group-item-info">Personen</h4><br>
            <select name="anzahl-personen" id="anzahl-personen" required>
                <option>--</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="left">
            <h4 class="list-group-item list-group-item-info">Mahlzeiten</h4><br>
            <?php foreach ($meals as $meal) : ?>
            <div class="checkbox">
                <label><input type="checkbox" name="essen[]" value="<?= $meal->id ?>" class="meal" data-price="<?= $meal->price ?>"><?= $meal->meal ?></label>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="left">
            <h4 class="list-group-item list-group-item-info">Anzahl Tage</h4><br>

            <h4>Start Date </h4>
            <label>Month</label>
            <select name="month-start" id="month-start" required/>
                <?php for ($i = 1; $i <= 12; $i++) : ?>
                    <?php if ($i == date('m')) : ?>
                    <option value="<?= $i ?>" selected><?= DateTime::createFromFormat('!m', $i)->format('F') ?></option>
                    <?php else : ?>
                    <option value="<?= $i ?>"><?= DateTime::createFromFormat('!m', $i)->format('F') ?></option>
                    <?php endif; ?>
                <?php endfor; ?>
            </select> -

            <label>Day</label>
            <select name="day-start" id="day-start" required/>
                <?php for ($i = 1; $i <= 31; $i++) : ?>
                    <?php if ($i == date('d')) : ?>
                        <option value="<?= $i ?>" selected><?= $i ?></option>
                    <?php else: ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endif ?>
                <?php endfor; ?>
            </select> -

            <label>Year</label>
            <select name="year-start" id="year-start" required/>
                <?php for ($i = 0; $i < 5; $i++) : ?>
                <option value="<?= date('Y', strtotime("+$i years")) ?>"><?= date('Y', strtotime("+$i years")) ?></option>
                <?php endfor; ?>
            </select>
            <span>(Month-Day-Year)</span>
            <br>
            <br>
            <h4>End Date </h4>
            <label>Month</label>
            <select name="month-end" id="month-end" required/>
            <?php for ($i = 1; $i <= 12; $i++) : ?>
                <?php if ($i == date('m', $nextDate)) : ?>
                    <option value="<?= $i ?>" selected><?= DateTime::createFromFormat('!m', $i)->format('F') ?></option>
                <?php else : ?>
                    <option value="<?= $i ?>"><?= DateTime::createFromFormat('!m', $i)->format('F') ?></option>
                <?php endif; ?>
            <?php endfor; ?>
            </select> -

            <label>Day</label>
            <select name="day-end" id="day-end" required/>
                <?php for ($i = 1; $i <= 31; $i++) : ?>
                    <?php if ($i == date('d', $nextDate)) : ?>
                        <option value="<?= $i ?>" selected><?= $i ?></option>
                    <?php else: ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endif ?>
                <?php endfor; ?>
            </select> -

            <label>Year</label>
            <select name="year-end" id="year-end" required/>
                <?php for ($i = 0; $i < 5; $i++) : ?>
                    <option value="<?= date('Y', strtotime("+$i years")) ?>"><?= date('Y', strtotime("+$i years")) ?></option>
                <?php endfor; ?>
            </select>
            <span>(Month-Day-Year)</span>
        </div>
    </div>

    <div class="left">
        <label>Preis: </label> <span id="price"></span> CHF<br><br>
        <button class="btn btn-info">Buchen</button>
    </div>
</form>
<script>
    var hotel = {
        price: <?= $hotel->price; ?>
    };
</script>
<script src="/js/reserve.js"></script>