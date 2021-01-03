<?php

//Diese Funktion liefert die Mail_Adresse des angemeldeten Benutzers
function get_mail_address($B_ID){

    //Verbindung zur DB herstellen
    $host = '132.231.36.109';
    $db = 'vms_db';
    $user = 'dbuser';
    $pw = 'dbuser123';

    $conn = new mysqli($host, $user, $pw, $db,3306);

    if($conn->connect_error){
        die('Connect Error (' . $conn->connect_errno . ') '
            . $conn->connect_error);
    }

    $query = "SELECT E_mail FROM Benutzerkonto WHERE B_ID = $B_ID";
    $res = $conn->prepare($query);
    $res->execute();
    $res->bind_result($email);
    $res->fetch();
    $res->close();

    return $email;
}

//Diese Funktion bekommt Empfänger, Nachricht und Betreff übergeben und schickt eine Mail ausgehend von der VMS Betreiber Mail
function send_email($empfaenger, $betreff, $nachricht){
    mail($empfaenger, $betreff, $nachricht, "From: VMS Grup9 <vms.grup9@gmail.com>");
}



