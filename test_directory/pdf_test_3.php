<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF test</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.69/pdfmake.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.69/vfs_fonts.js" crossorigin="anonymous"></script>
</head>

<body>

<?php
    $phpArrayN = array(
        0 => "Hans", 
        1 => "Sepp", 
        2 => "Franz",
    )
?>

<?php
$phpArrayV = array(
        0 => "Maier", 
        1 => "Huber", 
        2 => "Weber", 
    )
?>

<button type="button" onclick="genPDF()">Download</button>

<script>

    // getting arrays
    var jArrayN = <?php echo json_encode($phpArrayN); ?>;
    var jArrayV = <?php echo json_encode($phpArrayV); ?>;

    var combinedArray = [];
    for(var i = 0; i < jArrayN.length; i++) {
        var temp = [jArrayN[i], jArrayV[i]].join(" ");
        combinedArray.push(temp);
    }

    var titel = "Testveranstaltung";
    var header = ["Teilnehmerliste für die Veranstaltung:", titel].join(" ");

    var docDefinition = {
        content:[
            {text: header, style: 'header'},
            " ", 
            " ",
            combinedArray
        ],
        styles: {
            header: {
                fontSize: 22,
                bold: true,
                alignment: 'center'
            }
        }
    };

    function genPDF() {
        pdfMake.createPdf(docDefinition).download();
    }
</script>

</body>
</html>