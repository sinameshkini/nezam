<?php
if(!isset($_SESSION['user_type']) || $_SESSION['user_type']<1){
    require_once ("index.php");
    exit;
}
?>