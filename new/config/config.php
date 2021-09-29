<?php $sms_sender_id = 'Konnectine Group';//values in this script should be changed by app configureation
$app_domain = $_SERVER['HTTP_HOST'];

$company_name = 'Jupet Farm Fresh';
$app_name = 'JupetFarmFresh';
$app_slug = 'JupetFarmFresh';
$app_link = $_SERVER['HTTP_HOST'];
$app_domain_root= $_SERVER['HTTP_HOST'];
date_default_timezone_set('Africa/Lagos');

$admin_unique_id = '599f15b86c766b68e35c2a653d94a22e';
$user_unique_id = '6253e1b3e7d39816a2be7de22e9e6h51';
$bank_unique_id = '6253e1b3e7d39816a2be7de22e9e6d14';
$generate_password = uniqid('user_');

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB_NAME", "jupet_db");
define("FIRST_DAY_OF_YEAR", date('Y-m-d', strtotime('first day of january this year')) );
define("LAST_DAY_OF_YEAR", date('Y-m-d', strtotime('last day of december this year'))  );


$log_directory = 'c:/xampp/htdocs/jupet_farms_ecommerce/new/';
$project_base_path = 'c:/xampp/htdocs/jupet_farms_ecommerce/new/';
// "http://$_SERVER[HTTP_HOST]"
$files_exception_arr = ['access_denied.php','index.php','404.html','.','..','.browserslistrc','.git','.gitignore','.htaccess','.travis.yml','ajax','telegram_copy.php','algo1.php','create_members_copy.php','testgit22.php','testing.php','testing2.php','youtube_videos2.php','youtube_videos.php','view_files_back.php','telegram_copy.php','telegram.php','tables.php'];


// //set timezone
// $report_dir = "report/";
// $report_pre_fix = 'report';

// //NB: Expiry date is in days
// $expiry_date = "60";

// //Country code: NB: Should be a string
// $country_code = "234";

// //flutter public testkey
// $public_key = 'FLWPUBK-047d46ab372585f170bee6d70f65dc7f-X';

// //flutter secret testkey
// $secret_key = 'FLWSECK-e4d8bf253b4be22405decd22616c3337-X';


// // $uploads_path = "C:/wamp64/www/eac/api/";

//sms details
// $username = "adebsholey4real@gmail.com";
// $password = "Pass4adebunmi%%";

$token = "nHVJu7NGqF7DyZYJxJ6jDjrpemVqEvnf80cNuZZd6mCBjFwHLVBRqS0NjTnfMJT8upmvRgKqYG6YLBKkedcgAUaBdyctSMhuZIpy";
$routing = 2;
$sender_id = urlencode("SmartSMS");





?>
