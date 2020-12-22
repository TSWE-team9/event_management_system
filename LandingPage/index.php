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
                    <input type="email" placeholder="E-Mail-Adresse" name="email" maxlength="50" required>

                    <label for="passwort">Passwort</label>
                    <input type="password" placeholder="Passwort" name="passwort" pattern=".{10,50}" required>

                    <button class="login-button" type="submit" name="submit">Anmelden</button>
                  </form>
                </div>

                <button class="accordion">Passwort vergessen</button>
                  <div class="panel">
                    <form action="#" method="post">
                      <p>Geben Sie ihre E-Mail-Adresse an. Ihnen wird dann ein neues Passwort zugesendet, mit welchem Sie sich anmelden können.</p>
                        
                      <label for="email">E-Mail-Adresse</label>
                      <input type="email" placeholder="E-Mail-Adresse" name="email" maxlength="50" required>

                      <button class="login-button" type="submit" name="pw_reset">Passwort anfordern</button>
                    </form>
                  </div>
                

            <button class="accordion">Registrieren als Teilnehmer</button>
              <div class="panel">
                <form action="#" method="post">
                  <?php include('errors_t.php'); ?>
                  <br>
                  <label for="email">E-Mail-Adresse</label>
                  <input type="email" placeholder="E-Mail-Adresse" name="email" maxlength="50" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort" name="passwort_1" pattern=".{10,50}" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort" name="passwort_2" pattern=".{10,50}" required>

                  <label for="vorname">Vorname</label>
                  <input type="text" placeholder="Vorname" name="vorname" pattern="[A-Za-z]{1,50}" required>

                  <label for="nachname">Nachname</label>
                  <input type="text" placeholder="Nachname" name="nachname" pattern="[A-Za-z]{1,50}" required>

                  <label for="geburtsdatum">Geburtsdatum</label>
                  <input type="date" name="geburtsdatum" id="geb_t" required>                 

                  <label for="geschlecht">Geschlecht</label>
                  <select name="geschlecht" required>
                    <option value=1>männlich</option>
                    <option value=2>weiblich</option>
                    <option value=3>divers</option>
                  </select>

                  <label for="straße">Straße</label>
                  <input type="text" placeholder="Straße" name="straße" pattern="[A-Za-z]{1,50}" required>

                  <label for="hnummer">Hausnummer</label>
                  <input type="text" placeholder="Hausnummer" name="hnummer" pattern="[0-9]{1,50}" required>

                  <label for="postleitzahl">Postleitzahl</label>
                  <input type="text" placeholder="Postleitzahl" name="postleitzahl" pattern="[0-9]{1,50}" required>

                  <label for="ort">Ort</label>
                  <input type="text" placeholder="Ort" name="ort" pattern="[A-Za-z]{1,50}" required>

                  <label for="land">Land</label>
                  <input type="text" placeholder="Land" name="land" pattern="[A-Za-z]{1,50}"required>

                  <label for="telefonnummer">Telefonnummer</label>
                  <input type="text" placeholder="Telefonnummer" name="telefonnummer" pattern="[0-9]{1,50}">
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
                  <input type="email" placeholder="E-Mail-Adresse" name="email" maxlength="50" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort" name="passwort_1" pattern=".{10,50}" required>

                  <label for="passwort">Passwort</label>
                  <input type="password" placeholder="Passwort" name="passwort_2" pattern=".{10,50}" required>

                  <label for="vorname">Vorname</label>
                  <input type="text" placeholder="Vorname" name="vorname" pattern="[A-Za-z]{1,50}" required>

                  <label for="nachname">Nachname</label>
                  <input type="text" placeholder="Nachname" name="nachname" pattern="[A-Za-z]{1,50}" required>

                  <label for="geburtsdatum">Geburtsdatum</label>
                  <input type="date" name="geburtsdatum" id="geb_v" required>  

                  <label for="firmenname">Firmenname</label>
                  <input type="text" placeholder="Firmenname" name="firmenname" pattern="[A-Za-z]{1,50}" required>

                  <label for="straße">Straße</label>
                  <input type="text" placeholder="Straße" name="straße" pattern="[A-Za-z]{1,50}" required>

                  <label for="straße">Hausnummer</label>
                  <input type="text" placeholder="Hausnummer" name="hnummer" pattern="[0-9]{1,50}" required>

                  <label for="postleitzahl">Postleitzahl</label>
                  <input type="text" placeholder="Postleitzahl" name="postleitzahl" pattern="[0-9]{1,50}" required>

                  <label for="ort">Ort</label>
                  <input type="text" placeholder="Ort" name="ort" pattern="[A-Za-z]{1,50}" required>

                  <label for="land">Land</label>
                  <input type="text" placeholder="Land" name="land" pattern="[A-Za-z]{1,50}" required>

                  <label for="telefonnummer">Telefonnummer</label>
                  <input type="text" placeholder="Telefonnummer" name="telefonnummer" pattern="[0-9]{1,50}">
                  <br>
                  <button class="login-button" type="submit" name="reg_user_v">Registrieren</button>
                  <br>
                </form>
              </div>

            <button id="veranstaltungen" href="#">Veranstaltungsangebot</button>

        </div>
            

        <script>
          // accordion start
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
          // accordion end
          
          // function to subtract years from current date -> used for age verification
          function subtractYears(date, years) {
            var result = new Date(date);
            result.setFullYear(result.getFullYear() - years);
            return result;
          }

          // formats date to html format
          function dateToHtml(date) {
            var result = [date.getFullYear(), date.getMonth()+1, date.getDate()].join("-");
            return result;
          }
          
          // age must be 18
          var currentDate = new Date();
          var maxDate = dateToHtml(subtractYears(currentDate, 18));
          var maxT = document.getElementById("geb_t").max = maxDate;
          var maxV = document.getElementById("geb_v").max = maxDate;

          </script>

    </body>
</html>