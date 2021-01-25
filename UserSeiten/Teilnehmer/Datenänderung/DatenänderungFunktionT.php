<?php
session_start();
?>

<?php
//Variablen festgelegt
$curr_pw = $_SESSION["passwort"];
$curr_bid = $_SESSION["b_id"];
$errors_p = array();
$errors_e = array();
$errors_d = array();
$errors_del = array();
$notin1 = False;

//datenbankverbindung
$db = mysqli_connect('132.231.36.109', 'dbuser', 'dbuser123', 'vms_db');


//Sessionvariablen initiiert
$query = "SELECT Strasse, Haus_nr, PLZ, Ort, Land, Tel_nr FROM Teilnehmerkonto WHERE B_ID = $curr_bid";
$res = $db->prepare($query);
$res->execute();
$res->bind_result($Street,$Hausnr,$PLZ,$Ort,$Land,$Tel);

while($res->fetch()) {
    $_SESSION["Strasse"] = $Street;
    $_SESSION["Hausnummer"] = $Hausnr;
    $_SESSION["PLZ"] = $PLZ;
    $_SESSION["Ort"] = $Ort;
    $_SESSION["Land"] = $Land;
    $_SESSION["Telnummer"] = $Tel;
}
$res->close();

//passwort ändern
if (isset($_POST['änderung_pw_user_t'])) {


    $password_1 = md5(mysqli_real_escape_string($db, $_POST['passwortalt']));
    $password_2 = mysqli_real_escape_string($db, $_POST['passwortneu1']);
    $password_3 = mysqli_real_escape_string($db, $_POST['passwortneu2']);


    if ($password_1== $curr_pw) {

        if ($password_2 != $password_3) {
            array_push($errors_p, "passwort stimmt nicht überein");
        }else {
            $password_2 = md5($password_2);
            $query = "Update Benutzerkonto Set Passwort= '$password_2' Where B_ID=$curr_bid";
            $res = mysqli_query($db, $query);
            if($res === TRUE) {
                array_push($errors_p, "passwort wurde geändert");
                $_SESSION["passwort"] = $password_2;
            }
        }

    } else {
        array_push($errors_p, "Invalides Passwort");
    }

}


//email ändern
if (isset($_POST['änderung_email_user_t'])) {

    $email_1 = mysqli_real_escape_string($db, $_POST['email1']);
    $email_2 = mysqli_real_escape_string($db, $_POST['email2']);

    $query2 = "Select E_mail from Benutzerkonto WHERE E_mail='email_1'";
    $res23 = mysqli_query($db, $query);

    if(mysqli_num_rows($res23) == 0){
        $notin1 = True;
    }

    if ($email_1 != $email_2 or $notin1==False) {
        array_push($errors_e, "The two new Emails do not match or are already in use");
    }else {
        $query = "Update Benutzerkonto Set E_mail='$email_1' Where B_ID=$curr_bid";
        mysqli_query($db, $query);
        array_push($errors_e, "Email wurde geändert zu: " . $email_1);
    }
}


//daten ändern
if (isset($_POST['änderung_daten_user_t'])) {

    $street = $_POST['straße'];
    $hnummer = $_POST['hnummer'];
    $plz = $_POST['postleitzahl'];
    $ort = $_POST['ort'];
    $land = $_POST['land'];
    $tel = $_POST['telefonnummer'];

    $query_t = "Update Teilnehmerkonto Set Strasse='$street', Haus_nr='$hnummer', PLZ=$plz, Ort='$ort',
                Land='$land', Tel_nr=$tel Where B_ID=$curr_bid";
    mysqli_query($db, $query_t);
    array_push($errors_d, "Daten wurde geändert zu: " . $street . " ". $hnummer . " ". $plz . "...");


}


//account löschen
if (isset($_POST['acc_löschen'])) {

    $query_check = "SELECT V.V_ID FROM Veranstaltung V JOIN Teilnehmerliste_offen T on V.V_ID = T.V_ID
                    WHERE B_ID=$curr_bid AND V.Status IN (1,2,3)";

    $result = mysqli_query($db,$query_check);

    if(mysqli_num_rows($result) == 0){
        $query1 = "Update Benutzerkonto Set Status=2 Where B_ID=$curr_bid";
        mysqli_query($db, $query1);
        $query2 = "Update Benutzerkonto Set Passwort=NULL Where B_ID=$curr_bid";
        mysqli_query($db, $query2);
        // array_push($errors_del, "Benutzerkonto wurde gelöscht!");
        // Nachricht bei erfolgreicher Löschng
        echo 
        '<div class="overlay">
            <div class="popup">
                <h2  class="hdln">Kontolöschung erfolgreich</h2>
                <a class="close" href="../../../LandingPage/index.php">&times;</a>
                <div class="content">Sie haben ihr Nutzerkonto erfolgreich gelöscht.</div>
            </div>
        </div>';

    }else{
        array_push($errors_del, "Bitte melden Sie sich zu allen Veranstaltungen ab, um ihr Benutzerkonto zu löschen!");
    };


}