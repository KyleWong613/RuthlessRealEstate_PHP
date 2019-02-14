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


<center><h2>Property Types</h2></center>
<head>
<title>Property Type</title>
</head>
<body> 

<?php
include("connection.php");
$conn = oci_connect($UName,$PWord,$DB);
$query="SELECT * FROM PropertyType ORDER BY type_id ASC";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);

echo"<center>";
echo "<table style='width:70%'; border='3'; cellpadding='5'>";
echo "<tr>";
echo "<th>Type ID</th>";
echo "<th>Type Name</th>";
echo "<th colspan='2'>Action</th>";
echo "</tr>";
	while ($row = oci_fetch_array ($stmt))
	{
	echo "<tr>";
	echo "<td><center>$row[0]</center></td>";
	echo "<td>$row[1]</td>";
	echo "<td><center><a href='TypeModify.php?type_id=$row[0]&Action=Update'> Update </a></center></td>";
	echo "<td><center><a href='TypeModify.php?type_id=$row[0]&Action=Delete'> Delete </a></center></td>";
	echo "</tr>";
	}
echo "</table>";
echo"</center>";
?>
<br><center>
<input type="button" value="Add" OnClick="window.location='TypeAdd.php'"></center>

      
      <!-- End body-->
      
      </div>
 
<center><br /><a href="showtype.php" target="_blank">
  <img src="Type.png" alt="TypeBox"></center>
</a>

      </div>
  
 
 <div id="footer">
        <p>Copyright © Ruthless Real Estate 2016 </p>
      </div>
 </body>
 </html>