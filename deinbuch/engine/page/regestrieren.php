<?php
$accountInformation        = false;
$kundenInformation         = false;


if (isset($_POST) && count($_POST) > 0 && !$accountInformation) {
    $accountInformation         = true;

    $_SESSION['reg_user']       = $_POST['user'];
    $_SESSION['reg_password1']  = $_POST['password1'];
    $_SESSION['reg_password2']  = $_POST['password2'];
    $_SESSION['reg_email1']     = $_POST['email1'];
    $_SESSION['reg_email2']     = $_POST['email2'];
}




//  Seitenwegsel zwischen Kundeninformationen und AccountInformation
//  Entscheidung wegen überischtlichkeit
//#TODO endabschliesung der Regestrierung und session löschen nach regestrierung
if ($accountInformation) {
    echo "
        <div class='regContainer'>
        <form action='' methode='POST' class='reginput'>
            <span> <h2> Persönliche Informationen </h2></span>

            <p> Ihr Amtlicher Vorname / Rufname </p>
            <input type='text' name='name'          placeholder='Vornamen'       minlength='3' maxlength='90'>  
            <p> Ihr Amtlicher Nachname / Familienname </p>
            <input type='text' name='nachname'      placeholder='Nachnamen'      minlength='5' maxlength='90'>  
            <p> Wann sind SIe geboren: Monat.Tag.Jahr .</p>
            <input type='date' name='born'                                  min='1990-01-01' max='2008-01-01'>  
            <p> Ihre Telefonische erreichbarkeit. </p>
            <input type='text' name='nummer'        placeholder='Handy/Nummer'   minlength='10' maxlength='20'> 
            <p> Bundesland ausschreiben ! </p>
            <input type='text' name='bundesland'    placeholder='Bundesland'     minlength='5' maxlength='50'>  
            <p> Ihre Postleitzahl </p>
            <input type='text' name='plz'           placeholder='Postleitzahl'   minlength='5' maxlength='5'>   
            <p> Ihr Wohnort </p>
            <input type='text' name='ort'           placeholder='Ort'            minlength='5' maxlength='90'>  
            <input type='text' name='strasse'       placeholder='Strasse'        minlength='5' maxlength='90'>  
            <input type='text' name='hsnr'          placeholder='Hausnummer'     minlength='1' maxlength='20'>  

            <div class='sendenBtn'> <input type='submit' value='Regestrieren'> </div>
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
            <input type='text' name='user'      placeholder='Benutzernamen'              minlength='8' maxlength='20'>
            <p> Max 16 Zeichen und mindestens 8 Zeichen, Abc, 0-9, ! und ? sind erlaubt.</p>
            <input type='text' name='password1' placeholder='Passwort'                   minlength='8' maxlength='16'>
            <input type='text' name='password2' placeholder='Passwort wiederholen'       minlength='8' maxlength='16'>
            <p> Bitte geben Sie hier Ihre Email ein.</p>
            <input type='text' name='email1'    placeholder='Email'                      minlength='8' maxlength='50'>
            <input type='text' name='email2'    placeholder='Email wiederholen'          minlength='8' maxlength='50'>

            <div class='sendenBtn'> <input type='submit' value='Schritt 2'> </div>
            </form>

        </div>

        <div class='iputInformationen'>
            <span>  </span>
        </div>

        </div>
    ";
}


