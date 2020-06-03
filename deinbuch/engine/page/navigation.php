<?php
if (isset($_SESSION['login']) && $_SESSION['login'] === 1) {
    echo "
    <div id='navContainer'>
        <div id='navContent' >
            <nav id='navbar'>
            <a class='navBtn' href='?p=home'>Start</a>
            <a class='navBtn' href='?p=news'>Neuigkeiten</a>
            <a class='navBtn' href='?p=uns'>Über UNS</a>
            <a class='navBtn' href='?p=produkt'>Produkte</a>

            <div class='dropdown'>
                <div class='dropbtn'> Mein Profil </div>
                <div class='dropdown-content'>
                    <a href='?p=profiel'>Profiel</a>
                    <a>Warenkorb</a>
                    <a>Abmelden</a>
                </div>
            </div>

            </nav>
        </div>
    </div>";

    
} else {
    echo "
    <div id='navContainer'>
    <div id='navContent'>
        <nav id='navbar'>
        <!-- Unangemeldete Ansicht-->
        <a class='navBtn' href='?p=home'>Home</a>
        <a class='navBtn' href='?p=news'>Neuigkeiten</a>
        <a class='navBtn' href='?p=produkt'>Produkte</a>
        <a class='navBtn' href='?p=uns'>Über-UNS</a>
        <a class='navBtn' href='?p=login'>Anmelden</a>
        <a class='navBtn' href='?p=registrieren'>Regestrieren</a>
        </nav>
    </div>  </div>
    ";
}
