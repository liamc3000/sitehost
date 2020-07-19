
<?php header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="Requests.txt"'); //sets text file name


		$con = mysql_connect("localhost","web120-liamc3000","database"); //server login details
		if (!$con)
  		{
    			die('Could not connect: ' . mysql_error());
  		}

		mysql_select_db("web120-liamc3000", $con);


$query = "Select * from SongRequests"; //selects data

$dbRecords = mysql_query($query);


 
while ($arrRecords = mysql_fetch_array($dbRecords))
{

$RequestID = $arrRecords["RequestID"];
$SongID = $arrRecords["SongID"];
$ArtistID = $arrRecords["ArtistID"];
$AlbumID = $arrRecords["AlbumID"];
$CatalogID = $arrRecords["CatalogID"];

echo "$RequestID $SongID $ArtistID $AlbumID $CatalogID\r\n" ; //writes data to file

}


mysql_close($con); //closes connection



?>