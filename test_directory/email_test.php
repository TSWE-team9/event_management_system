<?php

$empfaenger = "felixbaumgartner13@gmail.com";
$betreff = "Test";
$from = "From: VMS Grup9 <vms.grup9@gmail.com>";
$text = "Das ist ein Email Test. Es hat funktioniert.";

mail($empfaenger, $betreff, $text, $from);
echo "Die Email wurde versendet";
