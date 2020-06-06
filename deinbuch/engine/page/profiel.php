<div>
    <form method='POST'>
        <span><input type="submit" name="daten" value="Meine Daten"></span>
        <span><input type="submit" name="bestellungen" value="Meine Bestellungen"></span>
        <span><input type="submit" name="aendern" value="Account Daten Ändern"></span>
        <span><input type="submit" name="logout" value="Abmelden"></span>


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
    ?>

        <table class='profielTable'>
            <tr>
                <td>Produktnamen</td>
                <td>Bestelldatum</td>
                <td>Preis</td>
            </tr>
        <?php
        //ISSUE: TODO: not perfect ,
        $result = $db->getOrders($_SESSION['account_id']);
        $prod = $db->directQuery("select * from produkt");
        $prodArray;
        $prodArray[] = 0;

        //alle Produkte in ein Array und via ID dann zuordnen  
        foreach ($prod as $id) {
            $prodArray[$id['id']][0] = $id;
        }

        //echo var_dump(($prodArray));

        foreach ($result as $order) {
            echo "<tr>
                <td>" . $prodArray[$order['produkt_id']][0]['name'] . "</td>
                <td>" . $order['bestelldatum'] . "</td>
                <td>" . $prodArray[$order['produkt_id']][0]['preis'] . "</td>
            </tr>";
        }
    }
        ?>
        </table>




        <table class='profielDataEnder'>
            <?php
            if (isset($_POST['aendern'])) {
                echo "
            <div class='regContainer'>
            <div>
                <form action='' method='POST' class='reginput'>
                <span> <h2> Account Informationen </h2></span>


                
                <p> Max 16 Zeichen und mindestes 8 Zeichen</p>
                <input type='text' name='user'      placeholder='Benutzernamen'              minlength='8' maxlength='20'  value='" . @$_SESSION['reg_user'] . "'> 
                <p> Max 16 Zeichen und mindestens 8 Zeichen, Abc, 0-9, ! und ? sind erlaubt.</p>
                <input type='text' name='password1' placeholder='Passwort'                   minlength='8' maxlength='16' value='" .  @$_SESSION['reg_password1'] . "'>
                <input type='text' name='password2' placeholder='Passwort wiederholen'       minlength='8' maxlength='16' value='" .  @$_SESSION['reg_password2'] . "'>
                <p> Bitte geben Sie hier Ihre Email ein.</p>
                <input type='text' name='email1'    placeholder='Email'                      minlength='8' maxlength='50' value='" .  @$_SESSION['reg_email1'] . "'>
                <input type='text' name='email2'    placeholder='Email wiederholen'          minlength='8' maxlength='50' value='" .  @$_SESSION['reg_email2'] . "'>

                <div class='sendenBtn'> <input type='submit' name='change' value='Daten Ändern'> </div>
                </form>

            </div>
            </div>
             ";
            }
            ?>
        </table>




        <?php
        if (isset($_POST['change'])) {


            if ($valider->validInput('accountName', $_POST['user'])) {
                //password gleich ?
                if ($_POST['password1'] === $_POST['password2'] && $valider->validInput('accountPw', $_POST['password1'])) {
                    //Email Richtig ?
                    if ($_POST['email1'] === $_POST['email2'] && $valider->validInput('email', $_POST['email1'])) {
                        echo "Erfolgreich Geändert";

                        $db->directQuery("update account set username='" .$_POST['user']. "', password='". md5($_POST['password1']). "', email='" .$_POST['email1'] . "' where id=" . $_SESSION['account_id'] );


                    } else {
                        echo "<p id='wrongInput'> Die eingegebenen Email stimmen nicht überein</p>";
                        //emails sind nicht identisch
                    }
                } else {
                    //Password nicht gleich
                    echo "<p id='wrongInput'>Die eingegebenen Passwörter stimmen nicht überein !</p>";
                }
            } else {
                echo "<p id='wrongInput'> Ungültiger Benutzername !</p>";
            }
        }


        if (isset($_POST['logout'])) {
            $_SESSION['login'] = 0;
            header("LOCATION: ?=phome");
        }
        ?>
</div>