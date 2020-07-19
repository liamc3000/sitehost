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
	
	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
		<ul class="right1">
				<h2>Home</h2>
				<p>This is the administration section of the website. Products and Categories can be managed by either clicking the button below or clicking Categories/Products in the sidebar</br></br> 
				<a href="CategoriesProducts.php"><button type="button">Categories & Products</button></a>
				</br></p>
				
<!--Usage stats start -->

<H2>Store Usage Statistics</H2>
</br>


<!--Usage stats end -->
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
