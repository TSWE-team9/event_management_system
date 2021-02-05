<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumreservierung</title>
    <link rel="stylesheet" type="text/css" href="../style/Formular.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Fehlermeldung.css" media="screen" />
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>

<body>
<?php include '../Header/header.php'; ?>
<script>document.getElementById("Reiter_Angebotserstellung").classList.add("active");  </script>

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

//Variablen setzen
$status = false;
$query_status = "";

//Abspeichern der ID des ausgewählten Raumes und weiteren Variablen nach Buttonklick
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

        //Meldung ausgeben und dann Angebot erstellen
        if($res === TRUE){
            $query_status = "Reservierung von Raum " . $R_ID . " war erfolgreich. ";
            echo "<div class='overlay'>" ;
            echo  "<div class='popup'>";
            echo "<h2>Bestätigung</h2>" ;
            echo "<a class='close' href='Angebot_erstellen.php'> &times;</a>" ;
            echo "<div class='content' >"  .$query_status."</div>";
            echo "</div>" ;
            echo "</div>" ;


        }
        else{
            $query_status = "Es ist ein Fehler beim Eintragen in den Kalender aufgetreten";
            echo "<div class='overlay'>" ;
            echo  "<div class='popup'>";
            echo "<h2>Entschuldingung es tut uns leid </h2>" ;
            echo "<a class='close' href='Angebotserstellung.php'>&times;</a>" ;
            echo "<div class='content' >"  .$query_status."</div>";
            echo "</div>" ;
            echo "</div>" ;

//            echo $query_status;
        }


    }

    //Belegung eines Raumes bei der Erstellung einer internen Veranstaltung
    elseif($_SESSION["Prüfungsart"] == 2){

        //Abspeichern der nötigen Daten für den INSERT in den Kalender
        $Beginn = $_SESSION["Beginn_final"];
        $Dauer = $_SESSION["Dauer_final"];
        $R_status = 2;

        //Insert in den Kalender und Weiterleitung zum Erstellen
        $insert_query = "INSERT INTO Kalender VALUES ('$Beginn', (SELECT DATE_ADD('$Beginn', INTERVAL $Dauer-1 DAY)), $R_ID, $R_status, NULL, NULL)";
        $res = $conn->query($insert_query);
        if($res === TRUE){
            $query_status = "Belegung von Raum " . $R_ID . " war erfolgreich.";
            echo "<div class='overlay'>" ;
            echo  "<div class='popup'>";
            echo "<h2>Bestätigung</h2>" ;
            echo "<a class='close' href='VeranstaltungBetreiber.php'>&times;</a>" ;
            echo "<div class='content' >"  .$query_status."</div>";
            echo "</div>" ;
            echo "</div>" ;
//            echo $query_status;

//            header("Location: VeranstaltungBetreiber.php");
        }
        else{
            $query_status = "Es ist ein Fehler beim Eintragen in den Kalender aufgetreten";
            echo "<div class='overlay'>" ;
            echo  "<div class='popup'>";
            echo "<h2>Fehler</h2>" ;
            echo "<a class='close' href='InterneVeranstaltungen.php'>&times;</a>" ;
            echo "<div class='content' >"  .$query_status."</div>";
            echo "</div>" ;
            echo "</div>" ;
            echo $query_status;
        }
    }

    else{
        $query_status = "Die Datenbankabfrage konnte nicht durchgeführt werden, da ein Session Fehler aufgetreten ist";
        echo "<div class='overlay'>" ;
        echo  "<div class='popup'>";
        echo "<h2>Fehler</h2>" ;
        echo "<a class='close' href='InterneVeranstaltungen.php'>&times;</a>" ;
        echo "<div class='content' >"  .$query_status."</div>";
        echo "</div>" ;
        echo "</div>" ;
    }
}

?>



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
        <button type="submit"  class="Auslösen" name="Reservieren"  value="Auswahl">Reservieren</button>
        <a href="../Startseiten/StartseiteBetreiber.php" type="button" class="Abbrechen">Abbrechen</a>
        </form>
    </div>



</div>
</body>
</html>

