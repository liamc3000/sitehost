<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />

</head>

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

<?php
//load config
if (file_exists('./configure.php')) {
    include('./configure.php');
	}
    else {
    echo("cannot find configure.php");
  }
  
if (file_exists('./storeconfigure.php')) {
		include('./storeconfigure.php');
		}
		else {
			echo("cannot find storeconfigure.php");
		}
?>

<body>
<div id="header-wrapper">
<div id="header" class="container">
	<div id="logo">
		<h1><strong><a href="main.php">Administration</a></strong></a></h1>
	</div>
	
	<!-- TOP NAV BAR -->
	
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="main.php" accesskey="1" title="">Home</a></li>
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

<?php
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
  
// Connect to server and select database.
mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_SERVER_PASSWORD)or die("cannot connect to database"); 
mysql_select_db(DB_DATABASE)or die("cannot select DB");
	
$productname = $_POST['productname']; //sends data to server
$productdescription = $_POST['productdescription'];
$price = $_POST['price'];
$productquantity = $_POST['productquantity'];
$categoryid = $_POST['categoryid'];

$sql="INSERT INTO Products (productname, productdescription, price, productquantity, categoryid, image) VALUES ('$productname', '$productdescription', '$price', '$productquantity', '$categoryid', '$filename' )";

if (!mysql_query($sql))
    {
     die('Error: ' . mysql_error());
    }

echo "</br>";
echo "</br>";
echo "			Product has been added, Redirecting now ";
				header('Refresh: 1; URL= CategoriesProducts.php');
mysql_close();
} else {
?>
	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
		<ul class="right1">
				<h2>Add Product</h2>				
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"> <!--form options to input data-->
				Product Name: <input name="productname" type="text" id="productname" style="" required autofocus/> </br>
				Product Description: <input name="productdescription" type="text" id="productdescription" style="" required/> </br>
				Price: (&pound)<input name="text" type="number" id="price" required/> </br>
				Quantity: <input name="productquantity" type="text" id="productquantity" required/> </br>
				Category: <input name="categoryid" type="text" id="categoryid" required/> </br>
				<label for="file">Image:</label><input type="file" name="userfile" id="userfile"> </br>
				<input type="submit" name="Submit" value="Submit" /> <!--submit button-->
				</form>
				
<?php
} 
?>
				</p>
		</ul>
	</div>
	

	
</div>

	<!-- FOOTER -->
<div id="footer">
	<?php
	echo "<p>| Copyright (c) "	.	STORE_ID .	" |</p>";
	?>
</div>
</body>
</html>
