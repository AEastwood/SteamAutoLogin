<?php
require_once('config.php');

use Core\SteamAPI;

$auth->requireAuthentication();
$auth->isAuthenticated();

if( $auth->isAjax() && $auth->isAuthenticated() )
{
    $accountName = $_GET['uname'];
    die( json_encode($database->getAccountDetails($accountName)) );
}

foreach($database->listAll() as $account)
{
    SteamAPI::addAccount([ 'user' => $account['user'], 'steamID64' => $account['steamid'] ]);
}

SteamAPI::makeRequest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title></SteamLogin></title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/main.css?<?php echo rand(0, getrandmax()) ?>">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/main.js?<?php echo rand(0, getrandmax()) ?>"></script>
</head>
<body>

	<h1>
		<span class="blue">&lt;/</span><span class="red">SteamLogin</span><span class="blue">&gt;</span>
	</h1>
	<div class="accounts">
		<?php SteamAPI::generateUserCards(); ?>
	</div>
		
	<div class="footer"> 
		AdamEastwood -> 
		<a href="logout.php" style="color:#a7a1ae;text-decoration:none;font-size: 16px;">
			Logout
		</a>
	</div>
	
</body>
</html>