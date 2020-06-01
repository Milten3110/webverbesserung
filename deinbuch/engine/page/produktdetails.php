<?php

$result = $db->getIsbnProdukt(intval($_GET['details']));

echo var_dump($result) . "<br>";



// abfrage an db, welche daten für das isbn produkt
echo "
    <a href='?p=produkt'>zurück</a>
    <div id='produktDetail'>
    
        <div class='variante2'> 
            <img src='./engine/assets/bilder/produkte/db_produkt/" . $result['isbn'] . ".jpg' alt='" . $result['name'] . " Buch bild'>
        </div>

        <div>" .
            $result['name']
        .
        "</div>

        <div>
        a
        </div>

    </div>
";

