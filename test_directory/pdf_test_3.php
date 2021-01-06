<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF test</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.69/pdfmake.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.69/vfs_fonts.js" crossorigin="anonymous"></script>
</head>

<body>

<button type="button" onclick="genPDF()">Download</button>



<script>

    var dl = ["hello", "there"];

    var docDefinition = {dl};

    function genPDF() {
        pdfMake.createPdf(docDefinition).download();
    }
</script>

</body>
</html>