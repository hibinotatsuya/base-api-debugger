<?php
// 検索で取得した商品情報を再取得
require_once("config.php");

$item_id = (isset($_POST['item_id'])) ? $_POST['item_id'] : NULL;
$shop_id = (isset($_POST['shop_id'])) ? $_POST['shop_id'] : NULL;

$params = array(
	'client_id' => CLIENT_ID_FOR_SEARCH,
	'client_secret' => CLIENT_SECRET_FOR_SEARCH,
	'item_id' => $item_id,
	'shop_id' => $shop_id,
);
$request_options = array(
	'http' => array(
		'method'  => 'GET',
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
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/search/refresh?' . http_build_query($params), false, $context);
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
	<h2>GET /<?php echo API_VERSION; ?>/search/refresh</h2>
	<form method="POST" action="search_refresh.php">
		item_id <input type="text" name="item_id" value="<?php echo $item_id; ?>" style="width:300px"><br>
		shop_id <input type="text" name="shop_id" value="<?php echo $shop_id; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
