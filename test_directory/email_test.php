<?php

$empfaenger = "felixbaumgartner13@gmail.com";
$betreff = "Test";
$from = "From: Felix Baumgartner <felixbaumgartner25@gmail.com>";
$text = "Das ist ein Email Test";

mail($empfaenger, $betreff, $text, $from);
