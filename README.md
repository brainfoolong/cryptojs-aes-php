CryptoJS 3.x AES encryption/decryption on client side with Javascript and on server side with PHP
================

I've long researched to make this working for me and i want to share my solution to make it possible to encrypt/decrypt data from/to CryptoJS and PHP.
This works with CryptoJS 3.x and PHP with openssl support.

I use a JSON format for encryption/decryption to be able to use any possible object/array/string data on both sides.
I also use the standard AES implementation from CryptoJS with a passphrase. I don't generate special keys, iv's or salts.

If you find any errors or have ideas for improvements just let me know with an issue or pull request.

Requirements
====
* PHP 5.4+ or higher, PHP7 supported
* PHP with OpenSSL Support: http://php.net/manual/en/openssl.installation.php
* Does not work with following php.ini option enabled: http://php.net/manual/en/mbstring.overload.php
