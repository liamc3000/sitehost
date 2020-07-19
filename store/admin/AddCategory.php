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
		<h1><a href="#"><strong><a href="main.php">Administration</a></strong></a></h1>
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

<?php
if (!empty($_POST)) {
	
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
	
$name = $_POST['name']; //sends data to server

$sql="INSERT INTO Categories (name) VALUES ('$name')";

if (!mysql_query($sql))
    {
     die('Error: ' . mysql_error());
    }

echo " Category has been added ";
mysql_close();

} else {
?>
	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
		<ul class="right1">
			<li class="first">
				<h2>Add Category</h2>
				<p>Category Name:</br>
				
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!--form options to input data-->
				<input name="name" type="text" id="name" required autofocus/>
				<input type="submit" name="Submit" value="Submit" /> <!--submit button-->
				</form>
				
<?php
} 
?>
				</p>
			</li>
		</ul>
	</div>
	

	
</div>

	<!-- FOOTER -->
<div id="footer">
	<?php
	echo "</br>";
	echo "<p>| Copyright (c) "	.	STORE_ID .	" |</p>";
	?>
</div>
</body>
</html>
