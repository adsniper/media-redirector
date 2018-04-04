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
<link rel='stylesheet' href='/css/styles.css' type='text/css' media='all'>
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
        }
    </style>
<?php

if (isAdmin()){
    require_once("config.php");
    require_once("dbi_ini.php");
    $query = "SELECT l.link, SUM(s.cnt) cn FROM links l, stats s WHERE l.id = s.linkid GROUP BY s.linkid ORDER BY cn DESC";
    $linksstat = array();
    if ($res = $mysqli->query($query)) {
        while ($row = $res->fetch_assoc()) {
            $linksstat[] = $row;
        }
    }

    print "<style>
                .cell {
                    border: 1px solid;
                }
               </style>";
    print "Статистика редиректов<br />";
    print "<table style='border: 1px solid;'>";
    print "<tr>
            <th class='cell'>URL</th>
            <th class='cell'>Всего редиректов</th>
       </tr>";
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
 ?></body>
</html>