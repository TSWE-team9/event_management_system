<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservierung</title>
    <link rel="stylesheet" type="text/css" href="Raumformularstylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="header.css" media="screen" />
</head>
<body >

<div class="contact-us">
    <h1> Raum Reservieren</h1>
    <!-- Fomular Spalten -->
    <h3>
        <em>&#x2a; </em> Bitte den gewünschten Raum aus der Liste auswählen.
    </h3>

    <div class="select-wrapper">
    <form action="" method="post">
        <select class="auswahl" name="Auswahl">
            <option value="">Raum</option>
        </select>
    </form>
    </div>
    <button type="submit"  class="Löschen" name=""  value="Select">Reservieren</button>
        <a href="#" type="button" class="Abbrechen">Abrechen</a>


    </div>

</body>

</html>

<style>
    .auswahl {
        width: 100%;
        height: 40px;
        /*-moz-padding-start: calc(10px - 3px);*/
        padding-left: 10px;
        background: url(fff-0-2.png) repeat;
        color: black;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.3);
        border-radius: 3px
        outline: none;
        cursor: pointer;
        position: relative;
        /*appearance: none;*/
        /*display: grid;*/
    }
    .select-wrapper {
        position: relative;
        width:20em;
    margin-bottom: 6em; }

    }
    .Löschen {
        display:block;
        float: right;
        line-height: 24pt;
        padding: 0 20px;
        border: none;
        background: #f45702;
        color: white;
        letter-spacing: 2px;
        transition: 0.2s all ease-in-out;
        border-bottom: 2px solid transparent;
        outline: none;
        margin-top: 30px;
        font-size: 14px;

    }
    .Löschen:hover {
        background: inherit;
        color: #f45702;
        border-bottom: 2px solid #f45702;
        cursor: pointer;
    }.
</style>