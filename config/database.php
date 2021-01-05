<?php

$dbc = mysqli_connect('localhost','root','','securityphp');

// Checks for connection fail
if(mysqli_connect_errno()){
    echo "Connection error: ".mysqli_connect_error();
}