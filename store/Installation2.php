<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ezStore - Installation Wizard</title>
<link href="installstyle.css" rel="stylesheet" type="text/css" media="all" />

<style type="text/css">

  input:required:invalid, input:focus:invalid {
    background-image: url(/images/invalid.png);
    background-position: right top;
    background-repeat: no-repeat;
  }
  input:required:valid {
    background-image: url(/images/valid.png);
    background-position: right top;
    background-repeat: no-repeat;
  }

</style>

</head>
<body>
<div id="maincontainer">

<div id="topsection"><div class="innertube">
	<h1>ezStore</h1>
	</br>
	<center>Installation Wizard Step 2</center></br>
</div>
<center><h2>This stage will ask for the administation settings. Please ensure all fields are accurate otherwise the website won't function as intended.</h2></center></br></br>
</div>

<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube">
	</br>
	</br>
	</br>
	</br>
	</br>
	<b>Store Settings</b></br>
	<b>Store Name:</b>
	</br>
	<b>Owners Name:</b>
	</br>
	<b>E-Mail:</b>
	</br>
	<b>Administrator Username:</b>
	</br>
	<b>Administrator Password:</b>
	</br>
	<b>Paypal E-mail Address:</b>
	</br>
	</br>
	<label for="file"><b>Logo:</b></label>
	</br>
	</br>
	</br>
	
</div>
</div>
</div>

<div id="rightcolumn">
<div class="innertube">

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
  
  //load config
	if (file_exists('./configure.php')) {
		include('./configure.php');
		}
		else {
			echo("cannot find configure.php");
		}
 
	// Connect to server and select database.
	mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_SERVER_PASSWORD)or die("cannot connect to database, Please ensure correct database information was inputted"); 
	mysql_select_db(DB_DATABASE)or die("cannot select DB");
	
	$adminID = $_POST['adminID'];
	$adminpasswordID = $_POST['adminpasswordID'];
	
	$sql1="INSERT INTO Administrators (username, password) VALUES ('$adminID', '$adminpasswordID')";
	
	if (!mysql_query($sql1))
    {
     die('Database connection failed, Error: ' . mysql_error());
    }
	
	mysql_close();
	echo "Installation Complete";
	header('Refresh: 2; URL= Installation3.php');
	} else {
?>	

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	<input name="storeID" type="text" id="storeID" required/> Store Name given to public
	</br>
	<input name="ownerID" type="text" id="ownerID" required/> Owners name given to public
	</br>
	<input name="emailID" type="email" id="emailID" required/> E-mail given to public
	</br>
	<input name="adminID" type="text" id="adminID" required/> Administration username
	</br>
	<input name="adminpasswordID" type="password" id="adminpasswordID" required/> Administration password
	</br>
	<input name="paypalemail" type="email" id="paypalemail" required/> Paypal merchant account email <bold>Required for payments</bold>
	</br>
	</br>
	<input type="file" name="userfile" id="userfile"> Website Logo, Optimal sizing 150x250pixel 
	</br>
	</br>
	</br>
	Please ensure all information is present and correct before submitting otherwise website may not function properly</br></br>
	<input type="submit" value="Submit"/>
	</br></br></br>
	</form>
<?php
	}
?>
</div>
</div>




<div id="footer"></br></br></br></br><p>| Copyright (c) ezStore |</p></div>

</body>
</html>