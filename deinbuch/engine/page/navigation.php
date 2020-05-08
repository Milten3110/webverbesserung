<?php
if (isset($_SESSION['login']) && $_SESSION['login'] === 1) {
    echo var_dump($_SESSION['login']);
    echo "
        <nav id='navbar'>
        <a href='?p=home'>Start</a>
        <a href='?p=news'>Neuigkeiten</a>
        <a href='?p=produkt'>Produkte</a>
        <a href='?p=profiel'>Mein Profiel</a>
        <a href='?p=logout'>Abmelden</a>
        <a href='?p=uns'>Über UNS</a>
        </nav>
    ";
} else {
    echo "
        <nav id='navbar'>
        <!-- Unangemeldete Ansicht-->
        <a href='?p=home'>Home</a>
        <a href='?p=news'>Neuigkeiten</a>
        <a href='?p=produkt'>Produkte</a>
        <a href='?p=login'>Anmelden</a>
        <a href='?p=regestrieren'>Regestrieren</a>
        <a href='?p=uns'>Über-UNS</a>
        </nav>  
    ";
}
