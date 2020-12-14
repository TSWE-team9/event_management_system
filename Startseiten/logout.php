<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

<?php

//Session Variablen werden gelöscht
session_unset();

//Session wird beendet
session_destroy();

echo "Sie wurden erfolgreich ausgeloggt und können hier zurück zur Startseite gelangen:";
?>

<br>
<a href='../LandingPage/index.php'>Zur Startseite</a>
</body>
</html>