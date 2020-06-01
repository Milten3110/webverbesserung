<?php
//wird einmal geladen mit der seite 
//soll die Init darstellen
//bugy wen bereits session vorhanden ist
session_start();
if(isset($_SESSION)){

}
else{
    $_SESSION['login']                  = 0;
    $_SESSION['variante']               = 'variante2';
    $_SESSION['gesucht']                = false;
    $_SESSION['detailsBtn']             = 'details_01';
}