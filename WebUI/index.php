<?php
require_once('config.php');
Config::SafetyCheck();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title></SteamLogin></title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <?php echo "<script>var IP = $IPAddress;</script>" ?>
</head>
<body>

<h1><span class="blue">&lt;/</span><span class="red">SteamLogin</span><span class="blue">&gt;</span></h1>

<table class="container">
	<thead>
		<tr>
			<th><h1>Username</h1></th>
			<th><h1>Login</h1></th>
		</tr>
	</thead>
	<tbody>
		<tr>
        <?PHP
            while($Account = $Query->fetch(PDO::FETCH_ASSOC))
            {
                $User = $Account['user'];
                echo "<tr>";
                echo "<td>$User</td>";
                echo "<td onclick=\"login('$User');\">Login</td>";
                echo "</tr>\n        ";
            }
        ?>
		</tr>
	</tbody>
</table>

    <div class="footer">AdamEastwood &copy; 2019</div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/main.js?<?php echo rand(0, getrandmax()) ?>"></script>

</body>
</html>