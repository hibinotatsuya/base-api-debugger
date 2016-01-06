<?php
// 商品情報を更新
require_once("config.php");

$token = (isset($_POST['token'])) ? $_POST['token'] : NULL;
if (empty($token) && isset($_COOKIE['base_access_token'])) {
	$token = $_COOKIE['base_access_token'];
}
$item_id = (isset($_POST['item_id'])) ? $_POST['item_id'] : NULL;
$title = (isset($_POST['title'])) ? $_POST['title'] : NULL;
$detail = (isset($_POST['detail'])) ? $_POST['detail'] : NULL;
$price = (isset($_POST['price'])) ? $_POST['price'] : 9800;
$stock = (isset($_POST['stock'])) ? $_POST['stock'] : 10;
$visible = (isset($_POST['visible'])) ? $_POST['visible'] : 1;
$identifier = (isset($_POST['identifier'])) ? $_POST['identifier'] : NULL;
$list_order = (isset($_POST['list_order'])) ? $_POST['list_order'] : NULL;
$edit_variation = (isset($_POST['edit_variation'])) ? $_POST['edit_variation'] : NULL;
$variation_id_0 = (isset($_POST['variation_id'][0])) ? $_POST['variation_id'][0] : NULL;
$variation_0 = (isset($_POST['variation'][0])) ? $_POST['variation'][0] : NULL;
$variation_stock_0 = (isset($_POST['variation_stock'][0])) ? $_POST['variation_stock'][0] : NULL;
$variation_identifier_0 = (isset($_POST['variation_identifier'][0])) ? $_POST['variation_identifier'][0] : NULL;
$variation_id_1 = (isset($_POST['variation_id'][1])) ? $_POST['variation_id'][1] : NULL;
$variation_1 = (isset($_POST['variation'][1])) ? $_POST['variation'][1] : NULL;
$variation_stock_1 = (isset($_POST['variation_stock'][1])) ? $_POST['variation_stock'][1] : NULL;
$variation_identifier_1 = (isset($_POST['variation_identifier'][1])) ? $_POST['variation_identifier'][1] : NULL;

if ($edit_variation) {
	$params = array(
		'item_id' => $item_id,
		'title' => $title,
		'detail' => $detail,
		'price' => $price,
		'stock' => $stock,
		'visible' => $visible,
		'identifier' => $identifier,
		'variation_id[0]' => $variation_id_0,
		'variation[0]' => $variation_0,
		'variation_stock[0]' => $variation_stock_0,
		'variation_identifier[0]' => $variation_identifier_0,
		'variation_id[1]' => $variation_id_1,
		'variation[1]' => $variation_1,
		'variation_stock[1]' => $variation_stock_1,
		'variation_identifier[1]' => $variation_identifier_1,
	);
} else {
	$params = array(
		'item_id' => $item_id,
		'title' => $title,
		'detail' => $detail,
		'price' => $price,
		'stock' => $stock,
		'visible' => $visible,
		'identifier' => $identifier,
	);
}

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
	$response_body = file_get_contents(API_HOST . '/' . API_VERSION . '/items/edit', false, $context);
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
	<h2>POST /<?php echo API_VERSION; ?>/items/edit</h2>
	<form method="POST" action="items_edit.php">
		access_token <input type="text" name="token" value="<?php echo $token; ?>" style="width:300px"><br>
		item_id <input type="text" name="item_id" value="<?php echo $item_id; ?>" style="width:300px"><br>
		title <input type="text" name="title" value="<?php echo $title; ?>" style="width:300px"><br>
		detail <input type="text" name="detail" value="<?php echo $detail; ?>" style="width:300px"><br>
		price <input type="text" name="price" value="<?php echo $price; ?>" style="width:300px"><br>
		stock <input type="text" name="stock" value="<?php echo $stock; ?>" style="width:300px"><br>
		visible <input type="text" name="visible" value="<?php echo $visible; ?>" style="width:300px"><br>
		identifier <input type="text" name="identifier" value="<?php echo $identifier; ?>" style="width:300px"><br>
		list_order <input type="text" name="list_order" value="<?php echo $list_order; ?>" style="width:300px"><br>
		variation を更新する <input type="checkbox" name="edit_variation" value="1" <?php if($edit_variation): ?>checked="checked"<?php endif; ?>><br>
		variation_id[0] <input type="text" name="variation_id[0]" value="<?php echo $variation_id_0; ?>" style="width:300px"><br>
		variation[0] <input type="text" name="variation[0]" value="<?php echo $variation_0; ?>" style="width:300px"><br>
		variation_stock[0] <input type="text" name="variation_stock[0]" value="<?php echo $variation_stock_0; ?>" style="width:300px"><br>
		variation_identifier[0] <input type="text" name="variation_identifier[0]" value="<?php echo $variation_identifier_0; ?>" style="width:300px"><br>
		variation_id[1] <input type="text" name="variation_id[1]" value="<?php echo $variation_id_1; ?>" style="width:300px"><br>
		variation[1] <input type="text" name="variation[1]" value="<?php echo $variation_1; ?>" style="width:300px"><br>
		variation_stock[1] <input type="text" name="variation_stock[1]" value="<?php echo $variation_stock_1; ?>" style="width:300px"><br>
		variation_identifier[1] <input type="text" name="variation_identifier[1]" value="<?php echo $variation_identifier_1; ?>" style="width:300px"><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<textarea style="width:600px;height:200px;"><?php echo $response_body; ?></textarea>
	<pre><?php var_dump($parsed_response); ?></pre>
</body>
</html>
