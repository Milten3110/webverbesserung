<?php
//wird einmal geladen mit der seite 
//soll die Init darstellen
session_start();
if(isset($_SESSION)){

}
else{
    $_SESSION["login"] = 0;
    $_SESSION['variante'] = 'variante2';
    $_SESSION['gesucht'] = false;
}