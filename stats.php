<?php
require_once 'adminfuncs.php';
if(isset($_POST['login']) && isset($_POST['password'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (login($login, $password)){
        header('Location: /stats.php');
    }
}
if (isset($_GET) && isset($_GET['logout']) && $_GET['logout'] == 1){
    logout();
}
session_start();
header('Powered: test');
header('Content-Type: text/html; charset=utf-8'); 
//setlocale(LC_ALL, 'nl_NL');
setlocale(LC_ALL, 'ru_RU.UTF-8');
date_default_timezone_set('Europe/Moscow');
# Turn on error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);



?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
<title>Ucoz rt</title>
<script type="text/javascript" src="/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<link rel='stylesheet' href='/css/bootstrap.css' type='text/css' media='all'>
<link rel='stylesheet' href='/css/style.css' type='text/css' media='all'>

<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/moment.js"></script>
<link rel='stylesheet' href='/css/jquery-ui.css' type='text/css' media='all'>

<!-- link rel="stylesheet" type="text/css" href="/css/demo.css" />
<link rel='stylesheet' href='/css/component.css' type='text/css' media='all'>
<link rel="stylesheet" type="text/css" href="/css/formenu.css" /
<script type="text/javascript" src="/js/modernizr.custom.js"></script -->

<script type="text/javascript" src="/js/urlmanager.js"></script>
<script type="text/javascript" src="/js/daterange.js"></script>
<link rel='stylesheet' href='/css/daterangepicker.css' type='text/css' media='all'>
<script type="text/javascript" src="/js/maindate.js"></script>

</head>
<body>
    <style>
        body{
            padding: 20px;
        }
        .form-signin {
            margin: 0 auto;
            max-width: 330px;
            padding: 15px;
        }
        .cell{
            padding-left: 10px;
            padding-right: 10px;
            border: 1px solid;
        }
    </style>
<?php

function getWhereDates($dates){
    $where = "";
    if (count($dates) == 2){
        $dates[0] = trim($dates[0]);
        $dates[1] = trim($dates[1]);
        $datesar1 = explode(".",$dates[0]);
        $datesar2 = explode(".",$dates[1]);
        if (count($datesar1) == 3 && count($datesar2) == 3){
            $datesar1[1] = intval($datesar1[1]);
            $datesar1[0] = intval($datesar1[0]);
            $datesar2[1] = intval($datesar2[1]);
            $datesar2[0] = intval($datesar2[0]);
            $dfrom = mktime(0,0,0,$datesar1[1], $datesar1[0], $datesar1[2]);
            $dto = mktime(23,59,59,$datesar2[1], $datesar2[0], $datesar2[2]);
            $where = " AND date>=".$dfrom." AND date<=".$dto." ";
        }
    }
    return $where;
}
if (isAdmin()){
    require_once("config.php");
    require_once("dbi_ini.php");
    
    
    $dates = array();
    if (isset($_GET['d'])){
        $d = $_GET['d'];
        $dates = explode("-", $d);
    }else{
        $t1 = time();
        $t2 = $t1 - 86400*7;
        $dates[0] = date("d.m.Y", $t2);
        $dates[1] = date("d.m.Y", $t1);
    }
    
    $where = getWhereDates($dates);
    
    $query = "SELECT l.link, SUM(s.cnt) cn FROM links l, stats s WHERE l.id = s.linkid ".$where." GROUP BY s.linkid ORDER BY cn DESC";
    $linksstat = array();
    if ($res = $mysqli->query($query)) {
        while ($row = $res->fetch_assoc()) {
            $linksstat[] = $row;
        }
    }
    ?>
    
    <strong>Статистика редиректов</strong><br /><br />
    <div class="datepic" style="float: none; margin-left: 0px;">
        <div class="fleft"><input id="datedat_interval" type="text" name="daterange" value="" class="dp-inp"/>
        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
    </div>
    <br /><br />
    <table style='border: 1px solid;'>
    <tr>
        <th class='cell'>URL</th>
        <th class='cell'>Всего редиректов</th>
    </tr>
    
    <?php
    $data_main = array();
    $im = 0;
    foreach($linksstat as $k=>$v){
        print "<tr>
                <td class='cell'>".$v['link']."</td>
                <td class='cell'>".$v['cn']."</td>
               </tr>";
        $im++;
    }
    print "</table>";
}else{
    
    ?>
    <style>
        body {
            background-color: #eee;
            padding-bottom: 40px;
            padding-top: 40px;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px;
            line-height: 1.42857;
        }
        
    </style>

    <div class="container">
        <form class="form-signin" action="/stats.php" method="post">
          <h2 class="form-signin-heading">Авторизация</h2>
          <label for="inputEmail" class="sr-only">Логин</label>
          <input  class="form-control" name="login" placeholder="Login"  autofocus>
          <label for="inputPassword" class="sr-only">Пароль</label>
          <input type="password" class="form-control" name="password" placeholder="Password" >
          <!-- div class="checkbox">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div -->
          <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        </form>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="js/ie10-viewport-bug-workaround.js"></script>-->

<?php
 }
 ?>
    
    <script>
        function reloadPage(){
            var valDates = $("#datedat_interval").val(), uidStr="";
            var valGeo = "", frod = "", idcurr, currParams = "";
//            if ($("#p_geo").hasClass("act")){
//                valGeo = "1";
//            }
//            if ($("#frodshow").hasClass("act")){
//                frod = "&frod=1";
//            }
            if ($("#curr_select a").length > 0){
                idcurr = $("#curr_select a.act").attr("id").split("_")[1];
                currParams = '&curr='+idcurr;
            }
//            if (uid != '0'){
//                uidStr = "&uid="+uid;
//            }
            window.location.href = '/stats.php?d='+valDates+''+currParams;
        }
    </script>
    </body>
</html>