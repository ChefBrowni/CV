<?php
	$database_username = 'root';
	$database_password = 'root';
	$pdo_conn = new PDO( 'mysql:host=localhost;dbname=mete; charset=utf8;', $database_username, $database_password );
?>
<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'mete';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
mysqli_set_charset($mysqli,"utf8");

/* Your query */
$resultc = $mysqli->query("SELECT DISTINCT garancia FROM asd") or die($mysqli->error);
$resulta = $mysqli->query("SELECT nev FROM digitalko_kat") or die($mysqli->error);
$resultb = $mysqli->query("SELECT DISTINCT nev FROM digitalko_markak ORDER BY nev asc") or die($mysqli->error);
$resultd = $mysqli->query("SELECT DISTINCT gyarto FROM asd ORDER BY gyarto asc") or die($mysqli->error);
$resulte = $mysqli->query("SELECT DISTINCT cikkcsopnev FROM asd ORDER BY cikkcsopnev asc") or die($mysqli->error);
$resultf = $mysqli->query("SELECT DISTINCT cikkfajta FROM asd ORDER BY cikkfajta asc") or die($mysqli->error);

?>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mete";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
