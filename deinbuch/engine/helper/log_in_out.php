<?php
    if(isset($_SESSION['login']) && $_SESSION['login'] === 1){
        session_destroy();
    }
    else{
        $_SESSION['login'] = 1;
    }