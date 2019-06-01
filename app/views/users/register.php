<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/navbar.php" ?>
	<div class="register_page">
		<div class="row">
			<div class="col">
				<div class="row">
					<div class="col-sm-6 register_form">
						<h1 class="text-center">Create An Account</h1>
						<p class="text-center">Please fill out this form to register with us</p>
						<div class="text-center" role="alert" id="fail_alert"></div>
						<form>
							<div class="row">
								<div class="form-group col-sm-6">
									<input class="form-control form-control-lg" value="<?php echo $data['first_name']; ?>" type="text" name="first_name" placeholder="First Name *" id="first_name">
									<span id="first_name_msg" class=""></span>
								</div>
								<div class="form-group col-sm-6">
									<input class="form-control form-control-lg" value="<?php echo $data['last_name']; ?>" type="text" name="last_name" placeholder="Last Name *" id="last_name">
									<span class="" id="last_name_msg"></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm">
									<input class="form-control form-control-lg" value="<?php echo $data['email']; ?>" type="text" name="email" placeholder="Email *" id="email">
									<span class="invalid-feedback" id="email_msg"></span>
								</div>								
							</div>
							<div class="row">
								<div class="form-group col-sm">
									<input class="form-control form-control-lg" value="<?php echo $data['username']; ?>" type="text" name="username" placeholder="Username *" id="username"  data-toggle="tooltip" data-placement="top" title="Username has to be 6-20 character long and must contain at least one uppercase character and at least one number. No special characters allowed!">
									<span class="invalid-feedback" id="username_msg"></span>
								</div>								
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<input class="form-control form-control-lg" value="<?php echo $data['password']; ?>" type="password" name="password" placeholder="Password *" id="password" data-toggle="tooltip" data-placement="top" title="Password has to be 8-20 character long and must contain at least one uppercase character and at least one number. No special characters allowed!">
									<span class="invalid-feedback" id="password_msg"></span>
								</div>
								<div class="form-group col-sm-6">
									<input class="form-control form-control-lg" value="<?php echo $data['confirm_password']; ?>" type="password" name="confirm_password" placeholder="Confirm Password *" id="confirm_password" data-toggle="tooltip" data-placement="top" title="Password and confirm password must match">
									<span class="invalid-feedback" id="confirm_password_msg"></span>
								</div>
							</div>							
							<div class="row">
								<div class="form-group col-sm-6">
									<input class="form-control form-control-lg log_reg_btn" type="button" value="Register" id="register">
								</div>
								<div class="form-group col-sm-6">
									<button type="button" class="btn btn-secondary btn-lg btn-block log_reg_btn"><a href="<?php echo URLROOT; ?>/users/login">Have an account? Login</a></button>
									<!-- <input class="form-control form-control-lg log_reg_btn" type="submit" value="Have an account? Login"> -->
								</div>
							</div>
						</form>
					</div>					
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$(document).bind('keydown', function(event){ 
			  if(event.keyCode == 13){
			    event.preventDefault();		  
			    return false;
			  }
			});
			$("#register").on('click', function(){
				var first_name = $("#first_name").val();
				var last_name = $("#last_name").val();
				var email = $("#email").val();
				var username = $("#username").val();
				var password = $("#password").val();
				var confirm_password = $("#confirm_password").val();
				
				$.ajax({
					url: 'http://localhost/vinyl/users/register',
					type: 'POST',
					data: {
						register : 1,
						first_name : first_name,
						last_name : last_name,
						email : email,
						username : username,
						password : password,
						confirm_password : confirm_password
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);					
						if (resp.first_name_err) {
							$('#first_name').removeClass("is-valid").addClass("is-invalid");
							$('#first_name_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#first_name_msg').html(resp.first_name_err);
						} else if(resp.first_name_ok) {
							$('#first_name').removeClass("is-invalid").addClass("is-valid");
							$('#first_name_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#first_name_msg').html(resp.first_name_ok);
						}

						if (resp.last_name_err) {
							$('#last_name').removeClass("is-valid").addClass("is-invalid");
							$('#last_name_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#last_name_msg').html(resp.last_name_err);							
						} else if(resp.last_name_ok) {
							$('#last_name').removeClass("is-invalid").addClass("is-valid");
							$('#last_name_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#last_name_msg').html(resp.last_name_ok);
						}

						if (resp.email_err) {
							$('#email').removeClass("is-valid").addClass("is-invalid");
							$('#email_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#email_msg').html(resp.email_err);							
						} else if(resp.email_ok) {
							$('#email').removeClass("is-invalid").addClass("is-valid");
							$('#email_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#email_msg').html(resp.email_ok);
						}

						if (resp.username_err) {
							$('#username').removeClass("is-valid").addClass("is-invalid");
							$('#username_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#username_msg').html(resp.username_err);							
						} else if(resp.username_ok){
							$('#username').removeClass("is-invalid").addClass("is-valid");
							$('#username_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#username_msg').html(resp.username_ok);
						}

						if (resp.password_err) {
							$('#password').removeClass("is-valid").addClass("is-invalid");
							$('#password_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#password_msg').html(resp.password_err);							
						} else if(resp.password_ok) {
							$('#password').removeClass("is-invalid").addClass("is-valid");
							$('#password_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#password_msg').html(resp.password_ok);
						}
						if (resp.confirm_password_err) {
							$('#confirm_password').removeClass("is-valid").addClass("is-invalid");
							$('#confirm_password_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#confirm_password_msg').html(resp.confirm_password_err);							
						} else if(resp.confirm_password_ok){
							$('#confirm_password').removeClass("is-invalid").addClass("is-valid");
							$('#confirm_password_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#confirm_password_msg').html(resp.confirm_password_ok);
						}

						if (resp.failure) {
							$('#fail_alert').addClass("alert alert-danger");
							$('#fail_alert').html(resp.failure);													
						} 

						if (resp.total_failure) {
							$('#fail_alert').addClass("alert alert-danger");
							$('#fail_alert').html(resp.total_failure);													
						} 

						if (resp.success == 1) {
							console.log(resp);
							window.location = 'http://localhost/vinyl/users/login';
						}
							
					},
					dataType: 'text'						
				});
				
			});
		});
	</script>
<?php require APPROOT . "/views/inc/footer.php" ?>