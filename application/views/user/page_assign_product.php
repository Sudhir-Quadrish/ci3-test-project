<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	
<head>
  <title>Assign Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

</head>
<body>
<div id="container">
	<h1>Assign Products <div style="float:right"><a href="<?php echo base_url() ?>User/">Back</a></h1>

		<div class="col-md-12">
			<form name="product_form" action="" onsubmit="return;" id="product_form" method="post"  >
	   
				<div class="col-md-4">
				   <div class="form-group">
				   <label>Product Name</label>
					<select name="productName" id="productName" class="form-control">
					<option value=""> Select Product</option>
					<?php foreach($products as $prod) { ?>
					
					<option value="<?php echo $prod['Id']; ?>"><?php echo$prod['productName']; ?> </option>
					<?php } ?>
					</select>
				   </div>
				</div>
				<div class="col-md-4">
				   <div class="form-group">
				   <label>Product Number</label>
				   <input type="number" name="productNumber" id="productNumber" class="form-control" placeholder="5" />
				   </div>
				</div>
				<div class="col-md-12">
				   <div class="form-group">
				   <label>Product Price</label>
				   <input type="text" name="productPrice"   id="productPrice" class="form-control" placeholder="0.0" />
				   </div>
				</div>
				
				
				
				<input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
				<div class="col-md-12">
				<div class="form-group">
				   <input type="button" name="btn-submit" id="btn-submit" class="btn btn-info"  value="Save" />
				   </div>
				 </div>
			</form>
		</div>
		<div class="col-md-12">
			<div class="col-md-12">
			<p><?php echo $this->session->flashdata('message'); ?></p>
			<table class="table table-border">
			  <thead><th>Id</th><th>Product Name</th><th>Price</th><th>No of Products</th><th>Description</th></thead>
			  <tbody>
			 
			  <?php  $tabs_data=''; if(!empty($assign_products)){ 
					foreach($assign_products as $product){
			    $tabs_data.='<tr><td>'.$product['Id'].'</td><td>'.$product['productName'].'</td><td> '.$product['productPrice'].'</td><td> '.$product['prodNumber'].'</td><td>'.$product['productDes'].'</td><tr>';
			  
			  } }else{  $tabs_data.='<tr><td colspan="4"> No record founds</td></tr>';}

				echo $tabs_data;
			  ?>
			  
			  </tbody>
			</table>
	
	     </div>	 
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
<script>
$(document).ready(function(){
	console.log("Check Form");
	$('#registration_form').validate({
		rules:{
			'productName':{
				required:true,
				
		     },
			 'productNumber':{
				required:true,
				number: true,
		     },
			 'productPrice':{
				required:true,
				digits:true,
		     },
			
		}
	});
		$("#btn-submit").click(function(){
			if($('#product_form').valid()){
			var form_data = $('#product_form').serialize();
			console.log(form_data);
			var product_path = $('#base_url').val()+'User/save_product_data';
			$.ajax({
				url: product_path,
				type:"POST",
				data:form_data,
				dataType:'json',
				success:function(response){
					
					if(response.status=='success')
					{
						location.reload();
					}
					
				}
				
			});
			}
		
	});
});
</script>

</html>
