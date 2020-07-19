<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />

</head>

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

		<p></p>
	</div>

<?php
 
if (!empty($_POST)) {
 
 
    $email_to = EMAIL_ID;
 
    $email_subject = "Store Contact Form ";
 

 
    function died($error) {
 
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['first_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['comments'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $first_name = $_POST['first_name']; // required
 
    $email_from = $_POST['email']; // required
 
    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
 
  }
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'The Message you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);
	
	
echo "Message Sent! </br> We will get back to you as soon as possible";

} else {
?>	
	<!-- RIGHT COLUMN -->
	
	<div id="rightcolumn">
		<ul class="right1">
				<h3>Contact Form</h3>
				<p>Contact us by using the form below or emailing <b><?php echo EMAIL_ID; ?></b> </br>
				
				<form name="contactform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 
<table width="450px">
 
<tr>
 
 <td valign="top">
 
  <label for="first_name">Name:</label>
 
 </td>
 
 <td valign="top">
 
  <input  type="text" name="first_name" maxlength="50" size="30" required autofocus>
 
 </td>
 
</tr>
  
<tr>
 
 <td valign="top">
 
  <label for="email">Email Address:</label>
 
 </td>
 
 <td valign="top">
 
  <input  type="email" name="email" maxlength="80" size="30" required>
 
 </td>
 
</tr>
 
<tr>
 
 <td valign="top">
 
  <label for="comments">Message:</label>
 
 </td>
 
 <td valign="top">
 
  <textarea  name="comments" maxlength="1000" cols="45" rows="10" required></textarea>
 
 </td>
 
</tr>
 
<tr>
 
 <td colspan="2" style="text-align:center">
 
  <input type="submit" value="Submit" name="submit" />
 
 </td>
 
</tr>
 
</table>
 
</form>

<?php
} 
?>
				
				</br></p>
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
