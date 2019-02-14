<?php 
ob_start();
session_start(); 
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
          <li class="first"><a title="" accesskey="3" href="Client.php">Client</a></li>
          <li><a title="" accesskey="4" href="Type.php">Type</a></li>
          <li><a title="" accesskey="5" href="Feature.php">Feature</a></li>
          <li><a title="" accesskey="6" href="MultipleProperty.php">Multiple Property</a></li>
          <li><a title="" accesskey="7" href="PropertyFeature.php">PropertyFeature</a></li>
          <li><a title="" accesskey="8" href="Documentation.php">Documentation</a></li>
          <li><a title="" accesskey="9" href="Logout.php">Logout</a></li>
        </ul>
      </div>
      <div id="page">
      <div id="contentwide">
      
      <!-- insert body here-->

<?php
        if (!isset($_GET['Action']) || $_GET['Action'] != "Email")
        {
            include("connection.php");
            $conn =    oci_connect("s26524457","monash00","fit2076")
            or die("Couldn't logon.");
            $query= "SELECT CLIENT_ID, CLIENT_EMAIL FROM CLIENT WHERE CLIENT_MAILINGLIST='T'";
            $stmt = oci_parse($conn, $query);
            if(!@oci_execute($stmt))
            {
                echo "<center> ><hform style='color: red;'>Unable to connect to database</hform> </center>";
            }
        
    ?>
        <form method="post" action="ClientEmail.php" >
            
            <table border="3" id="clientemail" class="display" cellpadding="3" align="center" width="50%">
                <center>  
                <thead>
                  <th><b>Client ID</b></th>
                  <th><b>Client Email</b></th>
                  <th><b>Select Checkbox to send</b></th>
                  </thead>
                  <tbody>
                  <?php
                      while($row = oci_fetch_array($stmt))
                      {
                          ?>
                      <tr>
                      <td><center><?php echo $row[0];?></center></td>
                      <td><?php echo $row[1];?></td>
                      <td>
                          <center><?php echo '<input type="checkbox" name="to[]" value="'.$row[1].'"'?></center>
                          </td>
                      </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                </center>
        </table><br> 
            <center>
        <h3>Subject:</h3><input type="text" name="subject"><br>
        <h3>Message:</h3><textarea cols="100" name="message" rows="10"></textarea><br>
        <div class="submitButtons">
            <input class="btn btn-lg btn-primary" type="Submit" Value="Send Email">
            <input class="btn btn-lg btn-info"type="Reset" Value="Clear">
            <input class="btn btn-lg btn-info"type="Submit" Value="Back To Client List" Onclick="client.php">
        </div>
        </center>
        </form>
        <?php 
        } else {
                $from = "From: Ruthless Real Estate <kjwon13@student.monash.edu>";
                $to = implode(',' , $_POST['to']);
                $msg = $_POST["message"];
                $subject = $_POST["subject"];
                if(mail($to, $subject, $msg, $from)) {
                    echo "Mail Sent"; ?>
                    <center><br /><input class="btn btn-lg btn-primary" type="submit" value="Return to list" ></center>';
    <?php
                } else {
                    echo "Error Sending Mail";
                    header("Location: Client.php?Action=EmailFailure");
                    echo $from.$to.$msg.$subject;
                }
            }
            

    ?> 
<?php
	oci_free_statement($stmt);
	oci_close($conn);
?>   
		  
        
      
      <!-- End body-->
      
      </div>


      </div>
  
 
 <div id="footer">
        <p>Copyright © Ruthless Real Estate 2016 </p>
      </div>
      </div>
 </body>
 </html>