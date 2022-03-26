<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Admin</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	
	table, th, td {
  border: 1px solid black;
}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to Admin <div style="float:right"><a href="<?php echo base_url() ?>Admin/users">Users</a> | <a href="<?php echo base_url(); ?>Admin/products">Products</a> | <a href="<?php echo base_url(); ?>Admin/get_exchange_ron_rate">Convert RON</a> | <a href="<?php echo base_url(); ?>Admin/get_exchange_ron_rate">Convert USD</a></div></h1>
	

	<div id="body">
	<h2>User Data</h2> 
		 <table class="table table-bordered"><thead><th>Verified User</th><th>Un Verified User</th><th>Attached Product</th></thead>
		 <tr><td><?php echo $user_data['verified']; ?></td><td><?php echo $user_data['un_verified']; ?></td><td><?php echo $user_data['ap_user_product']; ?></td></tr>
		</table>
	<h2>Product Data</h2> 
		 <table class="table table-bordered"><thead><th>Active Product</th><th>Not Attached Product</th><th>Total Attach Product</th><th> Product Amount</th></thead>
		 <tr><td><?php echo $product['acitve_product']; ?></td><td><?php echo $product['not_attach_product']; ?></td><td><?php echo $product['attach_product_count']; ?></td><td>$<?php echo number_format($product['total_amount'],2); ?></td></tr>
		</table>

<h2>User Product Data</h2> 
		 <table class="table table-bordered" style="border 1px solid #000"><thead><th>User</th><th>Total Amount</th></thead>
		 <?php if(isset($users) && !empty($users)){ 
				foreach($users as $u_data){
				?>
		 <tr><td><?php echo $u_data['firstName'].' '.$u_data['lastName'] ; ?></td><td><?php echo number_format($u_data['total_amount'],2); ?></td></tr>
		 <?php } } ?>
		</table>			
		
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
