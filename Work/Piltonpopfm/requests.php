<html>
<head>
<title>Pilton Pop FM</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<meta name="description" content="Pilton Pop FM radio station" />
<meta name="keywords" content="pilton, pop, fm, radio, 80's, 90's, playlist" />
<meta name="author" content="Liam Crosby" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
</head>

<body>
<div id="wrapper">
<!--banner-->
<div id="banner">
Pilton Pop FM
</div>

<!--Navigation Bar-->
<div id="sidebar">
<center><img src="images/logo.gif" alt=""/></center>
  <ul class="nav">
    <li><a href="index.php" id="IndexLink">Home</a></li>
    <li><a href="playlists.php" id="PlaylistLink">Our Playlists</a></li>
	<li><a href="presenters.php" id="PresentersLink">Presenters &amp; Shows</a></li>
	<li><a href="requests.php" id="RequestsLink">Request A Song</a></li>
    <li><a href="login.php" id="AdminLink">Administration</a></li>
  </ul>
</div>

<!--Main content section-->
<div id="main">
<h1>Request a song</h1>

<?php
if (!empty($_POST)) {  
     
$con = mysql_connect("localhost","web120-liamc3000","database"); //connects to mysql
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

  mysql_select_db("web120-liamc3000", $con); //chooses right databse

  $RequestID = $_POST['RequestID']; //sends data to server
  $SongID = $_POST['SongID'];
  $ArtistID = $_POST['ArtistID'];
  $AlbumID = $_POST['AlbumID'];
  
  $sql="INSERT INTO SongRequests (RequestID, SongID, ArtistID, AlbumID) VALUES ('$RequestID', '$SongID', '$ArtistID', '$AlbumID')"; //puts data into correct places

  if (!mysql_query($sql,$con))
    {
     die('Error: ' . mysql_error());
    }
    echo "Request Sent!";
    mysql_close($con); //closes connection

} else {
?>

 
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!--input boxes for information-->
Your Name:    <input name="RequestID" type="text" id="RequestID" /> <br/>
Song Title:   <input name="SongID" type="text" id="SongID" /> <br/>
Artist Name:  <input name="ArtistID" type="text" id="ArtistID" /> <br/>
Album Name:   <input name="AlbumID" type="text" id="AlbumID" /> <br/>

<input type="submit" name="Submit" value="Send Request" /> <!--submit button to send data-->
</form>
</body>
<?php 
} 
?>

</div>
<!--Footer-->
<div id="footer">
<br/>
&copy; Pilton Pop FM
</div>
</div>
</body>
</html>
