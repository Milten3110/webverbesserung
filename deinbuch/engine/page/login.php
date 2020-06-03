<div id="login_eingabemaske">
    <?php
        if(isset($_POST['anmelden'])){
            
            // valider 
            
            
            $b_01;
            $b_02;
            $valider->validInput('accountName', $_POST['benutzerName'])     === true ? $b_01 = true : $b_01 = false; 
            $valider->validInput('accountPw',   $_POST['benutzerPw'])       === true ? $b_02 = true : $b_02 = false;

            //true valid
            //echo $_POST['benutzerName'];
            //echo $_POST['benutzerPw'];

            if($b_01 && $b_02){
                // now check db user exists 
                if($db->login($_POST['benutzerName'], $_POST['benutzerPw'])){
                    //jetzt eingeloggt
                    $_SESSION['login'] = 1;
                    header('LOCATION: ?p=home');
                }
            }
        }
    ?>

    <form action="" method="POST" id="loginForm">
        <span>
            <h2> Persönliche Informationen </h2>
        </span>

        <p> Ihre Account Daten  </p>

        <div class="loginput">  <input type="text"      name="benutzerName"     placeholder="Benutzernamen"> </div>
        <div class="loginput">  <input type="text"      name="benutzerPw"       placeholder="Passwort"> </div>
        <div class="sendenBtn"> <input type="submit"    name='anmelden'         value="Anmelden"> </div>
    </form>
</div>