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
	
<h1>Playlist 1</h1>
<br/>
<?php
$con = mysql_connect("localhost","web120-liamc3000","database"); //connects to database
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("web120-liamc3000", $con);

$result = mysql_query("select * from playlist1"); //selects correct data

?>
	
	<table border=1 style="background-color:#F0F8FF;" > <!--creates table-->
	<tr>
	<th>Song</th>
	<th>Artist</th>
	<th>Album</th>
	<th>Year</th>
	<th>Duration</th>
	<th>Update</th>
	<th>Delete</th>
	</tr>
	
<?php
	while($row=mysql_fetch_array($result)) 
{
	echo "<tr><td>";
	echo $row['SongID']; //puts results in table
	echo "</td><td>";
	echo $row['ArtistID'];
	echo "</td><td>";
	echo $row['AlbumID'];
	echo "</td><td>";
	echo $row['YearID'];
	echo "</td><td>";
	echo $row['DurationID'];
	echo "</td><td>";
	echo " ( <a href=\"UpdateSong.php?CatalogID="	. $row['CatalogID']	.	"\">Update</a> )"; //puts catalog id in url if clicked and loads page
	echo "</td><td>";
	echo " ( <a href=\"DeleteSong.php?CatalogID="	. $row['CatalogID']	.	"\">Delete</a> )"; //puts catalog id in url if clicked and loads page
	echo "</td></tr>";
}
	echo "</table>";

mysql_close($con);
?>
	
<br/>
<h1>Playlist 2</h1>
<br/>
	
<?php
$con = mysql_connect("localhost","web120-liamc3000","database"); //repeats same process as first php
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("web120-liamc3000", $con);

$result = mysql_query("select * from playlist2");

?>
	
	<table border=1 style="background-color:#F0F8FF;" >
	<tr>
	<th>Song</th>
	<th>Artist</th>
	<th>Album</th>
	<th>Year</th>
	<th>Duration</th>
	<th>Update</th>
	<th>Delete</th>
	</tr>
	
<?php
	while($row=mysql_fetch_array($result))
{
	echo "<tr><td>";
	echo $row['SongID'];
	echo "</td><td>";
	echo $row['ArtistID'];
	echo "</td><td>";
	echo $row['AlbumID'];
	echo "</td><td>";
	echo $row['YearID'];
	echo "</td><td>";
	echo $row['DurationID'];
	echo "</td><td>";
	echo " ( <a href=\"UpdateSong2.php?CatalogID="	. $row['CatalogID']	.	"\">Update</a> )";
	echo "</td><td>";
	echo " ( <a href=\"DeleteSong2.php?CatalogID="	. $row['CatalogID']	.	"\">Delete</a> )";
	echo "</td></tr>";
}
	echo "</table>";

mysql_close($con);
?>
	
<br/>
<h1>Playlist 3</h1>
<br/>
	
<?php
$con = mysql_connect("localhost","web120-liamc3000","database"); //once again repeats same process
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("web120-liamc3000", $con);

$result = mysql_query("select * from playlist3");

?>
	
	<table border=1 style="background-color:#F0F8FF;" >
	<tr>
	<th>Song</th>
	<th>Artist</th>
	<th>Album</th>
	<th>Year</th>
	<th>Duration</th>
	<th>Update</th>
	<th>Delete</th>
	</tr>
	
<?php
	while($row=mysql_fetch_array($result))
{
	echo "<tr><td>";
	echo $row['SongID'];
	echo "</td><td>";
	echo $row['ArtistID'];
	echo "</td><td>";
	echo $row['AlbumID'];
	echo "</td><td>";
	echo $row['YearID'];
	echo "</td><td>";
	echo $row['DurationID'];
	echo "</td><td>";
	echo " ( <a href=\"UpdateSong3.php?CatalogID="	. $row['CatalogID']	.	"\">Update</a> )";
	echo "</td><td>";
	echo " ( <a href=\"DeleteSong3.php?CatalogID="	. $row['CatalogID']	.	"\">Delete</a> )";
	echo "</td></tr>";
}
	echo "</table>";

mysql_close($con); //closes connection
?>

<br/>		
	
</div>
<!--Footer-->
<div id="footer">
<br/>
&copy; Pilton Pop FM
</div>
</div>
</body>
</html>