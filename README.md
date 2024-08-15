# CryptoJS AES encryption/decryption on client side with Javascript and on server side with PHP

[![Tests](https://github.com/brainfoolong/cryptojs-aes-php/actions/workflows/tests.yml/badge.svg)](https://github.com/brainfoolong/cryptojs-aes-php/actions/workflows/tests.yml)

> [!IMPORTANT] 
> This library is considered deprecated, read-only and superseeded by my newer library https://github.com/brainfoolong/js-aes-php - It's basically the same without the need for the third party library `CryptoJS`.

A tool to AES encrypt/decrypt data in javascript and/or PHP. You can use it for PHP only, for Javascript only or mix it
together.

It uses default `aes-256-cbc` implementation with random salts and random initialization vector. This library does not
support other ciphers or modes.

## Features

* Encrypt any value in Javascript (objects/array/etc...) - Everything that can be passed to `JSON.stringify`
* Encrypt any value in PHP  (object/array/etc...) - Everything that can be passed to `json_encode`
* Decrypt in PHP/Javascript, doesn't matter where you have encrypted the values

## How to use

###### PHP | See [dist/example-php.php](https://github.com/brainfoolong/cryptojs-aes-php/blob/master/dist/example-php.php)

You need the file `src/CryptoJsAes.php`

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

###### Javascript | See [dist/example-js.html](https://github.com/brainfoolong/cryptojs-aes-php/blob/master/dist/example-js.html)

You need the file `dist/cryptojs-aes.min.js` and `dist/cryptojs-aes-format.js`

```html

<script src="dist/cryptojs-aes.min.js"></script>
<script src="dist/cryptojs-aes-format.js"></script>
<script>
    (function () {
        // encrypt value
        let valueToEncrypt = 'foobar' // this could also be object/array/whatever
        let password = '123456'
        let encrypted = CryptoJSAesJson.encrypt(valueToEncrypt, password)
        console.log('Encrypted:', encrypted)
        // something like: {"ct":"10MOxNzbZ7vqR3YEoOhKMg==","iv":"9700d78e12910b5cccd07304333102b7","s":"c6b0b7a3dc072248"}
    })()
</script>
<script>
    (function () {
        // decrypt value
        let encrypted = '{"ct":"hQDvpbAKTGp1mXgzSShR9g==","iv":"57fd85773d898d1f9f868c53b436e28f","s":"a2dac436512077c5"}'
        let password = '123456'
        let decrypted = CryptoJSAesJson.decrypt(encrypted, password)
        console.log('Decrypted:', decrypted)
    })()
</script>
```

## Composer Install

    composer require brainfoolong/cryptojs-aes-php

## Supported PHP versions

* 8.x
* 7.x
* 5.x (head to the [legacy branch](https://github.com/brainfoolong/cryptojs-aes-php/tree/legacy))

## Security Notes

Since the time that this library has been created, encryption technologies has been evolved. This library and using
AES-256-CBC encryption is still good and safe but there are (maybe) already better alternatives than this library or
CryptoJS itself. If you require really high security, you should invest more time for what is suitable for you.

Also, there's a good article about PHP issues/info related to this
library: https://stackoverflow.com/questions/16600708/how-do-you-encrypt-and-decrypt-a-php-string/30159120#30159120

## Alternatives - ASCON

You may wonder if there are alternatives to AES encryption that you can use in PHP/JS. ASCON is a newer, lightweight cipher that have been selected in 2023 by the [NIST](https://csrc.nist.gov/projects/lightweight-cryptography) as the new standard for lightweight cryptography, which may suite your needs. I have created libraries for both PHP and JS which you can find at https://github.com/brainfoolong/php-ascon and https://github.com/brainfoolong/js-ascon

## Requirements

* PHP with OpenSSL Support: http://php.net/manual/en/openssl.installation.php
* Does not work with following php.ini option enabled: http://php.net/manual/en/mbstring.overload.php

## Changelog

* 2.3.0 - Dez 2023
    * upgraded CryptoJS to v4.2.0

* 2.2.0 - 13. June 2023
    * fixed implicit true to 1 conversion by using proper OPENSSL flag (thx @benjumanji)
    * added tests for php and js
    * added a js console warning for passphrases with non ASCII characters, as it is and was never supported
    * minor improved php decrypt to avoid one useless hash cycle

* 2.1.1 - 15. January 2021
    * just a few documentation and composer fixes
* 2.1.0 - 30. December 2020
    * added quick decrypt and encrypt functions: `CryptoJSAesJson.encrypt()` and `CryptoJSAesJson.decrypt()` - See
      examples for more information
* 2.x.x - 7. April 2020
    * Upgraded project to namespaces
