<?php
require_once('config.php');

$scope = (isset($_POST['scope'])) ? $_POST['scope'] : 'read_users read_users_mail read_items read_orders read_savings write_items write_orders';
$state = (isset($_POST['state'])) ? $_POST['state'] : 'テストです';

$redirect_uri = urlencode(REDIRECT_URI);

$oauth_url = API_HOST . '/' . API_VERSION . '/oauth/authorize?response_type=code&client_id=' . CLIENT_ID . '&redirect_uri=' . $redirect_uri . '&scope=' . urlencode($scope) . '&state=' . urlencode($state);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>BASE API Debugger</title>
</head>
<body>
	<h1><a href="index.php">BASE API Debugger</a></h1>
	<h2>GET /<?php echo API_VERSION; ?>/oauth/authorize</h2>
	<p><a href="<?php echo $oauth_url; ?>"><?php echo $oauth_url; ?></a></p>
	<form method="POST" action="index.php">
		scope <input type="text" name="scope" value="<?php echo $scope; ?>" style="width:300px"><br>
		state <input type="text" name="state" value="<?php echo $state; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<br>
	<div><a href="oauth_token.php">POST /1/oauth/token</a></div>
	<div><a href="items.php">GET /1/items</a></div>
</body>
</html>
