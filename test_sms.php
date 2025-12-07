<?php
$apiKey = 'RSyJt9aO7pfXx05sUqwDW4IiYQ3bECGNVKHLTuvncA6zgeZ1kmpTbhaQs8Hy2ZLOBMDFlJY4R96SoiIq';
$message = "Your OTP is: 123456";
$phone = "9999999999"; // Plan to replace with user's phone if possible, or just a dummy valid one? 
// Valid phone needed. I'll use a dummy one, but the API might reject it. 
// I'll try to use a standard format 10 digit.

$url = "https://www.fast2sms.com/dev/bulkV2";
$data = [
    'message' => $message,
    'language' => 'english',
    'route' => 'q',
    'numbers' => $phone,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "authorization: $apiKey"
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

echo "Response: " . $response;
?>
