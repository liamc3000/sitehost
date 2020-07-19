<?php

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

  $id = $_GET['id'];
  $sql="DELETE FROM Categories where id=$id";
  $result=mysql_query($sql);
  
  if ($result)
    {
    echo "Category Deleted!";
	header('Refresh: 1; URL= CategoriesProducts.php');
    }
    else
	{
	echo "Error";
	}
    mysql_close();
	
	
?>