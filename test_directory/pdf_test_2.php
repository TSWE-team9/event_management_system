<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF test</title>
</head>

<body>

<button type="button" onclick="genPDF()">Download</button>


<script src="https://unpkg.com/jspdf@2.2.0/dist/jspdf.umd.min.js"></script>
<script>

    function genPDF() {}
    // Default export is a4 paper, portrait, using millimeters for units
        const doc = new jsPDF();

        doc.text("Hello world!", 10, 10);
        doc.save("a4.pdf");
    }

</script>

</body>
</html>