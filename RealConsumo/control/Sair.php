<?php

//if (!isset($_SESSION)) {
//    session_start();
//}
require_once '../classes/Util.php';
$util = new Util();
session_destroy();
$util->redirecionamentopage('../view/Login.php');    
