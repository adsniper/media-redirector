<?php
//$custom_proj = 'custom.up.ru';
//$ucoz_proj = 'ucoz.up.ru';
//function redirectIfNeed($from){
//    print $from;
//    print $_SERVER['SERVER_NAME'];
//    if ($from == 'index' && $_SERVER['SERVER_NAME'] == $ucoz_proj){
//        print "-1-";
//        header('Location: /ucoz.php');
//    }elseif ($from == 'ucoz' && $_SERVER['SERVER_NAME'] == $custom_proj){
//        print "-2-";
//        header('Location: /index.php');
//    }
//}
function login($login, $password){
//    if ($login == 'admin' && $password == 'test12345'){
    if ($login == 'admin' && $password == 'mBm76A8TdRw5VDtc'){
        session_start(); 
        $_SESSION['isadmin'] = 1;
        $_SESSION['log'] = $login;
        return true;
    }
    return false;
}

//function getUserData($params=array()){
//    if (!$params || count($params) == 0){
//        return array('user'=>$_SESSION['user']);
//    }elseif(count($params) == 1){
//        $nameParam = $params[0];
//        return $_SESSION[$nameParam];
//    }elseif(count($params) > 1){
//        $newArr = array();
//        foreach ($params as $k => $v){
//            $newArr[$v] = $_SESSION[$v];
//        }
//        return $newArr;
//    }
//}
//function matchData(){
//    if ( (getUserData(array('user')) == 'custom' && $_SERVER['SERVER_NAME'] == $custom_proj) ||
//         (getUserData(array('user')) == 'ucoz' && $_SERVER['SERVER_NAME'] == $ucoz_proj)
//        ){
//        return true;
//    }else{
//        return false;
//    }
//}

function isAdmin(){
    if ( isset($_SESSION) && isset($_SESSION['isadmin']) &&  $_SESSION['isadmin'] == "1" ){
        return true;
    }else{
        session_destroy();
        return false;
    }
}

function logout(){
    if ( !isset($_SESSION) ){
        session_start();
    }
    session_destroy();
    header('Location:/stats.php');
}