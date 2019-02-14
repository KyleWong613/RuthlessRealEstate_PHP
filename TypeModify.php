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

<head>
<title>Property Type</title>
</head>
<body>

<script language="javascript"> 
function confirm_delete() {
window.location='TypeModify.php?type_id=<?php echo
$_GET["type_id"]; ?>&Action=ConfirmDelete';
}

function VerifyDataEntry(theForm)
 {
if (theForm.typename.value.trim().length == 0) 
 {
 alert("Please enter a value for the \"Type Name\" field");
 theForm.typename.focus();
 return false;
 } 
 return true;
 }
 
</script>
<?php
include("connection.php");
$conn = oci_connect($UName,$PWord,$DB)
or die("Couldn't logon.");
$query="SELECT * FROM PropertyType WHERE type_id =".$_GET["type_id"]; 
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
$row = oci_fetch_array ($stmt);
switch($_GET["Action"])
{
	
case "Update": ?>
<form method="post" action="TypeModify.php?
type_id=<?php echo $_GET["type_id"]; ?>
&Action=ConfirmUpdate" OnSubmit="return VerifyDataEntry(this)">
<hform>Update Property Type</hform>
<br />Property Type Details
<table cellpadding="3">
<tr />
<td><b>Type ID</b></td>
<td><?php echo $row[0]; ?></td>
</tr>
<tr>
<td><b>Type</b></td>
<td><input type="text" name="typename" size="30"
value="<?php echo $row[1]; ?>"></td>
</tr>
</table><br/>
<table>
<tr>


<td><input type="submit" value="Update Property Type"></td>
<td><input type="button" value="Return to Type List"
OnClick="window.location='Type.php'"></td>
</tr>
</table>
</form>
<?php
break;

case "ConfirmUpdate":
$query="UPDATE PropertyType set type_name='$_POST[typename]' WHERE type_id =".$_GET["type_id"];
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
header("Location: Type.php");
break;

case "Delete":
?>
<form method="post" action="TypeModify.php?
type_id=<?php echo $_GET["type_id"]; ?>
&Action=ConfirmDelete" OnSubmit="return VerifyDataEntry(this)"> 
<hform><center>Delete Property Type</center></hform>
<center>Confirm deletion of the property type<br /></center>
<p />
<table align="center" cellpadding="3">
<tr>
<td><b>Type ID</b></td>
<td><?php echo $row[0]; ?></td>
</tr>
<tr>
<td><b>Type Name</b></td>
<td><?php echo $row[1]; ?></td>
</tr>
</table><br/> 
<table align="center">
<tr>
<td>
<input type="submit" value="Confirm"
OnClick="confirm_delete();">
</td>
<td>
<input type="button" value="Cancel"
OnClick="window.location='Type.php'">
</td>
</tr>
</table>
 </form>
<?php
break;
case "ConfirmDelete":
$query="DELETE FROM PropertyType WHERE type_id =".$_GET["type_id"];
$stmt = oci_parse($conn,$query);
if(@oci_execute($stmt))
{ ?>
<center>The following property type has been successfully
deleted<br />
<?php
echo "<center>";
echo "<b>Type ID: ".$row[0]."</b>";
echo "<br><b>Type Name: ".$row[1]."</b>";
echo "</center>";
}
else
{
echo "<center>Error deleting property type because FK constraint</center>
<p />";
}
echo "<center><input type='button' value='Return to List'
OnClick='window.location=\"Type.php\"'>
</center>";
break;
}
oci_free_statement($stmt);
oci_close($conn);
?>

      
      <!-- End body-->
      
      </div>


      </div>
  
 
 <div id="footer">
        <p>Copyright © Ruthless Real Estate 2016 </p>
      </div>
 </body>
 </html>