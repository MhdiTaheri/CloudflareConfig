<?php

function generateVlessConfig($uuid, $ip, $host, $sni)
{
    return base64_encode("vless://$uuid@$ip:443?security=tls&sni=$sni&alpn=http/2,http/1.1&fp=randomized&type=ws&path=/?ed%3D2048&host=$host&encryption=none#%7C%20𝙜𝙞𝙩𝙝𝙪𝙗.𝙘𝙤𝙢/𝙈𝙝𝙙𝙞𝙏𝙖𝙝𝙚𝙧𝙞%20%7C");
}

$ipFile = 'ip/ipv4.txt';
$ipAddresses = file($ipFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$selectedIPs = array_rand(array_flip($ipAddresses), 50);

$jsonContent = file_get_contents('https://devmahdi-site.000webhostapp.com/bot/info.json');
$info = json_decode($jsonContent, true);
$uuid = $info['uuid'] ?? '';
$host = $info['host'] ?? '';
$sni = $info['sni'] ?? '';

$configStrings = [];
foreach ($selectedIPs as $selectedIP) {
    $configStrings[] = generateVlessConfig($uuid, trim($selectedIP), $host, $sni);
}

$configFile = 'sub/config.txt';
file_put_contents($configFile, implode("\n", $configStrings));

echo 'Configurations saved to ' . $configFile;
?>
