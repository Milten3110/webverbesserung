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

function resetFormData(){
    unset($_SESSION['reg_user']     ); 
    unset($_SESSION['reg_password1']); 
    unset($_SESSION['reg_password2']); 
    unset($_SESSION['reg_email1']   ); 
    unset($_SESSION['reg_email2']   ); 
}