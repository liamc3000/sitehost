<?php
session_start();
if (!empty($_POST)) {

$password = $_POST['password'];

if ($password == 'password') 
{
	$_SESSION['loggedin'] = '1';
	header('Location: admin.php');
} 

else 
{
	echo "incorrect password";
	echo "<hr / > <a href=\"login.php\">Try again</a>";

}

}

else
{
?>

<form action= "<?php echo $_SERVER['PHP_SELF']; ?> "method="post">
Password: <input name="password" type="password" id="password" /></ br>
<input type="submit" name="Submit" value="Log-in" />
</form>

<?php
}
?>
