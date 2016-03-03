<?php
// 注文情報の一覧を取得
require_once("config.php");

$token = (isset($_POST['token'])) ? $_POST['token'] : NULL;
if (empty($token) && isset($_COOKIE['base_access_token'])) {
	$token = $_COOKIE['base_access_token'];
}
$start_ordered = (isset($_POST['start_ordered'])) ? $_POST['start_ordered'] : '2013-01-01 00:00:00';
$end_ordered = (isset($_POST['end_ordered'])) ? $_POST['end_ordered'] : date('Y-m-d H:i:s');
$limit = (isset($_POST['limit'])) ? $_POST['limit'] : 10;
$offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;

$params = array(
	'start_ordered' => $start_ordered,
	'end_ordered' => $end_ordered,
	'limit'  => $limit,
	'offset' => $offset,
);
$headers = array(
	'Authorization: Bearer ' . $token,
);
$request_options = array(
	'http' => array(
		'method'  => 'GET',
		'header'  => implode("\r\n", $headers),
		'ignore_errors' => true,
	),
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
	),
);
$context = stream_context_create($request_options);

$response_body = '';
$parsed_response = '';
if (!empty($_POST)) {
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/orders?' . http_build_query($params), false, $context);
	$parsed_response = json_decode($response_body, true);
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>BASE API Debugger</title>
</head>
<body>
	<h1><a href="index.php">BASE API Debugger</a></h1>
	<h2>GET /<?php echo API_VERSION; ?>/orders</h2>
	<form method="POST" action="orders.php">
		access_token <input type="text" name="token" value="<?php echo $token; ?>" style="width:300px"><br>
		start_ordered <input type="text" name="start_ordered" value="<?php echo $start_ordered; ?>" style="width:300px"><br>
		end_ordered <input type="text" name="end_ordered" value="<?php echo $end_ordered; ?>" style="width:300px"><br>
		limit <input type="text" name="limit" value="<?php echo $limit; ?>" style="width:300px"><br>
		offset <input type="text" name="offset" value="<?php echo $offset; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
