<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapazitätenabfrage intern</title>
    <link rel="stylesheet" type="text/css" href="Kapazitätenstylesheet.css" media="screen" />
</head>
<body>

<div class="contact-us">
    <h1> Neue Überprüfung</h1>
    <!-- Fomular  mit Abfrage eines alternativen Start- und Enddatums um freie Kapazitäten zu überprüfen-->
    <h3>
        <em>&#x2a; </em> Bitte ein Startdatum und eine Dauer (maximal 7 Tage) angeben.<br>
        &nbsp;&nbsp;Startdatum muss mindesten einen Monat in der Zukunft liegen!
    </h3>

    <form action="kapazitäts_check.php" method="post">
        <label for="Startdatum">Startdatum <em>&#x2a;</em></label><input id="Startdatum" name="Startdatum" required="" type="date" min="0" maxlength="10"/>
        <label for="Dauer"> Dauer in Tagen <em>&#x2a;</em></label><input id="Dauer" name="Dauer" required="" type="number" min="1" max="7"/>
        <label for="Teilnehmerzahl">Teilnehmerzahl <em>&#x2a;</em></label><input id="Teilnehmerzahl" name="Teilnehmerzahl" required="" type="number" min="1"/>
        <!--Auswahlbuttons zum Abbrechen und Rückkehr zur Startseite oder Abfrage nach freien Raum Kapazitäten -->
        <!--  Startdatum muss mindestens einen Monat in der Zukunft liegen über Backend lösen?-->
        <button type="submit"  name="Kapazitätsprüfung3" class="Auslösen">Abfragen</button>
        <a href="#" class="Abbrechen" type="button" >Abbrechen</a>
    </form>
</body>
</html>
<script>
    //Funktion um zu Überprüfen ob das Datum einen Monat in der Zukunft  liegt und nicht über ein Wochenende hinaus geht
    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

    function dateToHtml(date) {
        var result = [date.getFullYear(), date.getMonth()+1, date.getDate()].join("-");
        return result;
    }

    function dayOfWeek(date) {
        var day = new Date(date).getDay();
        var result;
        switch(day) {
            // sunday
            case 0:
                result = 1;
                break;

            // monday
            case 1:
                result = 7;
                break;

            // tuesday
            case 2:
                result = 6;
                break;

            // wednesday
            case 3:
                result = 5;
                break;

            // thursday
            case 4:
                result = 4;
                break;

            // friday
            case 5:
                result = 3;
                break;

            // saturday
            case 6:
                result = 2;
                break;
        }

        return result;
    }

    var currentDate = new Date();
    var maxDays = dayOfWeek(currentDate);
    var minDate = dateToHtml(addDays(currentDate, 28));
    var maxDaysHtml = document.getElementById("max_days").max = maxDays;
    var minDateHtml = document.getElementById("Startdatum").min = minDate;
</script>