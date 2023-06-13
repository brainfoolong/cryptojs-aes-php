<?php

use Nullix\CryptoJsAes\CryptoJsAes;

require __DIR__ . "/../src/CryptoJsAes.php";

$originalValue = ['foo' => 'bar', 'test' => '123öäüß'];
$password = "fancypensy_0192661";

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'js':
            $decrypted = CryptoJsAes::decrypt(base64_decode($_GET['encoded']), base64_decode($_GET['password']));
            if ($decrypted === $originalValue) {
                echo "OK";
            } else {
                echo "FAIL";
            }
            break;
        case 'encode':
            $encrypted = CryptoJsAes::encrypt($originalValue, $password);
            if (strpos($encrypted, '"ct"') !== false && strpos($encrypted, '"ev"') !== false && strpos($encrypted,
                    '"s"') !== false) {
                echo '<div id="results">OK</div>';
            }
            break;
        case 'decode':
            $encrypted = '{"ct":"Ub4hX3ftm2xF1uU8A2gRCNlG2CxZpja5xjcXNP/CqwXLr7p5dQ+DXO2bZtTqCQlL","iv":"88c2a4ae3cbb5a3e68d367a795465103","s":"af114239cbf37e89"}';
            $decrypted = CryptoJsAes::decrypt($encrypted, $password);
            if ($decrypted === $originalValue) {
                echo '<div id="results">OK</div>';
            }
            break;
        case 'cross':
            ?>
            <div id="results"></div>
            <iframe id="myframe"
                    src="test-js.html?action=php&encoded=<?= base64_encode(CryptoJsAes::encrypt($originalValue,
                        $password)) ?>&password=<?= base64_encode($password) ?>" style="visibility: hidden"></iframe>
            <script>
              (async function () {
                const frame = document.getElementById('myframe').contentWindow

                function check () {
                  let innerResults = frame.document.getElementById('results')
                  if (!innerResults || !innerResults.innerText) {
                    setTimeout(check, 200)
                    return
                  }
                  document.getElementById('results').innerText = innerResults.innerText
                }

                check()
              })()
            </script>
            <?php
            break;
    }
}