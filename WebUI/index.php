<?php
$Username = "root";
$Password = "";
$Database = "steam";

$PDO = new PDO("mysql:host=localhost;dbname=$Database", $Username, $Password);
$Query = $PDO->query('SELECT user FROM accounts WHERE enabled = 1 ORDER BY user ASC');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title></SteamLogin></title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/main.css">
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>