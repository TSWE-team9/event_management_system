<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/Startseite.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../Angebotserstellung/InterneVeranstaltungen.css" media="screen" />
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
        <form action="../../Veranstaltungsseite/VeranstaltungsSeite.php" method="post">
            <input type="hidden" name="veranstaltung_id" value="<?php echo $i[0];?>">
            <button type="submit" class="btnveranstaltung" name="veranstaltung"><div class="btnbeginn"><?php echo $i[2];?></div><div class="btntitel"><?php echo $i[1];?></div></button>
        </form>

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