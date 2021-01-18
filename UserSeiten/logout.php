<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../UserSeiten/Betreiber_Admin/style/Fehlermeldung.css" media="screen" />
</head>

<body>

<?php

//Session Variablen werden gelöscht
session_unset();

//Session wird beendet
session_destroy();

$status = "Sie wurden erfolgreich ausgeloggt.";
echo "<div class='overlay'>" ;
echo  "<div class='popup'>";
echo "<h2>Info</h2>" ;
echo "<a class='close' href='../LandingPage/index.php'>&times;</a>" ;
echo "<div class='content' >" .$status."</div>";
echo "</div>" ;
echo "</div>";

?>

</body>
</html>
<style>
    body{
    background: url("Betreiber_Admin/style/Bild/door-5831240_1920.jpg") fixed ;
       background-size: contain;
        width: 100%;
        height: 100%;
        position: fixed;
    }
</style>