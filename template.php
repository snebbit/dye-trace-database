<?php
ob_start();
require_once('includes/inc.tracing.php');

function head()
{
global $page;
?>
  <html>
    <head>
      <title><?=_branding?> [<?=_branding_short?>] <?=ucfirst($page)?></title>
      <base href="<?=_base_url?>" />
      
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
      <link rel="stylesheet" href="includes/js/tablesorter/css/theme.default.min.css">
      <link rel="stylesheet" href="includes/css/ndtd.css">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      
      <script type="text/javascript" src="includes/js/tablesorter/js/jquery.tablesorter.js"></script>
      <script type="text/javascript" src="includes/js/tablesorter/js/jquery.tablesorter.pager.js"></script>
      <script type="text/javascript" src="includes/js/tablesorter/js/jquery.tablesorter.widgets.js"></script>
      <script type="text/javascript" src="includes/js/tablesorter/js/custom-pager-controls.js"></script>
      
    </head>
    
    <body>
      <div id="page" class="page-<?=$page?>">
        <header>
          <h1>
          <span class="logo"><?=_branding_short?></span>
          <span class="sublogo">
          <?=_branding?>
          </span>
          </h1> 
          
          <nav class="main">
            <ul>
              <li><a href="/" class="<? if ($page=='index') echo ' current';?>">Home</a>
              <li><a href="/browse" class="<? if ($page=='browse') echo ' current';?>">&#128210; Browse</a>
              <li><a href="/search" class="<? if ($page=='search') echo ' current';?>">🔍 Search</a>
              <li><a href="/map" class="<? if ($page=='map') echo ' current';?>">📌 Map</a>
              <li><a href="/data" class="<? if ($page=='data') echo ' current';?>">📊 Data</a>
              <li><a href="/about" class="<? if ($page=='about') echo ' current';?>">&#128172; Contact</a>
              <li><a href="/contribute" class="<? if ($page=='contribute') echo ' current';?>">➕ Contribute</a>
            </ul>
          </nav>
        
        </header>
        
        <aside>
        
        </aside>
        
        <div id="content" class="container">
          <div id="content-inner">
<?
}

function foot()
{
?>
          </div>
        </div>
      </div>
    
    </body>
  </html>
<?
ob_end_flush();
}
