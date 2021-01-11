<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Excel test</title>
    <script src="https://unpkg.com/read-excel-file@4.1.0/bundle/read-excel-file.min.js"></script>
</head>
<body>

    <input type="file" id="input" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
    <p id="01">row1</p>
    <p id="02">row2</p>
    <p id="03">row3</p>
    <p id="04">row4</p>
    <button onclick="display()">anzeigen</button>
    <p id="anzahl"></p>
    <button onclick="fill()">füllen</button>

    <input type="hidden" name="v_id" id="v_id" value="<?php echo $V_ID; ?>">
    <input type="hidden" id="t_max" value="5">
    <!--Schleife für max anzahl-->
    <?php
    $counter = 1;
    while($counter <= 5){
    ?>
    <div class="row">
        <div style="width: 50%;"><input type="text" id="<?php echo "n".$counter; ?>" name="<?php echo "nachname".$counter; ?>"></div>
        <div style="width: 50%;"><input type="text" id="<?php echo "v".$counter; ?>" name="<?php echo "vorname".$counter; ?>"></div>
    </div>
    <!--Schleife Ende-->
    <?php $counter++;}
    ?>
<script>
    var input = document.getElementById("input");
    var arr = [];

    input.addEventListener('change', function() {
        readXlsxFile(input.files[0]).then((data) => {
            console.log(data);
            arr = data;
        });
    });

    function display() {
        document.getElementById("01").innerHTML = arr[0];
        document.getElementById("02").innerHTML = arr[1];
        document.getElementById("03").innerHTML = arr[2];
        document.getElementById("04").innerHTML = arr[3];
    }


    var max = document.getElementById("t_max").value;
    document.getElementById("anzahl").innerHTML = max;
    function fill() {
        for(var i = 1; i <= max; i++) {
            var n = ["n", i].join("");
            var v = ["v", i].join("");

            document.getElementById(n).value = arr[i-1][0];
            document.getElementById(v).value = arr[i-1][1];
        }
    }
</script>
</body>
</html>