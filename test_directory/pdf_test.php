<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

<?php
    $phpArray = array(
        0 => "Mon", 
        1 => "Tue", 
        2 => "Wed", 
        3 => "Thu",
        4 => "Fri", 
        5 => "Sat",
        6 => "Sun",
    )
?>
<p id="test"></p>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js">
     var jArray = <?php echo json_encode($phpArray); ?>;

     document.getElementById("test").innerHTML = jArray[0];
</script>
</body>
</html>