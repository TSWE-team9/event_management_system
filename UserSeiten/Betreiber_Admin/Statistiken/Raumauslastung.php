<?php
session_start();
include "RaumauslastungFunktion.php";

$host = '132.231.36.109';
$db = 'vms_db';
$user = 'dbuser';
$pw = 'dbuser123';

$conn = new mysqli($host, $user, $pw, $db,3306);
$temp = FALSE;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Formular.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Tabellen.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Statistik.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Fehlermeldung.css" media="screen" />
    <title>Raumauslastung</title>
    <script src="https://kit.fontawesome.com/23ad5628f9.js" crossorigin="anonymous"></script>
<!--    Einbindung von Chart.js für das Diagramm-->
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"></script>

</head>
<body>
<?php include '../Header/header.php'; ?>
<script>document.getElementById("Reiter_Statistiken").classList.add("active");  </script>

    <div class="grid-container" style=" grid-template-columns: 30% 60%;"

    <div class="grid-item">
    <form action="" method="post">
        <!--        Fomular zur Abfrage der Raumauslastung -->
        <div class="contact-us" >
            <h1> Raumauslastung</h1>
            <!-- Fomular Spalten -->
            <h3>
                <em>&#x2a; </em> Bitte den gewünschten Raum und Zeitraum auswählen um eine Abfrage zu starten .
            </h3>
                <!-- Auswahl des gewünschten Raumes aus der Datenbank-->
            <label for="Auswahl">Raum <em>&#x2a;</em></label>
            <div class="select-wrapper" style="margin-bottom: 3em; width:auto;">

                <select class="auswahl" name="Auswahl" id="Auswahl" style="background: none;">
                    <?php for($i = 0; $i<count($_SESSION["R_Array"]); $i++){?>
                        <option value="<?php echo $_SESSION["R_Array"][$i];?>"><?php echo $_SESSION["R_Array"][$i];?> </option>
                    <?php }?>
                </select>
            </div>
            <!-- Auswahl des gewünschten Zeitraumes        -->
            <label for="Startzeitraum">Startzeitraum <em>&#x2a;</em></label><input id="Startzeitraum" name="Startzeitraum" required="" type="date"/>
            <label for="Endzeitraum">Endzeitraum <em>&#x2a;</em></label><input id="Endzeitraum" name="Endzeitraum" required="" type="date"/>
            <button type="submit" class="Auslösen" name="Hinzufügen" style="margin-top: 0"> Abfragen</button>

    </form>
    </div>
            <div class="grid-item">
        <!--            Einbindung Diagramm-->
                <canvas id="myChart"></canvas>


            </div>
<!-- Java Scrip zur Erstellung des Diagrammes -->
<script>
    var chart  = document.getElementById('myChart').getContext('2d');
    var barChart= new Chart(chart, {
        type: 'doughnut',
        //Definieren der verwendeten Daten
        <?php
        if (isset($_POST['Hinzufügen'])) {
            $raum1 = $_POST['Auswahl'];
            $start1 = $_POST['Startzeitraum'];
            $ende1 = $_POST['Endzeitraum'];
            $temp = TRUE;


            $data_query1 = "SELECT DATEDIFF('$ende1','$start1')";
            $res1 = $conn->prepare($data_query1);
            $res1->execute();
            $res1->bind_result($count);
            $res1->fetch();
            $res1->close();

            if($count == 0){
                $count = 1;
            }


            $data_query2 = "SELECT SUM(DATEDIFF(Bis+1,Von)) FROM Kalender WHERE R_ID=(SELECT R_ID FROM Raum WHERE Bezeichnung='$raum1') And Status=1 Group by R_ID";
            $res2 = $conn->prepare($data_query2);
            $res2->execute();
            $res2->bind_result($kapa);

            while ($res2->fetch()){
                $kapa1 = $kapa;
                $kapa2 = $count-$kapa;
            }
            $res2->close();

            if(mysqli_num_rows($res2)==0){
             $kapa1= 0;
             $kapa2= $count;
            }


        }?>
        data: {
            <?php if($temp){?>
            labels: ["belegt", "freie Kapazität"],
            <?php }?>
            datasets: [
                {
                    label:"Raumauslastung",

                    backgroundColor: ["#f45702"],
            //Wert 1 : Raumbelegung innerhalb des ausgewählten Zeitraumes in Prozent
                    //Wert 2: 100% - belegter Zeitraum in % = freie Kapazität in %
                    data: [<?php echo $kapa1;?>, <?php echo $kapa2?>]
                }


            ],

        },
        //Styling Diagramm
        options: {
            legend: {
                display: true,
                position: "top"
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                        // lineWidth: 200,
                        color: "rgba(0, 0, 0, 0)"
                    },
                    ticks: {
                        display: false,
                        min: 0 ,
                        max: 100,
                        lineWidth: 7
                    }
                    // scaleLabel: {
                    //     display:true ,
                    //     labelString: "Raumauslastung",
                    //     fontColor: "black",
                    //     fontSize: 13
                    // }
                }],
                xAxes: [{
                    type: "percent",
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        display: false,
                    },

                }],
            }
        }
    })


</script>
<?php
if($count < 0){

    $text = "Endzeitraum liegt vor Startzeitraum";

echo "<div class='overlay'>" ;
    echo  "<div class='popup'>";
        echo "<h2>Fehler</h2>" ;
        echo "<a class='close' href='Raumauslastung.php'>&times;</a>" ;
        echo "<div class='content'>".$text."</div>";
        echo "</div>" ;
    echo "</div>" ;
}?>

    </div>
</body>
</html>

