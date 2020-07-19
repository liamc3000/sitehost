<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="login.css" rel="stylesheet" type="text/css" media="all" />

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

<body>
<div id="header-wrapper">
<div id="header" class="container">
	<div id="logo">
		<h1><a href="#"><strong><a href="index.html">Administration</a></strong></a></h1>
	</div>
	
	<!-- TOP NAV BAR -->
	
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="index.php" accesskey="1" title="">Home</a></li>
		</ul>
	</div>
</div>
</div>

	<!-- MAIN SECTION -->
		
<div id="page" class="container">
	
	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
			<!--Login form-->
			</br>
			</br>
			</br>
				<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
				<tr>
				<form name="form1" method="post" action="checklogin.php">
				<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
				<td colspan="3"><strong><center>Administrator Login</center> </strong></td>
				</tr>
				<tr>
				<td width="78">Username</td>
				<td width="6">:</td>
				<td width="294"><input name="myusername" type="text" id="myusername" required autofocus></td>
				</tr>
				<tr>
				<td>Password</td>
				<td>:</td>
				<td><input name="mypassword" type="password" id="mypassword" required></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Login"></td>
				</tr>
				</table>
				</td>
				</form>
				</tr>
				</table>
			<!--login form end-->
	</div>
</div>

	<!-- FOOTER -->
<div id="footer">

</div>
</body>
</html>
