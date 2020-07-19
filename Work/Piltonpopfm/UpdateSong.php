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
<br/>

<?php
if (!empty($_POST)) {  
     
$con = mysql_connect("localhost","web120-liamc3000","database");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("web120-liamc3000", $con);
$SongID = $_POST['SongID'];
$ArtistID = $_POST['ArtistID'];
$AlbumID = $_POST['AlbumID'];
$YearID = $_POST['YearID'];
$DurationID = $_POST['DurationID'];
$CatalogID = $_POST['CatalogID'];

$sql="UPDATE playlist1 SET SongID='$SongID', ArtistID='$ArtistID', AlbumID='$AlbumID', YearID='$YearID', DurationID='$DurationID' WHERE CatalogID='$CatalogID'";
  if (!mysql_query($sql,$con))
    {
     die('Error: ' . mysql_error());
    }
    echo "Song Updated";
	echo "<br/>";
    mysql_close($con);
} else {
$con = mysql_connect("localhost","web120-liamc3000","database");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("web120-liamc3000", $con);
$CatalogID = $_GET['CatalogID'];
$result = mysql_query("SELECT SongID, ArtistID, AlbumID, YearID, DurationID, CatalogID FROM playlist1 WHERE CatalogID=$CatalogID");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);
$SongID = $row[0];
$ArtistID = $row[1];
$AlbumID = $row[2];
$YearID = $row[3];
$DurationID = $row[4];
$CatalogID = $row[5];
mysql_close($con);
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Song: <input name="SongID" type="text" id="SongID" value="<?php echo $SongID ?>" /> 
<br/>
Artist: <input name="ArtistID" type="text" id="ArtistID" value="<?php echo $ArtistID ?>" /> 
<br/>
Album: <input name="AlbumID" type="text" id="AlbumID" style="width:200px;" value="<?php echo $AlbumID ?>" />
<br/> 
Year: <input name="YearID" type="text" id="YearID" style="width:50px;" value="<?php echo $YearID ?>" />
<br/>
Duration: <input name="DurationID" type="text" id="DurationID" style="width:50px;" value="<?php echo $DurationID ?>" />
<br/> 
<input name="CatalogID" type="hidden" id="CatalogID" value="<?php echo $CatalogID ?>" /> 

<input type="submit" name="Submit" value="Update Song" />

</form>


</div>
<!--Footer-->
<div id="footer">
<br/>
&copy; Pilton Pop FM
</div>
</div>
</body>
</html>