<?php
$page = 'index';

require_once('template.php');

head();    
    
?>
<h1><?=_branding?></h1>

<br>

<p>
[]
</p>

<br>

  <div class="row">
    <div class="col-sm-4">
      <a class="home-link" href="browse">
        <span class="icon">&#128210;</span>
        <span class="title">Browse List</span>
      </a>
    </div>
    
    <div class="col-sm-4">
      <a class="home-link" href="search">
        <span class="icon">&#128269;</span>
        <span class="title">Search Traces</span>
      </a>
    </div>
    
    <div class="col-sm-4">
      <a class="home-link" href="map">
        <span class="icon">&#128204;</span>
        <span class="title">Map View</span>
      </a>
    </div>
    
    <div class="col-sm-4">
      <a class="home-link" href="data">
        <span class="icon">&#128202;</span>
        <span class="title">Download Data</span>
      </a>
    </div>
    
    <div class="col-sm-4">
      <a class="home-link" href="about">
        <span class="icon">&#128172;</span>
        <span class="title">Contact/About</span>
      </a>
    </div>
    
    <div class="col-sm-4">
      <a class="home-link" href="contribute">
        <span class="icon">&#10133;</span>
        <span class="title">Contribute a Trace</span>
      </a>
    </div>
    
  </div>
  <br><br><br>

<div><div>
<?

foot();
