<?php include('DatenänderungFunktionV.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="VeranstalterDatenänderung.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/modal.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/popup.css">
    <title>Datenänderung</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body class="background3">
<?php include '../header.php';?>
<script>document.getElementById("reiter_daten").classList.add("active");</script>

<div class="box">
    <?php if (count($errors_p) > 0){include('errorsDatenänderungV.php');} ?>
    <?php if (count($errors_e) > 0){include('errorsDatenänderungV.php');} ?>
    <?php if (count($errors_d) > 0){include('errorsDatenänderungV.php');} ?>
    <?php if (count($errors_del) > 0){include('errorsDatenänderungV.php');}?>

    <button class="accordion">Passwort ändern</button>
        <div class="panel">
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
                <button class="button" type="submit" name="änderung_pw_user_v">Passwort ändern</button>
            </form>
        </div>
    
    <button class="accordion">E-Mail-Adresse ändern</button>
        <div class="panel">
            <form action="#" method="post">
                <?php if (count($errors_e) > 0){
                    include('errorsDatenänderungV.php');} ?>
                <br>
                <label for="email1">Neue E-Mail</label>
                <input type="email" placeholder="neue E-Mail-Adresse" name="email1" maxlength="50" required>

                <label for="email2">E-Mail bestätigen</label>
                <input type="email" placeholder="neue E-Mail-Adresse" name="email2" maxlength="50" required>
                <br>
                <button class="button" type="submit" name="änderung_email_user_v">E-Mail ändern</button>
            </form>
        </div>

    <button class="accordion">Kontaktdaten aktualisieren</button>  
        <div class="panel">
            <form action="#" method="post">
                <?php if (count($errors_d) > 0){
                    include('errorsDatenänderungV.php');} ?>

                <label for="straße">Straße</label>
                <input type="text" placeholder="Straße" name="straße" value='<?php echo $_SESSION['StrasseV'];?>' pattern="[A-Za-zäöüÄÖÜ ]{1,50}">

                <label for="hnummer">Hausnummer</label>
                <input type="text" placeholder="Hausnummer" name="hnummer" value='<?php echo $_SESSION['HausnummerV'];?>' pattern="[0-9a-z]{1,50}">

                <label for="postleitzahl">Postleitzahl</label>
                <input type="text" placeholder="Postleitzahl" name="postleitzahl" value='<?php echo $_SESSION['PLZV'];?>' pattern="[0-9]{1,50}">

                <label for="ort">Ort</label>
                <input type="text" placeholder="Ort" name="ort" value='<?php echo $_SESSION['OrtV'];?>' pattern="[A-Za-zäöüÄÖÜ ]{1,50}">

                <label for="land">Land</label>
                <input type="text" placeholder="Land" name="land" value='<?php echo $_SESSION['LandV'];?>' pattern="[A-Za-zäöüÄÖÜ ]{1,50}">

                <label for="telefonnummer">Telefonnummer</label>
                <input type="text" placeholder="Telefonnummer" name="telefonnummer" value='<?php echo $_SESSION['TelnummerV'];?>' pattern="[0-9]{1,50}">
                <br>
                <button class="button" type="submit" name="änderung_daten_user_v">Kontaktdaten ändern</button>
            </form>
        </div>

    <button id="löschen" onclick="document.getElementById('id01').style.display='block'" name="acc_delete">Konto löschen</button>
    <div id="id01" class="modal">
        <form class="modal_content" action="#" method="post">
            <div class="modal_container">
                <h1>Kontolöschung</h1>
                <p>Wollen Sie ihr Konto wirklich löschen?</p>
                <div class="modal_clearfix">
                    <button class="modal_btnconfirm" type="submit" name="acc_delete" onclick="document.getElementById('id01').style.display='none'">Löschen</button>
                    <button class="modal_btnabort" onclick="document.getElementById('id01').style.display='none'">Abbrechen</button>
                </div>
            </div>
        </form>
        <?php if (count($errors_del) > 0){include('errorsDatenänderungV.php');}?>
    </div>
</div>

<script src="VeranstalterDatenänderung.js"></script>

</body>
</html>