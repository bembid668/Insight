<?php

/* Attempt to connect to MySQL database */
$link = mysqli_connect("db720929300.db.1and1.com","dbo720929300","password","db720929300");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>