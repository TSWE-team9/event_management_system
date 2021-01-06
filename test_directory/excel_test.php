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
    <button onclick="display()">click me</button>
<script>
    var input = document.getElementById("input");
    var arr;

    input.addEventListener('change', function() {
        readXlsxFile(input.files[0]).then(function(data) {
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
</script>
</body>
</html>