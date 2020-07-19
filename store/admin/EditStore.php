<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
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
				</b><h2>Edit Store</h2></b>
				Here the store settings that were used for installation can be changed.</br>
				Please ensure all information is present and correct before submitting otherwise website may not function properly


<?php
if (!empty($_POST)) {

//image uploader

$uploaddir = "./icons/";
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo "<p>";

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  echo "All changes were successfull.\n";
} else {

}

echo "</p>";

//end of uploader
$filename = $_FILES['userfile']['name'];

if ($filename == "")
{ }
else if ($LOGO_ID != "")
{
$filename = $LOGO_ID;
}

// Connect to server and select database.
mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_SERVER_PASSWORD)or die("cannot connect to database"); 
mysql_select_db(DB_DATABASE)or die("cannot select DB");

//Database Settings changes
$hostnameID = $_POST['hostnameID'];
$username = $_POST['usernameID'];
$password = $_POST ['passwordID'];
$dbnameID = $_POST['dbnameID'];
$addressID = $_POST['addressID'];

$file_contents = '<?php' . "\n" .
                   '  define(\'DB_HOSTNAME\', \'' . $hostnameID . '\');' . "\n" .
                   '  define(\'DB_USERNAME\', \'' . $username . '\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'' . $password . '\');' . "\n" .
                   '  define(\'DB_DATABASE\', \'' . $dbnameID . '\');' . "\n" .
                   '  define(\'ADDRESS_ID\', \'' . $addressID . '\');' . "\n" ;
$file_contents .= '?>';

 $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);
  
 $fp = fopen($_SERVER['DOCUMENT_ROOT'] . 'admin/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);
  
//store settings changes
$storeID = $_POST['storeID'];
$ownerID = $_POST['ownerID'];
$emailID = $_POST['emailID'];
$adminID = $_POST['adminID'];
$adminpasswordID = $_POST['adminpasswordID'];
$paypalemail = $_POST['paypalemail'];

$file_contents = '<?php' . "\n" .
				   '  define(\'STORE_ID\', \'' . $storeID . '\');' . "\n" .
				   '  define(\'OWNER_ID\', \'' . $ownerID . '\');' . "\n" .
				   '  define(\'EMAIL_ID\', \'' . $emailID . '\');' . "\n" .
				   '  define(\'ADMIN_ID\', \'' . $adminID . '\');' . "\n" .
				   '  define(\'ADMIN_PASSWORD_ID\', \'' . $adminpasswordID . '\');' . "\n" .
				   '  define(\'LOGO_ID\', \'' . $filename . '\');' . "\n" .
				   '  define(\'Paypal_EMAIL\', \'' . $paypalemail . '\');' . "\n" ;
				   
$file_contents .= '?>';

 $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/storeconfigure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);
  
 $fp = fopen($_SERVER['DOCUMENT_ROOT'] . 'admin/storeconfigure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);
  
}
else {
?>
				
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	<table border=0 style="background-color:;">
		<tr>
		<td>Database Settings</td>
		</tr>
		<tr>
		<td>Server ip/hostname:</td><td><input name="hostnameID" type="text" id="hostnameID" size="35" value="<?php echo DB_HOSTNAME ?>" required autofocus/> Database hostname or ip address</td>
		</tr>
		<tr>
		<td>Username:</td><td><input name="usernameID" type="text" id="usernameID" size="35" value="<?php echo DB_USERNAME ?>" required/> Database login username </td>
		</tr>
		<tr>
		<td>Password:</td><td> <input name="passwordID" type="text" id="passwordID" size="35" value="<?php echo DB_SERVER_PASSWORD ?>" required/> Database login password </td>
		</tr>
		<tr>
		<td>Database Name:</td><td> <input name="dbnameID" type="text" id="dbnameID" size="35" value="<?php echo DB_DATABASE ?>" required/> Name of database to store content within </td>
		</tr>
		<tr>
		<td>Web Server</td>
		</tr>
		<tr>
		<td>WWW Address:</td><td> <input name="addressID" type="url" id="addressID" size="35" value="<?php echo ADDRESS_ID ?>" required/> Url for online store </td>
		</tr>
		<tr>
		<td>Store Settings</td>
		</tr>
		<tr>
		<td>Store Name</td><td><input name="storeID" type="text" id="storeID" size="35" value="<?php echo STORE_ID ?>" required/> Store Name given to public</td>
		</tr>
		<tr>
		<td>Owners Name:</td><td><input name="ownerID" type="text" id="ownerID" size="35" value="<?php echo OWNER_ID ?>" required/> Owners name given to public</td>
		</tr>
		<tr>
		<td>E-Mail:</td><td><input name="emailID" type="email" id="emailID" size="35" value="<?php echo EMAIL_ID ?>" required/> E-mail given to public</td>
		</tr>
		<tr>
		<td>Administrator Username:</td><td><input name="adminID" type="text" id="adminID" size="35" value="<?php echo ADMIN_ID ?>" required/> Administration username</td>
		</tr>
		<tr>
		<td>Administrator Password:</td><td><input name="adminpasswordID" type="password" id="adminpasswordID" size="35" value="<?php echo ADMIN_PASSWORD_ID ?>" required/> Administration password</td>
		</tr>
		<tr>
		<td>Paypal E-Mail Address:</td><td><input name="paypalemail" type="email" id="paypalemail" size="35" value="<?php echo Paypal_EMAIL ?>" required/> Paypal merchant account email <bold>Required</bold></td>
		</tr>
		<tr>
		<td><label for="file">Logo:</label></td><td> <input type="file" name="userfile" id="userfile"> Website Logo
		</tr>
		<tr>
		<td><input type="submit" name="Submit" value="Submit" /></td>
		</tr>
	</form>	
				
<?php
} 
?>		

				
		</ul>
	</div>
</div>

	<!-- FOOTER -->
<div id="footer">
	<?php
	//echo "<p>| Copyright (c) "	.	STORE_ID .	" |</p>";
	?>
</div>
</body>
</html>
