<?php include('DatenänderungFunktionV.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--Importierung ausgelagerter CCS Dateien-->
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="VeranstalterDatenänderung.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/modal.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/popup.css">

    <title>Datenänderung</title>

    <!--Importierung einer externen JavaScript Bibliothek für Reitericons in der Reiterleiste-->
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>

<!--body der Seite mit Hintergrundbild 3-->
<body class="background3">

<!--Importierung der ausgelagerten Reiterleiste und stylen des aktuellen Reiters mit der CSS Klasse 'active'-->
<?php include '../header.php';?>
<script>document.getElementById("reiter_daten").classList.add("active");</script>


<div class="box">
    <!--Importierung der ausgelagerten PHP Funktionen
        Anzeige von Fehlermeldungen-->
    <?php if (count($errors_p) > 0){include('errorsDatenänderungV.php');} ?>
    <?php if (count($errors_e) > 0){include('errorsDatenänderungV.php');} ?>
    <?php if (count($errors_d) > 0){include('errorsDatenänderungV.php');} ?>
    <?php if (count($errors_del) > 0){include('errorsDatenänderungV.php');}?>


    <!--Button zum Anzeigen der "Passwort ändern" Eingabemaske-->
    <button class="accordion">Passwort ändern</button>
        <div class="panel">
            <!--Eingabemaske für "Passwort ändern"
                Eingabefelder für altes Passwort, neues Passwort und Wiederholen des neuen Passworts-->
            <form action="" method="post">
                <?php if (count($errors_p) > 0){
                    include('errorsDatenänderungV.php');} ?>
                <br>
                <label for="passwortalt">altes Passwort</label>
                <input type="password" placeholder="altes Passwort" name="passwortalt" pattern=".{10,50}" required>

                <label for="passwortneu1">neues Passwort</label>
                <input type="password" placeholder="neues Passwort mindestens 10 Zeichen" name="passwortneu1" pattern=".{10,50}" required>

                <label for="passwortneu2">neues Passwort</label>
                <input type="password" placeholder="neues Passwort mindestens 10 Zeichen" name="passwortneu2" pattern=".{10,50}" required>
                <br>

                <!--Button zum Absenden der Eingabedaten-->
                <button class="button" type="submit" name="änderung_pw_user_v">Passwort ändern</button>
            </form>
        </div>
    

    <!--Button zum Anzeigen der "E-Mail ändern" Eingabemaske-->
    <button class="accordion">E-Mail-Adresse ändern</button>
        <div class="panel">
            <!--Eingabemaske für "E-Mail ändern"
                Eingabefelder für E-Mail und Wiederholen der E-Mail-->
            <form action="#" method="post">
                <?php if (count($errors_e) > 0){
                    include('errorsDatenänderungV.php');} ?>
                <br>
                <label for="email1">Neue E-Mail</label>
                <input type="email" placeholder="neue E-Mail-Adresse" name="email1" maxlength="50" required>

                <label for="email2">E-Mail bestätigen</label>
                <input type="email" placeholder="neue E-Mail-Adresse" name="email2" maxlength="50" required>
                <br>

                <!--Button zum Absenden der Eingabedaten-->
                <button class="button" type="submit" name="änderung_email_user_v">E-Mail ändern</button>
            </form>
        </div>


    <!--Button zum Anzeigen der "Kontaktdaten aktualisieren" Eingabemaske-->
    <button class="accordion">Kontaktdaten aktualisieren</button>  
        <div class="panel">
            <!--Eingabemaske für "Kontaktdaten aktualisieren"
                Eingabefelder für Straße, Hausnummer, Postleitzahl, Ort, Land und Telefonnnummer
                die Eingabefelder enthalten beim Anzeigen der Eingabemaske die aktuellen Kontaktdaten-->
            <form action="#" method="post">
                <?php if (count($errors_d) > 0){
                    include('errorsDatenänderungV.php');} ?>

                <label for="straße">Straße</label>
                <input type="text" placeholder="Straße" name="straße" value='<?php echo $_SESSION['StrasseV'];?>' pattern="[A-Za-zäöüÄÖÜß ]{1,50}">

                <label for="hnummer">Hausnummer</label>
                <input type="text" placeholder="Hausnummer" name="hnummer" value='<?php echo $_SESSION['HausnummerV'];?>' pattern="[0-9a-z]{1,50}">

                <label for="postleitzahl">Postleitzahl</label>
                <input type="text" placeholder="Postleitzahl" name="postleitzahl" value='<?php echo $_SESSION['PLZV'];?>' pattern="[0-9]{1,50}">

                <label for="ort">Ort</label>
                <input type="text" placeholder="Ort" name="ort" value='<?php echo $_SESSION['OrtV'];?>' pattern="[A-Za-zäöüÄÖÜß ]{1,50}">

                <label for="land">Land</label>
                <input type="text" placeholder="Land" name="land" value='<?php echo $_SESSION['LandV'];?>' pattern="[A-Za-zäöüÄÖÜß ]{1,50}">

                <label for="telefonnummer">Telefonnummer</label>
                <input type="text" placeholder="Telefonnummer" name="telefonnummer" value='<?php echo $_SESSION['TelnummerV'];?>' pattern="[0-9]{1,50}">
                <br>

                <!--Button zum Absenden der Eingabedaten-->
                <button class="button" type="submit" name="änderung_daten_user_v">Kontaktdaten ändern</button>
            </form>
        </div>

    <!--Button zum Anzeigen des "Konto löschen" Fensters-->
    <button id="löschen" onclick="document.getElementById('id01').style.display='block'" name="acc_delete">Konto löschen</button>
    <div id="id01" class="modal">
        <form class="modal_content" action="#" method="post">
            <div class="modal_container">
                <h1>Kontolöschung</h1>
                <p>Wollen Sie ihr Konto wirklich löschen?</p>
                <div class="modal_clearfix">
                    <button class="modal_btnconfirm" type="submit" name="acc_delete" onclick="document.getElementById('id01').style.display='none'">Löschen</button>
                    <!--Button zur Bestätigung der Kontolöschung-->
                    <button class="modal_btnabort" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                    <!--Button zum Schließen des Fensters-->
                </div>
            </div>
        </form>
        <?php if (count($errors_del) > 0){include('errorsDatenänderungV.php');}?>
    </div>
</div>

<!--Importierung des ausgelagertes JavaScript Codes-->
<script src="VeranstalterDatenänderung.js"></script>

</body>
</html>