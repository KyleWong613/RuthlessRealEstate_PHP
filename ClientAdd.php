<?php 
ob_start();
session_start(); 
include("logincheck.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
    <title></title>
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arvo%7COswald" />
    <link media="all" type="text/css" rel="stylesheet" href="style.css" />
  </head>
  <body>
  	
    <div id="header">
      <div class="container" id="logo">
        <h1><a href="#" align="center"> Ruthless Real Estate </a></h1>
      </div>
      <div class="container" id="menu">
        <ul>
           <li><a title="" accesskey="1" href="index.html">Home</a></li>
          <li><a title="" accesskey="2" href="Property.php">Property</a></li>
          <li class="first"><a title="" accesskey="3" href="Client.php">Client</a></li>
          <li><a title="" accesskey="4" href="Type.php">Type</a></li>
          <li><a title="" accesskey="5" href="Feature.php">Feature</a></li>
          <li><a title="" accesskey="6" href="MultipleProperty.php">Multiple Property</a></li>
          <li><a title="" accesskey="7" href="PropertyFeature.php">Property Feature</a></li>
          <li><a title="" accesskey="8" href="Documentation.php">Documentation</a></li>
          <li><a title="" accesskey="9" href="Logout.php">Logout</a></li>
        </ul>
      </div>
      <div id="page">
      <div id="contentwide">
      
      <!-- insert body here-->
<div id="addform">
<hform>Add Client</hform>
<head>
<title>Property </title>
</head>
<body>

<?php
    
 if (empty($_POST["client_id"]))
 {
?> 

        
    <form method="post" Action="ClientAdd.php" >
    <p /> Enter Client Details <p />
    <table cellpadding= "5">

<tr>
    <td><b>Family Name</b></td>  
    <td><input type="text" name="fname" required></td>
</tr>

<tr>
    <td><b>Given Name</b></td>  
    <td><input type="text" name="gname" required></td>
</tr>
<tr>
    <td><br /><b><u>Address</u></b></td>
</tr>
<tr>
    <td><b>Street</b></td>  
    <td><input type="text" name="street" required></td>
</tr>

<tr>
    <td><b>Town</b></td>  
    <td><input type="text" name="town" required></td>
</tr>

<tr>
    <td><b>Postcode</b></td>  
    <td><input type="text" name="pc" pattern="[0-9]*" placeholder="E.g: 68000" required></td>
</tr>

<tr>
    <td><b>State</b></td>  
    <td><input type="text" name="state" required></td>
</tr>

<tr>
    <td><b>Country</b></td>  
    <td><input type="text" name="country" required></td>
</tr>


<tr>
    <td><br /><b>Email</b></td>  
    <td><br /><input type="email" name="email" placeholder="E.g: john@gmail.com"></td>
</tr>

<tr>
    <td><b>Mobile</b></td>  
    <td><input type="text" name="mobile" pattern="[0-9]*" placeholder="E.g: 01234567189" required></td>
</tr>

<tr>
    <td><b>Mailing List: <br />(T for True, F for False)</b></td>  
    <td><select name="mailinglist">
    <option value="T">T</option>
    <option value="F">F</option>
    </select></td>
</tr>
</table>
    
    <br/> 
    <input class="btn btn-lg btn-primary" type="Submit" Value="Submit">
    <input type="Reset" Value="Clear Form Fields">
    <input type="Button" Value="Return to List" onClick="window.location='Client.php'">
    </form> 
      
    <?php
    }
    else
    {
    include("connection.php");
	$conn = oci_connect($UName,$PWord,$DB) or die("Couldn't logon.");

   $query="INSERT INTO Client (client_id, client_familyname, client_givenname, client_street, client_suburb, client_pc, client_state, client_country, client_email, client_mobile, client_mailinglist) VALUES(client_seq.nextval, $_POST[fname]',$_POST[gname]',$_POST[street]',$_POST[town]',$_POST[pc]',$_POST[state]',$_POST[country]',$_POST[email]',$_POST[mobile]',$_POST[mailinglist]')"; 
        
	$stmt = oci_parse($conn,$query);
    oci_execute($stmt);
	
	
echo "Successfully added";
 
?>
		
  
        <?php
         oci_free_statement($stmt);
         oci_close($conn);
         }
         ?>
    

        
      
      <!-- End body-->
      
      </div>


      </div>
  
 
 <div id="footer">
        <p>Copyright © Ruthless Real Estate 2016 </p>
      </div>
 </body>
 </html>