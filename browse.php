<?php
$page = 'browse';

require_once('template.php');

head();    
    
?><h1>Browse Traces</h1> <?

$tracing = new Tracing;
$tracing->drawTable();
?>

<script>
    <?
    if (isset($_GET['nc_area']) && strlen($_GET['nc_area']) > 0)
    {
      ?>
      function selectnc(){
        $('tr.tablesorter-filter-row td:nth-of-type(2) input').val('<?=urldecode($_GET['nc_area'])?>').trigger('blur');
      }
      setTimeout('selectnc()',1500);
      <?
    }
    if (isset($_GET['det_method']) && strlen($_GET['det_method']) > 0)
    {
      ?>
      function selectdet(){
        $('tr.tablesorter-filter-row td:nth-of-type(9) input').val('<?=$_GET['det_method']?>').trigger('blur');
      }
      setTimeout('selectdet()',1500);
      <?
    }
    if (isset($_GET['tracer']) && strlen($_GET['tracer']) > 0)
    {
      ?>
      function selecttracer(){
        $('tr.tablesorter-filter-row td:nth-of-type(8) input').val('<?=$_GET['tracer']?>').trigger('blur');
      }
      setTimeout('selecttracer()',1500);
      <?
    }
    if (isset($_GET['inj_point']) && strlen($_GET['inj_point']) > 0)
    {
      ?>
      function selectinj_point(){
        $('tr.tablesorter-filter-row td:nth-of-type(3) input').val('<?=$_GET['inj_point']?>').trigger('blur');
      }
      setTimeout('selectinj_point()',1500);
      <?
    }
    if (isset($_GET['det_point']) && strlen($_GET['det_point']) > 0)
    {
      ?>
      function selectdet_point(){
        $('tr.tablesorter-filter-row td:nth-of-type(6) input').val('<?=$_GET['det_point']?>').trigger('blur');
      }
      setTimeout('selectdet_point()',1500);
      <?
    }
    ?>
</script>

<?
foot();
