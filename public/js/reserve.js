/**
 * Created by bvuond on 13.03.2017.
 */




var elPrice = document.getElementById("price");
elPrice.innerHTML = hotel.price;

var chkFrühstück = document.getElementById("frühstück");
var chkMittag = document.getElementById("mittag");
var chkNachmittag = document.getElementById("nachmittag");
var chkAbends = document.getElementById("abends");

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
    tage: 0
}

function berechneBuchung() {
    elPrice.innerHTML = (hotel.price + buchung.zimmer + buchung.personen + buchung.optionen) * buchung.tage;
}

var selectTyp = document.getElementById("zimmer-typ");
selectTyp.addEventListener('change', function() {
    if (selectTyp.value == 'einzelzimmer'){
        buchung.zimmer = 0;
        berechneBuchung();
    }
    if (selectTyp.value == 'doppelzimmer'){
        buchung.zimmer = 150;
        berechneBuchung();
    }
    if (selectTyp.value == 'viererzimmer'){
        buchung.zimmer = 300;
        berechneBuchung();
    }
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

    if (chkFrühstück.checked) {
        buchung.optionen += 50;
    }
    if (chkMittag.checked) {
        buchung.optionen += 50;
    }
    if (chkNachmittag.checked) {
        buchung.optionen += 50;
    }
    if (chkAbends.checked) {
        buchung.optionen += 50;
    }

    berechneBuchung();
}

chkFrühstück.addEventListener('click', berechneOptionen);
chkMittag.addEventListener('click', berechneOptionen);
chkNachmittag.addEventListener('click', berechneOptionen);
chkAbends.addEventListener('click', berechneOptionen);

function berechneDatum() {
    buchung.tage = 0;

    var startDate;
    var endDate;

    startDate = new Date(jahrStart.value + "-" + monatStart.value + "-" + tagStart.value);
    endDate = new Date(jahrEnde.value + "-" + monatEnde.value + "-" + tagEnde.value);

    var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    buchung.tage= diffDays;
    berechneBuchung();
}

monatStart.addEventListener('click', berechneDatum);
tagStart.addEventListener('click', berechneDatum);
jahrStart.addEventListener('click', berechneDatum);
monatEnde.addEventListener('click', berechneDatum);
tagEnde.addEventListener('click', berechneDatum);
jahrEnde.addEventListener('click', berechneDatum);



