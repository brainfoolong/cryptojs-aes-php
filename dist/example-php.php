<?php

use Nullix\CryptoJsAes\CryptoJsAes;

require __DIR__ . "/../src/CryptoJsAes.php";

// encrypt
$originalValue = ["Coming from PHP - We do encrypt an array", "123", ['nested']]; // this could be any value
$password = "123456";
$encrypted = CryptoJsAes::encrypt($originalValue, $password);
echo "Encrypted:<br/><a href='example-js.html?encrypted=" . base64_encode($encrypted) . "' title='Pass to JS testpage' target='_blank'>" . $encrypted . "</a><br/><br/>\n";
// something like: {"ct":"g9uYq0DJypTfiyQAspfUCkf+\/tpoW4DrZrpw0Tngrv10r+\/yeJMeseBwDtJ5gTnx","iv":"c8fdc314b9d9acad7bea9a865671ea51","s":"7e61a4cd341279af"}

// decrypt
$encrypted = isset($_GET['encrypted']) ? base64_decode($_GET['encrypted']) : $encrypted;
$password = "123456";
$decrypted = CryptoJsAes::decrypt($encrypted, $password);

echo "Decrypted (From $encrypted):<br/>" . print_r($decrypted, true);