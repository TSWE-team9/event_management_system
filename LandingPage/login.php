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
//Login-Funktion

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

//Überprüfung ob Mail und Passwort einen Eintrag in der Datenbank haben
$query = "Select E_mail, Passwort , B_ID, Rolle FROM Benutzerkonto WHERE E_mail=? AND passwort=?";
$sql = $conn->prepare($query);
$pw = md5($_POST["passwort"]);
$email = strtolower($_POST["email"]);
$sql->bind_param("ss", $email, $pw);
$sql->execute();
$sql->bind_result($res_email, $res_passwort, $res_b_id, $res_rolle);

while($sql->fetch()) {

    //Abspeichern von Benutzerdaten in Session-Variablen
    if ($res_email == $email && $res_passwort == $pw) {
        $_SESSION["email"] = $res_email;
        $_SESSION["passwort"] = $res_passwort;
        $_SESSION["b_id"] = $res_b_id;
        $_SESSION["rolle"] = $res_rolle;
    }


    //Weiterleitung zur jeweiligen Startseite
    switch ($res_rolle){
        //Veranstalter ist Rolle 1
        case 1:
            header("Location: ../Startseiten/VeranstalterStartseite.html");
            break;
        //Teilnehmer ist Rolle 2
        case 2:
            header("Location: ../Startseiten/TeilnehmerStartseite.html");
            break;
        //Betreiber ist Rolle 3
        case 3:
            header("Location: ../Startseiten/StartseiteBetreiber.html");
            break;
        //Admin ist Rolle 4
        case 4:
            header("Location: ../Startseiten/StartseiteBetreiber.html");
            break;
    }

}

//Falls die Anmeldung misslingt, wird eine Fehlermeldung ausgegeben
echo "Es ist ein Fehler beim Login aufgetreten. Versuchen Sie es bitte erneut.";
$sql->close();


?>


</body>

</html>

