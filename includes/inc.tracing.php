<?php

@require_once('config.php');
@require_once('includes/config.php');

class Tracing{

  private $db;
  public $data;
  public $fields;
  public $filters;
  public $dataSource = 'example-import.csv';
  private $loadSource = 'db'; // csv or db
  
  public $ncAreas = ['Alston',
        'Alum Pot',
        'Barbondale',
        'Birkwith',
        'Brough',
        'Bruntscar',
        'Chapel-le-Dale',
        'Cosh and Foxup',
        'Darnbrook and Cowside',
        'Dentdale and Garsdale',
        'Ease Gill',
        'East Kingsdale',
        'Fountains Fell',
        'Gaping Gill',
        'Grassington',
        'Great Whernside',
        'Ingleborough',
        'Langstrothdale',
        'Leck Fell',
        'Lower Littondale',
        'Malham',
        'Marble Steps',
        'Newby Moss',
        'Nidderdale',
        'Park Fell',
        'Penyghent',
        'Penyghent Gill',
        'Ribblehead',
        'Scales Moor',
        'Stump Cross',
        'Swaledale and Arkengarthdale',
        'The Allotment',
        'Upper Littondale',
        'Upper Wharfedale',
        'Vale of Eden',
        'Weardale',
        'West Kingsdale',
        'Wensleydale',
        'Wharfedale',
        'White Scar',
        'Wild Boar Fell'];

  public function __construct()
  {
  
    $this->db = new mysqli(_db_host, _db_user, _db_pass, _db_db, _db_port);
  
    $this->fields = [
      'serial'=>[
        'filter'=>false,
        'sort'=>'int',
        'label'=>'Serial No.',
        'csvCol'=>0,
        'locked'=>true
      ],
      'nc_area'=>[
        'filter'=>true,
        'sort'=>'string',
        'label'=>'Northern Caves Area',
        'csvCol'=>1,
        'type'=>'ncarea',
      ],
      'inj_point'=>[
        'filter'=>false,
        'sort'=>'string',
        'label'=>'Injection Point',
        'csvCol'=>2,
      ],
      'inj_point_detail'=>[
        'filter'=>false,
        'sort'=>'string',
        'label'=>'Injection Point Detail',
        'csvCol'=>3,
      ],
      'inj_grid'=>[
        'filter'=>false,
        'sort'=>'string',
        'label'=>'Inj. Grid',
        'csvCol'=>4,
      ],
      'det_point'=>[
        'filter'=>false,
        'sort'=>'string',
        'label'=>'Detection Point',
        'csvCol'=>5,
      ],
      'det_point_detail'=>[
        'filter'=>false,
        'sort'=>false,
        'label'=>'Det. Point Notes',
        'csvCol'=>6,
        'summaryHide'=>1,
      ],
      'det_grid'=>[
        'filter'=>false,
        'sort'=>'string',
        'label'=>'Det. Grid',
        'csvCol'=>7,
      ],
      'tracer'=>[
        'filter'=>true,
        'sort'=>'string',
        'label'=>'Tracer',
        'csvCol'=>8,
      ],
      'quantity'=>[
        'filter'=>false,
        'sort'=>'string',
        'label'=>'Quantity',
        'csvCol'=>9,
        'summaryHide'=>1,
      ],
      'det_method'=>[
        'filter'=>true,
        'sort'=>'string',
        'label'=>'Detection Method',
        'csvCol'=>10,
      ],
      'time'=>[
        'filter'=>false,
        'sort'=>'string',
        'label'=>'Time',
        'csvCol'=>11,
      ],
      'distance'=>[
        'filter'=>false,
        'sort'=>'float',
        'label'=>'Distance',
        'csvCol'=>12,
      ],
      'average_velocity'=>[
        'filter'=>false,
        'sort'=>'float',
        'label'=>'Average Velocity',
        'csvCol'=>13,
        'summaryHide'=>1,
      ],
      'depth'=>[
        'filter'=>false,
        'sort'=>'float',
        'label'=>'Depth',
        'csvCol'=>14,
      ],
      'date'=>[
        'filter'=>false,
        'sort'=>false,
        'label'=>'Date',
        'csvCol'=>15,
        'type'=>'date',
      ],
      'people'=>[
        'filter'=>false,
        'sort'=>false,
        'label'=>'People',
        'csvCol'=>16,
      ],
      'ref'=>[
        'filter'=>false,
        'sort'=>false,
        'label'=>'References',
        'csvCol'=>17,
        'summaryHide'=>1,
        'type'=>'textbox',
      ],
      'notes'=>[
        'filter'=>false,
        'sort'=>false,
        'label'=>'Notes',
        'csvCol'=>18,
        'summaryHide'=>1,
        'type'=>'textbox',
      ]
    ];
    $this->loadData();
    
  }
    
  private function loadData()
  {
    if  ($this->loadSource == 'csv')
    {
      $row = 1;
      if (($handle = fopen($this->dataSource, "r")) !== FALSE) {
          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
              if ($row == 1){
                $row++;
                continue;
              }
              $rowData = [];
              foreach ($this->fields as $key=>$field)
              {
                  $csvCol = $field['csvCol'];
                  $rowData[$key] = ['label'=>$field['label'], 'value' => $data[$csvCol], 'summaryHide'=>$field['summaryHide']];
              }
              $this->data[]=$rowData;
             
          }
          $row++;
          fclose($handle);
      }
    }
    else
    {
      $this->data = $this->getTraces();
    }
  }
  
  
  private function importToDb()
  {
    $qstring = '';
    foreach ($this->data as $rowData)
    {
      $qstring= "INSERT INTO `traces` (";
      $fieldArr = [];
      $varArr = [];
        foreach ($this->fields as $key=>$field)
        {
          $fieldArr[]= '`' . $key . '`';
          $varArr[]= "'" . addslashes($rowData[$key]['value']) . "'";
        }
      
      $qstring.= implode(",", $fieldArr);
      $qstring.= ") VALUES (";
      $qstring.= implode(",", $varArr);
      $qstring.= ");\r\n";
            
       $this->query($qstring);
       echo 'Done ' . $rowData['serial']['value'] .'<br>';
     }
  }
  
  public function getTrace($id)
  {
    $id = (int)$id;
    $arr = mysqli_fetch_assoc($this->query("SELECT * FROM `traces` where `serial` = '$id' LIMIT 1"));
    $outArr = [];
    foreach ($arr as $key=>$val)
    {
      $outArr[$key] = ['label'=>$this->fields[$key]['label'], 'value'=> $val];
    }
    $this->data = [$outArr];
    return $arr;
  }
  
  public function getTraces()
  {
    if ($this->getCacheExists('traces'))
    {
      return json_decode($this->getCache('traces'), true);
    }
    else
    {
      $re = $this->query("SELECT * FROM `traces` order by serial asc");
      $res = [];
      while ($row = mysqli_fetch_assoc($re))
      {
        $rowData = [];
        foreach ($row as $key=>$val)
        {
          $rowData[$key] = ['label'=> $this->fields[$key]['label'], 'value'=> $val];
        }
        $res[]= $rowData;
      }
      $this->nukeCache('traces');
      $this->setCache('traces', json_encode($res));
      return $res;
    }
  }
  
  
  private function query($qstring)
  {
    $res = mysqli_query($this->db, $qstring) or die($this->db->error);
    return $res;
  }
  
  
  
  
    
  public function drawTable($admin=false)
    {
    
    if ($admin && !isset($_SESSION['user'])) $admin = false;
    
    if ($this->getCacheExists('table'))
    {
      echo $this->getCache('table');
    }
    else
    {
      ob_start();
      
      ?>
      <div class="table-responsive" style="overflow-x: scroll;">
      <table class="dye table table-striped table-bordered table-hover table-condensed">
      
      <thead>
        <tr>
          <?
          foreach ($this->fields as $key=>$field)
            {
              if ($field['summaryHide']!==1)
              {
                echo '<th' . ($field['sort'] ? ' data-sort="' . $field['sort'] . '" style="color:#571010;"' : '') . '>'. $field['label'] . ' ' . ($field['sort'] ? '<span class="btn-sort">&udarr;</span>' : '') . '</th>';
              }
            }
          ?>
        </tr>
      </thead>
      
      <?
      foreach ($this->data as $rowData)
       {
          echo '<tr>';
            $num = count($this->data);
            $row++;
            $ii=0;
            foreach ($rowData as $key=>$dataz)
            {
              if ($this->fields[$key]['summaryHide']!==1)
              {
                echo '<td>';
                if ($ii == 0) echo '<a '. ($admin ? 'target="_blank" title="View on website" href="../' : 'href="') . 'trace/?id=' . (int)$dataz['value'] . '">';
                echo $dataz['value'];
                if ($ii == 0) echo ' 🔍</a>';
                if ($ii == 0 && $admin) echo '<a class="btn btn-small btn-primary" href="index.php?trace=' . (int)$dataz['value'] . '" style="">Edit</a>';
                $ii++;
                echo "</td>\n";
              }
            }
          echo '</tr>';
        }
      ?>
      
      <tfoot>
      <tr>
        <?
        foreach ($this->fields as $key=>$field)
          {
          if ($field['summaryHide']!==1)
            {
              echo '<th' . ($field['sort'] ? ' data-sort="' . $field['sort'] . '" style="color:#571010;"' : '') . '>'. $field['label'] . ' ' . ($field['sort'] ? '<span class="btn-sort">&udarr;</span>' : '') . '</th>';
            }
          }
        ?>
      </tr>
      <tr>
        <td colspan="6">
          <div class="pager">
            <nav class="right">
              <span class="prev">
                &larr;&nbsp; Prev
              </span>&nbsp;|&nbsp;
              <span class="pagecount"></span>
              &nbsp;|&nbsp;
              <span class="next">Next &rarr;
              </span>
            </nav>
          </div>
        </td>
        <td colspan="8"></td>
      </tr>
    </tfoot>
    
  </table></div>

  <script>
      $(function(){
      var $table = $('table.dye'),
      $pager = $('.pager');

      $.tablesorter.customPagerControls({
        table          : $table,
        pager          : $pager,
        pageSize       : '.left a',
        currentPage    : '.right a',
        ends           : 3,
        aroundCurrent  : 2,
        link           : '<a href="#">{page}</a>',
        currentClass   : 'current',
        adjacentSpacer : '<span> | </span>',
        distanceSpacer : '<span> &#133; <span>',
        addKeyboard    : true,
        pageKeyStep    : 20
      });

      $table
        .tablesorter({
          theme: 'blue',
          widgets: ['zebra', 'columns', 'filter','paging']
        })
        .tablesorterPager({
          container: $pager,
          size: 20,
          output: 'showing: {startRow} to {endRow} ({filteredRows})'
        }).trigger('pageSize', 20);

    });
  </script>

      <?
      $table = ob_get_flush();
      $this->nukeCache('table');
      $this->setCache('table', $table);
    }
  }
  
  
  public function drawMap($singular = false)
  {
    ?>
    
<div id="map" style="width: 100%; height: <?=$singular ? 45 : 70 ?>0px;">
  
</div>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> 

<script src="https://maps.googleapis.com/maps/api/js?key=<?=_gmap_api_key?>&libraries=&v=weekly" async></script>
  
<script type="module">
  import OsGridRef from '/includes/js/geodesy/osgridref.js';
  initMap();
    <?
      foreach ( $this->data as $dataRow)
      {?>
      
        map = window.map;
        
        <? if (strlen($dataRow['inj_grid']['value']) > 0)
        { ?>
          gridref = OsGridRef.parse('<?=$dataRow['inj_grid']['value']?>');
          wgs84 = gridref.toLatLon();
          var injlat = wgs84.lat;
          var injlon = wgs84.lon;
          var marker<?=$dataRow['serial']['value']?> = new google.maps.Marker({
            position: {lat: injlat, lng: injlon},
            map,
            title: "Inj: <?=$dataRow['inj_point']['value']?>",
            icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
          });
          
          <? if (!$singular) { ?>marker<?=$dataRow['serial']['value']?>.addListener("click", () => { <? } ?>
            new google.maps.InfoWindow({
            content: "<? if (!$singular) { ?><a href=\"trace/?id=<?=$dataRow['serial']['value']?>\" style=\"display:inline-block;float:right;margin-left: 15px;padding: 5px;background:#efefef;border:1px solid #999;border-radius:4px;\">View<br>Trace</a><? } ?> <b>Injection Point</b><br> <?=$dataRow['inj_point']['value']?><br> <?=$dataRow['inj_grid']['value']?>",
          }).open(window.map, marker<?=$dataRow['serial']['value']?>);
          <? if (!$singular) { ?>});<? } ?>
  
  
        <? } 
        
        
        if (strlen($dataRow['det_grid']['value']) > 0)
        { ?>
          gridref = OsGridRef.parse('<?=$dataRow['det_grid']['value']?>');
          wgs84 = gridref.toLatLon();
          var detlat = wgs84.lat;
          var detlon = wgs84.lon;
          var marker<?=$dataRow['serial']['value']?>d = new google.maps.Marker({
            position: {lat: detlat, lng: detlon},
            map,
            title: "Det: <?=$dataRow['det_point']['value']?>",
            
            icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
          });
          
          <? if (!$singular) { ?>marker<?=$dataRow['serial']['value']?>d.addListener("click", () => {<? } ?>
            new google.maps.InfoWindow({
            content: "<? if (!$singular) { ?><a href=\"trace/?id=<?=$dataRow['serial']['value']?>\" style=\"display:inline-block;float:right;margin-left: 15px;padding: 5px;background:#efefef;border:1px solid #999;border-radius:4px;\">View<br>Trace</a><? } ?> <b>Detection Point</b><br> <?=$dataRow['det_point']['value']?><br> <?=$dataRow['det_grid']['value']?>",
          }).open(window.map, marker<?=$dataRow['serial']['value']?>d);
          <? if (!$singular) { ?>});<? } ?>
        
      <?}
      
      if (strlen($dataRow['det_grid']['value']) > 0 && strlen($dataRow['inj_grid']['value']) > 0)
      { ?>
          var flightPlanCoordinates = [
            { lat: injlat, lng: injlon },
            { lat: detlat, lng: detlon },
          ];
          var flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            icons: [{
              icon: {
  path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
},
              offset: '100%',
              scaledSize: new google.maps.Size(50, 50), // scaled size
            }],
            geodesic: true,
            strokeColor: "#Ffffff",
            strokeOpacity: 1,
            strokeWeight: 2,
          });
          flightPath.setMap(window.map);
          
          <? if ($singular) { ?>
          map.setCenter({ lat: injlat, lng: injlon });
          map.setZoom(15);
          <? } ?>
          
      <? }
      
      }
    ?>
      
</script>

<script>
function initMap() {
  const myLatLng = { lat: 54.23, lng: -2.325347 };
  window.map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: myLatLng,
    mapTypeId: 'hybrid'
  });
}
</script>

    <?
  }
  
  
  
  
  
  
  
  
  
  function drawFormFields($data)
  {
  echo '<div class="row">';
  $i = 0;
    foreach ($this->fields as $key=>$field)
    {
      $i++;
      if ($i == 1) continue;
      
      echo '<div class="form-group col-sm-12">';
        echo '<label for="input-' . $key . '" class="col-sm-2 control-label">' . $field['label'] . '</label>';
        echo '<div class="col-sm-10" id="input-container-' . $key . '">';
        
        switch ($field['type']){
          case 'textbox':
            echo '<textarea class="form-control" rows="3" type="" id="input-' . $key . '"' . ($field['locked'] ? ' disabled="disabled"' : '') . '>' . $data[$key]['value'] . '</textarea>';
          break;
          
          case 'ncarea':
            $this->drawNortherncaves($data[$key]['value']);
          break;
          
          default:
            echo '<input class="form-control" type="" id="input-' . $key . '" value="' . $data[$key]['value'] . '"' . ($field['locked'] ? ' disabled="disabled"' : '') . ' />';
          break;
        }
        
        echo '</div>';
      echo '</div>';
      
      if ($field['type'] == 'date'){
        ?>
          <script>
            $(document).ready(function(){
              $('#input-<?=$key?>').flatpickr({dateFormat: 'd-m-Y'});
            });
          </script>
        <?
      
      }
    }
    echo '</div>';
  }
    
    
  
  function drawNortherncaves($area = false)
  {
    ?>
    <select name="nc_area" id="nc_area" class="form-control">
      <option<?if (!$area) echo ' selected';?> disabled>Northern Caves area</option>
      <?
      foreach ($this->ncAreas as $ncArea)
      {
        echo '<option' . ($ncArea == $area ? ' selected="selected"' : '') . '>' . $ncArea . '</option>';
      }
      ?>
    </select>
    <?
  }
  
  public function setCache($key, $value)
  {
    return file_put_contents('var/cache/' . $key . date('Ymd') . '.cache', $value);
  }
  
  public function getCache($key)
  {
    if ($this->getCacheExists($key))
    {
      return file_get_contents('var/cache/' . $key . date('Ymd') . '.cache');
    }
    else return false;
  }
  
  public function getCacheExists($key)
  {
    if (file_exists('var/cache/' . $key . date('Ymd') . '.cache')) return true;
    else return false;
  }
  
  public function nukeCache($type = false)
  {
    if ($type && in_array($type, ['traces','table']))
    {
      $glob = 'var/cache/' . $type . '*';
    }
    else $glob = 'var/cache/*';
    $files = glob($glob); 
    foreach($files as $file){ 
      if(is_file($file)) {
        unlink($file);
      }
    }
  }
  
  public function outputCsv()
  {
      header('Content-Type: text/csv; charset=UTF-8');
      header('Content-Disposition: attachment; filename=dye-trace-database.csv');
      header("Pragma: no-cache");
      header("Expires: 0");
      $delimiter = ',';
      $f = fopen('php://output', 'w');
      $line = [];
      foreach ($this->fields as $key=>$val) {
        $line[]=$key;
      }
      fputcsv($f, $line, $delimiter); 
      
      foreach ($this->data as $line) {
        $dataLine = [];
        foreach ($line as $val) {
          $dataLine[]=$val['value'];
        }
          fputcsv($f, $dataLine, $delimiter); 
      }
      
      fclose($f);
  }
  
  

}