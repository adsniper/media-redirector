<?php
/*
if ($dbcnx = mysql_connect("localhost", "root", "WoQza8MVvlij")){
	@mysql_select_db("upru",$dbcnx);
	//mysql_query("SET NAMES 'cp-1251'");
	mysql_query ("set character_set_client='cp1251'");
	mysql_query ("set character_set_results='cp1251'");
	mysql_query ("set collation_connection='cp1251_general_ci'"); 
}else{
	print "База данных не доступна";
}

*/
//require_once("config.php");
//$dbuser = $dbname = 'tdb';
//$dbpassword = 'kpl3r9pBazPFjwX';
//require_once('/application/core/lib/config.php');
//$dbpassword = "";
//$dbuser = "root";
//$dbname = "articles";
$mysqli = new mysqli('localhost', $dbuser, $dbpass, $dbname);
//$mysqli = new mysqli('localhost', 'root', '', 'upru');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}else{
    $mysqli->query ("set character_set_client='utf8'");
    $mysqli->query ("set character_set_results='utf8'");
    $mysqli->query ("set collation_connection='utf8_general_ci'"); 
}

/*
$replaceDataSql = "SELECT * FROM tbl_users";
if ($resRD = $mysqli->query($replaceDataSql)) {
        while ($rowRD = $resRD->fetch_assoc()) {
            print $rowRD['id']."<br />";
        }
 }
 
  
 */