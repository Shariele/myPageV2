<?php
// Konfigurera och �ppna databasen
$dbhost = "localhost";
$dbuser = "nrlfeskn_shariele";
$dbpass = "Ulthwe95";
$dbname = "nrlfeskn_blog";

// Ansluter till MySQL och den angivna databasen
$opendb = mysqli_connect($dbhost, $dbuser, $dbpass)
or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));

mysqli_select_db($opendb,$dbname)
or die("Kunde inte ansluta till databasen:<br />" . mysqli_error($opendb));
?>