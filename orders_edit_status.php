<?php
// 注文情報のステータスを更新 or 後払い決済ステータスを更新
require_once("config.php");

$token = (isset($_POST['token'])) ? $_POST['token'] : NULL;
if (empty($token) && isset($_COOKIE['base_access_token'])) {
	$token = $_COOKIE['base_access_token'];
}
$order_item_id = (isset($_POST['order_item_id'])) ? $_POST['order_item_id'] : NULL;
$status = (isset($_POST['status'])) ? $_POST['status'] : NULL;
$add_comment = (isset($_POST['add_comment'])) ? $_POST['add_comment'] : NULL;
$atobarai_status = (isset($_POST['atobarai_status'])) ? $_POST['atobarai_status'] : NULL;
$delivery_company_id = (isset($_POST['delivery_company_id'])) ? $_POST['delivery_company_id'] : NULL;
$tracking_number = (isset($_POST['tracking_number'])) ? $_POST['tracking_number'] : NULL;

$params = array(
	'order_item_id' => $order_item_id,
	'status' => $status,
	'add_comment' => $add_comment,
	'atobarai_status' => $atobarai_status,
	'delivery_company_id' => $delivery_company_id,
	'tracking_number' => $tracking_number,
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
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
	),
);
$context = stream_context_create($request_options);

$response_body = '';
$parsed_response = '';
if (!empty($_POST)) {
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/orders/edit_status', false, $context);
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
	<h2>POST /<?php echo API_VERSION; ?>/orders/edit_status</h2>
	<form method="POST" action="orders_edit_status.php">
		access_token <input type="text" name="token" value="<?php echo $token; ?>" style="width:300px"><br>
		order_item_id <input type="text" name="order_item_id" value="<?php echo $order_item_id; ?>" style="width:300px"><br>
		status <input type="text" name="status" value="<?php echo $status; ?>" style="width:300px"><br>
		add_comment <input type="text" name="add_comment" value="<?php echo $add_comment; ?>" style="width:300px"><br>
		atobarai_status <input type="text" name="atobarai_status" value="<?php echo $atobarai_status; ?>" style="width:300px"><br>
		delivery_company_id <input type="text" name="delivery_company_id" value="<?php echo $delivery_company_id; ?>" style="width:300px"><br>
		tracking_number <input type="text" name="tracking_number" value="<?php echo $tracking_number; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
