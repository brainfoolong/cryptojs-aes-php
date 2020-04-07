# CryptoJS 3.x AES encryption/decryption on client side with Javascript and on server side with PHP

A tool to AES encrypt/decrypt data in javascript and/or PHP. You can use it for PHP only, for Javascript only or mix it together. 

It uses default aes-256-cbc implementation with random salts and initialization vector.

## Features
* Encrypt any value in Javascript (objects/array/etc...) - Everything that can be passed to `JSON.stringify`
* Encrypt any value in PHP  (object/array/etc...) - Everything that can be passed to `json_encode`
* Decrypt in PHP/Javascript, doesn't matter where you have encrypted the values

## Upgrade Info
Breaking changes: This library has changed to PSR-4 namespaces as of 7. April 2020. Also parameters and behaviour has changed to the previous version. For the old version of this library head to the [legacy branch](https://github.com/brainfoolong/cryptojs-aes-php/tree/legacy).

## How to use
###### PHP | See dist/example-php.php
```php
<?php
use Nullix\CryptoJsAes\CryptoJsAes;
require "CryptoJsAes.php";

// encrypt
$originalValue = ["We do encrypt an array", "123", ['nested']]; // this could be any value
$password = "123456";
$encrypted = CryptoJsAes::encrypt($originalValue, $password);
// something like: {"ct":"g9uYq0DJypTfiyQAspfUCkf+\/tpoW4DrZrpw0Tngrv10r+\/yeJMeseBwDtJ5gTnx","iv":"c8fdc314b9d9acad7bea9a865671ea51","s":"7e61a4cd341279af"}

// decrypt
$encrypted = '{"ct":"g9uYq0DJypTfiyQAspfUCkf+\/tpoW4DrZrpw0Tngrv10r+\/yeJMeseBwDtJ5gTnx","iv":"c8fdc314b9d9acad7bea9a865671ea51","s":"7e61a4cd341279af"}';
$password = "123456";
$decrypted = CryptoJsAes::decrypt($encrypted, $password);

echo "Encrypted: " . $encrypted . "\n";
echo "Decrypted: " . print_r($decrypted, true) . "\n";
```
###### Javascript | See dist/example-js.html
```html
<script src="dist/cryptojs-aes.min.js"></script>
<script src="dist/cryptojs-aes-format.js"></script>
<script>
      (function () {
        // encrypt value
        let valueToEncrypt = 'foobar' // this could also be object/array/whatever
        let password = '123456'
        let encrypted = CryptoJS.AES.encrypt(valueToEncrypt, password, { format: CryptoJSAesJson }).toString()
        console.log('Encrypted: ' + encrypted)
        // something like: {"ct":"NJzdx9GyvW6RglcNeldSng==","iv":"ad4bdf7f5a89ec335083bedaff34e851","s":"9a607051e0f4517e"}
      })()
    </script>
    <script>
      (function () {
        // decrypt value
        let encrypted = '{"ct":"NJzdx9GyvW6RglcNeldSng==","iv":"ad4bdf7f5a89ec335083bedaff34e851","s":"9a607051e0f4517e"}'
        let password = '123456'
        let decrypted = CryptoJS.AES.decrypt(encrypted, password, { format: CryptoJSAesJson }).toString(CryptoJS.enc.Utf8)
        console.log('Decrypted: ' + decrypted)
      })()
    </script>
```

## Requirements
* PHP 7.x - If you need 5.x support, head to the [legacy branch](https://github.com/brainfoolong/cryptojs-aes-php/tree/legacy)
* PHP with OpenSSL Support: http://php.net/manual/en/openssl.installation.php
* Does not work with following php.ini option enabled: http://php.net/manual/en/mbstring.overload.php

## Changelog
* 7\. April 2020 
  * Upgraded project to namespaces
