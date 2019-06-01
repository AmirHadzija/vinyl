<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/navbar.php" ?>
	<div class="row">
		<div class="col hero_line">
			<h1 class="text-center hero">Prepare for an <br>adventure!</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 blog_line">
			<div class="row">
				<div class="col">
					<h1>VINYL REVIVAL</h1>
					<a href="blog.php" class="nav-link"><span>let's go back to the future</span></a>
				</div>
			</div>
			<div class="row">
				<div class="col">

				</div>
			</div>
		</div>
		<div class="col-sm-6 blog_img">
			<img src="<?php echo URLROOT; ?>/images/front/div_bg_2.jpg">
		</div>		
	</div>
	<div class="row">
		<div class="col slider">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<div class="row slider" alt="First slide">
							<?php

								for ($i=0; $i < 3; $i++) { 
									?>
									<div class="col-sm-4 p-0">
										<a href="http://localhost/vinyl/pages/single?id=<?php echo $data['populate_slider'][$i]['id']; ?>" class="slider_link d-block w-100"><img class="d-block w-100 mh-100" src="<?php echo $data['populate_slider'][$i]['img_url']; ?>"></a>
									</div>
									<?php
								}

							?>							    		
						</div>
					</div>
					<div class="carousel-item">
						<div class="row slider" alt="Second slide">
							<?php

								for ($i=3; $i < 6; $i++) { 
									?>
										<div class="col-sm-4 p-0">
											<a href="http://localhost/vinyl/pages/single?id=<?php echo $data['populate_slider'][$i]['id']; ?>" class="slider_link d-block w-100"><img class="d-block w-100 mh-100" src="<?php echo $data['populate_slider'][$i]['img_url']; ?>"></a>
										</div>
									<?php
								}

							?>									
						</div>
					</div>
					<div class="carousel-item">
						<div class="row slider" alt="Third slide">
							<?php
								for ($i=6; $i < 9; $i++) { 
									?>
										<div class="col-sm-4 p-0">
											<a href="http://localhost/vinyl/pages/single?id=<?php echo $data['populate_slider'][$i]['id']; ?>" class="slider_link d-block w-100"><img class="d-block w-100 mh-100" src="<?php echo $data['populate_slider'][$i]['img_url']; ?>"></a>
										</div>
									<?php
								}
							?>							    		
						</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col promotion">
				<h1>ALBUMS ON SALE!!!</h1>
				<h2>until the end of promotional period or while supplies last</h2>
			</div>
		</div>
		<div class="row sales">
				<?php
					foreach ($data['sales'] as $value) {
						?>
							<div class="col-sm-4">
								<div class="row">
									<div class="col offer">
										<div class="ribbon"><span>SALE&nbsp;<?php echo $value['precentage']; ?>%</span></div>
										<a href="http://localhost/vinyl/pages/single?id=<?php echo $value['id_album']; ?>"><img src="<?php echo $value['img_url']; ?>"></a>
									</div>
								</div>
								<div class="row">
									<div class="col price pb-5">
										<h1><?php echo $value['title']; ?></h1>
										<h1><?php  echo alternative_money($value['price']); ?></h1>
									</div>
								</div>
							</div>
						<?php
					}
				?>
		</div>		
	</div>
	<div class="row about" id="about">		
		<div class="col-sm-6 about_w">
			<h1>About Us</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		<div class="col-sm-6">	

		</div>
	</div>
	<div class="row contact" id="contact">
		<div class="col-sm-6 contact_f">
			<div class="alert alert-success d-none text-center" role="alert" id="cont_success">
			 
			</div>
			<form>
				<div class="form-group">
					<input type="text" name="name" class="form-control" placeholder="Name*" id="cont_name">
					<span id="cont_name_msg"></span>		
				</div>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email*" id="cont_email">
					<span id="cont_email_msg"></span>
				</div>
				<div class="form-group">
					<input type="text" name="subject" class="form-control" placeholder="Subject*" id="cont_subj">
					<span id="cont_subj_msg"></span>
				</div>
				<div class="form-group">
					<textarea class="form-control" wrap="hard" rows="5" placeholder="Message*" id="cont_mess"></textarea>
					<span id="cont_mess_msg"></span>
				</div>
				<button type="button" class="btn btn-dark" id="cont_btn">Submit</button>
			</form>
		</div>
		<div class="col-sm-6 contact_w">
			<h1>Contact</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#cont_btn').on('click', function(){
				var name = $('#cont_name').val();
				var email = $('#cont_email').val();
				var subj = $('#cont_subj').val();
				var mess = $('#cont_mess').val();

				$.ajax({
					url: 'http://localhost/vinyl/pages/contact_form',
					type: 'POST',
					data: {
						cont_form: 1,												
						name: name,												
						email: email,												
						subj: subj,												
						mess: mess												
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.name_err) {
							$('#cont_name').removeClass("is-valid").addClass("is-invalid");
 							$('#cont_name_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#cont_name_msg').html(resp.name_err);
 						} else {
 							$('#cont_name').removeClass("is-invalid").addClass("is-valid");
							$('#cont_name_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#cont_name_msg').html(resp.name_ok);
 						}

 						if (resp.email_err) {
							$('#cont_email').removeClass("is-valid").addClass("is-invalid");
 							$('#cont_email_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#cont_email_msg').html(resp.email_err);
 						} else {
 							$('#cont_email').removeClass("is-invalid").addClass("is-valid");
							$('#cont_email_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#cont_email_msg').html(resp.email_ok);
 						}

 						if (resp.subj_err) {
							$('#cont_subj').removeClass("is-valid").addClass("is-invalid");
 							$('#cont_subj_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#cont_subj_msg').html(resp.subj_err);
 						} else {
 							$('#cont_subj').removeClass("is-invalid").addClass("is-valid");
							$('#cont_subj_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#cont_subj_msg').html(resp.subj_ok);
 						}

 						if (resp.mess_err) {
							$('#cont_mess').removeClass("is-valid").addClass("is-invalid");
 							$('#cont_mess_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#cont_mess_msg').html(resp.mess_err);
 						} else {
 							$('#cont_mess').removeClass("is-invalid").addClass("is-valid");
							$('#cont_mess_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#cont_mess_msg').html(resp.mess_ok);
 						}

 						if (resp.server_response_ok) {
 							 $('#cont_name').val('');
 							 $('#cont_email').val('');
 							 $('#cont_subj').val('');
 							 $('#cont_mess').val('');

 							 $('#cont_name').removeClass("is-valid");
 							 $('#cont_email').removeClass("is-valid");
 							 $('#cont_subj').removeClass("is-valid");
 							 $('#cont_mess').removeClass("is-valid");

 							 $('#cont_success').removeClass('d-none');
 							 $('#cont_success').html('Your message has been sent. Thank you for your interest.');
 							 setTimeout(function(){ $('#cont_success').addClass('d-none'); }, 10000);
 						}

 						if (resp.server_response_err) {
							$('#cont_success').removeClass('d-none');
 							$('#cont_success').removeClass('alert-success').addClass('alert-danger');
 							$('#cont_success').html(resp.server_response_err);
 							setTimeout(function(){ $('#cont_success').addClass('d-none'); }, 10000);
 						}


						
						
					},
					dataType: 'text'
				});
			});
		});
	</script>
<?php require APPROOT . "/views/inc/footer.php" ?>


