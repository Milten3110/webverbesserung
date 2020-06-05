<div>
    <form method='POST'>
        <span><input type="submit" name="daten" value="Meine Daten"></span>
        <span><input type="submit" name="bestellungen" value="Meine Bestellungen"></span>
        <span><input type="submit" name="" value="Account Daten Ändern"></span>
        <span><input type="submit" name="" value="Abmelden"></span>


        <!--

        //meine Daten:
            zeigt an, private daten
        
        //bestellzungen
            zeigt an, alle bestellungen
        //Account Datenändern
            email und passwort kann geändert werden
        
-->
    </form>


    <?php
    if (isset($_POST['daten'])) {
        $result = $db->getUserInformation($_SESSION['account_id']);
        $rsTmp = $result[1];
        $result = $result[0]->fetch_array();
        $rsTmp = $rsTmp->fetch_array();
    ?>
    
    <table class='profielTable'>
        <tr>
            <td>Vorname</td>
            <td><?php echo $result['vorname'] ?></td>
        </tr>

        <tr>
            <td>Nachname</td>
            <td><?php echo $result['nachname'] ?></td>
        </tr>

        <tr>
            <td>Geburtstag</td>
            <td><?php echo $result['geburtsdatum'] ?></td>
        </tr>

        <tr>
            <td>Nummer</td>
            <td><?php echo $result['nummer'] ?></td>
        </tr>

        <tr>
            <td>Bundesland</td>
            <td><?php echo $result['bundesland'] ?></td>
        </tr>

        <tr>
            <td>Postleitzahl</td>
            <td><?php echo $result['plz'] ?></td>
        </tr>

        <tr>
            <td>Ort</td>
            <td><?php echo $result['ort'] ?></td>
        </tr>

        <tr>
            <td>Strasse</td>
            <td><?php echo $result['strasse'] ?></td>
        </tr>

        <tr>
            <td>Hausnummer</td>
            <td><?php echo $result['hausnummer'] ?></td>
        </tr>

        <tr>
            <td>Treuepunkte</td>
            <td><?php echo $rsTmp[0] ?></td>
        </tr>

    </table>

    <?php
    }

    if (isset($_POST['bestellungen'])) {
        $result = $db->getOrders($_SESSION['account_id']);

        //TODO
        foreach ($result as $order) {
            echo $order['bestelldatum'] . "<br>";
        }
    }



    if (isset($_POST['aendern'])) {
        
    }




    if(isset($_POST['abmelden'])){
        $_SESSION['login'] = 0;
        header("LOCATION: ?=phome");
    }
    ?>


    <!-- ProfielDataRouting -->
    <div>

    </div>

</div>