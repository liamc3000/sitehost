<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
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
	
	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
		<ul class="right1">
			<li class="first">
				<h3>Categories</h3>
				<p>
<!--PHP-->

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

//filling tables
$categoriesresult = mysql_query("select * from Categories");
$productsresult = mysql_query("select * from Products");

?>
				<!-- Categories Table -->

				<a href="AddCategory.php"><button type="button">Add Category</button></a>
				</br>
				<table border=0 style="background-color:;" > <!--creates table-->
				<tr>
				<th>ID</th>
				<th>Name</th>
				</tr>
<?php				
while($row=mysql_fetch_array($categoriesresult)) 
{
	echo "<tr><td>";
	echo $row['id']; //puts results in table
	echo "</td><td>";
	echo $row['name'];
	echo "</td><td>";
	echo " ( <a href=\"DeleteCategory.php?id="	. $row['id']	.	"\" onclick=\"return confirm ('Are you sure you wish to delete?')\">Delete</a> )"; //puts row id in url if clicked and loads page
	echo "</td></tr>";
}
	echo "</table>";
?>
				</p>
				</br>
				
				<!-- Products Table -->
				
				<h3>Products</h3>
				<p><a href="AddProduct.php"><button type="button">Add Product</button></a>
				</br>
				<table border=0 style="background-color:;" > <!--creates table-->
				<tr>
				<th>ID</th>
				<th>Product Name</th>
				<th>Price</th>
				<th>Category</th>
				<th>Quantity</th>
				</tr>
<?php				
while($row=mysql_fetch_array($productsresult)) 
{
	echo "<tr><td>";
	echo $row['productid']; //puts results in table
	echo "</td><td>";
	echo $row['productname'];
	echo "</td><td>";
	echo $row['price'];
	echo "</td><td>";
	echo $row['categoryid'];
	echo "</td><td>";
	echo $row['productquantity'];
	echo "</td><td>";
	echo " ( <a href=\"EditProduct.php?productid="	. $row['productid']	.	"\" >Edit</a> )"; //puts product id in url
	echo "</td><td>";
	echo " ( <a href=\"DeleteProduct.php?productid="	. $row['productid']	.	"\" onclick=\"return confirm ('Are you sure you wish to delete?')\">Delete</a> )"; //puts product id in url if clicked and loads page
	echo "</td></tr>";
}
	echo "</table>";
	
	mysql_close();
?>
				
				</p>
			</li>
			<li>

			</li>
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
