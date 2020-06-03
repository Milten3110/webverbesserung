<?php
    if(isset($_SESSION['login']) && $_SESSION['login'] === 1){
        $_SESSION['login'] = 0;
    }
    else{
        $_SESSION['login'] = 1;
    }