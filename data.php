<?php
$page = 'data';

require_once('template.php');

if (isset($_GET['download']))
{
  $tr = new Tracing;
  $tr->outputCsv();
}
else
{
  head();    
  ?>
  <h1>Data Downloads</h1>

  <p>
  The current complete dataset is available as a CSV download.<br><br>
  <a href="data?download=1" target="_blank" class="btn btn-primary">Download CSV</a>
  </p>


  <br><br><br><br><br><br>

  <?
  foot();
}
