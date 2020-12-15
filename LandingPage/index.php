<?php include('register.php') ?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Landing Page</title>
        <meta charset="utf-8"/>
        <link href="landingpage.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div class="login-box">            
          <img id="logo" src="img/vmslogo.png">
            <br>
             <button class="accordion">Login</button>
                <div class="panel">
                  <form action="login.php" method="post">
                    <br>
                    <label for="email">E-Mail-Adresse</label>
                    <input type="email" placeholder="E-Mail-Adresse" name="email">

                    <label for="passwort">Passwort</label>
                    <input type="password" placeholder="Passwort" name="passwort">

                    <button class="login-button" type="submit" name="submit">Anmelden</button>
                  </form>
                </div>

            <button class="accordion">Registrieren als Teilnehmer</button>
              <div class="panel">
                <form action="#" method="post">
                    <?php include('errors_t.php'); ?>
                  <br>
                  <label for="email">E-Mail-Adresse</label>
                  <input type="email" placeholder="E-Mail-Adresse" name="email" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort" name="passwort_1" required>

                    <label for="passwort">Passwort</label>
                    <input type="password" placeholder="Passwort" name="passwort_2" required>

                  <label for="vorname">Vorname</label>
                  <input type="text" placeholder="Vorname" name="vorname" required>

                  <label for="nachname">Nachname</label>
                  <input type="text" placeholder="Nachname" name="nachname" required>

                  <label for="geburtsdatum">Geburtsdatum</label>
                  <input type="date" name="geburtsdatum">                 

                  <label for="geschlecht">Geschlecht</label>
                  <select name="geschlecht" required>
                    <option value=1>männlich</option>
                    <option value=2>weiblich</option>
                    <option value=3>divers</option>
                  </select>

                  <label for="straße">Straße</label>
                  <input type="text" placeholder="Straße" name="straße" required>

                    <label for="hnummer">Hausnummer</label>
                    <input type="text" placeholder="Hausnummer" name="hnummer" required>

                  <label for="postleitzahl">Postleitzahl</label>
                  <input type="text" placeholder="Postleitzahl" name="postleitzahl" required>

                  <label for="ort">Ort</label>
                  <input type="text" placeholder="Ort" name="ort" required>

                  <label for="land">Land</label>
                  <input type="text" placeholder="Land" name="land" required>

                  <label for="telefonnummer">Telefonnummer</label>
                  <input type="text" placeholder="Telefonnummer" name="telefonnummer">
                  <br>
                  <button class="login-button" type="submit" name="reg_user_t">Registrieren</button>
                  <br>
                </form>
              </div>

            <button class="accordion">Registrieren als Veranstalter</button>
              <div class="panel">
                <form action="#" method="post">
                    <?php include('errors_v.php'); ?>
                  <br>
                  <label for="email">E-Mail-Adresse</label>
                  <input type="email" placeholder="E-Mail-Adresse" name="email" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort" name="passwort_1" required>

                    <label for="passwort">Passwort</label>
                    <input type="password" placeholder="Passwort" name="passwort_2" required>

                  <label for="vorname">Vorname</label>
                  <input type="text" placeholder="Vorname" name="vorname" required>

                  <label for="nachname">Nachname</label>
                  <input type="text" placeholder="Nachname" name="nachname" required>

                  <label for="geburtsdatum">Geburtsdatum</label>
                  <input type="date" name="geburtsdatum">  

                  <label for="firmenname">Firmenname</label>
                  <input type="text" placeholder="Firmenname" name="firmenname" required>

                    <label for="straße">Straße</label>
                    <input type="text" placeholder="Straße" name="straße" required>

                    <label for="straße">Hausnummer</label>
                    <input type="text" placeholder="Hausnummer" name="hnummer" required>

                  <label for="postleitzahl">Postleitzahl</label>
                  <input type="text" placeholder="Postleitzahl" name="postleitzahl" required>

                  <label for="ort">Ort</label>
                  <input type="text" placeholder="Ort" name="ort" required>

                  <label for="land">Land</label>
                  <input type="text" placeholder="Land" name="land" required>

                  <label for="telefonnummer">Telefonnummer</label>
                  <input type="text" placeholder="Telefonnummer" name="telefonnummer">
                  <br>
                  <button class="login-button" type="submit" name="reg_user_v">Registrieren</button>
                  <br>
                </form>
              </div>

            <button id="veranstaltungen" href="#">Veranstaltungsangebot</button>

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

    </body>
</html>