<?php

function fetchAndSaveIPs()
{
    $url = 'https://devmahdi-site.000webhostapp.com/bot/ipv4.txt';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
        return;
    }

    curl_close($ch);

    $ipAddresses = explode("\n", $response);

    $ipAddresses = array_filter($ipAddresses, function ($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP);
    });

    $ipAddresses = array_values(array_unique($ipAddresses));

    shuffle($ipAddresses);

    $selectedIPs = array_slice($ipAddresses, 0, 100);

    $file = 'ip/ipv4.txt';

    if (!is_writable($file)) {
        echo "File is not writable: $file";
        return;
    }

    $result = file_put_contents($file, implode("\n", $selectedIPs) . "\n", LOCK_EX);

    if ($result === false) {
        echo "Failed to write to file: $file";
        return;
    }

    echo '70 random IPv4 addresses saved to ' . $file;
}

fetchAndSaveIPs();

?>
