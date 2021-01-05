<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF test</title>
</head>

<body>

<?php
    $phpArray = array(
        0 => "Hans", 
        1 => "Sepp", 
        2 => "Franz",
    )
?>


<p id="test"></p>


<script>
    // getting arrays
    var jArrayN = <?php echo json_encode($phpArray); ?>;
    // putting variable into html
    document.getElementById("test").innerHTML = jArray[0]:

</script>

</body>
</html>