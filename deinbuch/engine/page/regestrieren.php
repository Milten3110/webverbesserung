<?php
    $accountInformation        = false;
    $kundenInformation         = false;


    if(isset($_POST) && count($_POST) > 0 && !$accountInformation){
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
    if($accountInformation){
        echo "
        <form action='' methode='POST'>
            <input type='text' name='name'          placeholder='Vornamen'       minlength='3' maxlength='90'>
            <input type='text' name='nachname'      placeholder='Nachnamen'      minlength='5' maxlength='90'>
            <input type='date' name='born'                                  min='1990-01-01' max='2008-01-01'>
            <input type='text' name='nummer'        placeholder='Handy/Nummer'   minlength='10' maxlength='20'>
            <input type='text' name='bundesland'    placeholder='Bundesland'     minlength='5' maxlength='50'>
            <input type='text' name='plz'           placeholder='Postleitzahl'   minlength='5' maxlength='5'>
            <input type='text' name='ort'           placeholder='Ort'            minlength='5' maxlength='90'>
            <input type='text' name='strasse'       placeholder='Strasse'        minlength='5' maxlength='90'>
            <input type='text' name='hsnr'          placeholder='Hausnummer'     minlength='1' maxlength='20'>

            <input type='submit' value='Regestrieren'>
        </form>
        
        
        ";
    }
    else{
        echo "
        <form action='' method='POST'>
            <input type='text' name='user'      placeholder='Benutzernamen'              minlength='8' maxlength='20'>
            <input type='text' name='password1' placeholder='Passwort'                   minlength='8' maxlength='16'>
            <input type='text' name='password2' placeholder='Passwort wiederholen'       minlength='8' maxlength='16'>
            <input type='text' name='email1'    placeholder='Email'                      minlength='8' maxlength='50'>
            <input type='text' name='email2'    placeholder='Email wiederholen'          minlength='8' maxlength='50'>

            <input type='submit' value='Schritt 2'>
        </form>
    ";
    }

?>



