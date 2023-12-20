<?php

function fetchAndSaveIPs($urls)
{
    $ipAddresses = [];
    
    foreach ($urls as $url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        preg_match_all('/\b(?:\d{1,3}\.){3}\d{1,3}\b/', $response, $matches);

        $ipAddresses = array_merge($ipAddresses, $matches[0]);
    }

    $ipAddresses = array_values(array_unique($ipAddresses));

    $file = 'ipv4.txt';
    file_put_contents($file, implode("\n", $ipAddresses));

    echo 'IPv4 addresses saved to ' . $file;
}

$urls = [
    'https://t.me/s/cf_clean',
    'https://t.me/s/YeBeKheCleanIP',
    'https://t.me/s/CF_IR_IP',
    'https://t.me/s/cloudflare_ip4',
    'https://t.me/s/snilist',
    'https://t.me/s/cloudflare_healthy',
];

fetchAndSaveIPs($urls);
?>
