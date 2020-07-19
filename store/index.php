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
			header('Refresh: 1; URL= Installation.php');
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

		<p></p>
	</div>
<?php

$productsresult = mysql_query("select * FROM Products ORDER BY productid DESC LIMIT 3;");

?>	
	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
		<ul class="right1">
			<li class="first">
				<h3>New Items</h3>
				
				<p>
				
<?php

				
				echo '<table border=0 style="background-color:; text-align:center;" >';
				echo '<tr>';
				
while($row=mysql_fetch_array($productsresult))
{

				echo "<th height=\"250\" width=\"250\" ><a href=\"ProductDescription.php?productid=" . $row['productid'] . "\" ><img src=\"./admin/images/" . $row['image'] . "\" alt=\"product image\" width=\"175\" height=\"200\"></a> </br>";
				echo $row['productname']."</br>";
				echo '&pound'.$row['price'];
				echo "</th>";


				

}
			echo '</tr>';
			echo "</table>";
				
			mysql_close();
			
?>
				</br></br></p>
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
