<?php
require_once 'config.php';
require_once 'fct/fct_mysql.php';
/*
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/

$username = null;
if (isset($_SESSION['username'])) {
    //Ajoute un shaarli
    if($_POST['id']) {
        $mysqli = shaarliMyConnect();
        
        if(isset($_POST['do']) && $_POST['do'] == 'delete') {
            deleteRss($mysqli, $_SESSION['username'], $_POST['id']);
        }elseif(isset($_POST['do']) && $_POST['do'] == 'add') {
            $monRss = creerMonRss($_SESSION['username'], $_POST['id'], $_SESSION['username']);
            insertEntite($mysqli, 'mes_rss', $monRss);
        }
        
        shaarliMyDisconnect($mysqli);
        header('HTTP/1.1 200 OK', true, 200);
        return;
    }
}else{
    header('HTTP/1.1 401 Unauthorized', true, 401);
    return;
}
header('HTTP/1.1 401 Bad Request', true, 400);
return;
