<?php
require_once('config.php');

$auth->requireAuthentication();
$auth->isAuthenticated();

if( $auth->isAjax() && $auth->isAuthenticated() )
{
    $accountName = $_GET['uname'];
    die( json_encode($database->getAccountDetails($accountName)) );
}
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

<h1><span class="blue">&lt;/</span><span class="red">SteamLogin</span><span class="blue">&gt;</span></h1>

<table class="container">
	<thead>
		<tr>
			<th><h1>Avatar</h1></th>
			<th><h1>Persona Name</h1></th>
			<th><h1>Profile URL</h1></th>
			<th><h1>Login</h1></th>
		</tr>
	</thead>
	<tbody>
		<tr>
        <?PHP
            foreach($database->listAll() as $account)
            {
                $steamData = new Core\SteamAPI($account['steamid']);
                echo "<tr>";
                echo "<td class='table_display'><img src='" . $steamData::$account['avatarmedium'] . "'></td>";
                echo "<td class='table_persona'>" . $steamData::$account['personaname'] . "</td>";
                echo "<td class='table_profile' onclick=\"window.open('" . $steamData::$account['profileurl'] . "');\">" .$steamData::$account['profileurl'] . "</td>";
                echo "<td onclick=\"login('" . $account['user'] . "');\">Login</td>";
                echo "</tr>\n";
            }
        ?>
		</tr>
	</tbody>
</table>

    <div class="footer"> AdamEastwood -> <a href="logout.php" style="color:#a7a1ae;text-decoration:none;">Logout</a></div>
</body>
</html>