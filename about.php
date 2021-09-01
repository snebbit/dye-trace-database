<?php
$page = 'about';

require_once('template.php');

function contact_clean($input)
{
  return strip_tags($input);
}

if (isset($_POST['go']))
{
  $name = contact_clean($_POST['name']);
  $type = contact_clean($_POST['type']);
  $email = contact_clean($_POST['email']);
  $msg = contact_clean($_POST['msg']);
  
  $emailMsg = "Name: " . $name . "\r\n Email: " . $email . "\r\n Type: " . $type . "\r\n Message: " . $msg;
  
  mail(_contact_email, _branding_short . ' Contact Form', $emailMsg, "From:info@dtd.local");
}

head();

?>
<h1>About</h1>

<p>
Text here
</p>

<p>
Overseen by <b>[]</b><br>
Data  management by <b>[]</b><br>
</p>

<h3>Contact</h3>

<form action="" method="post" role="form" class="form col-md-6">

  <div class="form-group">
  <select name="type" id="type" class="form-control">
    <option selected disabled>Enquiry type</option>
    <option>Data correction</option>
    <option>Website problem</option>
  </select>
  </div>

  <div class="form-group">
    <input class="form-control" type="text" name="name" id="name" placeholder="Name" />
  </div>
  
  <div class="form-group">
    <input class="form-control" type="text" name="email" id="email" placeholder="Email address" />
  </div>
  
  <div class="form-group">
    <textarea class="form-control" name="msg" id="msg" placeholder="Message"></textarea>
  </div>
  
  <div class="form-group">
  <input type="submit" name="go" value="Send" class="form-control btn btn-primary" style="width: 100px;" />
  </div>
  
</form>

<p>
<b>Credits</b><br>
<a href="https://github.com/snebbit/dye-trace-database" target="_blank">dye-trace-database by Snebbit<br>
<a href="https://mottie.github.io/tablesorter/docs/" target="_blank">tablesorter by Mottie<br>
<a href="https://github.com/chrisveness/geodesy" target="_blank">Chris Veness' Geodesy</a> library
</p>
<br><br><br><br><br><br>

<?
foot();
