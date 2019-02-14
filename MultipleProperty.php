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
          <li  class="first"><a title="" accesskey="6" href="MultipleProperty.php">Multiple Property</a></li>
          <li><a title="" accesskey="7" href="PropertyFeature.php">Property Feature</a></li>
          <li><a title="" accesskey="8" href="Documentation.php">Documentation</a></li>
          <li><a title="" accesskey="9" href="Logout.php">Logout</a></li>
         
        </ul>
         
      </div>
      <div id="page">
      <div id="contentwide">
      
      <!-- insert body here-->
      
   <?php
ob_start();
session_start();
?>

<?php
    include("connection.php");
    $conn = oci_connect($UName,$PWord,$DB);
    $query="SELECT * FROM Property ORDER BY property_id" ;
    $stmt = oci_parse($conn, $query);
    oci_execute($stmt);
?>

<h2><center>Edit Multiple Property Listings</center><br></h2>

    <?php
        
			if (!isset($_GET["Action"]) || $_GET["Action"] != "Update") {
			?>
        
            <form id="multiproperty" class="edit-form" method="post" action="multipleproperty.php?Action=Update" onsubmit="return validateForm(this)">
        
            <table border="1" align="center" class="display-table">
                
                
            <tr>
				<th>Property ID</th>
                <th>Property Name</th>
				<th>Address</th>
				<th>Town</th>
				<th>Type</th>
				<th>Listing Price</th>
			</tr>
        
        <?php
                $data = false;
                while ($row = oci_fetch_array($stmt))
                {
                    // Need a new statement to select from new table(Listing Table)
                    $data = true;
                    $query= "SELECT listing_price FROM Listing WHERE listing_id =".$row[0];
					$stmt2 = oci_parse($conn, $query);
					oci_execute($stmt2);
					$row2 = oci_fetch_array($stmt2);
                
                
                ?>
            <tr>
				<td><?php echo $row[0]?></td>
                <td><?php echo $row[1]?></td>
                <td><?php echo $row[2]?></td>
                <td><?php echo $row[3]?></td>
                <td><?php echo $row[4]?></td>
                <td><?php echo $row[5]?></td>
                
              </tr>  
        <?php
          
                    // Need a new statement to select from new table(Propertytype Table)
                    $query = "SELECT type_name FROM Propertytype WHERE type_id =".$row[0];
					$stmt2 = oci_parse($conn, $query);
					oci_execute($stmt2);
					$type = oci_fetch_array($stmt2);
                    oci_free_statement($stmt2);
            
        ?>
        
        <tr>
				<td><?php echo $type[0]?></td>
                <td><input type="number" name="<?php echo $row[0]; ?>" min="0" value="<?php echo $row2[0]; ?>" required /><input type="submit" value="Update Prices" /></td>

        </tr>
                
        
        <?php  }
            if (!$data) {
                echo "<tr><td colspan='5'><p>No properties found.</p></td></tr>";
            }
        ?>
        </table>
        </form>
        
        <script language="javascript">
        $("#multiproperty").validate();
        </script>
        
        <?php } 
        else {
            while ($row = oci_fetch_array($stmt)) {
                
                $query = "UPDATE Listing SET listing_price=:price WHERE property_id=:id";
					$stmt2 = oci_parse($conn, $query);
					oci_bind_by_name($stmt2, ":price", $_POST[$row[0]]);
					oci_bind_by_name($stmt2, ":id", $row[0]);
					oci_execute($stmt2);
                
            }
            echo "<center>";
            echo "<p>Listing price updated.</p>";
            echo "</center>";
            ?>
            <center><br /><input type="Button" Value="Return to Multiple Properties List" onClick="window.location='multipleproperty.php'"></center>
        <?php
        }
        ?>
        <br>
        
        <tr>
            
           <center><br /><input type="Button" Value="Return to Properties List" onClick="window.location='Property.php'"></center>

        </tr>
    <?php
	oci_free_statement($stmt);
	oci_close($conn);
    ?>
      <!-- End body-->
      
      </div>

<center><br /><a href="showmultipleproperty.php" target="_blank" >
  <img src="MultipleProperty.png" alt="MultiplePropertyBox" >
</a></center>

      </div>
  
 
 <div id="footer">
        <p>Copyright © Ruthless Real Estate 2016 </p>
      </div>
 </body>
 </html>
