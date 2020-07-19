<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />

</head>

<?php
if (file_exists('./storeconfigure.php')) {
		include('./storeconfigure.php');
		}
		else {
			echo("cannot find storeconfigure.php");
		}
?>

<style type="text/css">
  input:required:invalid, input:focus:invalid {
    background-image: url(/icons/invalid.png);
    background-position: right top;
    background-repeat: no-repeat;
  }
  input:required:valid {
    background-image: url(/icons/valid.png);
    background-position: right top;
    background-repeat: no-repeat;
  }
</style>

<body>
<div id="header-wrapper">
<div id="header" class="container">
	<div id="logo">
		<h1><a href="#"><strong><a href="index.html">Administration</a></strong></a></h1>
	</div>
	
	<!-- TOP NAV BAR -->
	
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="index.php" accesskey="1" title="">Home</a></li>
			<li><a href="Logout.php" accesskey="2" title="">Log Out</a></li>
		</ul>
	</div>
</div>
</div>

	<!-- MAIN SECTION -->
		
<div id="page" class="container">
	
	<!-- LEFT COLUMN -->
	
	<div id="content">	
		<div class="leftcolumn">
		
		<!-- CATEGORIES -->
			<div class="title"><h2>Options</h2></div>
			<a href="CategoriesProducts.php" style="text-decoration:none;">View Categories</a></br></br>
			<a href="AddCategory.php" style="text-decoration:none;">Add Category</a></br></br>
			<a href="CategoriesProducts.php" style="text-decoration:none;">View Products</a></br></br>
			<a href="AddProduct.php" style="text-decoration:none;">Add Product</a></br></br>
			<a href="EditStore.php" style="text-decoration:none;">Store Settings</a></br></br>

			</br>
		</div>
	</div>
	
	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
		<ul class="right1">
			<li class="first">
				<h3>Edit Product</h3></br>

<?php
//load config
if (file_exists('./configure.php')) {
    include('./configure.php');
	}
    else {
    echo("cannot find configure.php");
  }
  
// Connect to server and select database.
mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_SERVER_PASSWORD)or die("cannot connect to database"); 
mysql_select_db(DB_DATABASE)or die("cannot select DB");

if (!empty($_POST)) {

//image uploader

$uploaddir = "./images/";
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo "<p>";

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  echo "File is valid, and was successfully uploaded.\n";
} else {
   echo "Upload failed";
}

echo "</p>";

//end of uploader
$filename = "";
$filename = $_FILES['userfile']['name'];

$productname = $_POST['productname'];
$productdescription = $_POST['productdescription'];
$price = $_POST['price'];
$categoryid = $_POST['categoryid'];
$productquantity = $_POST['productquantity'];
$productid = $_POST['productid'];

if ($filename == "")
{
$sql="UPDATE Products SET productname='$productname', productdescription='$productdescription', price='$price', categoryid='$categoryid', productquantity='$productquantity' WHERE productid='$productid'";
} else {
$sql="UPDATE Products SET productname='$productname', productdescription='$productdescription', price='$price', categoryid='$categoryid', productquantity='$productquantity', image='$filename' WHERE productid='$productid'";
  }
  if (!mysql_query($sql))
    {
     die('Error: ' . mysql_error());
    }
    echo "Product Updated";
	echo "<br/>";
    mysql_close();
} else {

$productid = $_GET['productid'];
$result = mysql_query("SELECT productname, productdescription, price, categoryid, productquantity, productid FROM Products WHERE productid=$productid");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);
$productname = $row[0];
$productdescription = $row[1];
$price = $row[2];
$categoryid = $row[3];
$productquantity = $row[4];
$productid = $row[5];
mysql_close();
}
?>
				
				<p><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
				Product Name: <input name="productname" type="text" id="productname" value="<?php echo $productname ?>" required autofocus/> 
				<br/>
				Description: <input name="productdescription" type="text" id="productdescription" value="<?php echo $productdescription ?>" required/> 
				<br/>
				Price (£): <input name="price" type="text" id="price" style="width:200px;" value="<?php echo $price ?>" required/>
				<br/> 
				Category: <input name="categoryid" type="text" id="categoryid" style="width:50px;" value="<?php echo $categoryid ?>" required/>
				<br/>
				Quantity: <input name="productquantity" type="text" id="productquantity" style="width:50px;" value="<?php echo $productquantity ?>" required/>
				<br/>
				<label for="file">Image:</label><input type="file" name="userfile" id="userfile"> </br>				
				<input name="productid" type="hidden" id="productid" value="<?php echo $productid ?>" /> 

				<input type="submit" name="Submit" value="Submit" />
				</form>
</br></p>
			</li>
		</ul>
	</div>
</div>

	<!-- FOOTER -->
<div id="footer">
	<p>| Copyright (c) Site Name |</p>
</div>
</body>
</html>
