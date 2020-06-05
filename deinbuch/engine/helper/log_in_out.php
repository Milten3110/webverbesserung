<?php
    if(isset($_SESSION['login']) && $_SESSION['login'] === 1){
        //logout
        $_SESSION['login'] = 0;

        //delete warenkorb
        unset($_SESSION['produkte']);
    }
    else{
        //login
        $_SESSION['login'] = 1;
    }