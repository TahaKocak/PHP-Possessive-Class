<?php
require_once "src/class.possessive.php";
echo possessive::add("Taha"); // Taha'nın
echo possessive::add("Taha","arabası"); // Taha'nın arabası
echo possessive::add("Taha","arabası" , "tolower"); // taha'nın arabası
echo possessive::add("Taha","arabası" , "toupper"); // TAHA'NIN ARABASI 
echo possessive::add("Taha","arabası" , "tofirstupper"); // Taha'nın arabası
