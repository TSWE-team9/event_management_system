<?php
session_start();
include "../send_email.php";

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
if(isset($_POST["mitteilung"])){
    $_SESSION["V_ID"] = $_POST["veranstaltung_id"];
}

//Abspeichern der V_ID in lokaler Variable
$V_ID = $_SESSION["V_ID"];

//Abfragen des Titels der Veranstaltung
$query = "SELECT Titel FROM Veranstaltung WHERE V_ID = $V_ID";
$res = $conn->prepare($query);
$res->execute();
$res->bind_result($titel);
$res->fetch();
$res->close();

//Abspeichern der Daten aus dem Mitteilungsformular, Versenden der Mitteilung
if(isset($_POST["mitteilung_senden"])){
    $V_ID = $_POST["v_id"];
    $nachricht = $_POST["nachricht"];


    //Angemeldete Teilnehmer per Mail benachrichtigen (nur offene Veranstaltungen)
    $query = "SELECT B_ID FROM Teilnehmerliste_offen WHERE V_ID = $V_ID";
    $res = $conn->query($query);
    if($res->num_rows > 0){

        $betreff = "Mitteilung vom Veranstalter der Veranstaltung: " . $titel;

        while($i = $res->fetch_row()){
            $empfaenger = get_mail_address($i[0]);
            send_email($empfaenger, $betreff, $nachricht);
        }

        //Je nach Rolle anderer Link zurück zur Startseite
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

        // Erfolgsmeldung ausgeben und Weiterleitung zur Startseite
        echo "<div class='overlay'>" ;
        echo "<div class='popup'>";
        echo "<h2 class='hdln'>Mitteilung versendet</h2>" ;
        echo "<a class='close' href=".$href.">&times;</a>" ;
        echo "<div class='content'>Mitteilung wurde erfolgreich versendet.</div>";
        echo "</div>" ;
        echo "</div>" ;
    }

    // Fehlermeldung ausgeben
    else {
        echo 
            '<div class="overlay">
                <div class="popup">
                    <h2 class="hdln">Fehler Mitteilung</h2>
                    <a class="close" href="./SeiteMitteilung.php">&times;</a>
                    <div class="content">Fehler: Es wurden keine Nachrichten verschickt (Keine Teilnehmer bzw. Fehler bei der Abfrage).</div>
                </div>
            </div>';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../CSS/modal.css">
    <link rel="stylesheet" type="text/css" href="../CSS/listen.css">
    <link rel="stylesheet" type="text/css" href="../CSS/veranstaltungen.css">
    <link rel="stylesheet" type="text/css" href="../CSS/popup.css">
    <title>Veranstaltung</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body class="background2">

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
    <p class="txt">Hier können Sie eine Mitteilung mit maximal 300 Zeichen verfassen, welche an alle Teilnehmer ihrer Veranstaltung versendet werden.</p>

    <form action="SeiteMitteilung.php" method="post">
        <textarea name="nachricht" placeholder="Schreiben Sie hier den Inhalt ihrer Mitteilung" cols="30" rows="10" maxlength="300" required></textarea>
        
        <!--Button um die Mitteilungsversendung zu bestätigen-->
        <button class="btn" style="float: right;" type="button" name ="mitteilung_senden" onclick="document.getElementById('id01').style.display='block'">Mitteilung versenden</button>
        <!--Modal wenn Veranstalter auf Ablehnen klickt-->
        <div id="id01" class="modal">
            <div class="modal_content">
                <div class="modal_container">
                    <h1>Mitteilung versenden</h1>
                    <p>Wollen Sie diese Mitteilung an alle Teilnemer der Veranstaltung versenden?</p>
                    <div class="modal_clearfix">
                        <input type="hidden" name="v_id" value="<?php echo $V_ID; ?>">
                        <button class="modal_btnconfirm" type="submit" name="mitteilung_senden" onclick="document.getElementById('id01').style.display='none'">Versenden</button>
                        <button class="modal_btnabort" type="button" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                    </div>
                </div>           
            </div>
        </div>
    </form>

    <!--Button um zur Veranstaltungsseite zurückzukehren-->
    <form action="VeranstaltungsSeite.php" method="post">
        <input type="hidden" name="veranstaltung_id" value="<?php echo $V_ID; ?>">
        <button type="submit" class="btn" name="veranstaltung">zurück zur Veranstaltung</button> 
    </form>

</div>

<script src="SeiteMitteilung.js"></script>

</body>
</html>