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

//Abspeichern der V_ID in lokaler Variable
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
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../CSS/listen.css">
    <link rel="stylesheet" type="text/css" href="../CSS/modal.css">
    <link rel="stylesheet" type="text/css" href="../CSS/veranstaltungen.css">
    <link rel="stylesheet" type="text/css" href="../CSS/popup.css">
    <title>Teilnehmerübermittlung</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
    <!--Importierung Excel library-->
    <script src="https://unpkg.com/read-excel-file@4.1.0/bundle/read-excel-file.min.js"></script>
</head>
<body class="background3">

<?php
//Header unterscheidung
switch ($_SESSION["rolle"]){
    case 0: include './header/headerGast.php';               //header Gast
        break;
    case 1: include './header/headerVeranstalter.php';      // header Veranstalter
        break;
    case 2: include './header/headerTeilnehmer.php';        // header Teilnehmer
        break;
    case 3: include './header/headerBetreiber.php';          // header Betreiber
        break;
    case 4: include './header/headerAdmin.php';              // header Admin
        break;

}
?>

<div class="container-50-outer">
    <h1 class="hdln"><?php echo $titel; ?></h1>
    <p class="txt">Um eine Teilnehmerliste von einer Excel Datei zu importieren, wählen Sie zuerst die Datei aus und importieren diese dann. 
                    Dabei muss in der ersten Spalte der Excel Datei der Nachname stehen und in der zweiten Spalte der Vorname.
                    Falls mehr Teilnehmer in der Datei gespeichert sind als für die Veranstaltung zugelassen sind, werden nur soviele Teilnehmer eingelesen wie zugelassen. 
                    Die Namen werden dann in die Liste übernommen, wo diese überprüft werden können und im Anschluss übermittelt werden können.
                    Bei der Überprüfung werden nur Namen beachtet solange kein Nachnamefeld frei ist. Namen danach werden nicht überprüft und auch nicht übermittelt.</p>

    <div class="container-80-inner">
        <h2 class="hdln">Importierung aus Excel Datei</h2>
            <label for="t_liste">Wählen Sie eine Datei aus:</label>
            <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="input" />
            <button style="float: right;" type="button" class="btn" onclick="fill()">Teilnehmerliste einlesen</button>

        <!--Button um zur Veranstaltungsseite zurückzukehren-->
        <form action="VeranstaltungsSeite.php" method="post">
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
            <!--Schleife für max anzahl, Ausgabe der Eingabefelder bzw. bereits mit Namen aus Excel Import-->
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
        //Abspeichern der eingegebenen Teilnehmer
        if(isset($_POST["liste-übermitteln"])){

            //Variablen
            $counter = 1;
            $counter2 = 1;
            $teilnehmer_nr = 1;
            $V_ID = $_POST["v_id"];
            $vorname_array = array();
            $nachname_array = array();
            $status_empty = false;
            $status_meldung = "";

            //Jeweils die übergebenen Namen abspeichern
            while($counter <= $teilnehmer_max) {

                $nachname = $_POST["nachname".$counter];
                $vorname = $_POST["vorname".$counter];

                //Überprüfen, ob Nachname oder Vorname leer

                //Wenn Nachname fehlt, nur bis dahin die Liste übermitteln also break
                if(empty($nachname)){
                    break;
                }

                //Wenn Vorname fehlt, dann Meldung speichern
                if(empty($vorname)){
                    $status_empty = true;
                    $status_meldung = "Vorname ". $counter. " fehlt";
                    break;
                }

                //Wenn alles passt, dann speichern in ein Array für später
                if($status_empty == false){
                    array_push($nachname_array, $nachname);
                    array_push($vorname_array, $vorname);
                    }

                $counter++;
            }

            //Wenn ein Nachname oder Vorname nicht angegeben wurde, Fehlermeldung und alte Liste bleibt
            if($status_empty){

                echo "<div class='overlay'>" ;
                echo "<div class='popup'>";
                echo "<h2 class='hdln'>Fehler bei Übermittlung</h2>" ;
                echo "<a class='close' href='./SeiteTeilnehmerübermittlung.php'>&times;</a>" ;
                echo "<div class='content'>".$status_meldung."</div>";
                echo "</div>";
                echo "</div>";
            }

            //Wenn alles passt dann Einspeichern in Datenbank
            else{

                //Alte Liste löschen
                $query = "DELETE FROM Teilnehmerliste_ges WHERE V_ID = $V_ID";
                $conn->query($query);

                $i = 0;
                $query_status= true;

                //Einfügen der Namen in die Teilnehmerliste
                while($counter2 <= $teilnehmer_max){

                    $nachname = $nachname_array[$i];
                    $vorname = $vorname_array[$i];

                    if(!empty($nachname) && !empty($vorname)){

                    $query = "INSERT INTO Teilnehmerliste_ges VALUES ($V_ID, $teilnehmer_nr, '$nachname', '$vorname', LOCALTIMESTAMP)";
                    $res = $conn->query($query);
                    $teilnehmer_nr++;

                    //Fehlermeldung wenn Fehler (sollte nicht eintreten)
                        if($res === FALSE){

                            echo 
                            '<div class="overlay">
                                <div class="popup">
                                    <h2 class="hdln">Fehler bei Übermittlung</h2>
                                    <a class="close" href="./SeiteTeilnehmerübermittlung.php">&times;</a>
                                    <div class="content">FEHLER aufgetreten beim manuellen Einfügen.</div>
                                </div>
                            </div>';
                            $query_status = false;
                            break;
                        }
                    }
                    $i++;
                    $counter2++;
                }

                //Nur, wenn auch alles funktioniert hat
                if($query_status){

                    //Aktuelle Teilnehmerzahl in Veranstaltung aktualisieren
                    $update_query = "UPDATE Veranstaltung SET Teilnehmer_akt=(SELECT COUNT(*) FROM Teilnehmerliste_ges WHERE Teilnehmerliste_ges.V_ID = $V_ID) WHERE V_ID = $V_ID";
                    $res_update = $conn->query($update_query);
                    if($res_update === FALSE){

                        echo 
                        '<div class="overlay">
                            <div class="popup">
                                <h2 class="hdln">Fehler bei Übermittlung</h2>
                                <a class="close" href="./SeiteTeilnehmerübermittlung.php">&times;</a>
                                <div class="content">FEHLER aufgetreten beim Update der akt. Teilnehmerzahl</div>
                            </div>
                        </div>';
                    }

                    //Fallunterscheidung der Links zur Startseite
                    $href = "";
                    if($_SESSION["rolle"] == 1){
                        $href = "../Veranstalter/Startseite/VeranstalterStartseite.php";
                    }
                    if($_SESSION["rolle"] == 3){
                        $href = "../Betreiber_Admin/Startseiten/StartseiteBetreiber.php";
                    }
                    if($_SESSION["rolle"] == 4){
                        $href = "../Betreiber_Admin/Startseiten/StartseiteBetreiber.php";
                    }

                    // Nachricht erfolgreiche Übermittlung
                    echo "<div class='overlay'>" ;
                    echo "<div class='popup'>";
                    echo "<h2 class='hdln'>Teilnehmerübermittlung</h2>" ;
                    echo "<a class='close' href=".$href.">&times;</a>" ;
                    echo "<div class='content'>Die Teilnehmerliste wurde erfolgreich übermittelt.</div>";
                    echo "</div>";
                    echo "</div>";

                }
            }
        }

        ?>

        <!--Button um zur Veranstaltungsseite zurückzukehren-->
        <form action="VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $V_ID; ?>">
            <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button> 
        </form>

    </div>

</div>

<script src="SeiteTeilnehmerübermittlung.js"></script>

</body>
</html>