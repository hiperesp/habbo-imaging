<?php
$query = [];
foreach($_GET as $key => $value) {
    if(!\is_string($value)) {
        continue;
    }
    $query[$key] = $value;
}

$queryStr = \http_build_query($query);

$ch = \curl_init();
\curl_setopt($ch, CURLOPT_URL, "https://habbo.co.uk/habbo-imaging/avatarimage?{$queryStr}");
\curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
\curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
\curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
\curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
\curl_setopt($ch, CURLOPT_HEADER, 1);

$result = \curl_exec($ch);
if($result === false)
    exit;

$header_size = \curl_getinfo($ch, CURLINFO_HEADER_SIZE);

$contentType = \curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$body = \substr($result, $header_size);

\curl_close($ch);

\header("Content-Type: {$contentType}");
echo $body;