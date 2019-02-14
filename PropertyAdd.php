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
          <li><a title="" accesskey="7" href="PropertyFeature.php">Property Feature</a></li>
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
<title>Property </title>
</head>
<body>
<script language="JavaScript">
    function VerifyDataEntry(theForm)
{
    if (theForm.street.value.trim().length == 0) 
    {
        alert("Please enter a value for \"Street\" field");
        theForm.street.focus();
        return false;
    }
	
	if (theForm.town.value.trim().length == 0) 
    {
        alert("Please enter a value for \"Town\" field");
        theForm.town.focus();
        return false;
    }
	
	if (theForm.pc.value.trim().length == 0) 
    {
        alert("Please enter a value for \"Postcode\" field");
        theForm.pc.focus();
        return false;
    }
	
	if (theForm.state.value.trim().length == 0) 
    {
        alert("Please enter a value for \"State\" field");
        theForm.state.focus();
        return false;
    }
	
	if (theForm.country.value.trim().length == 0) 
    {
        alert("Please enter a value for \"Country\" field");
        theForm.country.focus();
        return false;
    }
	
	if (theForm.type.value.trim().length == 0) 
    {
        alert("Please enter a value for \"Type\" field");
        theForm.type.focus();
        return false;
    }
    return true;
}
</script>



<?php
    if (empty($_POST["street"]))
    {
        ?>
    <form method="post" Action = "PropertyAdd.php" OnSubmit="return VerifyDataEntry(this)">
    <hform>Add Property</hform>
    
    <p /> Enter Property details <p />
    
<table cellpadding= "5">

<tr>
    <td><b>Street</b></td>  
    <td><input type="text" name="street" size="30"></td>
</tr>
    
<tr>
    <td><b>Town</b></td> 
    <td><input type="text" name="town" size="30"></td>
</tr>
    
<tr>
    <td><b>Postcode</b></td> 
    <td><input type="text" name="pc" size="30" placeholder="E.g: 68000" ></td>
</tr>	
	
<tr>
    <td><b>State</b></td> 
    <td><input type="text" name="state" size="30"></td>
</tr>
    
    
<tr>
    <td><b>Country</b></td> 
    <td><input type="text" name="country" size="30"></td>
</tr>

<tr>
    <td><b>Type</b></td> 
    <td>
    <select name="type" type = "text">
		<?php
		include("connection.php");
		$conn = oci_connect($UName,$PWord,$DB)
        or die("Couldn't logon.");
    	$query="SELECT * FROM PropertyType"; 
    	$stmt = oci_parse($conn,$query);
    	oci_execute($stmt);
		
        while ($row = oci_fetch_array ($stmt))
        {
		?>
        <option value="<?php echo $row[0];?>">
        <?php echo $row[0]." - ".$row[1]; ?> 
        </option>
		<?php
        }
		?>
        </select>
    </td>
</tr> 

</table><br/>
    
    
    
    <input class="btn btn-lg btn-primary" type="Submit" Value="Submit">
    <input type="Reset" Value="Clear Form Fields">
    <input type="Button" Value="Return to list" onClick="window.location='Property.php'">
    
    </form>
    
   
<?php
	}
	else
    {
include("connection.php");
	$conn = oci_connect($UName,$PWord,$DB) or die("Couldn't logon.");
 
 $query="INSERT INTO Property (property_id, property_street, property_town, property_pc,property_state, property_country, property_type) VALUES(property_seq.nextval, '$_POST[street]', '$_POST[town]', '$_POST[pc]', '$_POST[state]', '$_POST[country]', '$_POST[type]')";
 $stmt = oci_parse($conn,$query);
 oci_execute($stmt);
 
 $query="SELECT * FROM Property ORDER BY property_id ASC"; 
 $stmt = oci_parse($conn,$query);
 oci_execute($stmt);
 $row = oci_fetch_array ($stmt);
 	echo "<center>";
	echo "<hform>Successful!</hform>";
	echo "<br><h2>Successfully Added Property!</h2>";
	echo"</center>";
 
?>
<center><input type="Button" Value="Return to List" onClick="window.location='Property.php'"></center>

<?php
 oci_free_statement($stmt);
 oci_close($conn);
 } 
?> 
      
     
      <!-- End body-->
      
      </div>
      </div>
  
 <!-- Footer -->
 
 <div id="footer">
        <p>Copyright © Ruthless Real Estate 2016 </p>
      </div>
 </body>
 </div>
 </html>
