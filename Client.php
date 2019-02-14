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
          <li><a title="" accesskey="7" href="PropertyFeature.php">Property Feature</a></li>
          <li><a title="" accesskey="8" href="Documentation.php">Documentation</a></li>
          <li><a title="" accesskey="9" href="Logout.php">Logout</a></li>
        </ul>
      </div>
      <div id="page">
      <div id="contentwide">
      
      <!-- insert body here-->
<script>
function PDF() {
    window.location.href = "Client.php? Action=PDF";
}

</script>        

<center><h2>Clients List</h2></center>
<?php
$css = "style.css";
echo "<link rel='stylesheet' href='" . $css . "'>";
include("connection.php");
$conn = oci_connect($UName,$PWord,$DB) or die("Couldn't logon.");
$query="SELECT * FROM Client ORDER BY client_id ASC";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
echo"<center>";
echo "<table style='width:50%'; border='3'; cellpadding='3'>";
echo"<tr>";
echo"<th><center>Client ID</center></th>";
echo"<th>Family Name</th>";
echo"<th>Given Name</th>";
echo"<th>Street</th>";
echo"<th>Town</th>";
echo"<th>Postcode</th>";
echo"<th>State</th>";
echo"<th>Country</th>";
echo"<th>E-mail</th>";
echo"<th>Mobile No.</th>";
echo"<th><center>Mailing List</center></th>";
echo "<th colspan='2'>Action</th>";
echo"</center>";
echo "</tr>";
	while ($row = oci_fetch_array ($stmt))
	{
    
	echo "<tr>";
	echo "<td><center>$row[0]</center></td>";
	echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
    echo "<td>$row[5]</td>";
    echo "<td>$row[6]</td>";
	echo "<td>$row[7]</td>";
    echo "<td>$row[8]</td>";
    echo "<td>$row[9]</td>";
    echo "<td><center>$row[10]</center></td>";
	echo "<td><center><a href='ClientUpdate.php?client_id=$row[0]&Action=Update'> Update </a></center></td>";
	echo "<td><center><a href='ClientUpdate.php?client_id=$row[0]&Action=Delete'> Delete </a></center></td>";
	echo "</tr>";
    
	}
echo "</table>";
echo "</center>";
?>
<br>
<center><input type="button" value="Add" OnClick="window.location='ClientAdd.php'">
<button class="edit btn btn-lg btn-primary" onClick="PDF();">Create Clients PDF</button>
<input type="button" value="Send Email" OnClick="window.location='ClientEmail.php'"></center>
<br>
<br>
    
    
    
<?php    
    if(isset($_GET["Action"])) 
{
    switch($_GET["Action"])
    {
        case "PDF":    
        define('FPDF_FONTPATH', '/FPDF/font');
        require ("FPDF/fpdf.php");
        class XFPDF extends FPDF {
            function ftable($header, $data) {
                $this -> SetFillColor(20, 145, 186);
                $this -> SetTextColor(180, 205, 235);
                $this -> SetDrawColor(50, 0, 0);
                $this -> SetLineWidth(.2);
                $this -> SetFont('', 'B');
                $w = array(25,35,35,55,25);
                
                $this -> Cell($w[0], 6, $header[0], 1, 0, 'C', 1);
                $this -> Cell($w[1], 6, $header[1], 1, 0, 'C', 1);
                $this -> Cell($w[2], 6, $header[2], 1, 0, 'C', 1);
                $this -> Cell($w[3], 6, $header[3], 1, 0, 'C', 1);
                $this -> Cell($w[4], 6, $header[4], 1, 0, 'C', 1);
                
                $this -> Ln();
                $this -> SetFillColor(224, 235, 255);
                $this -> SetTextColor(0, 0, 0);
                $this -> SetFont('');
                $fill = 0;

                foreach ($data as $row)
                {
                    $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
                    $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                    $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
                    $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
                    $this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
                    $this->Ln();
                    $fill=!$fill; 
                }
                $this -> Cell(array_sum($w), 0, '', 'T');
            }
        }

        $query = "SELECT * FROM Client ORDER BY client_id";
        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);
        $nrows = oci_fetch_all($stmt, $results);
        if ($nrows > 0)
        {
           $data = array();
           $header = array();
            while(list($column_name) = each($results))
            {
                $header[] = $column_name;
            }
            for($i=0; $i<$nrows; $i++)
            {
                reset($results);
                $j=0;
                while(list(,$column_value) = each($results))
                {
                    $data[$i][$j] = $column_value[$i];
                    $j++;
                }
            }
        } else {
            echo "No Records Found";
        }
        oci_free_statement($stmt);
        $pdf = new XFPDF();
        $pdf->SetFont('Arial','B',14);
        $pdf->AddPage();
        $pdf->Write(10, "Ruthless Real Estate Client List");
        $pdf->Ln();
        $pdf->SetFont('Arial','',5);
        $pdf->ftable($header,$data);
        $pdf->Output('F','PDF/Clients.pdf');
            ?>
        <html> <head><title></title></head> <body>
        <center>
            <br>
            <br>
        <a href="PDF/Clients.pdf">Click here to see PDF</a>
            
        </center>
            <br>
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arvo%7COswald" />
        <link media="all" type="text/css" rel="stylesheet" href="style.css" />
    <?php
        echo "<type='button' value='Return to Clients List' OnClick='window.location=\"Client.php\"'>";
        break; 

        case "GeneratePDFsuccess":
        echo '<h2>PDF Successfully created.</h2><br />';
        echo '<input class="btn btn-lg btn-primary" type="button" value="Return to list" onClick=window.location="Client.php">';
        break;
    
    default:
        header("Location: Client.php");
        break;
    }
}
  ?>  



    

        
      
      <!-- End body-->
      
      </div>
<center><a href="showclient.php" target="_blank">
    <img src="Client.png" alt="ClientBox">
        </a></center>

      </div>
  
 
 <div id="footer">
        <p>Copyright © Ruthless Real Estate 2016 </p>
      </div>
 </body>
 </html>