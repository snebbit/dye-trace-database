<?php
$page = 'contribute';


require_once('template.php');

function contact_clean($input)
{
  return strip_tags($input);
}

head();    
    
if (isset($_POST['go']))
{
  $name = contact_clean($_POST['name']);
  $email = contact_clean($_POST['email']);
  
  $emailMsg = "Name: " . $name . "\r\n Email: " . $email . "\r\n\r\n";
  
  $tr = new Tracing;
  foreach ($tr->fields as $key=>$field)
  {
    if ($key!='serial' && $key!='nc_area')
    {
      $emailMsg.=$field['label'] . ': ' . contact_clean($_POST[$key]) . "\r\n";
    }
  }
  
  mail(_contact_email, _branding_short . ' Contribution Form', $emailMsg, "From:info@dtd.local");
  echo '<div class="alert alert-success">Your contribution has been sent. Many thanks, we\'ll be in touch if we need to clarify any details.</div>';
}

?>
<h1>Contribute</h1>

<p>
We would delightfully accept your own dye-tracing data for inclusion in the database; you can do so using the form below for single records, or get in touch if you have any lovely bulk CSVs.
</p>

<p><small>
<b>Minimum required fields:</b>
<ul>
  <li>Injection point name</li>
  <li>Injection grid ref (minimum 6 digit)</li>
  <li>Detection point name</li>
  <li>Detection grid ref (minimum 6 digit)</li>
  <li>Tracer material</li>
  <li>People involved</li>
</ul>
</small></p>

<h3>Submit a dye trace</h3>

<form action="" method="post" role="form" class="form col-sm-10">

  <div class="row">
    <div class="col-sm-6">
      <h4>Injection Point</h4>
      <div class="form-group">
        <input class="form-control" type="text" name="inj_point" id="inj_point" placeholder="Injection Point Name" />
      </div>
      
      <div class="form-group">
        <input class="form-control" type="text" name="inj_point_details" id="inj_point_details" placeholder="Injection Point Detail/notes" style="font-size:12px;" />
      </div>
      
      <div class="form-group">
        <input class="form-control" type="text" name="inj_grid" id="inj_grid" placeholder="Injection Point Grid Ref" />
      </div>
    </div>
    <div class="col-sm-6">
      <h4>Detection Point</h4>
      <div class="form-group">
        <input class="form-control" type="text" name="det_point" id="det_point" placeholder="Detection Point Name" />
      </div>
      
      <div class="form-group">
        <input class="form-control" type="text" name="det_point_details" id="det_point_details" placeholder="Detection Point Detail/notes" style="font-size:12px;" />
      </div>
      
      <div class="form-group">
        <input class="form-control" type="text" name="det_grid" id="det_grid" placeholder="Detection Point Grid Ref" />
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-6">
      <h4>Methodology</h4>
      
      <div class="form-group">
        <input class="form-control" type="text" name="tracer" id="tracer" placeholder="Tracer material" />
      </div>

      <div class="form-group">
        <input class="form-control" type="text" name="quantity" id="quantity" placeholder="Quantity" />
      </div>
      
      <div class="form-group">
        <input class="form-control" type="text" name="det_method" id="det_method" placeholder="Detection Method" />
      </div>
      
      <div class="form-group">
        <input class="form-control" type="datetime" name="date" id="date" placeholder="Date of Test" />
      </div>
  
    </div>
    <div class="col-sm-6">
      <h4>Results</h4>
      
      <div class="form-group">
        <input class="form-control" type="text" name="time" id="time" placeholder="Time Taken" />
      </div>
      
      <div class="form-group">
        <input class="form-control" type="text" name="distance" id="distance" placeholder="Distance Travelled" />
      </div>
      
      <div class="form-group">
        <input class="form-control" type="text" name="depth" id="depth" placeholder="Depth Travelled" />
      </div>
      
      <div class="form-group">
        <input class="form-control" type="text" name="average_velocity" id="average_velocity" placeholder="Average Velocity" />
      </div>
    </div>
    
  </div>
  
  <div class="form-group">
    <textarea class="form-control" name="people" id="people" placeholder="People/Organisations Involved"></textarea>
  </div>
  
  <div class="form-group">
    <textarea class="form-control" name="ref" id="ref" placeholder="References"></textarea>
  </div>

  <div class="form-group">
    <input class="form-control" type="text" name="name" id="name" placeholder="Your Name" />
  </div>
  
  <div class="form-group">
    <input class="form-control" type="text" name="email" id="email" placeholder="Your Email address" />
  </div>
  
  <div class="form-group">
  <input type="submit" name="go" value="Send" class="form-control btn btn-primary" style="width: 100px;" />
  </div>
  
</form>

<?
foot();
