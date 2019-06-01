<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/navbar.php" ?> 
	<div class="register_page">
		<div class="row">
			<div class="col">
				<div class="row">
					<div class="col-sm-6 login_form">
						<h1 class="text-center">Sign In</h1>
						<p class="text-center">Please fill out your credentials to log in</p>
						<div class="text-center" role="alert" id="fail_alert"></div>
						<?php flash('register_success'); ?>
						<div class="text-center" id="login_msg" role="alert"></div>
						<form>
							<div class="row">
								<div class="form-group col-sm">
									<input class="form-control form-control-lg" value="" type="text" name="email" placeholder="Email / Username *" id="email_username">								
								</div>								
							</div>
							<div class="row">
								<div class="form-group col-sm">
									<input class="form-control form-control-lg" value="" type="password" name="password" placeholder="Password *" id="password">									
								</div>								
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<input class="form-control form-control-lg log_reg_btn" type="button" value="Login" id="login">
								</div>
								<div class="form-group col-sm-6">
									<button type="button" class="btn btn-secondary btn-lg btn-block log_reg_btn"><a href="<?php echo URLROOT; ?>/users/register">No Account? Register</a></button>
									<!-- <input class="form-control form-control-lg log_reg_btn" type="submit" value="No Account? Register" href="<?php echo URLROOT; ?>/users/register"> -->
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
			$("#login").on('click', function(){
				var email_username = $("#email_username").val();
				var password = $("#password").val();
				

				$.ajax({
					type : 'POST',
					url : 'http://localhost/vinyl/users/login',					
					data : {
						login : 1,
						email_username : email_username,
						password : password
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.failure) {
							$("#email_username").removeClass("is-valid").addClass("is-invalid");
							$("#password").removeClass("is-valid").addClass("is-invalid");
							$('#login_msg').addClass("alert alert-danger");
							$('#login_msg').html(resp.failure);					
						}

						if(resp.total_failure) {
							$('#fail_alert').addClass("alert alert-danger");
							$('#fail_alert').html(resp.total_failure);	
						}

						if (resp.user_status == 'logged_in') {
							window.location = 'http://localhost/vinyl/';
						}

						

						
					},
					dataType : 'text'
				});
			});
		});
	</script>
<?php require APPROOT . "/views/inc/footer.php" ?>