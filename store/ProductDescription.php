<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />

</head>

<!-- Image viewer -->
<script type="text/javascript" src="../highslide/highslide-with-gallery.js"></script>
<link rel="stylesheet" type="text/css" href="../highslide/highslide.css" />
 
<script type="text/javascript">
    hs.graphicsDir = '../highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>

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
	
<!--PHP-->

<?php


//filling tables
$productid = $_GET['productid'];
$result =  mysql_query("SELECT productname, productdescription, price, categoryid, productquantity, image FROM Products WHERE productid=$productid");
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
$image = $row[5];
mysql_close();
?>

	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
		<ul class="right1">

<?php
echo "<h3>$productname</h3>";
echo "<a id=\"thumb1\" href=\"./admin/images/" . $image . "\" class=\"highslide\" onclick=\"return hs.expand(this)\">
<img src=\"./admin/images/" . $image . "\" alt=\"Highslide JS\" width=\"400\" height=\"400\" align=\"left\" id=\"image\" ></a> ";
?>


</br>
</br>


<?php
echo '<p style="margin-left:15px; float:center;"><b>';
echo "&pound"; echo $price; 
echo '</b>';
?>  
		<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">

		<!-- Identify your business so that you can collect the payments. -->
		<input type="hidden" name="business" value="<?php echo Paypal_EMAIL?>">

		<!-- Specify a PayPal Shopping Cart Add to Cart button. -->
		<input type="hidden" name="cmd" value="_cart">
		<input type="hidden" name="add" value="1">

		<!-- Specify details about the item that buyers will purchase. -->
		<input type="hidden" name="item_name" value="<?php echo $productname?>">
		<input type="hidden" name="amount" value="<?php echo $price?>">
		<input type="hidden" name="currency_code" value="GBP">

		<!-- Display the payment button. -->
		<input type="image" name="submit" border="0"
			src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_addtocart_120x26.png"
			alt="PayPal - The safer, easier way to pay online" float="right">
		<img alt="" border="0" width="1" height="1"
			src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
		</form></br>
		
<?php

if ($productquantity > 0)
  {
	echo "In Stock</br>";
  }
  else
  {
    echo "Out of Stock";
  }


echo "product id: $productid</br></br>";
echo $productdescription;


?>


			</p>
		</ul>
	</div>
</div>

<div class="highslide-caption">
    <?php echo $productname; ?>
</div>

	<!-- FOOTER -->
<div id="footer">
	<?php
	echo "<p>| Copyright (c) "	.	STORE_ID .	" |</p>";
	?>
</div>
</body>
</html>
