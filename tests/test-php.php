<?php

use Nullix\CryptoJsAes\CryptoJsAes;

require __DIR__ . "/../src/CryptoJsAes.php";

$originalValue = ['foo' => 'bar', 'test' => '123öäüß'];
$password = "fancypensy_0192661";

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CryptoJS Aes PHP Tests</title>
    </head>
    <body>
    <?php
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
                if (strpos($encrypted, '"ct"') !== false && strpos($encrypted, '"iv"') !== false && strpos($encrypted,
                        '"s"') !== false) {
                    echo '<div id="results" data-result>OK</div>';
                }
                break;
            case 'decode':
                $encrypted = '{"ct":"tEwvZSmr9wWagPz9y/Wug3YbPBjzrAlZ7vIR25bh1eGxqXxATuMJYG8O1fQWNRSj","iv":"b04916e6d6bfc4a567004adee9763f70","s":"41c3279e949d2f7d"}';
                $decrypted = CryptoJsAes::decrypt($encrypted, $password);
                if ($decrypted === $originalValue) {
                    echo '<div id="results"  data-result>OK</div>';
                }
                break;
            case 'cross':
                ?>
                <div id="results"></div>
                <iframe id="myframe"
                        src="test-js.html?action=php&encoded=<?= base64_encode(CryptoJsAes::encrypt($originalValue,
                            $password)) ?>&password=<?= base64_encode($password) ?>"
                        style="visibility: hidden"></iframe>
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
                      document.getElementById('results').setAttribute('data-result', '1')
                    }

                    check()
                  })()
                </script>
                <?php
                break;
        }
    }

    ?>
    </body>
    </html>
<?php
