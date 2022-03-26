<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	
<head>
  <title>Admin Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<body>

<div id="container">
	<h1>Admin Products<div style="float:right"><a href="<?php echo base_url() ?>Admin/">Back</a> | <a href="<?php echo base_url(); ?>Admin/users">Users</a></div></h1>
		<div class="row">
		<div class="col-md-12">
			<p><?php echo $this->session->flashdata('message'); ?></p>
			<table class="table table-border">
			  <thead><th>Id</th><th>Product Name</th><th>Description</th><th>Status</th></thead>
			  <tbody>
			 
			  <?php  $tabs_data=''; if(!empty($products)){ 
					foreach($products as $product){
			    $tabs_data.='<tr><td>'.$product['Id'].'</td><td>'.$product['productName'].'</td><td> '.$product['productDes'].'</td><td>'.$product['productStatus'].'</td><tr>';
			  
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
	$('#login_form').validate({
		rules:{
			
			 'userEmail':{
				required:true,
				email:true,
		     },
			  'userPassword':{
				required:true,
				minlength:6,
				maxlength:12,
		     }
		}
	});
		/*$("#btn-submit").click(function(){
			if($('#registration_form').valid()){
			var form_data = $('#registration_form').serialize();
			console.log(form_data);
			var register_path = $('#base_url').val()+'Register/save_data';
			$.ajax({
				url: register_path,
				type:"POST",
				data:form_data,
				success:function(response){
					
					if(response.status=='success')
					{
						alert(response.message);
					}
					
				}
				
			});
			}
		
	}); */
});
</script>

</html>
