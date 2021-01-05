<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF test</title>
</head>

<body>

<?php
    $phpArrayN = array(
        0 => "Hans", 
        1 => "Sepp", 
        2 => "Franz",
    )

    $phpArrayV = array(
        0 => "Maier", 
        1 => "Huber", 
        2 => "Weber", 
?>
<p id="test"></p>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
<script>
    // getting arrays
    var jArrayN = <?php echo json_encode($phpArrayN); ?>;
    var jArrayV = <?php echo json_encode($phpArrayV); ?>;

    var combinedArray;
    for(var i = 0; i < jArrayN.length; i++) {
        var temp = [jArrayN[i], jArrayV[i]].join(" ");
        combinedArray.push(temp);
    }
    // putting variable into html
    document.getElementById("test").innerHTML = combinedArray[0]:

    import { jsPDF } from "jspdf";

    // Default export is a4 paper, portrait, using millimeters for units
    const doc = new jsPDF();
</script>
</body>
</html>