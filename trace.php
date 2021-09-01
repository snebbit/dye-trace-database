<?php
$page = 'trace';

ini_set('display_errors',1);
require_once('template.php');

head();    

$id = (int)$_GET['id'];
$tr = new Tracing;
$trace = $tr->getTrace($id);

/*
$trace = [
  'id'=>1,
  'nc_area'=>'Easegill',
  'inj_point'=>'Pool Sink',
  'inj_grid'=>'SD123456',
  'det_point'=>'Green and Smelly Passage',
  'det_point_detail'=>'Choke at highest point',
  'det_grid'=>'SD123234',
  'tracer'=>'Fluorescein',
  'quantity'=>'5 litres',
  'det_method'=>'Cottonwool Detectors',
  'time'=>'5 hours',
  'distance'=>'1km',
  'average_velocity'=>'200m/hr',
  'depth'=>'23m',
  'date'=>'18/02/2007',
  'people'=>'Dave Stephenson',
  'ref'=>'Stephenson et al 2003',
  'notes'=>'Went well, very strong',
];
*/

?>
<h1>Trace #<?=$trace['serial']?>: <?=$trace['inj_point']?> <small>(<?=$trace['nc_area']?>)</small></h1>

<div class="row">
  <div class="col-sm-6">
    <h3>Locations</h3>
    <table class="table">
      <tbody>
        <tr>
          <td><img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png"></td>
          <td><b>Injection Point</b></td>
          <td><?=$trace['inj_point']?><br><?=$trace['inj_point_detail']?><br><small>[<?=$trace['inj_grid']?>]</small></td>
        </tr>
        <tr>
          <td><img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png"></td>
          <td><b>Detection Point</b></td>
          <td><?=$trace['det_point']?><br><?=$trace['det_point_detail']?><br><small>[<?=$trace['det_grid']?>]</small></td>
        </tr>        
      </tbody>
    </table>
  </div>
  <div class="col-sm-6">
    <h3>Methodoloy</h3>
    <table class="table">
      <tbody>
        <tr>
          <td><b>Tracer</b></td>
          <td><?=$trace['tracer']?></td>
        </tr>
        <tr>
          <td><b>Quantity</b></td>
          <td><?=$trace['quantity']?></td>
        </tr>
        <tr>
          <td><b>Detection Method</b></td>
          <td><?=$trace['det_method']?></td>
        </tr>
        <tr>
          <td><b></b></td>
          <td></td>
        </tr>
        
      </tbody>
    </table>
  </div>
  
</div>

<br>


<div class="row">
  <div class="col-sm-6">
    <h3>Results</h3>
    <table class="table">
      <tbody>
        <tr>
          <td><b>Time</b></td>
          <td><?=$trace['time']?></td>
        </tr>
        <tr>
          <td><b>Distance</b></td>
          <td><?=$trace['distance']?></td>
        </tr>
        <tr>
          <td><b>Average Velocity</b></td>
          <td><?=$trace['average_velocity']?></td>
        </tr>
        <tr>
          <td><b>Depth</b></td>
          <td><?=$trace['depth']?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-6">
    <h3>Test Details</h3>
    <table class="table">
      <tbody>
        <tr>
          <td><b>Date</b></td>
          <td><?=$trace['date']?></td>
        </tr>
        <tr>
          <td><b>Notes</b></td>
          <td><?=$trace['notes']?></td>
        </tr>
        <tr>
          <td><b>Test credit</b></td>
          <td><?=$trace['people']?></td>
        </tr>
        <tr>
          <td><b>References</b></td>
          <td><?=$trace['ref']?></td>
        </tr>
      </tbody>
    </table>
  </div>
  
</div>

<h3>Map</h3>
<?=$tr->drawMap(true)?>
<br><br><br><br>

<?
foot();
