<?php echo
'<nav>
    <ul class="header">
        <li class="headerel"><a class="headerel" id="Reiter_Startseite" href="../Startseiten/StartseiteBetreiber.php">Startseite</a></li>
        <li class="headerel"><a class="headerel" id="Reiter_Angebotserstellung" href="../Angebotserstellung/Angebotserstellung.php">Angebotserstellung</a></li>
        <li class="headerel"><a class="headerel" id="Reiter_Abrechnung" href="../Abrechnung/AbrechnungsSeite.php">Abrechnung</a></li>
        <li class="headerel"><a class="headerel" id="Reiter_Raumverwaltung" href="../Raumverwaltung/Raumverwaltung.php">Raumverwaltung</a></li>
        <li class="headerel"><a class="headerel" id="Reiter_MeineVeranstaltungen" href="../Angebotserstellung/InterneVeranstaltungen.php">Meine Veranstaltungen</a></li>
      

    <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn" id="Reiter_Statistiken">Statistiken</a>
    <div class="dropdown-content">
      <a href="#">Raumauslastung</a>
      <a href="../Statistiken/Seminarstatistik.php">Seminare</a>

    </div>
  </li>';
if($_SESSION["rolle"] == 4) {
    echo

    '<li class="headerel"><a href="http://132.231.36.109/phpmyadmin/index.php">Datenbank</a></li>
    <li class="headerel" style="float: right;"> <a href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>
        <li class="headerel" style="float:right;"> <a href="../../Betreiber_Admin/Betreiberaccount/b_account_erstellen.php"  > <i class="fas fa-user-circle" ></i> </a></li>';}
else{
        echo ' <li class="headerel" style="float: right;"> <a href="../../logout.php"> <i class="fas fa-sign-out-alt"></i> </a></li>';

    }
echo '
       
     
</ul>
</nav>';

 ?>



