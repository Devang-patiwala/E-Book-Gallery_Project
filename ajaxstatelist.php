<?php
error_reporting(E_ALL & ~E_NOTICE);
if(!isset($_SESSION)){ session_start(); }
include("databaseconnection.php");
?>
<div class="container">
State <br>
    <div id='loadajaxstate'>
    <select name="state" id="state" >
    </select>
    </div>
</div>
<div id="loading"></div>