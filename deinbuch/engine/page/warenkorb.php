<?php
    //kaufen
    if(isset($_POST['kaufen'])){
        //SQL query das die bestellung eingetragen wurde und die punkte auf den account gut geschrieben wurden
        //einfacherheits halber, keine direkte kauf abwicklung, bestellt ist sofort bezahlt
        @$db->buy($_SESSION['treuepunkte'], $_SESSION['produkte']);
    }
?>

<table class="warenkorp">
    <tr>
        <td>
            Produkt Name
        </td>
        <td>
            Autor
        </td>
        <td>
            neue Punkte
        </td>
        <td>
            Einzel Preis
        </td>
        <td>
            Anzahl
        </td>
        <td>
            Positionspreis
        </td>
    </tr>


    <?php
    //TODO
    //Warenkorp
    $produkte = $db->getProdukte();
    $count = 0;
    //echo var_dump($_SESSION['produkte']);
    $gesamtpreis;

    foreach ($produkte as $produkt) {
        if (@$_SESSION['produkte'][$produkt['isbn']] > 0) {
            //jetzt tablpe comp erweitern um alle produkte anzuzeigen
            //echo $produkt['name'] . "<br>";
            echo
                "
            <tr>
                <td>" . $produkt['name'] . "</td>
                <td>" . $produkt['author'] . "</td>
                <td></td>
                <td>" . $produkt['preis'] . " € </td>
                <td>" . $_SESSION['produkte'][$produkt['isbn']] . "</td>
                <td>" . ($_SESSION['produkte'][$produkt['isbn']] * $produkt['preis'])  . " €</td>
                
                <td>
                    <form method='POST'> <input type='submit' value='Hinzufügen' name='add_" . $produkt['isbn'] . "' > </form>
                </td>
                <td>
                    <form method='POST'> <input type='submit' value='Löschen' name='del_" . $produkt['isbn'] . "' > </form>
                </td>
            </tr>
            ";
            //abfrage löschen oder hinzufügen von vorhandenen Produkten
            if (array_key_exists('add_' . $produkt['isbn'], @$_POST)) {
                @$_SESSION['produkte'][$produkt['isbn']] += 1;
                header('LOCATION: ?p=warenkorb');
            }

            if (array_key_exists('del_' . $produkt['isbn'], @$_POST)) {
                @$_SESSION['produkte'][$produkt['isbn']] -= 1;
                header('LOCATION: ?p=warenkorb');
            }

            //gesamt preis berechnen
            @$_SESSION['gesamtpreis'] += ($_SESSION['produkte'][$produkt['isbn']] * $produkt['preis']);
        }
    }



    ?>
</table>


<table>
    <!-- 1 Zeile abstand zu den Einträge des Warenkoprs -->
    <!-- Anzeige, vielendank für Ihre bestelllung-->
    <tr>
        <td>Gesamtpunkte Gutschrift</td>
        <td>Gesamtpreis</td>
        <td>Bestellen</td>
    </tr>

    <tr>

        <form method='post'>
            <td>
                <?php
                //berechnung der Treuepunkte vor dem Kauf
                    $_SESSION['treuepunkte'] = ($_SESSION['gesamtpreis'] / 10) * 2;
                    echo $_SESSION['treuepunkte'];
                ?>
            </td>
            <td>
                <?php
                echo $_SESSION['gesamtpreis'] . ' -€';
                ?>
            </td>
            <!-- Eigentliche Kaufentscheidung -->
            <td> <input type="submit" name='kaufen' value='Kostenpflichtig Bestellen'></td>
        </form>
    </tr>
</table>