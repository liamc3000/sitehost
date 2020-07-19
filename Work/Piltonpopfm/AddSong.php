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
<br/>
	<center><a href="AddSong.php" id="AddSong">Add Song</a></center>
	<center><a href="ModifyPlaylist.php" id="ModifyPlaylist">Modify/Delete Songs</a></center>
	<center><a href="ViewRequests.php" id="ViewRequestsLink">View Requests</a></center>
	
<?php
if (!empty($_POST)) {  
     
$con = mysql_connect("localhost","web120-liamc3000","database");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

  mysql_select_db("web120-liamc3000", $con);

  
  $SongID = $_POST['SongID']; //sends data to server
  $ArtistID = $_POST['ArtistID'];
  $AlbumID = $_POST['AlbumID'];
  $YearID = $_POST['YearID'];
  $DurationID = $_POST['DurationID'];
  $PlaylistID = $_POST['PlaylistID'];
  
  if ($PlaylistID == "1") //decides which database data goes into
  {
	$sql="INSERT INTO playlist1 (SongID, ArtistID, AlbumID, YearID, DurationID) VALUES ('$SongID', '$ArtistID', '$AlbumID', '$YearID', '$DurationID')";
  }
	elseif ($PlaylistID =="2")
	{
		$sql="INSERT INTO playlist2 (SongID, ArtistID, AlbumID, YearID, DurationID) VALUES ('$SongID', '$ArtistID', '$AlbumID', '$YearID', '$DurationID')";
	}
		elseif ($PlaylistID =="3")
		{
			$sql="INSERT INTO playlist3 (SongID, ArtistID, AlbumID, YearID, DurationID) VALUES ('$SongID', '$ArtistID', '$AlbumID', '$YearID', '$DurationID')";
		}

  if (!mysql_query($sql,$con))
    {
     die('Error: ' . mysql_error());
    }
    echo "song has been added";
    mysql_close($con);

} else {
?>

<h2>Add a song</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!--form options to input data-->
Song: <input name="SongID" type="text" id="SongID" /> </br>
Artist: <input name="ArtistID" type="text" id="ArtistID" /> </br>
Album: <input name="AlbumID" type="text" id="AlbumID" /> </br>
Year: <input name="YearID" type="text" id="YearID" /> </br>
Duration: <input name="DurationID" type="text" id="DurationID" /> </br>
Playlist: <select name="PlaylistID" type="text" id="PlaylistID" /> </br> <!--drop down list-->
			<option>1</option>
			<option>2</option>
			<option>3</option>
		</select>

<input type="submit" name="Submit" value="Add Song" /> <!--submit button-->
</form>

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