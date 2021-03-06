<?php
session_start();

//Default Wert für Benutzerrolle
$_SESSION["rolle"] = 0;

include('../UserSeiten/send_email.php');
include('register.php');
include('passwort_vergessen.php');
?>


<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Landing Page</title>
        <meta charset="utf-8"/>

        <!--Importierung ausgelagerter CCS Dateien-->
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="stylesheet" type="text/css" href="../UserSeiten/CSS/popup.css">

        <link rel="icon" type="image/gif"  href=" img/favicon.gif">
    </head>


    <body>
      <!--Importierung der ausgelagerten PHP Funktionen-->
      <?php include('errors_t.php'); ?>
      <?php include('errors_v.php'); ?>
      <?php include('login.php'); ?>
      <?php include "errors_pw.php" ?>


        <div class="login-box">
            
          <!--VMS Logo-->
          <img id="logo" src="img/vmslogo.png">
            <br>

            <!--Button zum Anzeigen der "Login" Eingabemaske-->
             <button class="accordion">Login</button>
                <div class="panel">
                  <!--Eingabemaske für "Login"
                      Eingabefelder für E-Mail und Passwort-->
                  <form action="#" method="post">
                    <br>
                    <label for="email">E-Mail-Adresse</label>
                    <input type="email" placeholder="E-Mail-Adresse" name="email" maxlength="50" required>

                    <label for="passwort">Passwort</label>
                    <input type="password" placeholder="Passwort" name="passwort" pattern=".{10,50}" required>

                    <!--Button zum Absenden der Eingabedaten-->
                    <button class="login-button" type="submit" name="login_submit">Anmelden</button>
                  </form>
                </div>


                <!--Button zum Anzeigen der "Passwort vergessen" Eingabemaske-->
                <button class="accordion">Passwort vergessen</button>
                  <div class="panel">
                      <!--Eingabemaske für "Passwort vergessen"
                      Eingabefeld für E-Mail-->
                      <form action="#" method="post">
                      <p>Geben Sie ihre E-Mail-Adresse an. Ihnen wird dann ein neues Passwort zugesendet, mit welchem Sie sich anmelden können.</p>
                        
                      <label for="email">E-Mail-Adresse</label>
                      <input type="email" placeholder="E-Mail-Adresse" name="email" maxlength="50" required>

                      <!--Button zum Absenden der Eingabedaten-->
                      <button class="login-button" type="submit" name="pw_reset">Passwort anfordern</button>
                    </form>
                  </div>
                

            <!--Button zum Anzeigen der "Registrieren als Teilnehmer" Eingabemaske-->
            <button class="accordion">Registrieren als Teilnehmer</button>
              <div class="panel">
                <!--Eingabemaske für "Registrieren als Teilnehmer"
                    Eingabefelder für E-Mail, Passwort, Passwort wiederholen, Vorname, Nachname, Geburtsdatum, Geschlecht, Straße, Hausnummer, Postleitzahl, Ort, Land und Telefonnummer-->
                <form action="#" method="post">
                  <br>
                  <label for="email">E-Mail-Adresse</label>
                  <input type="email" placeholder="E-Mail-Adresse" name="email" maxlength="50" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort mindestens 10 Zeichen" name="passwort_1" pattern=".{10,50}" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort mindestens 10 Zeichen" name="passwort_2" pattern=".{10,50}" required>

                  <label for="vorname">Vorname</label>
                  <input type="text" placeholder="Vorname" name="vorname" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="nachname">Nachname</label>
                  <input type="text" placeholder="Nachname" name="nachname" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="geburtsdatum">Geburtsdatum</label>
                  <input type="date" name="geburtsdatum" id="geb_t" required>                 

                  <label for="geschlecht">Geschlecht</label>
                  <select name="geschlecht" required>
                    <option value=1>männlich</option>
                    <option value=2>weiblich</option>
                    <option value=3>divers</option>
                  </select>

                  <label for="straße">Straße</label>
                  <input type="text" placeholder="Straße" name="straße" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="hnummer">Hausnummer</label>
                  <input type="text" placeholder="Hausnummer" name="hnummer" pattern="[0-9a-z]{1,50}" required>

                  <label for="postleitzahl">Postleitzahl</label>
                  <input type="text" placeholder="Postleitzahl" name="postleitzahl" pattern="[0-9]{1,50}" required>

                  <label for="ort">Ort</label>
                  <input type="text" placeholder="Ort" name="ort" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="land">Land</label>
                  <input type="text" placeholder="Land" name="land" pattern="[A-Za-zäöüÄÖÜß ]{1,50}"required>

                  <label for="telefonnummer">Telefonnummer</label>
                  <input type="text" placeholder="Telefonnummer" name="telefonnummer" pattern="[0-9]{1,50}">
                  <br>
                  <!--Button zum Absenden der Eingabedaten-->
                  <button class="login-button" type="submit" name="reg_user_t">Registrieren</button>
                  <br>
                </form>
              </div>

            <!--Button zum Anzeigen der "Registrieren als Veranstalter" Eingabemaske-->
            <button class="accordion">Registrieren als Veranstalter</button>
              <div class="panel">
                <!--Eingabemaske für "Registrieren als Veranstalter"
                    Eingabefelder für E-Mail, Passwort, Passwort wiederholen, Vorname, Nachname, Geburtsdatum, Firmenname, Straße, Hausnummer, Postleitzahl, Ort, Land und Telefonnummer-->
                <form action="#" method="post">
                  <br>
                  <label for="email">E-Mail-Adresse</label>
                  <input type="email" placeholder="E-Mail-Adresse" name="email" maxlength="50" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort mindestens 10 Zeichen" name="passwort_1" pattern=".{10,50}" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort mindestens 10 Zeichen" name="passwort_2" pattern=".{10,50}" required>

                  <label for="vorname">Vorname</label>
                  <input type="text" placeholder="Vorname" name="vorname" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="nachname">Nachname</label>
                  <input type="text" placeholder="Nachname" name="nachname" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="geburtsdatum">Geburtsdatum</label>
                  <input type="date" name="geburtsdatum" id="geb_v" required>  

                  <label for="firmenname">Firmenname</label>
                  <input type="text" placeholder="Firmenname" name="firmenname" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="straße">Straße</label>
                  <input type="text" placeholder="Straße" name="straße" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="straße">Hausnummer</label>
                  <input type="text" placeholder="Hausnummer" name="hnummer" pattern="[0-9a-z]{1,50}" required>

                  <label for="postleitzahl">Postleitzahl</label>
                  <input type="text" placeholder="Postleitzahl" name="postleitzahl" pattern="[0-9]{1,50}" required>

                  <label for="ort">Ort</label>
                  <input type="text" placeholder="Ort" name="ort" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="land">Land</label>
                  <input type="text" placeholder="Land" name="land" pattern="[A-Za-zäöüÄÖÜß ]{1,50}" required>

                  <label for="telefonnummer">Telefonnummer</label>
                  <input type="text" placeholder="Telefonnummer" name="telefonnummer" pattern="[0-9]{1,50}">
                  <br>

                  <!--Button zum Absenden der Eingabedaten-->
                  <button class="login-button" type="submit" name="reg_user_v">Registrieren</button>
                  <br>
                </form>
              </div>


            <!--Weiterleitung zum Veranstaltungsangebot für nicht registrierte Besucher-->
            <a href="../UserSeiten/Gast/Veranstaltungsangebot.php"><button id="veranstaltungen">Veranstaltungsangebot</button></a>

        </div>
            
        <!--Importierung des ausgelagertes JavaScript Codes-->
        <script src="index.js"></script>

    </body>
</html>