<?php
// config.php
// Replace these with your actual cPanel MySQL credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'your_cpanel_db_user');
define('DB_PASS', 'your_cpanel_db_password');
define('DB_NAME', 'your_cpanel_db_name');

// Admin password for viewing leads (change this!)
define('ADMIN_PASSWORD', 'PrimePath2026!');

// Zoho CRM Integration Credentials
define('ZOHO_CLIENT_ID', 'YOUR_ZOHO_CLIENT_ID');
define('ZOHO_CLIENT_SECRET', 'YOUR_ZOHO_CLIENT_SECRET');
define('ZOHO_REFRESH_TOKEN', 'YOUR_ZOHO_REFRESH_TOKEN');
define('ZOHO_AUTH_URL', 'https://accounts.zoho.com'); // change to .eu or .in if outside US
define('ZOHO_API_DOMAIN', 'https://www.zohoapis.com'); // change to .eu or .in if outside US
?>
