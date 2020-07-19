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
	<center>Installation Wizard Step 1</center></br>
</div>
<center><h2>This stage will ask for the settings to configure your online store. Please ensure all fields are accurate otherwise the website won't function as intended.</h2></center></br></br>
</div>

<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube">
	</br>
	</br>
	</br>
	</br>
	</br>
	<b>Database Settings</b></br>
	<b>Server ip/hostname:</b>
	</br>
	<b>Username:</b>
	</br>
	<b>Password:</b>
	</br>
	<b>Database Name:</b>
	</br>
	</br>
	<b>Web Server</b></br>
	<b>WWW Address:</b>
	</br>
	</br>
	</br>
	</br>
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
                   '  define(\'ADDRESS_ID\', \'' . $addressID . '\');' . "\n" .
$file_contents .= '?>';

 $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);
  
 $fp = fopen($_SERVER['DOCUMENT_ROOT'] . 'admin/configure.php', 'w');
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
	mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_SERVER_PASSWORD)or die("cannot connect to database"); 
	mysql_select_db(DB_DATABASE)or die("cannot select DB");
	
	//create databases required
	$sql="CREATE TABLE IF NOT EXISTS `Administrators` (`id` int(4) NOT NULL AUTO_INCREMENT, `username` varchar(65) NOT NULL DEFAULT '', `password` varchar(65) NOT NULL DEFAULT '', PRIMARY KEY (`id`))";
	$sql1="CREATE TABLE IF NOT EXISTS `Categories` (`id` int(11) NOT NULL AUTO_INCREMENT, `name` text NOT NULL, UNIQUE KEY `id` (`id`))";
	$sql2="CREATE TABLE IF NOT EXISTS `Products` (`productid` int(11) NOT NULL AUTO_INCREMENT, `productquantity` int(11) NOT NULL, `price` double NOT NULL, `categoryid` int(11) NOT NULL, `image` varchar(50) NOT NULL,
  `productname` text NOT NULL, `productdescription` text NOT NULL, PRIMARY KEY (`productid`))";
	
	
	if (!mysql_query($sql))
    {
     die('Error: ' . mysql_error());
    }
	
	if (!mysql_query($sql1))
    {
     die('Error: ' . mysql_error());
    }
	
	if (!mysql_query($sql2))
    {
     die('Error: ' . mysql_error());
    }
	
	
	mysql_close();
	header('Refresh: 2; URL= installation2.php');
	} else {
?>	

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	<input name="hostnameID" type="text" id="hostnameID" required autofocus/> Database hostname or ip address
	</br>
	<input name="usernameID" type="text" id="usernameID" required/> Database login username
	</br>
	<input name="passwordID" type="text" id="passwordID" required/> Database login password
	</br>
	<input name="dbnameID" type="text" id="dbnameID" required/> Name of database to store content within
	</br>
	</br>
	</br>
	<input name="addressID" type="url" id="addressID" required/> Url for online store
	</br>
	</br>
	Please ensure all information is present and correct before submitting otherwise website may not function properly</br>
	<input type="submit" value="Submit"/>
	</br></br></br>
	</form>
<?php
	}
?>
</br>
</br>
</div>
</div>




<div id="footer"></br></br></br></br><p>| Copyright (c) ezStore |</p></div>

</body>
</html>