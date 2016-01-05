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
	<div><a href="oauth_token.php">POST /<?php echo API_VERSION; ?>/oauth/token</a></div>
	<br>
	<div><a href="users_me.php">GET /<?php echo API_VERSION; ?>/users/me</a></div>
	<br>
	<div><a href="items.php">GET /<?php echo API_VERSION; ?>/items</a></div>
	<div><a href="items_detail.php">GET /<?php echo API_VERSION; ?>/items/detail/:item_id</a></div>
	<div><a href="items_add.php">POST /<?php echo API_VERSION; ?>/items/add</a></div>
	<div><a href="items_edit.php">POST /<?php echo API_VERSION; ?>/items/edit</a></div>
	<div><a href="items_delete.php">POST /<?php echo API_VERSION; ?>/items/delete</a></div>
	<div><a href="items_add_image.php">POST /<?php echo API_VERSION; ?>/items/add_image</a></div>
	<div><a href="items_delete_image.php">POST /<?php echo API_VERSION; ?>/items/delete_image</a></div>
	<div><a href="items_edit_stock.php">POST /<?php echo API_VERSION; ?>/items/edit_stock</a></div>
	<div><a href="items_delete_variation.php">POST /<?php echo API_VERSION; ?>/items/delete_variation</a></div>
	<br>
	<div><a href="categories.php">GET /<?php echo API_VERSION; ?>/categories</a></div>
	<div><a href="categories_add.php">POST /<?php echo API_VERSION; ?>/categories/add</a></div>
	<div><a href="categories_edit.php">POST /<?php echo API_VERSION; ?>/categories/edit</a></div>
	<div><a href="categories_delete.php">POST /<?php echo API_VERSION; ?>/categories/delete</a></div>
	<br>
	<div><a href="item_categories_detail.php">GET /<?php echo API_VERSION; ?>/item_categories/detail/:item_id </a></div>
	<div><a href="item_categories_add.php">POST /<?php echo API_VERSION; ?>/item_categories/add</a></div>
	<div><a href="item_categories_delete.php">POST /<?php echo API_VERSION; ?>/item_categories/delete</a></div>
	<br>
	<div><a href="orders.php">GET /<?php echo API_VERSION; ?>/orders</a></div>
	<div><a href="orders_detail.php">GET /<?php echo API_VERSION; ?>/orders/detail/:unique_key</a></div>
	<div><a href="orders_edit_status.php">POST /<?php echo API_VERSION; ?>/orders/edit_status</a></div>
	<br>
	<div><a href="savings.php">GET /<?php echo API_VERSION; ?>/savings</a></div>
	<br>
	<div><a href="delivery_companies.php">GET /<?php echo API_VERSION; ?>/delivery_companies</a></div>
	<br>
	<div><a href="search.php">GET /<?php echo API_VERSION; ?>/search</a></div>
	<div><a href="search_refresh.php">GET /<?php echo API_VERSION; ?>/search/refresh</a></div>
</body>
</html>
