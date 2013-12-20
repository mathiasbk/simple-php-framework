<?php
include("../config.php");
include("../class/public.php");

$Security = new Security;


/*****************************************************************************
/*  Function:    Encryptstring
/*  Description: Encrypts a string using sha1, md5 and sha1
/*  Inputs:      String to encrypt
/*  Outputs:     encrypted string
*****************************************************************************/

$string = "Not encrypted";
echo "String before: \"" . $string ."\" <br> After: " . $Security->Hash_string($string);

?>