<?php
// 商品情報の在庫数を更新
require_once("config.php");

$token = (isset($_POST['token'])) ? $_POST['token'] : NULL;
if (empty($token) && isset($_COOKIE['base_access_token'])) {
	$token = $_COOKIE['base_access_token'];
}
$item_id = (isset($_POST['item_id'])) ? $_POST['item_id'] : NULL;
$stock = (isset($_POST['stock'])) ? $_POST['stock'] : NULL;
$variation_id = (isset($_POST['variation_id'])) ? $_POST['variation_id'] : NULL;
$variation_stock = (isset($_POST['variation_stock'])) ? $_POST['variation_stock'] : NULL;

$params = array(
	'item_id' => $item_id,
	'stock' => $stock,
	'variation_id' => $variation_id,
	'variation_stock' => $variation_stock,
);

$headers = array(
	'Authorization: Bearer ' . $token,
	'Content-Type: application/x-www-form-urlencoded',
);
$request_options = array(
	'http' => array(
		'method'  => 'POST',
		'header'  => implode("\r\n", $headers),
		'content' => http_build_query($params),
		'ignore_errors' => true,
	),
);
$context = stream_context_create($request_options);

$response_body = '';
$parsed_response = '';
if (!empty($_POST)) {
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/items/edit_stock', false, $context);
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
	<h2>POST /<?php echo API_VERSION; ?>/items/edit_stock</h2>
	<form method="POST" action="items_edit_stock.php">
		access_token <input type="text" name="token" value="<?php echo $token; ?>" style="width:300px"><br>
		item_id <input type="text" name="item_id" value="<?php echo $item_id; ?>" style="width:300px"><br>
		stock <input type="text" name="stock" value="<?php echo $stock; ?>" style="width:300px"><br>
		variation_id <input type="text" name="variation_id" value="<?php echo $variation_id; ?>" style="width:300px"><br>
		variation_stock <input type="text" name="variation_stock" value="<?php echo $variation_stock; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
