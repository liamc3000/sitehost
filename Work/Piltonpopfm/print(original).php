<?php
header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="requests.txt"');

echo "Listener Requests";
$con = mysql_connect("localhost","web120-liamc3000","database");  //connect to the database
if (!$con)
{
die('Could not connect: ' . mysql_error());
}
mysql_select_db("web120-liamc3000", $con);
$result = mysql_query("SELECT * FROM `SongRequests`");
while($row = mysql_fetch_array($result))  //loop to display data 
{
echo $row['RequestID'];
echo $row['SongID'];
echo $row['ArtistID'];
echo $row['AlbumID'];

}
?>