<?php

    function current_user(){
        return auth()->user();
}

    function isAdmin(){
        return current_user()->role == 'admin';
    }
?>
