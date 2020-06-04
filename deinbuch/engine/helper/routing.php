<?php
$baisc_pfad = 'engine/page/';
if (isset($_GET["p"])) {
    switch (@$_GET["p"]) {
        case 'home':
            include $baisc_pfad . 'home.php';
            break;
        case 'news':
            include $baisc_pfad . 'news.php';
            break;
        case 'produkt':
            include $baisc_pfad . 'produkte.php';
            break;
        case 'login':
            include $baisc_pfad . 'login.php';
            break;
        case 'registrieren':
            include $baisc_pfad . 'regestrieren.php';
            break;
        case 'uns':
            include $baisc_pfad . 'ueber-uns.php';
            break;
        case 'impressum':
            include $baisc_pfad . 'impressum.php';
            break;
        case 'logout':
            include "./engine/helper/log_in_out.php";
            header("Location: ?p=home");
            break;
        case 'profiel':
            include $baisc_pfad . 'profiel.php';
            break;
        case 'warenkorb':
            include $baisc_pfad . 'warenkorb.php';
            break;
        case 'logout':
            include "../helper/log_in_out.php";
        break;
            //Produkt Details anzeige       
        default:
            echo $_GET['p'];
            include $baisc_pfad . 'home.php';
            break;
    }
} else if (isset($_GET["details"])) {
    switch (@$_GET["details"]) {
        default:
            include $baisc_pfad . 'produktdetails.php';
            break;
    }
} else {
    header("Location: ?p=home");
}

//reset FormData when change the apge from registrieren
if($_GET['p'] != 'registrieren'){
    resetFormData();
}