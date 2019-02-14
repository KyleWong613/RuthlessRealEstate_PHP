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
          <li><a title="" accesskey="4" href="Type.php">Type</a></li>
          <li><a title="" accesskey="5" href="Feature.php">Feature</a></li>
          <li><a title="" accesskey="6" href="MultipleProperty.php">Multiple Property</a></li>
          <li  class="first"><a title="" accesskey="7" href="PropertyFeature.php">Property Feature</a></li>
          <li><a title="" accesskey="8" href="Documentation.php">Documentation</a></li>
          <li><a title="" accesskey="9" href="Logout.php">Logout</a></li>
         
        </ul>
         
      </div>
      <div id="page">
      <div id="contentwide">
      
      <!-- insert body here-->


<?php
function getselect($checkval, $selectedval) {
	$selectStr = "";
	if ($checkval == $selectedval) {
		$selectStr = " Selected";
	}
	return $selectStr;
}
?>

<?php
include("connection.php");
$conn = oci_connect($UName,$PWord,$DB);
$query="SELECT * FROM Property ORDER BY property_id" ;
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
?>


<h2><center>Edit Property Features</center><br></h2>
    <?php
			
			if (!isset($_POST["id"])) {
			
			?>
			
			<form method="get" action="PropertyFeature.php">
				
				<table align="center" class="edit-table">
				
				<tr>
					<center><h2>Select Property</h2></center>
					<td>
						<select name="property_id">
						
						<option value="">Select a property</option>
						
						<?php
							while ($row = oci_fetch_array($stmt)) {
							?>

								<option value="<?php echo $row[0]; ?>" 
								<?php // 
								if (isset($_GET["property_id"])) {
								echo getselect($_GET["property_id"], $row[0]); 
									} ?>>
								<?php echo $row[1]; ?>
								</option>

							<?php	
							}
							?>

					</select>
					</td>
					<td>
						<input type="submit" value="Show Features" />
					</td>
				</tr>
				<td>
                        <center><input type="button"  value='Return to Properties List' OnClick='window.location="Property.php"' /></center>

                    </td>
				</table>
				
			</form>
			
			<?php
			
			if (isset($_GET["property_id"]) && $_GET["property_id"] != "") {
								
				?>
				
				<form method="post" action="PropertyFeature.php">
				
				<input type="hidden" name="property_id" value="<?php echo $_GET["property_id"]; ?>" />
				
				<table align="center" cellpadding="3" class="edit-table">
				
				<tr>
                    <td><b>Feature</b></td>
                    <td><b>Select</b></td>
				</tr>
				
				<?php
					
					$query = "SELECT * FROM Feature ORDER BY feature_name";
					$stmt = oci_parse($conn, $query);
					oci_execute($stmt);
				
					while ($row = oci_fetch_array($stmt)) {
						?>
						
						<tr>
							
							<td><?php echo $row[1]; ?></td>
							<td><input type='checkbox' name='check[]' value='<?php echo $row[0]; ?>'
							<?php
								// A new statement to select from new table
								$query2 = "SELECT * FROM PropertyFeature WHERE property_id = ".$_GET["property_id"]." AND feature_id = ".$row[0];
								$stmt2 = oci_parse($conn, $query2);
								oci_execute($stmt2);
								
								if ($row = oci_fetch_array($stmt2)) {
									echo "checked";
								}
						   	?> /></td>
							
						</tr>
						
						<?php
						
					}
				?>
				
				</table>
				
				<table align="center">
				<tr>
					<td><input type="submit" value="Update Property with selected Features"></td>
					<td><input type="button" value="Cancel" onclick="window.location='PropertyFeature.php'"></td>
				</tr>
			</table>
					
				</form>
				
				<?php
				
			} else {
				
				echo "<center>Please select a property to edit.</center>";
				
			}
			
			} else {

				$query = "DELETE FROM PropertyFeature WHERE property_id = ".$_POST["property_id"];
				$stmt = oci_parse($conn, $query);
				oci_execute($stmt);

				if (isset($_POST["check"])) {
					
					foreach($_POST["check"] as $feature) {
						$query = "INSERT INTO PropertyFeature VALUES (".$_POST["property_id"].", :feature)";
						$stmt = oci_parse($conn, $query);
						oci_bind_by_name($stmt, ":feature", $feature);
						oci_execute($stmt);
					}
				}
				
				echo "<p>Property features were updated.</p>";
				echo "<a href='PropertyFeature.php?id=".$_POST["property_id"]."'>Return to Property Features</a>";
				
			}
			
			?>
    <?php
	oci_free_statement($stmt);
	oci_close($conn);
    ?>

      
      <!-- End body-->
      
      </div>
<center><br /><a href="showpropertyfeature.php" target="_blank" >
  <img src="PropertyFeature.png" alt="PropertyFeatureBox" >
</a></center>

      </div>
  
 
 <div id="footer">
        <p>Copyright © Ruthless Real Estate 2016 </p>
      </div>
 </body>
 </html>
