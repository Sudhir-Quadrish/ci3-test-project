<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	
<head>
  <title>Ci Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

</head>
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
	</style>
</head>
<body>

<div id="container">
	<h1>Register User</h1>

	
			<form name="login_form" action="login_user" id="<?php echo base_url(); ?>Login/login_form" method="post"  >
	          <p><?php echo $this->session->flashdata('message'); ?></p>
				
				<div class="col-md-12">
				   <div class="form-group">
				   <label>Email</label>
				   <input type="text" name="userEmail"   id="userEmail" class="form-control" placeholder="test.example@test.com" />
				   </div>
				</div>
				<div class="col-md-12">
				   <div class="form-group">
				   <label>Password</label>
				   <input type="password" name="userPassword"  id="userPassword" class="form-control" placeholder="123456" />
				   </div>
				</div>
				
			
				<input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
				<div class="col-md-12">
				<div class="form-group">
				   <input type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"  value="submit" />
				   </div>
				 </div>
			</form>
		
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
