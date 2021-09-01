<?php
$page = 'search';

require_once('template.php');

head();    
    

?>
<h1>Search</h1>

<br><br>

  <form action="browse" method="get" role="form" class="form col-md-6">

    <div class="form-group">
    <? $tracing = new Tracing;
    $tracing->drawNortherncaves();?>
    </div>
    
    <div class="form-group">
    <select name="detection_method" id="detection_method" class="form-control">
      <option selected disabled>Detection Method</option>
      <option>Activated Charcoal</option>
      <option>Cotton Wool</option>
      <option>UV</option>
      <option>Excess of Chlorine</option>
      <option>Nesslers Reagent</option>
      <option>Nets</option>
      <option>No published details</option>
      <option>Not detected</option>
      <option>Silver nitrate and Pottasium chromate</option>
      <option>Visual</option>
    </select>
    </div>
    
    <div class="form-group">
    <select name="tracer" id="tracer" class="form-control">
      <option selected disabled>Tracer</option>
      <option>Ammonium Sulphate</option>
      <option>Artificial flood pulse</option>
      <option>Diffuse application of Herbicide</option>
      <option>Dye</option>
      <option>Fluorescein</option>
      <option>Leucophor</option>
      <option>Lycopodium spores</option>
      <option>Mine tailings</option>
      <option>Muddy Water</option>
      <option>No published details</option>
      <option>OBA</option>
      <option>Pyranine</option>
      <option>Rhodamine</option>
      <option>Sodium chloride</option>
    </select>
    </div>
    

    <div class="form-group">
    <input class="form-control" type="text" name="inj_point" id="inj_point" placeholder="Injection Point" />
    </div>
    
    <div class="form-group">
    <input class="form-control" type="text" name="det_point" id="det_point" placeholder="Detection Point" />
    </div>
    
    <div class="form-group">
    <input type="submit" name="go" value="Search" class="form-control btn btn-primary" style="width: 100px;" />
    </div>
    
  </form>


  <br><br><br><br><br><br>

<?
foot();
