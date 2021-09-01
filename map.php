<?php
$page = 'map';
require_once('template.php');
head();    
$tracing = new Tracing;
    
?>
<h1>Map View</h1>

<p>
<img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png"> = Injection point &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png"> = Detection point
</p>

<?
$tracing->drawMap();

foot();
