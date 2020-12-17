<?php
session_start();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>

    <body>

<?php
//Variablen festgelegt
$curr_pw = $_SESSION["passwort"];
$curr_bid = $_SESSION["b_id"];

//datenbankverbindung
$db = mysqli_connect('132.231.36.109', 'dbuser', 'dbuser123', 'vms_db');


//Sessionvariablen initiiert
$query = "SELECT Strasse, Haus_nr, PLZ, Ort, Land FROM Teilnehmerkonto WHERE B_ID = $curr_bid";
$res = $db->prepare($query);
$res->execute();
$res->bind_result($Street,$Hausnr,$PLZ,$Ort,$Land);

while($res->fetch()) {
    $_SESSION["Strasse"] = $Street;
    $_SESSION["Hausnummer"] = $Hausnr;
    $_SESSION["PLZ"] = $PLZ;
    $_SESSION["Ort"] = $Ort;
    $_SESSION["Land"] = $Land;
}

//pw ändern
if (isset($_POST['änderung_pw_user_t'])) {


    $password_1 = md5(mysqli_real_escape_string($db, $_POST['passwortalt']));
    $password_2 = mysqli_real_escape_string($db, $_POST['passwortneu1']);
    $password_3 = mysqli_real_escape_string($db, $_POST['passwortneu2']);

    if ($password_1== $curr_pw) {
        echo 'Valides Passwort!';

        if ($password_2 != $password_3) {
            echo"The two new passwords do not match";
        }else {
            $query = "Update Benutzerkonto Set Passwort=md5($password_2) Where B_ID=$curr_bid";
            mysqli_query($db, $query);
        }

    } else {
        echo 'Invalides Passwort.';
    }

}


//email ändern
if (isset($_POST['änderung_email_user_t'])) {

    $email_1 = mysqli_real_escape_string($db, $_POST['email1']);
    $email_2 = mysqli_real_escape_string($db, $_POST['email2']);

    if ($email_1 != $email_2) {
        echo"The two new Emails do not match";
    }else {
        $query = "Update Benutzerkonto Set E_mail=$email_1 Where B_ID=$curr_bid";
        mysqli_query($db, $query);
    }
}


//daten ändern
if (isset($_POST['änderung_daten_user_t'])) {

    $street = mysqli_real_escape_string($db, $_POST['straße']);
    $hnummer = mysqli_real_escape_string($db, $_POST['hnummer']);
    $plz = mysqli_real_escape_string($db, $_POST['postleitzahl']);
    $ort = mysqli_real_escape_string($db, $_POST['ort']);
    $land = mysqli_real_escape_string($db, $_POST['land']);
    $tel = mysqli_real_escape_string($db, $_POST['telefonnummer']);

    $query_t = "Update Teilnehmerkonto Set Strasse=$street, Haus_nr=$hnummer, PLZ=$plz, Ort=$ort,
                Land=$land, Tel_nr=$tel Where B_ID=$curr_bid";
    mysqli_query($db, $query_t);


}


//account löschen
if (isset($_POST['del_account'])) {

    $query_check = 'SELECT Titel from Veranstaltung JOIN Teilnehmerliste_offen T on Veranstaltung.V_ID = T.V_ID 
                    Where Status = 1 or 2 or 3 And B_ID = $curr_bid';
    $result = mysqli_query($db,$query_check);

    if(!empty($result)){
        $query = "Update Benutzerkonto Set Status=2 Where B_ID=$curr_bid";
        mysqli_query($db, $query);
    }


}