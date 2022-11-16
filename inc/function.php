<?php


function userConnected()
{

    if (!isset($_SESSION['user'])) {

        return false;
    } else {

        return true;
    }
}
