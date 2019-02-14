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
          <li class="first"><a title="" accesskey="3" href="Client.php">Client</a></li>
          <li ><a title="" accesskey="4" href="Type.php">Type</a></li>
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

<script language="javascript"> 
    function confirm_delete() 
    {
    window.location='ClientUpdate.php?client_id=<?php echo
    $_GET["client_id"]; ?>&Action=ConfirmDelete';
    }
	
	function VerifyDataEntry(theForm)
{
    if(theForm.fname.value == "")
    {
        alert("Please enter a value for \"Family Name\" field");
        theForm.fname.focus();
        return false;
    }
    return true;
}
</script>
    
<?php
$css = "style.css";
echo "<link rel='stylesheet' href='" . $css . "'>";
    include("connection.php");
$conn = oci_connect($UName,$PWord,$DB) or die("Couldn't logon.");
    $query="SELECT * FROM Client WHERE client_id =".$_GET["client_id"];
    $stmt = oci_parse($conn,$query);
    oci_execute($stmt);
    $row = oci_fetch_array ($stmt);
    switch($_GET["Action"])
    {
        case "Update": 
    ?>
    <hform>Update Client</hform>
        <form method="post" action="ClientUpdate.php?
            client_id=<?php echo $_GET["client_id"]; ?>
            &Action=ConfirmUpdate" OnSubmit="return VerifyDataEntry(this)">

        <table cellpadding="3">
    
        <tr>
            <td><b>Client ID:</b></td>
            <td><?php echo $row[0]; ?></td>
        </tr>
            
        <tr>
            <td><b>Family Name</b></td>
            <td><input type="text" name="fname" size="30"
            value="<?php echo $row[1]; ?>" required="required"></td>
        </tr>
        <tr>
            <td><b>Given Name</b></td>
            <td><input type="text" name="gname" size="30"
            value="<?php echo $row[2]; ?>" required="required"></td>
        </tr>
        <tr>
        
            <td><br /><b><u>Address</u></b></td>
        </tr>
        <tr>
            <td><b>Street</b></td>
            <td><input type="text" name="street" size="30"
            value="<?php echo $row[3]; ?>" required="required"></td>
        </tr>
        <tr>
            <td><b>Client Town</b></td>
            <td><input type="text" name="town" size="30"
            value="<?php echo $row[4]; ?>" required="required"></td>
        </tr>
        
        <tr>
            <td><b>Client Pc</b></td>
            <td><input type="text" name="pc" size="30"
            value="<?php echo $row[5]; ?>" required="required"></td>
        </tr>
        
        <tr>
            <td><b>Client State</b></td>
            <td><input type="text" name="state" size="30"
            value="<?php echo $row[6]; ?>" required="required"></td>
        </tr>
            
        <tr>
            <td><b>Client Country</b></td>
            <td><input type="text" name="country" size="30"
            value="<?php echo $row[7]; ?>" required="required"></td>
        </tr>
            
        
        
        <tr>
            <td><br /><b>Client Email</b></td>
            <td><br /><input type="text" name="email" size="30"
            value="<?php echo $row[8]; ?>" required="required"></td>
        </tr>
            
        <tr>
            <td><b>Client Mobile</b></td>
            <td><input type="text" name="mobile" size="30"
            value="<?php echo $row[9]; ?>" required="required"></td>
        </tr>    
            
        <tr>
            <td><b>Client Mailing List</b></td>
            <td><select name="mailinglist">
            <option <?php if($row[10] == 'T'){echo("selected");}?> value="T">T</option>
  <option <?php if($row[10] == 'F'){echo("selected");}?> value="F">F</option>
    </select></td>
        </tr>
            
        </table><br/>
        <table>
        <tr>
            <td><input type="submit" value="Update Client"></td>
            <td><input type="button" value="Return to List"
            OnClick="window.location='Client.php'"></td>
        </tr>
        </table>
        </form>

        <?php
            break;
            case "ConfirmUpdate":
				
$query="UPDATE Client set client_familyname='$_POST[fname]', client_givenname='$_POST[gname]', client_street='$_POST[street]', client_suburb='$_POST[town]', client_pc='$_POST[pc]', 
client_state='$_POST[state]', client_country='$_POST[country]', client_email='$_POST[email]' , client_mobile='$_POST[mobile]', client_mailinglist='$_POST[mailinglist]' WHERE client_id =".$_GET["client_id"];
				
                $stmt = oci_parse($conn,$query);
                oci_execute($stmt);
            header("Location: Client.php");

            break;
            case "Delete":
        ?>
        <form method="post" action="ClientUpdate.php?
client_id=<?php echo $_GET["client_id"]; ?>
&Action=ConfirmDelete"> 
<hform><center>Delete Client</center></hform>
            <br /><center>Confirm deletion of this client?<br /></center>

    
        <table align="center" cellpadding="3">
        <tr>
            <td><b>Client ID:</b></td>
            <td><?php echo $row[0]; ?></td>
        </tr>
        <tr>
            <td><b>Client Name:</b></td>
            <td><?php echo $row[1].' '.$row[2]; ?></td>
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
            OnClick="window.location='Client.php'">
            </td>
        </tr>
        </table>
            </form>
    
        <?php
            break;
            case "ConfirmDelete":
            $query="DELETE FROM Client WHERE client_id =".$_GET["client_id"];
            $stmt = oci_parse($conn,$query);
            if(@oci_execute($stmt))
        { 
        echo "<center>The following customer record has been successfully deleted<br /> </center>";
		echo "<center>";
            echo "<br><b>Client ID. : </b>".$row[0];
            echo "<br><b>Client Name: </b>".$row[1]." ".$row[2];
            echo "</center>";
			echo "<center><input type='button' value='Return to List'
            OnClick='window.location=\"Client.php\"'>
            </center>";
			
        }
            else
        {
            echo "<center>Error deleting Client record</center>
            <p />";
        
            echo "<center><input type='button' value='Return to List'
            OnClick='window.location=\"Client.php\"'>
            </center>";
        }
            break;

            
            case "EmailSuccess":    
                echo '<h2> Email Successfully Sent</h2><br/>';
                echo '<input class="btn btn-lg btn-primary" type="button" value="Return to list" onClick=window.location="Client.php">';
                break;
        
            case "EmailFailure":
                echo '<h2> Failed to deliver Email</h2><br/>';
                echo '<input class="btn btn-lg btn-primary" type="button" value="Return to list" onClick=window.location="Client.php">';
                break;
        
            case "InsertSuccess": 
                echo '<h2> Client Added Successfully</h2></br>';
                echo '<input class="btn-lg btn-primary" type="button" value="Return to List" onClick=window.location="Client.php">';
            break;
            
            case "InsertFailure":
                echo '<h2> Failed to Add Client</h2></br>';
                echo '<input class="btn-lg btn-primary" type="button" value="Return to List" onClick=window.location="Client.php">';
            break;
        
    }
        
        if(!isset($_GET["Action"])) 
        {
            $query= "SELECT * FROM CLIENT";
            $stmt = oci_parse($conn, $query);
            if(!@oci_execute($stmt)) {
                echo "<center style='color: red;'><h1>Failed to connect to the database<h1></center>";
                echo "<center style='color: red;'><h2>Try refreshing<h2></center>";
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