
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raumlöschen</title>
    <link rel="stylesheet" type="text/css" href="Raumlöschen.css" media="screen" />
</head>
    <body>

<div class="contact-us">
    <h1> Raum Löschen</h1>

    <h3>
        <em>&#x2a; </em> Bitte gewünschten Raum und Löschen auswählen.
    </h3>


        <form action="#">
    <label for="Raumbezeichnung">Raumbezeichnung <em>&#x2a;</em></label><input id="Raumbezeichnung" name="Raumbezeichnung" required="" type="text"/>
    <fieldset id = "Status">
        <label for = "Status"> Raumstatus <em>&#x2a;</em></label>
<!--    <input type= "radio" id="aktiv" name="Status" value="aktiv">-->
<!--    <label for="aktiv"> aktiv</label>-->
    <input type="radio" id="inaktiv" name="Status" value="inaktiv">
    <label for="inaktiv"> inaktiv</label>
    </fieldset>
<!--    <label for="Raumstatus">Raumstatus<em>&#x2a;</em></label><input id="Raumstatus" name="Raumstatus" required="" type="Number"  />-->
<!--    <form action="select.html">-->
<!--    <label>Raumstatus:-->
<!--        <select name="Status" size="2">-->
<!--            <option>aktiv</option>-->
<!--            <option>inaktiv</option>-->
<!--        </select>-->
<!--    </label>-->
<!--    </form>-->



<!--    <button id="Löschen">Löschen</button>-->

            <button type="submit" class="Löschen" formaction="#">Löschen</button>
<!--            <method="post">-->
<!--            <input type="submit"  class="Löschen"  name="ausfuehren" value="Löschen"/>-->
<!--            </method>-->
            <a href="#" type="button" class="Abbrechen">Abbrechen</a>


</form>

