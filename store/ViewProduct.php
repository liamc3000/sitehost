<!DOCTYPE html>
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
		
	// Connect to server and select database.
	mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_SERVER_PASSWORD)or die("cannot connect to database"); 
	mysql_select_db(DB_DATABASE)or die("cannot select DB");

	//filling tables
	$categoriesresult = mysql_query("select * from Categories");
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
	<img src="/admin/icons/<?php echo LOGO_ID; ?>" width="250px" height="150px" style="padding-right:20px float:left">
	<div id="logo">
	</br></br>
		<h1><strong><a href="index.php"><?php echo STORE_ID; ?></a></strong></a></h1>
	</div>
	
	<!-- TOP NAV BAR -->
	
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="index.php" accesskey="1" title="">Home</a></li>
			<li></br></br></br><form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="business" value="<?php echo Paypal_EMAIL?>">
				<input type="image" align="center" src="https://www.paypal.com/en_US/i/btn/btn_viewcart_LG.gif" style="padding-left:10px; padding-top:2px;" border="0" name="submit" alt="">
				<img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
				<input type="hidden" name="display" value="1">
				</form></li>
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
			<div class="title"><h2>Categories</h2></div>
			<hr>
			<!-- lists categories -->
			
			<table border=0 style="background-color:;" >
<?php				
while($row=mysql_fetch_array($categoriesresult)) 
{
	echo "<tr><td>";
	echo "<a href=\"ViewProduct.php?keyword=&sort=&id="	. $row['id']	.	"\" style=\"text-decoration:none;\">" . $row['name'] . "</a>";
	echo "</td></tr>";
	
}
	echo "</table>";
?>
			</br>
			</br>
		<!-- SEARCH -->
			<div class="title"><h2>Search</h2></div>
			<hr>
			<form method="post" action="SProcess.php">
			<input name="search" type="text" id="search">
			<input type="submit" value="Go" name="submit">
			</form>	 
			</br>
			</br>
		<!-- About -->	
			<div class="title"><h2>About</h2></div>
			<hr>
			<a href="contact.php" style="text-decoration:none;">Contact Us</a>
			</br>
			</br>
		</div>
	</div>
	
	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
		<ul class="right1">
				<h3>Products</h3>
				<p> 
				
<?php
$id = $_GET['id'];

if ( $_GET['keyword'] != "")
{
$keyword = $_GET['keyword'];
}
else
{
$keyword = "";
}

if ( $_GET['sort'] != "")
{
$sort = $_GET['sort'];
}
else
{
$sort = "";
}


if ($sort == "")
{
	if ($id == "")
	{
		$productsresult = mysql_query("select * FROM Products");
	}
	else
	{
		$productsresult = mysql_query("select * FROM Products WHERE categoryid=$id");
	}
}
else if ($sort == "priceasc")
{
	if ($id == "")
	{
		$productsresult = mysql_query("select * FROM Products ORDER BY price ASC");
	}
	else
	{
		$productsresult = mysql_query("select * FROM Products WHERE categoryid=$id ORDER BY price ASC");
	}
}
else if ($sort == "pricedes")
{
	if ($id == "")
	{
		$productsresult = mysql_query("select * FROM Products ORDER BY price DESC");
	}
	else
	{
		$productsresult = mysql_query("select * FROM Products WHERE categoryid=$id ORDER BY price DESC");
	}
}
else if ($sort == "alphabet")
{
	if ($id == "")
	{
		$productsresult = mysql_query("select * FROM Products ORDER BY productname ASC");
	}
	else
	{
		$productsresult = mysql_query("select * FROM Products WHERE categoryid=$id ORDER BY productname ASC");
	}
}



?>
				<!-- Product Table -->
				
				Sort by:
				<a href="ViewProduct.php?keyword=<?php echo $keyword; ?>&id=<?php echo $id; ?>&sort=alphabet "><button type="button">Alphabetical</button></a>
				<a href="ViewProduct.php?keyword=<?php echo $keyword; ?>&id=<?php echo $id; ?>&sort=priceasc  "><button type="button">Price Ascending</button></a>
				<a href="ViewProduct.php?keyword=<?php echo $keyword; ?>&id=<?php echo $id; ?>&sort=pricedes "><button type="button">Price Descending</button></a>

		
				</br>
				<table border=0 style="background-color:;" > <!--creates table-->
				<tr>
				<th></th>
				<th></th>
				</tr>
<?php				
while($row=mysql_fetch_array($productsresult)) 
{
	echo '<tr><td height="100" width="150" overflow="hidden">';
	echo " <a href=\"ProductDescription.php?productid=" . $row['productid'] . "\" ><img src=\"./admin/images/" . $row['image'] . "\" alt=\"product image\" width=\"60\" height=\"95\"></a> "; //puts results in table
	echo '</td><td height="100" width="400" overflow="hidden">';
	echo $row['productname']."</br>";
	echo '</td><td height="100" width="70" overflow="hidden">';
	echo '&pound'.$row['price'];
	echo '</td><td height="100" width="150" overflow="hidden">';
	echo " <a href=\"ProductDescription.php?productid="  . $row['productid']    .   "\" ><button type=\"button\">View Product</button></a> "; //puts row id in url if clicked and loads page
	echo "</td></tr>";
}
	echo "</table>";
	
	mysql_close();
?>
				
				
				</br> </br></p>
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