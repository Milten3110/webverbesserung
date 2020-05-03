<?php
if (isset($_GET["p"])) {
    $baisc_pfad = 'engine/page/';
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
        case 'regestrieren':
            include $baisc_pfad . 'regestrieren.php';
            break;
        case 'uns':
            include $baisc_pfad . 'ueber-uns.php';
            break;
        case 'impressum':
            include $baisc_pfad . 'impressum.php';
            break;
        default:
            include $baisc_pfad . 'home.php';
            break;
    }
} else {
    header("Location: ?p=home");
}
