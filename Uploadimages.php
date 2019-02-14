<?php
ob_start();
session_start();
include("logincheck.php");
?>

<html> 
    <head>
        <title>Properties</title>
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
        <h1><a href="#" align="center"> Ruthless Real Estate </a></h1>
      </div>
      <div class="container" id="menu">
        <ul>
          <li class="first"><a title="" accesskey="1" href="main.html">Home</a></li>
          <li><a title="" accesskey="2" href="property.php">Properties</a></li>
          <li><a title="" accesskey="4" href="type.php">Type</a></li>
          <li><a title="" accesskey="3" href="feature.php">Features</a></li>
          <li><a title="" accesskey="5" href="clients.php">Our Clients</a></li>
          <li><a title="" accesskey="6" href="Documentation.php">Documentation</a></li>
        </ul>
      </div>
      <div id="page">
      <div id="content">
          </div>
            </div>
        </div>
<b><center>Upload Images</center><br></b>
<?php if (!isset($_FILES["userfile"]["tmp_name"]))
 {
 ?>
<form method="post" enctype="multipart/form-data" action="UploadImages.php"> <table border="0">
    
    <tr>
    
      <td><b>Select a file to upload:</b><br>
       <input type="file" size="50" name="userfile">
</td> </tr>
    <tr>
      <td><input type="submit" value="Upload File"> </td>
</tr>
    </table>
  </form>
<?php } 
        else 
    { 
        $upfile = "property_images/".$_FILES["userfile"]["name"]; 

        if($_FILES["userfile"]["type"] != "image/gif" && $_FILES["userfile"]["type"] != "image/pjpeg" && $_FILES["userfile"]["type"] != "image/jpeg") 
        { 
            echo "ERROR: You can only upload .jpg or .gif files"; 
        } 
        else 
        { 
             if(!move_uploaded_file($_FILES["userfile"]["tmp_name"],$upfile)) 
             { 
             echo "ERROR: Could Not Move File into Directory"; 
             } 
             else 
             { 
             echo "Uploaded File Name: " .$_FILES["userfile"]["tmp_name"]."<br /><br>"; 
             echo "File Name: " .$_FILES["userfile"]["name"]."<br /><br>"; 
             echo "File Size: " .$_FILES["userfile"]["size"]."<br /><br>"; 
             echo "File Type: " .$_FILES["userfile"]["type"]."<br /><br>"; 
             } 
        } 
    } 
?> 

    </body>
</html>