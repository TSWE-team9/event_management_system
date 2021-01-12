<?php
session_start();

//Verbindung zur Datenbank herstellen
$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';
$conn = new mysqli($host, $user, $pw, $db,3306);

include "../../veranstaltung_refresh.php";
veranstaltung_refresh();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/InterneVeranstaltungen.css" media="screen" />
    <title>Title</title>
    <script src="../js/Tabs.js"></script>
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include '../Header/header.php'; ?>
<script>document.getElementById("Reiter_Startseite").classList.add("active");  </script>

<div class="ordnung">
    <div id="aktuelle" class="tabcontent" style="margin-left: 15em">
        <h3 style="text-align: center;">Aktuelle Veranstaltungen</h3>
        <?php
        $query_check = "SELECT V_ID, Beginn, Titel FROM Veranstaltung WHERE Status=1";
        $res_check = $conn->query($query_check);
        while($i = $res_check->fetch_row()){
        ?>
        <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
            <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo $i[1];?></div><div class="btntitel"><?php echo $i[2];?></div></button>
        </form>
        <?php }?>
    </div>

</div>
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