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

    unset($_SESSION['reg_name']);
    unset($_SESSION['reg_nachname']);
    unset($_SESSION['reg_born']);
    unset($_SESSION['reg_nummer']);
    unset($_SESSION['reg_bundesland']);
    unset($_SESSION['reg_plz']);
    unset($_SESSION['reg_ort']);
    unset($_SESSION['reg_strasse']);
    unset($_SESSION['reg_hsnr']);
}