<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ezStore - Installation Wizard</title>
<link href="install1style.css" rel="stylesheet" type="text/css" media="all" />

<?php
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
			echo("cannot find configure.php");
		}
?>

</head>
<body>
<div id="maincontainer">

<div id="topsection"><div class="innertube">
	<h1>ezStore</h1>
	</br>
	<center>Installation Complete!</center></br>
</div></div>

<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube">
	</br>

	</br>
	Thank you for choosing ezStore as your e-commerce product and we hope you enjoy our system and good luck.
	</br>
	The storefront will now load from the destination which the files were copied to the server.
	</br></br>
	Administrative login is located at this url <b><?php echo ADDRESS_ID; ?>/admin</b>
	</br>
	Please write down or remember that url. Click the button below to go there.</br></br>
	<a href="admin/index.php"><button>Administration</button></a>
	</br></br>
	Click the button below if you would like to continue to the store</br></br>
	<a href="index.php"><button>Store</button></a>
	
</div>
</div>
</div>


<div id="footer"></br></br></br></br></br></br></br></br><p>| Copyright (c) ezStore |</p></div>

</body>
</html>