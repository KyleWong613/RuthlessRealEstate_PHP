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
<script language="javascript"> 
	function confirm_delete() {
    window.location='Property.php?property_id=<?php echo
    $_GET["property_id"]; ?>&Action=ConfirmDelete';
}

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
    include("connection.php");
    
    function fSelect($value1, $value2)
    {
        $strSelect = "";
        if($value1 == $value2)
        {
            $strSelect = "Selected";
        }
        return $strSelect;
    }
    
    $conn = oci_connect($UName,$PWord,$DB)
        or die("Couldn't logon.");
    $query="SELECT * FROM Property WHERE property_id =".$_GET["property_id"]; 
    $stmt = oci_parse($conn,$query);
    oci_execute($stmt);
    $row = oci_fetch_array ($stmt);
    
    #$query = "SELECT PROPERTY_ID, type from PROPERTY
      #ORDER BY PROPERTY_TYPE";
    #$stmt = oci_parse($conn,$query);
    #oci_execute($stmt);
    
	switch($_GET["Action"])
{
case "Update": ?>
<form method="post" action="PropertyUpdate.php?
property_id=<?php echo $_GET["property_id"]; ?>
&Action=ConfirmUpdate" OnSubmit="return VerifyDataEntry(this)"> 
<hform>Update Property</hform>
<br>Property Details<br /><br />
<table celpadding= "3">
<tr>
    <td><b>Property ID</b></td>
    <td><?php echo $row[0]; ?></td>
</tr>
    
<tr>
    <td><b>Property Street</b></td>  
    <td><input type="text" name="street" size="30"
    value="<?php echo $row[1]; ?>"></td>
</tr>
    
<tr>
    <td><b>Property Town</b></td> 
    <td><input type="text" name="town" size="30"
    value="<?php echo $row[2];?>"></td>
</tr>
    
<tr>
    <td><b>Property Postcode</b></td> 
    <td><input type="text" name="pc" size="30"
    value="<?php echo $row[3];?>"></td>
</tr>	
	
<tr>
    <td><b>Property State</b></td> 
    <td><input type="text" name="state" size="30"
    value="<?php echo $row[4];?>"></td>
</tr>
    
    
<tr>
    <td><b>Property Country</b></td> 
    <td><input type="text" name="country" size="30"
    value="<?php echo $row[5];?>"></td>
</tr>
    
<tr>
     <td><b>Type</b></td>
     <td>
     
     
     <select name="type" type = "text">
		<?php
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

<div style="margin-left:80px">       
<table>
<tr>
    <td><input type="submit" value="Update Property"></td>
    <td><input type="button" value="Return to List"
     OnClick="window.location='Property.php'"></td> 
    </tr> 
    </table>
</div>
    </form>
    <?php
        break;
        
        case "ConfirmUpdate":
        $query="UPDATE Property set property_street='$_POST[street]',
        property_town='$_POST[town]', property_state='$_POST[state]',
        property_pc='$_POST[pc]', property_country='$_POST[country]', property_type='$_POST[type]' WHERE property_id =".$_GET["property_id"];
        $stmt = oci_parse($conn,$query);
        oci_execute($stmt);
        header("Location: Property.php");
        
        break;
        
        case "Delete": 
    ?>
    <form method="post" action="PropertyUpdate.php?
property_id=<?php echo $_GET["property_id"]; ?>
&Action=ConfirmDelete"> 
<hform><center>Delete Property</center></hform>
        <center>Confirm deletion of Property<br /></center>    <p />
    <center>
    <table cellpadding="3">
    <tr>
        <td><b>Property ID</b></td>
        <td><?php echo $row[0]; ?></td>
    </tr>
    <tr>
        <td><b>Property Address</b></td>
        <td><?php echo $row[1].", ".$row[2].", ".$row[3].", ".$row[4].", ".$row[5]."."; ?></td>
    </tr>
    <tr>
        <td><b>Property Type</b></td>
        <td><?php echo $row[6]; ?></td>
    </tr>
    </table><br/>
    
    <table align="center">
    <tr>
        <td>
        <input type="submit" value="Confirm">
        </td>
        <td>
            <input type="button" value="Cancel"
                OnClick="window.location='Property.php'">
        </td>
    </tr>
    </table>
    </form>
    </center>
    <?php
        break; 
    case "ConfirmDelete":
        
     $query="DELETE FROM Property WHERE property_id =".$_GET["property_id"];
$stmt = oci_parse($conn,$query);
if(@oci_execute($stmt))
{ ?>
<center>The following property has been successfully
deleted<br />
<?php

echo"<br>";
echo"<center>";
	echo "<table style='width:50%'; border='5'; cellpadding='5'>";
		echo"<tr>";
		echo"<td><b>Property ID</b></td>";
		echo"<td>$row[0]</td>";
		echo"</tr>";
		echo"<tr>";
		echo"<td><b>Property Address</b></td>";
		echo"<td>$row[1]<br> $row[2]<br> $row[3] <br> $row[4]<br> $row[5]</td>";
		echo"</tr>";
		echo"<tr>";
		echo"<td><b>Property Type</b></td>";
		echo"<td>$row[6]</td>";
		echo"</tr>";
		
	echo"</table>";
	echo"</center>";


}
else
{
echo "<center>Error deleting property!</center>
<p />";
}
echo "<br><center><input type='button' value='Return to List'
OnClick='window.location=\"Property.php\"'>
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
 </div>
 </html>
