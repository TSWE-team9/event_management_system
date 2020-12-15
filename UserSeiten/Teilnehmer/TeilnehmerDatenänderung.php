!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Startseite.css" media="screen" />
    <title>Title</title>

    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <ul>
        <li><a href="TeilnehmerStartseite.php">Startseite</a></li>
        <li><a href="TeilnehmerAngebot">Veranstaltungsangebot</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Hilfe</a></li>
        <li><a href="TeilnehmerVeranstaltungen.php">Meine Veranstaltungen</a></li>
        <li style="text-align: right;"> <a href="../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li > <a class="active"> <i class="fas fa-user-circle"></i> </a></li>

    </ul>
</nav>

<link href="teilnehmer.css" type="text/css" rel="stylesheet">

<div class="box">

    <button class="accordion">Passwort ändern</button>
        <div class="panel">
            <form action="#" method="post">
                <br>
                <label for="passwortalt">altes Passwort</label>
                <input type="password" placeholder="altes Passwort" name="passwortalt" required>

                <label for="passwortneu1">neues Passwort</label>
                <input type="password" placeholder="neues Passwort" name="passwortneu1" required>

                <label for="passwortneu2">neues Passwort</label>
                <input type="password" placeholder="neues Passwort" name="passwortneu2" required>
                <br>
                <button class="button" type="submit" name="änderung_pw_user_t">Passwort ändern</button>
            </form>
        </div>
    
    <button class="accordion">E-Mail-Adresse ändern</button>
        <div class="panel">
            <form action="#" method="post">
                <br>
                <label for="email1">Neue E-Mail</label>
                <input type="email" placeholder="neue E-Mail-Adresse" name="email1" required>

                <label for="email2">E-Mail bestätigen</label>
                <input type="email" placeholder="neue E-Mail-Adresse" name="email2" required>
                <br>
                <button class="button" type="submit" name="änderung-email_user_t">E-Mail ändern</button>
        </div>

    <button class="accordion">Kontaktdaten ändern</button>  
        <div class="panel">
            <form action="#" method="post">

                <label for=""></label>
                <input type="text" placeholder="" name="">

                <label for=""></label>
                <input type="text" placeholder="" name="">

                <label for=""></label>
                <input type="text" placeholder="" name="">

                <label for=""></label>
                <input type="text" placeholder="" name="">

                <label for=""></label>
                <input type="text" placeholder="" name="">

                <label for=""></label>
                <input type="text" placeholder="" name="">
            </form>
        </div>
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