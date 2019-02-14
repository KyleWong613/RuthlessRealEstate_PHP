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
          <li><a title="" accesskey="3" href="Client.php">Client</a></li>
          <li class="first"><a title="" accesskey="4" href="Type.php">Type</a></li>
          <li><a title="" accesskey="5" href="Feature.php">Feature</a></li>
          <li><a title="" accesskey="6" href="MultipleProperty.php">Multiple Property</a></li>
          <li><a title="" accesskey="7" href="Property Feature.php">PropertyFeature</a></li>
          <li><a title="" accesskey="8" href="Documentation.php">Documentation</a></li>
          <li><a title="" accesskey="9" href="Logout.php">Logout</a></li>
        </ul>
      </div>
      <div id="page">
      <div id="contentwide">
      
      <!-- insert body here-->


<html> 

<div id="addform">
<hform>Add Property Type</hform>

<head>
<title>Property Type</title>
</head>
<body> 

<script language="JavaScript">
 function VerifyDataEntry(theForm)
 {
if (theForm.type_name.value.trim().length == 0) 
 {
 alert("Please enter a value for the \"Type Name\" field");
 theForm.type_name.focus();
 return false;
 } 
 return true;
 }
</script>


<?php
 if (empty($_POST["type_name"]))
 {
?> 
<form method="post" Action="type.php" OnSubmit="return VerifyDataEntry(this)">
<p /> Enter Property Type details <p />
Type Name: <input type="text" name="type_name"> <p />
<input type="Submit" Value="Submit">
<input type="Reset" Value="Clear Form Fields">
<input type="button" Value="Return to List" OnClick="window.location='Type.php'">
</form>

<?php
 }
 else
 {
include("connection.php");
 $conn = oci_connect($UName,$PWord,$DB)
 or die("Couldn't logon.");
 $query="INSERT INTO PropertyType (type_id, type_name) VALUES(type_seq.nextval, '$_POST[type_name]')";
 $stmt = oci_parse($conn,$query);
 if(@oci_execute($stmt))
{ ?>
<center>The following property type has been successfully
added<br />
<?php
echo "<center>";
echo "Type ID: ".$row[0];
echo "Type Name: ".$row[1];
echo "</center>";
}
else
{
echo "<center>Error adding property type</center>
<p />";
}
echo "<center><input type='button' value='Return to List'
OnClick='window.location=\"Type.php\"'>
</center>";
break;
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