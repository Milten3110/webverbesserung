<?php
$accountInformation        = false;
$kundenInformation         = false;


if (isset($_POST) && count($_POST) > 0 && !$accountInformation) {
    @$_SESSION['reg_user']       = isset($_POST['user'])        === true ? $_POST['user']       : $_SESSION['reg_user'];
    @$_SESSION['reg_password1']  = isset($_POST['password1'])   === true ? $_POST['password1']  : $_SESSION['reg_password1'];
    @$_SESSION['reg_password2']  = isset($_POST['password2'])   === true ? $_POST['password2']  : $_SESSION['reg_password2'];
    @$_SESSION['reg_email1']     = isset($_POST['email1'])      === true ? $_POST['email1']     : $_SESSION['reg_email1'];
    @$_SESSION['reg_email2']     = isset($_POST['email2'])      === true ? $_POST['email2']     : $_SESSION['reg_email2'];

    //valider
    $_SESSION['reg_name']       =  @$_POST['name'];
    $_SESSION['reg_nachname']   =  @$_POST['nachname'];
    $_SESSION['reg_born']       =  @$_POST['born'];
    $_SESSION['reg_nummer']     =  @$_POST['nummer'];
    $_SESSION['reg_bundesland'] =  @$_POST['bundesland'];
    $_SESSION['reg_plz']        =  @$_POST['plz'];
    $_SESSION['reg_ort']        =  @$_POST['ort'];
    $_SESSION['reg_strasse']    =  @$_POST['strasse'];
    $_SESSION['reg_hsnr']       =  @$_POST['hsnr'];



    //Valid Account Daten
    //username Korrekt ?
    if ($valider->validInput('accountName', $_SESSION['reg_user'])) {
        //password gleich ?
        if ($_SESSION['reg_password1'] === $_SESSION['reg_password2'] && $valider->validInput('accountPw', $_SESSION['reg_password1'])) {
            //Email Richtig ?
            if ($_SESSION['reg_email1'] === $_SESSION['reg_email2'] && $valider->validInput('email', $_SESSION['reg_email1'])) {
                $accountInformation         = true;
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

if (isset($_POST['zurueck'])) {
    //zurück auf Account Informationen
    $accountInformation = false;
}

//#TODO
//nachdem alle Daten abgegeben wurde, soll der Valider erst prüfen
//dann soll bei fehlerhaften eingaben die meldung kommen was falsch ist 
//und der user zurück auf die regestierungsseite geleitet.
if (isset($_POST['reg_abschliesen'])) {



    //Valid Kunden Informationen
    if ($valider->validInput('vornachname', $_SESSION['reg_name'])) {
        if ($valider->validInput('vornachname', $_SESSION['reg_nachname'])) {
            //Vorerst keine Altersprüfung
            //Valid Nummer
            if ($valider->validInput('nummer', @$_SESSION['nummer'])) {
                //Bundesland Valider
                if ($valider->validInput('bundesland', $_SESSION['reg_bundesland'])) {
                    //plz
                    if ($valider->validInput('plz', $_SESSION['reg_plz'])) {
                        //Ort
                        if ($valider->validInput('ort', $_SESSION['reg_ort'])) {
                            //strasse
                            if ($valider->validInput('strasse', $_SESSION['reg_strasse'])) {
                                //hausnummer
                                if ($valider->validInput('hsnr', $_SESSION['reg_hsnr'])) {

                                    //Jetz DB schreiben zum Regestrieren
                                    //$userame, $password, $email, $vorname, $nachname, $geburtsdatum, $nummer, $bundesland, $plz, $ort, $strasse, $hausnummer
                                    $db->createNewUser(
                                        $_SESSION['reg_user'], $_SESSION['reg_password1'], $_SESSION['reg_email1'],  $_SESSION['reg_name'], $_SESSION['reg_nachname'], $_SESSION['reg_born'], "0", $_SESSION['reg_bundesland'], $_SESSION['reg_plz'], $_SESSION['reg_ort'], $_SESSION['reg_strasse'], $_SESSION['reg_hsnr']
                                    );

                                    header("LOCATION: ?p=login");

                                } else {
                                    echo "<p id='wrongInput'> Ungültige Eingabe der Hausnummer !</p>";
                                }
                            } else {
                                echo "<p id='wrongInput'> Ungültige Eingabe der Strasse !</p>";
                            }
                        } else {
                            echo "<p id='wrongInput'> Ungültige Eingabe des Ortes !</p>";
                        }
                    } else {
                        echo "<p id='wrongInput'> Ungültige Eingabe der PLZ !</p>";
                    }
                } else {
                    echo "<p id='wrongInput'> Ungültige Eingabe des Bundeslands !</p>";
                }
            } else {
                echo "<p id='wrongInput'> Ungültige Eingabe der Nummer !</p>";
            }
        } else {
            echo "<p id='wrongInput'> Ungültige Eingabe des Nachnamens !</p>";
        }
    } else {
        echo "<p id='wrongInput'> Ungültige Eingabe des Vornamen !</p>";
    }
}
//wenn alles richtig war, dann soll der user auf login geleitet werden







//  Seitenwegsel zwischen Kundeninformationen und AccountInformation
//  Entscheidung wegen überischtlichkeit
//#TODO endabschliesung der Regestrierung und session löschen nach regestrierung
if ($accountInformation) {
    echo "
        <div class='regContainer'>
        <form action='' method='POST' class='reginput'>
            <span> <h2> Persönliche Informationen </h2></span>
            <input type='submit' name='zurueck' value='zurück'>
            <p> Ihr Amtlicher Vorname / Rufname </p>
            <input type='text' name='name'          placeholder='Vornamen'       minlength='3' maxlength='90' value='" . @$_SESSION['reg_name'] . "'>  
            <p> Ihr Amtlicher Nachname / Familienname </p>
            <input type='text' name='nachname'      placeholder='Nachnamen'      minlength='5' maxlength='90' value='" . @$_SESSION['reg_nachname'] . "'>  
            <p> Wann sind SIe geboren: Monat.Tag.Jahr .</p>
            <input type='date' name='born'                                  min='1990-01-01' max='2008-01-01' value='>  
            <p> Ihre Telefonische erreichbarkeit. </p>
            <input type='text' name='nummer'        placeholder=''   minlength='10' maxlength='20' value='" . @$_SESSION['reg_nummer'] . "'> 
            <p> Bundesland ausschreiben ! </p>
            <input type='text' name='bundesland'    placeholder='Bundesland'     minlength='5' maxlength='50' value='" . @$_SESSION['reg_bundesland'] . "'>  
            <p> Ihre Postleitzahl </p>
            <input type='text' name='plz'           placeholder='Postleitzahl'   minlength='5' maxlength='5' value='" . @$_SESSION['reg_plz'] . "'>   
            <p> Ihr Wohnort </p>
            <input type='text' name='ort'           placeholder='Ort'            minlength='5' maxlength='90' value='" . @$_SESSION['reg_ort'] . "'>  
            <input type='text' name='strasse'       placeholder='Strasse'        minlength='5' maxlength='90' value='" . @$_SESSION['reg_strasse'] . "'>  
            <input type='text' name='hsnr'          placeholder='Hausnummer'     minlength='1' maxlength='20' value='" . @$_SESSION['reg_hsnr'] . "'>  

            <div class='sendenBtn'> <input type='submit' name='reg_abschliesen' value='Regestrieren'> </div>
        </form>
        </div>
        
        ";
} else {
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

            <div class='sendenBtn'> <input type='submit' value='Schritt 2'> </div>
            </form>

        </div>

        <div class='iputInformationen'>
            <span>  </span>
        </div>

        </div>
    ";
}
