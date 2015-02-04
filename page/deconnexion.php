<?php 
session_start();

$_SESSION = array();
session_destroy();

/*echo $_COOKIE['auth'];
setcookie('auth', 'deco', time()+3600);
echo $_COOKIE['auth'];*/

header("Location: $racine");

?>