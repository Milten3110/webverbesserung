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

            <div class='dropdown>
                <button class='dropbtn'> Dropdown
                    <i class='fa fa-caret-down'></i>
                </button>
                <div class='dopdown-content'>
                    <a>Test1</a>
                    <a>Test2</a>
                    <a>Test3</a>
                </div>
            </div>

            <a class='navBtn' href='?p=profiel'>Mein Profiel</a>

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
