<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumreservierung</title>
    <link rel="stylesheet" type="text/css" href="Raumformularstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="header.css" media="screen" />
</head>

<body>

<?php
//Zugangsdaten zur Datenbank
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);

if($conn->connect_error){
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

//Variablen
$status = false;
$query_status = "";

//Abspeichern der ID des ausgewählten Raumes und weiteren Variablen
if(isset($_POST["Reservieren"])){

    $R_ID = $_POST["Auswahl"];
    //Session für übergebene R_ID für Angebotserstellung und Veranstaltungserstellung (intern)
    $_SESSION["R_ID"] = $R_ID;
    $status = true;
}

//Reservierungs/Belegungsvorgang nur wenn auch eine R_ID empfangen wurde
if($status){

    //Reservierung eines Raumes für eine Anfrage
    if($_SESSION["Prüfungsart"] == 1){

        //Abspeichern der nötigen Daten für den INSERT in den Kalender
        $Beginn = $_SESSION["Beginn_final"];
        $Dauer = $_SESSION["Dauer_final"];
        $BeAr_ID = $_SESSION["BeAr_ID"];
        $R_status = 2;


        //Insert in den Kalender
        $insert_query = "INSERT INTO Kalender VALUES ('$Beginn', (SELECT DATE_ADD('$Beginn', INTERVAL $Dauer-1 DAY)), $R_ID, $R_status, NULL, $BeAr_ID)";
        $res = $conn->query($insert_query);
        if($res === TRUE){
            $query_status = "Reservierung von Raum " . $R_ID . " war erfolgreich. ";
            echo $query_status;

            //TODO Weiterleitung zu Angebot_erstellen.php

        }
        else{
            $query_status = "Es ist ein Fehler beim Eintragen in den Kalender aufgetreten";
            echo $query_status;
        }


    }

    //Belegung eines Raumes bei der Erstellung einer internen Veranstaltung
    elseif($_SESSION["Prüfungsart"] == 2){

        //Abspeichern der nötigen Daten für den INSERT in den Kalender
        $Beginn = $_SESSION["Beginn_final"];
        $Dauer = $_SESSION["Dauer_final"];
        $R_status = 1;

        //Insert
        $insert_query = "INSERT INTO Kalender VALUES ('$Beginn', (SELECT DATE_ADD('$Beginn', INTERVAL $Dauer-1 DAY)), $R_ID, $R_status, NULL, NULL)";
        $res = $conn->query($insert_query);
        if($res === TRUE){
            $query_status = "Belegung von Raum " . $R_ID . " war erfolgreich.";
            echo $query_status;

            //TODO Hier dann Weiterleitung zum Erstellen der Veranstaltung
        }
        else{
            $query_status = "Es ist ein Fehler beim Eintragen in den Kalender aufgetreten";
            echo $query_status;
        }
    }

    else{
        $query_status = "Die Datenbankabfrage konnte nicht durchgeführt werden, da ein Session Fehler aufgetreten ist";
    }
}

?>

</body>

<div class="contact-us">
    <h1> Raum Reservieren</h1>
    <!-- Fomular Spalten -->
    <h3>
        <em>&#x2a; </em> Bitte den gewünschten Raum aus der Liste auswählen.
    </h3>

    <div class="select-wrapper">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <select class="auswahl" name="Auswahl">
                <?php for($i = 0; $i<count($_SESSION["R_ID_Array"]); $i++){?>
                <option value="<?php echo $_SESSION["R_ID_Array"][$i];?>"><?php echo "Raum " . $_SESSION["R_ID_Array"][$i];?> </option>
                <?php }?>
            </select>
        <button type="submit"  class="Löschen" name="Reservieren"  value="Auswahl">Reservieren</button>
        <a href="#" type="button" class="Abbrechen">Abbrechen</a>
        </form>
    </div>



</div>

</html>

<style>
    .auswahl {
        width: 100%;
        height: 40px;
        /*-moz-padding-start: calc(10px - 3px);*/
        padding-left: 10px;
        background: white;
        color: black;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.3);
        border-radius: 3px
        outline: none;
        cursor: pointer;
        position: relative;
        /*appearance: none;*/
        /*display: grid;*/
    }
    .select-wrapper {
        position: relative;
        width:20em;
        margin-bottom: 6em; }

    }
    .Löschen {
        display:block;
        float: right;
        line-height: 24pt;
        padding: 0 20px;
        border: none;
        background: #f45702;
        color: white;
        letter-spacing: 2px;
        transition: 0.2s all ease-in-out;
        border-bottom: 2px solid transparent;
        outline: none;
        margin-top: 30px;
        font-size: 14px;

    }
    .Löschen:hover {
        background: inherit;
        color: #f45702;
        border-bottom: 2px solid #f45702;
        cursor: pointer;
    }.
</style>
