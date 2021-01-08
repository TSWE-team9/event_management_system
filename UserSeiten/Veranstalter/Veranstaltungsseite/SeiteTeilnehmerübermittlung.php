<?php
session_start();

//Verbindung zur Datenbank herstellen
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';
$conn = new mysqli($host, $user, $pw, $db,3306);


//Überprüfen ob es einen Verbindungsfehler gab
if($conn->connect_error){
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

//Abspeichern der V_ID nach Buttonklick von der Veranstaltungsseite
if(isset($_POST["teilnehmerliste_übermitteln"])){
    $_SESSION["V_ID"] = $_POST["veranstaltung_id"];
}

$V_ID = $_SESSION["V_ID"];

//Abfragen des Titels, Max. Teilnehmerzahl der Veranstaltung
$query = "SELECT Titel, Teilnehmer_max FROM Veranstaltung WHERE V_ID = $V_ID";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($titel,  $teilnehmer_max);
$res->fetch();
$res->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../CSS/listen.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/modal.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/veranstaltungen.css">
    <title>Veranstaltung</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
    <!--Importierung Excel library-->
    <script src="https://unpkg.com/read-excel-file@4.1.0/bundle/read-excel-file.min.js"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="../Startseite/VeranstalterStartseite.php">Startseite</a></li>
        <li><a href="../erstellenAnfrage/VeranstalterAnfrage.php">Angebot einholen</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a class="active" href="../eigeneVeranstaltungen/VeranstalterVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="float: right;"> <a href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li style="float: right;"> <a href="../Datenänderung/VeranstalterDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>
    </ul>
</nav>

<div class="container-50-outer">
    <h1 class="hdln"><?php echo $titel; ?></h1>
    <p class="txt">Um eine Teilnehmerliste von einer Excel Datei zu importieren, wählen Sie zuerst die Datei aus und importieren diese dann. Alternativ können Sie die Teilnehmerliste manuell eingeben.</p>

    <div class="container-80-inner">
        <h2 class="hdln">Importierung aus Excel Datei</h2>
            <label for="t_liste">Wählen Sie eine Datei aus:</label>
            <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="input" />
            <button style="float: right;" type="button" class="btn" onclick="fill()">Teilnehmerliste einlesen</button>

        <!--Button um zur Veranstaltungsseite zurückzukehren-->
        <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $V_ID; ?>">
            <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button> 
        </form>
    </div>

    <div class="container-80-inner">
        <h1 class="hdln">Manuelle Eingabe</h1>

        <div class="row">
            <div class="col-50">Nachname</div>
            <div class="col-50">Vorname</div>
        </div>
        <form action="SeiteTeilnehmerübermittlung.php" method="post">
            <input type="hidden" name="v_id" id="v_id" value="<?php echo $V_ID; ?>">
            <input type="hidden" id="t_max" value="<?php echo $teilnehmer_max; ?>">
            <!--Schleife für max anzahl-->
            <?php
            $counter = 1;
            while($counter <= $teilnehmer_max){
            ?>
            <div class="row">
                <div class="col-50"><input type="text" id="<?php echo "n".$counter; ?>" name="<?php echo "nachname".$counter; ?>"></div>
                <div class="col-50"><input type="text" id="<?php echo "v".$counter; ?>" name="<?php echo "vorname".$counter; ?>"></div>
            </div>
            <!--Schleife Ende-->
            <?php $counter++;}
            ?>
            <br>
            <button style="float: right;" type="button" name="liste-übermitteln" class="btn" onclick="document.getElementById('id02').style.display='block'">Teilnehmerliste übermitteln</button>

            <!--Modal wenn auf Importieren gedrückt wurde-->
            <div id="id02" class="modal">
                <div class="modal_content"> 
                    <div class="modal_container">
                        <h1>Teilnehmerübermittlung</h1>
                        <p>Falls bereits eine Teilnehmerliste übermittelt wurde, wird diese komplett mit der neuen Liste ersetzt.</p>
                        <p>Wollen Sie diese Teilnehmerliste übermitteln?</p>
                        <div class="modal_clearfix">
                            <button class="modal_btnconfirm" type="submit"  id="anmelden" name="liste-übermitteln" onclick="document.getElementById('id02').style.display='none'">Übermitteln</button>
                            <button class="modal_btnabort" type="button" onclick="document.getElementById('id02').style.display='none'">Abbrechen</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php
        //Abspeichern der manuell eingegebenen Teilnehmer
        if(isset($_POST["liste-übermitteln"])){

            //Alte Liste löschen
            $query = "DELETE FROM Teilnehmerliste_ges WHERE V_ID = $V_ID";
            $conn->query($query);

            //Variablen
            $counter = 1;
            $teilnehmer_nr = 1;
            $V_ID = $_POST["v_id"];

            while($counter <= $teilnehmer_max) {

                $nachname = $_POST["nachname".$counter];
                $vorname = $_POST["vorname".$counter];
                //echo "<br>"."<br>"."<br>"."<br>";
                //echo $nachname . $vorname;

                //Einfügen der Namen in die Teilnehmerliste
                if(!empty($nachname) && !empty($vorname)){

                    $query = "INSERT INTO Teilnehmerliste_ges VALUES ($V_ID, $teilnehmer_nr, '$nachname', '$vorname', LOCALTIMESTAMP)";
                    $res = $conn->query($query);
                    $teilnehmer_nr++;
                    if($res === FALSE){
                        echo "<br>"."<br>"."<br>"."<br>"."FEHLER aufgetreten beim manuellen Einfügen";
                    }
                }
                $counter++;

            }

            //Aktuelle Teilnehmerzahl in Veranstaltung aktualisieren
            $update_query = "UPDATE Veranstaltung SET Teilnehmer_akt=(SELECT COUNT(*) FROM Teilnehmerliste_ges WHERE Teilnehmerliste_ges.V_ID = $V_ID) WHERE V_ID = $V_ID";
            $res_update = $conn->query($update_query);
            if($res_update === FALSE){
                echo "<br>"."<br>"."<br>"."<br>"."FEHLER aufgetreten beim Update der akt. Teilnehmerzahl";
            }

        }

        ?>

        <!--Button um zur Veranstaltungsseite zurückzukehren-->
        <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $V_ID; ?>">
            <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button> 
        </form>

    </div>

</div>

<script src="SeiteTeilnehmerübermittlung.js"></script>

</body>
</html>