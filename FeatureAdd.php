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
          <li ><a title="" accesskey="2" href="Property.php">Property</a></li>
          <li ><a title="" accesskey="3" href="Client.php">Client</a></li>
          <li ><a title="" accesskey="4" href="Type.php">Type</a></li>
          <li class="first"><a title="" accesskey="5" href="Feature.php">Feature</a></li>
          <li><a title="" accesskey="6" href="MultipleProperty.php">Multiple Property</a></li>
          <li ><a title="" accesskey="7" href="Property Feature.php">PropertyFeature</a></li>
          <li><a title="" accesskey="8" href="Documentation.php">Documentation</a></li>
          <li><a title="" accesskey="9" href="Logout.php">Logout</a></li>
        </ul>
      </div>
      <div id="page">
      <div id="contentwide">
      
      <!-- insert body here-->

  <?php
ob_start();

?>

<html> 

<div id="addform">
<hform>Add Feature</hform>
<head>
<title>Feature </title>
</head>
<body>
<script language="JavaScript">
    function VerifyDataEntry(theForm)
{
	
	if (theForm.feature_name.value.trim().length == 0) 
    {
        alert("Please enter a value for \"Feature Name\" field");
        theForm.feature_name.focus();
        return false;
    }
	
    return true;
}
</script>

<?php
    if (empty($_POST["feature_name"]))
    {
        ?>
    <form method="post" Action = "FeatureAdd.php" OnSubmit="return VerifyDataEntry(this)">
    
    <p /> Enter Feature Details <p />
   
<table cellpadding= "5">

<tr>
    <td><b>Feature Name</b></td>  
    <td><input type="text" name="feature_name" size="30"></td>
</tr>

</table><br/>
    
    
    
    
    
    <input class="btn btn-lg btn-primary" type="Submit" Value="Submit">
    <input type="Reset" Value="Clear Form Fields">
    <input type="Button" Value="Return to list" onClick="window.location='Feature.php'">
    
    </form>
    
   
<?php
	}
	else
    {
 include("connection.php");
 $conn = oci_connect($UName,$PWord,$DB)
 or die("Couldn't logon.");
 
 $query="INSERT INTO Feature (feature_id, feature_name) VALUES(feature_seq.nextval, '$_POST[feature_name]')";
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