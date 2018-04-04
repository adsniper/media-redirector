<?php

require_once("config.php");
require_once("dbi_ini.php");

$getData = "SELECT * FROM links ORDER BY RAND() LIMIT 1;";
$linkdata = array();
if ($res = $mysqli->query($getData)) {
    while ($row = $res->fetch_assoc()) {
        $linkdata = $row;
    }
}
if (count($linkdata)>0){
    if (!preg_match("/^http:\/\//i", $linkdata['link']) && !preg_match("/^https:\/\//i", $linkdata['link']) ){
        $link = "https://".$linkdata['link'];
    }else{
        $link =$linkdata['link'];
    }
    $date = time();
    $mysqli->query("INSERT stats (`linkid`, `date`) VALUES ('".$linkdata['id']."', '".$date."')");
    header('Location: '.$link);
}
exit;


