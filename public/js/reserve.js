/**
 * Created by bvuond on 13.03.2017.
 */
var elPrice = document.getElementById("price");
elPrice.innerHTML = hotel.price;

var monatStart = document.getElementById("month-start");
var tagStart = document.getElementById("day-start");
var jahrStart = document.getElementById("year-start");
var monatEnde = document.getElementById("month-end");
var tagEnde = document.getElementById("day-end");
var jahrEnde = document.getElementById("year-end");

var buchung = {
    zimmer: 0,
    personen: 0,
    optionen: 0,
    tage: 1
}

function berechneBuchung() {
    berechneDatum();
    elPrice.innerHTML = (hotel.price + buchung.zimmer + buchung.personen + buchung.optionen) * buchung.tage;
}

$('#zimmer-typ').change(function() {

    var price = $("#zimmer-typ").find(":selected").attr('data-price');
    buchung.zimmer = eval(price);

    berechneBuchung();
});


var selectPersonen = document.getElementById("anzahl-personen");
selectPersonen.addEventListener('change', function() {
    if (selectPersonen.value == 1){
        buchung.personen = 0;
        berechneBuchung();
    }
    if (selectPersonen.value == 2){
        buchung.personen = 150;
        berechneBuchung();
    }
    if (selectPersonen.value == 3){
        buchung.personen = 200;
        berechneBuchung();
    }
    if (selectPersonen.value == 4){
        buchung.personen = 300;
        berechneBuchung();
    }
});

function berechneOptionen() {
    buchung.optionen = 0;

    $('.meal').each(function(index, element) {
        var price = $(this).attr('data-price');

        if ($(this).is(':checked')) {
            buchung.optionen = buchung.optionen + eval(price);
        }
    });
    berechneBuchung();
}

$('.meal').click(berechneOptionen);

function berechneDatum() {
    buchung.tage = 0;

    var startDate;
    var endDate;

    startDate = new Date(jahrStart.value + "-" + monatStart.value + "-" + tagStart.value);
    endDate = new Date(jahrEnde.value + "-" + monatEnde.value + "-" + tagEnde.value);

    var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    buchung.tage= diffDays;
}

monatStart.addEventListener('click', berechneBuchung);
tagStart.addEventListener('click', berechneBuchung);
jahrStart.addEventListener('click', berechneBuchung);
monatEnde.addEventListener('click', berechneBuchung);
tagEnde.addEventListener('click', berechneBuchung);
jahrEnde.addEventListener('click', berechneBuchung);



