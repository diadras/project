//Project Sessies
<?php
session_start();
$_SESSION['logged'] = 1;

session_unset(); //Alle variabelen vrijgeven (optioneel)
session_destroy();


?>