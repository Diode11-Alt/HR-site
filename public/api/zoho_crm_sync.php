<?php
require_once 'config.php';

/**
 * Generates a new Access Token using the Zoho Refresh Token
 */
function getZohoAccessToken() {
    if (ZOHO_CLIENT_ID === 'YOUR_ZOHO_CLIENT_ID') {
        return null; // Not configured yet
    }

    $url = ZOHO_AUTH_URL . '/oauth/v2/token';
    $postParams = [
        'refresh_token' => ZOHO_REFRESH_TOKEN,
        'client_id'     => ZOHO_CLIENT_ID,
        'client_secret' => ZOHO_CLIENT_SECRET,
        'grant_type'    => 'refresh_token'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postParams));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response, true);
    return $json['access_token'] ?? null;
}

/**
 * Pushes a new Inquiry to Zoho CRM as a Lead
 */
function pushLeadToZoho($name, $email, $phone, $message) {
    $accessToken = getZohoAccessToken();
    
    if (!$accessToken) {
        error_log("Zoho Sync Failed: Access Token not available.");
        return false;
    }

    $url = ZOHO_API_DOMAIN . '/crm/v3/Leads';

    // Zoho CRM Requires Last Name. We'll split the name roughly.
    $nameParts = explode(' ', trim($name), 2);
    $firstName = $nameParts[0];
    $lastName = $nameParts[1] ?? 'Unknown';

    $leadData = [
        'data' => [
            [
                'First_Name'  => $firstName,
                'Last_Name'   => $lastName,
                'Email'       => $email,
                'Phone'       => $phone,
                'Description' => $message,
                'Company'     => 'Website Inquiry', // Required field by default
                'Lead_Source' => 'Website Contact Form'
            ]
        ]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($leadData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Zoho-oauthtoken ' . $accessToken,
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode >= 200 && $httpCode < 300) {
        return true;
    } else {
        error_log("Zoho CRM API Error: " . $response);
        return false;
    }
}
?>
