!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <link href="teilnehmer.css" type="text/css" rel="stylesheet">
    <title>Title</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="TeilnehmerStartseite.php">Startseite</a></li>
        <li><a href="TeilnehmerAngebot.php">Veranstaltungsangebot</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a href="TeilnehmerVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="text-align: right;"> <a href="../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li> <a class="active" href="TeilnehmerDatenänderung.php"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>


<div class="box">

    <button class="accordion">Passwort ändern</button>
        <div class="panel">
            <form action="#" method="post">
                <br>
                <label for="passwortalt">altes Passwort</label>
                <input type="password" placeholder="altes Passwort" name="passwortalt" pattern=".{10,50}" required>

                <label for="passwortneu1">neues Passwort</label>
                <input type="password" placeholder="neues Passwort" name="passwortneu1" pattern=".{10,50}" required>

                <label for="passwortneu2">neues Passwort</label>
                <input type="password" placeholder="neues Passwort" name="passwortneu2" pattern=".{10,50}" required>
                <br>
                <button class="button" type="submit" name="änderung_pw_user_t">Passwort ändern</button>
            </form>
        </div>
    
    <button class="accordion">E-Mail-Adresse ändern</button>
        <div class="panel">
            <form action="#" method="post">
                <br>
                <label for="email1">Neue E-Mail</label>
                <input type="email" placeholder="neue E-Mail-Adresse" name="email1" maxlength="50" required>

                <label for="email2">E-Mail bestätigen</label>
                <input type="email" placeholder="neue E-Mail-Adresse" name="email2" maxlength="50" required>
                <br>
                <button class="button" type="submit" name="änderung_email_user_t">E-Mail ändern</button>
            </form>
        </div>

    <button class="accordion">Kontaktdaten aktualisieren</button>  
        <div class="panel">
            <form action="#" method="post">

                <label for="straße">Straße</label>
                <input type="text" placeholder="Straße" name="straße" pattern="[A-Za-z]{1,50}">

                <label for="hnummer">Hausnummer</label>
                <input type="text" placeholder="Hausnummer" name="hnummer" pattern="[0-9]{1,50}">

                <label for="postleitzahl">Postleitzahl</label>
                <input type="text" placeholder="Postleitzahl" name="postleitzahl" pattern="[0-9]{1,50}">

                <label for="ort">Ort</label>
                <input type="text" placeholder="Ort" name="ort" pattern="[A-Za-z]{1,50}">

                <label for="land">Land</label>
                <input type="text" placeholder="Land" name="land" pattern="[A-Za-z]{1,50}">

                <label for="telefonnummer">Telefonnummer</label>
                <input type="text" placeholder="Telefonnummer" name="telefonnummer" pattern="[0-9]{1,50}">
                <br>
                <button class="button" type="submit" name="änderung_daten_user_t">Kontaktdaten ändern</button>
            </form>
        </div>

    <button id="löschen" href="#">Konto löschen</button>
</div>


<script>
    var acc = document.getElementsByClassName("accordion");
    var i;
            
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
    </script>
<!--<footer>
   <div>
       <a href="#">Impressum</a>
        <a href="#">AGB</a> <br>
   VMS
  < /div>
</footer>-->

<div class="footer">
    <div id="button"></div>
    <div id="container">
        <div id="cont">
            <!--         <div class="footer_center">-->
            <!--                <h3>VMS</h3>-->
            <!--             <a href="AGB">AGB </a>-->
            <a class ="impressum " href="#"> Impressum </a>
            <a class ="agb"   href="#">AGB</a>

            <!-- agb col-xs-12 col-sm-3 col-sm-pull-6 -->
        </div>

    </div>
</div>


</body>
</html>