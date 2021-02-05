<?php

//Fehler Array für Passwort Vergessen Funktion
$errors_pw = array();


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

//Button in index.php wurde geklickt
if(isset($_POST["pw_reset"])){

    //Abspeichern der eingegebenen Email und in Kleinbuchstaben umwandeln
    $email = $_POST["email"];
    $email = strtolower($email);

    //Überprüfen, ob Email zu einem Account im System existiert
    $query = "SELECT B_ID FROM Benutzerkonto WHERE E_mail='$email' AND Passwort IS NOT NULL ";
    $res = $conn->query($query);
    if($res->num_rows == 0){
        array_push($errors_pw, "Es existiert kein Account mit der angegebenen E-Mail-Adresse!");
    }
    //Zufallszahl generieren und als Passwort hashen
    else{
        $new_pw = rand(1000000000, 2000000000);
        $new_pw_hash = md5($new_pw);

        //Neues Passwort Einfügen in die Datenbank und an Nutzer per Mail senden
        while($i = $res->fetch_row()){
            $update_query = "UPDATE Benutzerkonto SET Passwort = '$new_pw_hash' WHERE B_ID = $i[0]";
            $res_update = $conn->query($update_query);
            if($res_update === TRUE){
                array_push($errors_pw, "Es wurde ein neues Passwort hinterlegt. Wir haben Ihnen dieses per Mail geschickt.");
                send_email($email, "Passwortänderung", "Ihr neues Passwort: " . $new_pw);
            }
        }

    }
}
