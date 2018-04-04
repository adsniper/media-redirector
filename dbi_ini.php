<?php

//$dbpassword = "";
//$dbuser = "root";
//$dbname = "articles";
$mysqli = new mysqli('localhost', $dbuser, $dbpassword, $dbname);
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