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
          <li class="first"><a title="" accesskey="2" href="Property.php">Property</a></li>
          <li><a title="" accesskey="3" href="Client.php">Client</a></li>
          <li><a title="" accesskey="4" href="Type.php">Type</a></li>
          <li><a title="" accesskey="5" href="Feature.php">Feature</a></li>
          <li><a title="" accesskey="6" href="MultipleProperty.php">Multiple Property</a></li>
          <li><a title="" accesskey="7" href="Property Feature.php">Property Feature</a></li>
          <li><a title="" accesskey="8" href="Documentation.php">Documentation</a></li>
          <li><a title="" accesskey="9" href="Logout.php">Logout</a></li>
        </ul>
      </div>
      <div id="page">
      <div id="contentwide">
      
      <!-- insert body here-->
      


<html> 
<!-- Search Property -->

<?php

echo "<center><h2>Search Results:</h2></center>";

//If they did not enter a search term we give them an error
if(isset($_POST['search']))
            {
            $find =$_POST['find'];
			}
			
//if ($find == "")
if (strlen(trim($find)) == 0)
{
echo "<center>";
echo "<br>No results found!";
echo "<br>You forgot to enter a search term!";
echo "<br><br><input type='button' value='Return to Property Page'
                OnClick='window.location=\"Property.php\"'>";
echo "</center>";
exit;
}
else{

// Otherwise we connect to our Database
include("connection.php");
$conn = oci_connect($UName,$PWord,$DB) or die("Couldn't logon.");


//Now we search for our search term, in the field the user specified
$query="SELECT * FROM Property WHERE UPPER(property_street) LIKE UPPER('%$find%') OR UPPER(property_town) LIKE UPPER('%$find%') OR UPPER(property_state) LIKE UPPER('%$find%') OR UPPER(property_country) LIKE UPPER('%$find%')";
$stmt = oci_parse($conn,$query);
oci_execute($stmt);

//When no results found
if ($row = oci_fetch_array ($stmt) == NULL){
	echo"<center>";
	echo "<br>No results found!";
	
	echo "<br><br><input type='button' value='Return to Property Page'
                OnClick='window.location=\"Property.php\"'>";
	echo"</center>";
}


//If results are found
else{
	echo"<center>";
	echo "<table style='width:90%'; border='3'; cellpadding='5'>";
	echo"<tr>";
	echo"<th>Property ID</th>";
	echo"<th>Street</th>";
	echo"<th>Town</th>";
	echo"<th>PostCode</th>";
	echo"<th>State</th>";
	echo"<th>Country</th>";
	echo"<th>Type</th>";
	echo "<th colspan='2'>Action</th>";
	echo "</tr>";
		while ($row = oci_fetch_array ($stmt))
		{
		echo "<tr>";
		echo "<td><center>$row[0]</center></td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td>";
		echo "<td>$row[3]</td>";
		echo "<td>$row[4]</td>";
		echo "<td><center>$row[5]</center></td>";
		echo "<td><center>$row[6]</center></td>";
		echo "<td><center><a href='PropertyUpdate.php?property_id=$row[0]&Action=Update'> Update </a></center></td>";
		echo "<td><center><a href='PropertyUpdate.php?property_id=$row[0]&Action=Delete'> Delete </a></center></td>";
		echo "</tr>";
		}
	echo "</table>";
	echo "<br><input type='button' value='Return to Property Page'
                OnClick='window.location=\"Property.php\"'>";
	echo"</center>";
}
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
