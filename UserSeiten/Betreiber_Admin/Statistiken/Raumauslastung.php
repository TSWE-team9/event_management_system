<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="../style/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Formular.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../style/Tabellen.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="seminarstatistik.css" media="screen" />
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
                    <option value=""></option>
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
        data: {
            labels: ["belegt", "freie Kapazität"],
            datasets: [
                {
                    label:"Raumauslastung",

                    backgroundColor: ["#f45702"],
            //Wert 1 : Raumbelegung innerhalb des ausgewählten Zeitraumes in Prozent
                    //Wert 2: 100% - belegter Zeitraum in % = freie Kapazität in %
                    data: [59, 100-59]
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

    </div>
</body>
</html>

