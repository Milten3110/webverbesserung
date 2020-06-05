<?php
$result = $db->getIsbnProdukt(intval($_GET['details']));
//add to Warenkorp wenn eingeloggt
if(isset($_POST['buy']) && $_SESSION['login'] == 1){
    // nun in den Warenkorp
    //echo intval($_GET['details']);
    
    @$_SESSION['produkte'][$result['isbn']] += 1;
    //echo var_dump($_SESSION['produkte']);

}



//echo var_dump($result) . "<br>";

$tmpProduktBeschreibung = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vitae ornare nisl. Mauris eu vehicula nibh. Integer vehicula pulvinar erat vel fringilla. Morbi diam dui, feugiat eu urna vel,
tempor imperdiet quam. Donec venenatis tempor justo, et eleifend ex cursus quis. Aliquam imperdiet urna in viverra lobortis. Nam porttitor eros euismod sollicitudin facilisis. Nunc tincidunt erat vel tellus
gravida placerat. Curabitur euismod purus id finibus posuere. Fusce quis ligula congue, porta nulla suscipit, mollis leo. Duis nec sem ex. Nam ut cursus ante, et convallis leo. Vestibulum ante ipsum primis
in faucibus orci luctus et ultrices posuere cubilia curae";

// abfrage an db, welche daten für das isbn produkt
echo "
    <a href='?p=produkt'>zurück</a>
    <div id='produktDetail'>
    
        <div class='variante2'> 
            <img src='./engine/assets/bilder/produkte/db_produkt/" . $result['isbn'] . ".jpg' alt='" . $result['name'] . " Buch bild'>
        </div>

        <div id='produktInfo'>
            <table>
                <tr>
                    <td>Buch  Name:  </td>
                    <td class='tableText'>". $result['name'] ."</td>
                </tr>

                <tr>
                    <td> Autor: </td>
                    <td class='tableText'>". $result['author'] ."</td>
                </tr>

                <tr>
                    <td> Verlag: </td>
                    <td class='tableText'>".$result['verlag'] ."</td>
                </tr>

                <tr>
                    <td> Preis: </td>
                    <td class='tableText'>". $result['preis'] ."</td>
                </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                    <td>
                        <form action='". ($_SESSION['login'] == 0 ? '?p=login' :  '') ."' method='post'>
                            <input type='submit' name='buy' value='" . ($_SESSION['login'] == 0 ? 'Anmelden zum Kaufen' : 'In den Warenkorb') . "'>
                        </form>
                    </td>
                </tr>
            </table>
        </div>

        <div>
            <span id='produktInformationUeberschrift'> Beschreibung </span>
            <p>$tmpProduktBeschreibung</p>
        </div>

    </div>
";

