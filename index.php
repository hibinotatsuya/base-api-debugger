<?php
require_once('config.php');

$redirect_uri = urlencode(REDIRECT_URI);
$scope = urlencode('read_users read_users_mail read_items read_orders read_savings write_items write_orders');
$state = urlencode('hoge');

$oauth_url = API_HOST . '/' . API_VERSION . '/oauth/authorize?response_type=code&client_id=' . CLIENT_ID . '&redirect_uri=' . $redirect_uri . '&scope=' . $scope . '&state=' . $state;
?>
<html>
<head>
	<meta charset="utf-8">
	<title>BASE API Debugger</title>
</head>
<body>
	<h1>BASE API Debugger</h1>
	<h2>GET /<?php echo API_VERSION; ?>/oauth/authorize</h2>
	<div><a href="<?php echo $oauth_url; ?>" target="_blank"><?php echo $oauth_url; ?></a></div>
</body>
</html>
