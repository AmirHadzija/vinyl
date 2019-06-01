<?php require APPROOT . "/views/inc/header.php"; ?>
<?php require APPROOT . "/views/inc/navbar.php"; ?>
	<div class="admin_page">
		<div class="row">
			<div class="col-sm-2 user_side">
				<div class="admin_img_frame">
					<img src="<?php echo $_SESSION['user']->img_url; ?>" class="user_img">	
					<input type="file" id="us_img_edit">					
				</div>
				<div class="row d-none" id="img_ch_div">
					<div class="col-sm">
						<div class="alert alert-success text-center" role="alert" id="img_ch_alert">
						  
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-10">
				<?php flash('insert_success'); ?>
				<?php flash('update_success'); ?>
				<?php flash('artist_del_success'); ?>
				<?php flash('artist_ins_success'); ?>
				<?php flash('product_del_success'); ?>
				<?php flash('ord_processed'); ?>
				<?php flash('sale_success'); ?>
								
				<h4>DETAILS</h4>
				<div class="row d-none" id="address_alert">
					<div class="col-sm">
						<div class="alert alert-success text-center" role="alert" id="user_info_alert">
						  
						</div>
					</div>
				</div>
				<hr>
				<p><i class="far fa-edit" id="edit_user_name"></i> Name: <var id="fn"><?php echo $_SESSION['user']->first_name ?></var> <var id="ln"><?php echo $_SESSION['user']->last_name; ?></var></p>
				<div class="form-group col-sm-6 mb-0" id="fn_ln_form" style="display: none;">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="Insert new First Name" aria-label="Insert new First Name" aria-describedby="button-addon2" id="new_fn">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary user_ch_btn" type="button" id="new_fn_btn">Submit</button>
					  </div>
					  	<span id="new_fn_msg"></span>
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" placeholder="Insert new Last Name" aria-label="Insert new Last Name" aria-describedby="button-addon2" id="new_ln">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary user_ch_btn" type="button" id="new_ln_btn">Submit</button>
					  </div>
					  <span id="new_ln_msg"></span>
					</div>
				</div>
				<p><i class="far fa-edit" id="edit_username"></i> Username: <var id="us"><?php echo $_SESSION['user']->username; ?></var></p>
				<div class="form-group col-sm-6 mb-0">
					<div class="input-group mb-3" id="un_form" style="display: none;">
					  <input type="text" class="form-control" placeholder="Insert new Username" aria-label="Insert new Username" aria-describedby="button-addon2" id="new_us">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary" type="button" id="new_us_btn">Submit</button>
					  </div>
					  <span id="new_us_msg"></span>
					</div>
				</div>
				<p><i class="far fa-edit" id="edit_user_email"></i> Email: <var id="em"><?php echo $_SESSION['user']->email; ?></var></p>
				<div class="form-group col-sm-6 mb-0">
					<div class="input-group mb-3" id="em_form" style="display: none;">
					  <input type="text" class="form-control" placeholder="Insert new Email" aria-label="Insert new Email" aria-describedby="button-addon2" id="new_em">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary" type="button" id="new_em_btn">Submit</button>
					  </div>
					  <span id="new_em_msg"></span>
					</div>
				</div>
				<p><i class="fas fa-key" id="edit_password"></i> Change password</p>
				<div class="form-group col-sm-6 mb-0" id="pass_form" style="display: none;">
					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="Enter old Password" aria-label="Enter old Password" aria-describedby="button-addon2" id="old_pass">
					  <span id="old_pass_msg"></span>  
					</div>
					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="Retype old Password" aria-label="Retype old Password" aria-describedby="button-addon2" id="old_pass_r">
					  <span id="old_pass_r_msg"></span>  
					</div>
					<div class="input-group mb-3">
					  <input type="password" class="form-control" placeholder="Enter new Password" aria-label="Enter new Password" aria-describedby="button-addon2" id="new_pass">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary user_pass_btn" type="button" id="new_pass_btn">Submit</button>
					  </div>
					  <span id="new_pass_msg"></span>
					</div>
				</div>
				<p>Position: <?php echo $_SESSION['user']->permission; ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm inner_nav_user">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active text-center" id="pills-address-tab" data-toggle="pill" href="#pills-address" role="tab" aria-controls="pills-address" aria-selected="true">Address Information</a>
					</li>					
					<li class="nav-item">
						<a class="nav-link text-center" id="pills-orders-tab" data-toggle="pill" href="#pills-orders" role="tab" aria-controls="pills-orders" aria-selected="false">Orders</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-address" role="tabpanel" aria-labelledby="pills-address-tab">
					<div class="row">
						<div class="col-sm text-center">
							<h1 class="pb-3 pt-3">YOUR ADDRESS INFO</h1>
							<h3 class="pb-3">Update your address information regularly to be sure that any purchase made in our boutique is done quickly and safely</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-1">
						</div>
						<div class="col-sm-5">
							<div class="row mt-3">
								<div class="col-sm p-2">
									<h3 class="pt-4">Address Info</h3>
									<div class="alert alert-success text-center d-none" role="alert" id="address_alert_upd">
									  
									</div>
									<hr><br><br>
									<h4 class="pb-2">Address: <var id="address_v"><?php echo $data['get_u_address']->address1; ?></var></h4>
									<h4 class="pb-2">Postal code: <var id="postal_v"><?php echo $data['get_u_address']->postal_code; ?></var></h4>
									<h4 class="pb-2">City: <var id="city_v"><?php echo $data['get_u_address']->city; ?></var></h4>
									<h4 class="pb-2">Country: <var id="country_v"><?php echo $data['get_u_address']->country; ?></var></h4>
									<h4 class="pb-4">Phone: <var id="phone_v"><?php echo $data['get_u_address']->phone; ?></var></h4>
								</div>
							</div>
						</div>
						<div class="col-sm-5">
							<form>
								<div class="form-group">
									<label for="address" class="boutique_form">Address*:</label>
									<input type="text" class="form-control form-control-sm" id="address" placeholder="Address*">
									<span id="address_msg"></span>
								</div>
								<div class="form-group">
									<label for="postal_code" class="boutique_form">Postal Code*:</label>
									<input type="text" class="form-control form-control-sm" id="postal_code" placeholder="Postal Code*">
									<span id="postal_code_msg"></span>
								</div>
								<div class="form-group">
									<label for="city" class="boutique_form">City*:</label>
									<input type="text" class="form-control form-control-sm" id="city" placeholder="City*">
									<span id="city_msg"></span>
								</div>
								<div class="form-group">
									<label for="country" class="boutique_form">Country*:</label>
									<input type="text" class="form-control form-control-sm" id="country" placeholder="Country*">
									<span id="country_msg"></span>
								</div>
								<div class="form-group">
									<label for="phone" class="boutique_form">Phone*:</label>
									<input type="text" class="form-control form-control-sm" id="phone" placeholder="Phone*">
									<span id="phone_msg"></span>
								</div>
								<div class="form-group">
									<input type="button" class="form-control form-control-sm log_reg_btn" id="add_btn" value="SUBMIT">
								</div>
							</form>						
						</div>
						<div class="col-sm-1">
							
						</div>
					</div>
				</div>				
				<div class="tab-pane fade" id="pills-orders" role="tabpanel" aria-labelledby="pills-orders-tab">
					<div class="row">
						<div class="col-sm-6 p-5">
							<h3 class="pt-3 pb-3 text-center">ACTIVE ORDERS</h3>
							<?php
								if (isset($data['get_u_orders']) && !empty($data['get_u_orders'])) {
									foreach ($data['get_u_orders'] as $key => $value) {
										?>
											<div class="row p-2 us_or_row">
												<div class="col-sm us_or_col pt-3 pb-1">
													<h4>Order processing ID: <?php echo $value->id_orders; ?></h4>
												</div>
											</div>
										<?php				
										$exp_img = explode(',',$value->img_url);
										$exp_title = explode(',', $value->titles); 
										$exp_quantity = explode(',', $value->quantity);
										$exp_price = explode(',', $value->album_price);
										for ($i=0; $i < count($exp_img); $i++) { 
											?>											
												<div class="row p-2 us_or_row">
													<div class="col-sm-2 us_or_col p-0">
														<img class="us_ord_img" src="<?php echo $exp_img[$i]; ?>">
													</div>
													<div class="col-sm-10 us_or_col p-0">												
														<p class="m-0 pl-2 pb-2 pt-2">Title: <?php echo $exp_title[$i]; ?></p>					
														<p class="m-0 pl-2 pb-2">Quantity: <?php echo $exp_quantity[$i]; ?></p>
														<p class="m-0 pl-2 pb-1">Price: <?php echo alternative_money($exp_price[$i]); ?></p>
													</div>
												</div>
											<?php														
										}
											?>
											<div class="row p-2 us_or_row">
												<div class="col-sm p-2 us_or_col text-left">
													<p>Remark: <?php echo $value->order_notes; ?></p>
												</div>
											</div>
											<div class="row p-2 us_or_row mb-5">
												<div class="col-sm p-2 us_or_col text-right">
													<h5 class="pt-2 mb-0">Total: <?php echo alternative_money($value->total); ?></h5>
												</div>
											</div>
										<?php
									}								
								}
							?>
						</div>				
						<div class="col-sm-6 p-5">
							<h3 class="pt-3 text-center">PROCESSED ORDERS</h3>							
							<?php
								if (isset($data['get_u_archive']) && !empty($data['get_u_archive'])) {
									foreach ($data['get_u_archive'] as $key => $value) {
										?>
											<div class="row mb-3">
												<div class="col-sm p-4"
												<?php
													if ($value->order_end_status == 'processed') {
														?>
															style="background-color: rgba(90, 255, 62, 0.3);";
														<?php
													} elseif ($value->order_end_status == 'canceled') {
														?>
															style="background-color: rgba(224, 0, 0, 0.3);";
														<?php
													}
												?>
												>
													<div class="row">
														<div class="col-sm pb-1 pt-3 <?php if($value->order_end_status == 'processed'){
															?> us_ora_col_pro <?php } elseif($value->order_end_status == 'canceled'){?>us_ora_col_can <?php } ?>">
															<?php
																if ($value->order_end_status == 'processed') {
																	?>
																		<h4>Processed order ID: <?php echo $value->id; ?></h4>
																	<?php
																} elseif ($value->order_end_status == 'canceled') {
																	?>
																		<h4>Canceled order ID: <?php echo $value->id; ?></h4>
																	<?php
																}
															?>
														</div>
													</div>
													<?php
														$exp_title = explode(',', $value->product_titles);
														$exp_quantity = explode(',', $value->quantity);
														$exp_price = explode(',', $value->unit_price);

														for ($i=0; $i < count($exp_title); $i++) { 
															?>
																<div class="row mt-3 mb-3">													 
																	 <div class="col-sm <?php if($value->order_end_status == 'processed'){
																		?> us_ora_col_pro <?php } elseif($value->order_end_status == 'canceled'){?>us_ora_col_can <?php } ?>">
																	 	<p class="m-0 pl-2 pb-2 pt-2">Title: <?php echo $exp_title[$i]; ?></p>
																	 	<p class="m-0 pl-2 pb-2">Quantity: <?php echo $exp_quantity[$i]; ?></p>
																	 	<p class="m-0 pl-2 pb-1">Price: <?php echo $exp_price[$i]; ?></p>
																	 </div>
																</div>
															<?php
														}
													?>
													<div class="row mb-3">
														<div class="col-sm p-2 text-left <?php if($value->order_end_status == 'processed'){
															?> us_ora_col_pro <?php } elseif($value->order_end_status == 'canceled'){?>us_ora_col_can <?php } ?>">
															<p>Remark: <?php echo $value->order_notes; ?></p>
														</div>
													</div>
													<div class="row">
														<div class="col-sm p-2 text-right <?php if($value->order_end_status == 'processed'){
															?> us_ora_col_pro <?php } elseif($value->order_end_status == 'canceled'){?>us_ora_col_can <?php } ?>">
															<h5 class="p-2 mb-0">Total: <?php echo alternative_money($value->total); ?></h5>
														</div>
													</div>									
												</div>
											</div>
										<?php
									}									
								}
							?>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>		
	</div>
	<script type="text/javascript">
		$(document).ready(function(){		
			$('#edit_user_name').on('click', function(){
				$('#fn_ln_form').toggle();
			});
			$('#edit_username').on('click', function(){
				$('#un_form').toggle();
			});
			$('#edit_user_email').on('click', function(){
				$('#em_form').toggle();
			});
			$('#edit_password').on('click', function(){
				$('#pass_form').toggle();
			});
			$('.user_img').on('click', function(){
				$('#us_img_edit').trigger('click');
			});
			$('#us_img_edit').on('change', function(){
				var us_img = $("#us_img_edit").prop('files')[0];					
				var ext = us_img.name.split('.').pop().toLowerCase();				

				var reader = new FileReader();
				reader.onload = function(e){
					$(".user_img").attr('src', e.target.result);


				var form_data = new FormData();	
				form_data.append("img_change", 1);
				form_data.append("file", us_img);

				$.ajax({
					url: 'http://localhost/vinyl/admins/user_img_edit',
					type: 'POST',
					data: form_data,
					contentType: false,
					cache: false,
					processData: false,
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);											
						
						if (resp.server_response_ok) {							
 							$('#img_ch_div').removeClass('d-none');
 							$('#img_ch_alert').html('You successfully changed your image');
 							setTimeout(function(){ $('#img_ch_alert').addClass('d-none'); }, 10000);
 						} 

 						if (resp.server_response_err) {
 							$('#img_ch_div').removeClass('d-none');
 							$('#img_ch_alert').removeClass('alert-success').addClass('alert-danger');
 							$('#img_ch_alert').html('There was a problem with changing your image');
 							setTimeout(function(){ $('#img_ch_alert').addClass('d-none'); }, 10000);
 						}					
					},
					dataType: 'text'
				});										
				}
				reader.readAsDataURL(us_img);
			});
			$('#new_fn_btn').on('click', function(){
				var new_fn = $('#new_fn').val();

				$.ajax({
					url: 'http://localhost/vinyl/admins/user_info_change',
					type: 'POST',
					data: {
						fn_change: 1,
						new_fn: new_fn,															
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.new_fn_err) {
							$('#new_fn').removeClass("is-valid").addClass("is-invalid");
 							$('#new_fn_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#new_fn_msg').html(resp.new_fn_err);
 						} else {
 							$('#new_fn').removeClass("is-invalid").addClass("is-valid");
							$('#new_fn_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#new_fn_msg').html(resp.new_fn_ok);
 						}

 						if (resp.server_response_ok) {	
 							$('#fn').text(new_fn);
 							$('#new_fn').val('');
 							$('#info_al_div').removeClass('d-none');
 							$('#user_info_alert').html('You successfully changed your First Name');
 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
 						} 

 						if (resp.server_response_err) {
 							$('#info_al_div').removeClass('d-none');
 							$('#user_info_alert').removeClass('alert-success').addClass('alert-danger');
 							$('#user_info_alert').html('There was a problem with changing your First Name');
 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
 						}					
					},
					dataType: 'text'
				});	

				
			});
			$('#new_ln_btn').on('click', function(){
				var new_ln = $('#new_ln').val();

				$.ajax({
					url: 'http://localhost/vinyl/admins/user_info_change',
					type: 'POST',
					data: {
						ln_change: 1,
						new_ln: new_ln,															
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.new_ln_err) {
							$('#new_ln').removeClass("is-valid").addClass("is-invalid");
 							$('#new_ln_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#new_ln_msg').html(resp.new_ln_err);
 						} else {
 							$('#new_ln').removeClass("is-invalid").addClass("is-valid");
							$('#new_ln_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#new_ln_msg').html(resp.new_ln_ok);
 						}

 						if (resp.server_response_ok) {	
 							$('#ln').text(new_ln);
 							$('#new_ln').val('');
 							$('#info_al_div').removeClass('d-none');
 							$('#user_info_alert').html('You successfully changed your Last Name');
 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
 						} 

 						if (resp.server_response_err) {
 							$('#info_al_div').removeClass('d-none');
 							$('#user_info_alert').removeClass('alert-success').addClass('alert-danger');
 							$('#user_info_alert').html('There was a problem with changing your Last Name');
 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
 						}					
					},
					dataType: 'text'
				});				
			});
			$('#new_us_btn').on('click', function(){
				var new_us = $('#new_us').val();

				$.ajax({
					url: 'http://localhost/vinyl/admins/user_info_change',
					type: 'POST',
					data: {
						us_change: 1,
						new_us: new_us,															
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.new_us_err) {
							$('#new_us').removeClass("is-valid").addClass("is-invalid");
 							$('#new_us_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#new_us_msg').html(resp.new_us_err);
 						} else {
 							$('#new_us').removeClass("is-invalid").addClass("is-valid");
							$('#new_us_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#new_us_msg').html(resp.new_us_ok);
 						}

 						if (resp.server_response_ok) {	
 							$('#us').text(new_us);
 							$('#new_us').val('');
 							$('#info_al_div').removeClass('d-none');
 							$('#user_info_alert').html('You successfully changed your Username');
 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
 						} 

 						if (resp.server_response_err) {
 							$('#info_al_div').removeClass('d-none');
 							$('#user_info_alert').removeClass('alert-success').addClass('alert-danger');
 							$('#user_info_alert').html('There was a problem with changing your Username');
 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
 						}					
					},
					dataType: 'text'
				});				
			});
			$('#new_em_btn').on('click', function(){
				var new_em = $('#new_em').val();

				$.ajax({
					url: 'http://localhost/vinyl/admins/user_info_change',
					type: 'POST',
					data: {
						em_change: 1,
						new_em: new_em,															
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.new_em_err) {
							$('#new_em').removeClass("is-valid").addClass("is-invalid");
 							$('#new_em_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#new_em_msg').html(resp.new_em_err);
 						} else {
 							$('#new_em').removeClass("is-invalid").addClass("is-valid");
							$('#new_em_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#new_em_msg').html(resp.new_em_ok);
 						}

 						if (resp.server_response_ok) {	
 							$('#em').text(new_em);
 							$('#new_em').val('');
 							$('#info_al_div').removeClass('d-none');
 							$('#user_info_alert').html('You successfully changed your Username');
 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
 						} 

 						if (resp.server_response_err) {
 							$('#info_al_div').removeClass('d-none');
 							$('#user_info_alert').removeClass('alert-success').addClass('alert-danger');
 							$('#user_info_alert').html('There was a problem with changing your Username');
 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
 						}					
					},
					dataType: 'text'
				});				
			});
			$('#new_pass_btn').on('click', function(){
				var old_pass = $('#old_pass').val();
				var old_pass_r = $('#old_pass_r').val();
				var new_pass = $('#new_pass').val();

				if (old_pass === old_pass_r) {
					$.ajax({
						url: 'http://localhost/vinyl/admins/user_info_change',
						type: 'POST',
						data: {
							pass_change: 1,
							old_pass: old_pass,															
							old_pass_r: old_pass_r,															
							new_pass: new_pass														
						},
						success: function(response){
							var resp = JSON.parse(response);
							console.log(resp);

							if (resp.old_pass_err) {
								$('#old_pass').removeClass("is-valid").addClass("is-invalid");
	 							$('#old_pass_msg').removeClass("valid-feedback").addClass("invalid-feedback");
	 							$('#old_pass_msg').html(resp.old_pass_err);
	 						} else {
	 							$('#old_pass').removeClass("is-invalid").addClass("is-valid");
								$('#old_pass_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#old_pass_msg').html(resp.old_pass_ok);
	 						}

	 						if (resp.old_pass_r_err) {
								$('#old_pass_r').removeClass("is-valid").addClass("is-invalid");
	 							$('#old_pass_r_msg').removeClass("valid-feedback").addClass("invalid-feedback");
	 							$('#old_pass_r_msg').html(resp.old_pass_r_err);
	 						} else {
	 							$('#old_pass_r').removeClass("is-invalid").addClass("is-valid");
								$('#old_pass_r_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#old_pass_r_msg').html(resp.old_pass_r_ok);
	 						}

	 						if (resp.new_pass_err) {
								$('#new_pass').removeClass("is-valid").addClass("is-invalid");
	 							$('#new_pass_msg').removeClass("valid-feedback").addClass("invalid-feedback");
	 							$('#new_pass_msg').html(resp.new_pass_err);
	 						} else {
	 							$('#new_pass').removeClass("is-invalid").addClass("is-valid");
								$('#new_pass_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#new_pass_msg').html(resp.new_pass_ok);
	 						}

	 						if (resp.server_response_ok) {	 							
	 							$('#old_pass').val('');
	 							$('#old_pass_r').val('');
	 							$('#new_pass').val('');
	 							$('#info_al_div').removeClass('d-none');
	 							$('#user_info_alert').html('You successfully changed your Password');
	 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
	 						} 

	 						if (resp.server_response_err) {
	 							$('#info_al_div').removeClass('d-none');
	 							$('#user_info_alert').removeClass('alert-success').addClass('alert-danger');
	 							$('#user_info_alert').html('There was a problem with changing your Password');
	 							setTimeout(function(){ $('#user_info_alert').addClass('d-none'); }, 10000);
	 						}

												
						},
						dataType: 'text'
					});
				} else {
					$('#old_pass').removeClass("is-valid").addClass("is-invalid");
					$('#old_pass_r').removeClass("is-valid").addClass("is-invalid");
					$('#old_pass_msg').removeClass("valid-feedback").addClass("invalid-feedback");
					$('#old_pass_r_msg').removeClass("valid-feedback").addClass("invalid-feedback");
					$('#old_pass_msg').html('Passwords do not match');
					$('#old_pass_r_msg').html('Passwords do not match');
				}				
			});
			$('#add_btn').on('click', function(){
				var	address = $('#address').val();
				var	postal_code = $('#postal_code').val();
				var	city = $('#city').val();
				var	country = $('#country').val();
				var	phone = $('#phone').val();

				$.ajax({
					url: 'http://localhost/vinyl/admins/user_address_update',
					type: 'POST',
					data: {
						add_upd: 1,
						address: address,															
						postal_code: postal_code,													
						city: city,															
						country: country,															
						phone: phone														
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.address_err) {
							$('#address').removeClass("is-valid").addClass("is-invalid");
 							$('#address_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#address_msg').html(resp.address_err);
 						} else {
 							$('#address').removeClass("is-invalid").addClass("is-valid");
							$('#address_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#address_msg').html(resp.address_ok);
 						}

 						if (resp.postal_code_err) {
							$('#postal_code').removeClass("is-valid").addClass("is-invalid");
 							$('#postal_code_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#postal_code_msg').html(resp.postal_code_err);
 						} else {
 							$('#postal_code').removeClass("is-invalid").addClass("is-valid");
							$('#postal_code_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#postal_code_msg').html(resp.postal_code_ok);
 						}

 						if (resp.city_err) {
							$('#city').removeClass("is-valid").addClass("is-invalid");
 							$('#city_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#city_msg').html(resp.city_err);
 						} else {
 							$('#city').removeClass("is-invalid").addClass("is-valid");
							$('#city_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#city_msg').html(resp.city_ok);
 						}

 						if (resp.country_err) {
							$('#country').removeClass("is-valid").addClass("is-invalid");
 							$('#country_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#country_msg').html(resp.country_err);
 						} else {
 							$('#country').removeClass("is-invalid").addClass("is-valid");
							$('#country_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#country_msg').html(resp.country_ok);
 						}

 						if (resp.phone_err) {
							$('#phone').removeClass("is-valid").addClass("is-invalid");
 							$('#phone_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#phone_msg').html(resp.phone_err);
 						} else {
 							$('#phone').removeClass("is-invalid").addClass("is-valid");
							$('#phone_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#phone_msg').html(resp.phone_ok);
 						}

 						if (resp.server_response_ok) {
 							$('#address_v').text(address);
 							$('#postal_v').text(postal_code);
 							$('#city_v').text(city);
 							$('#country_v').text(country);
 							$('#phone_v').text(phone);
 							$('#address').val('');
							$('#postal_code').val('');
							$('#city').val('');
							$('#country').val('');
							$('#phone').val('');
 							$('#address_alert_upd').removeClass('d-none');
 							$('#address_alert_upd').html('You successfully updated your address');
 							setTimeout(function(){ $('#address_alert_upd').addClass('d-none'); }, 10000);
 						}

 						if (resp.server_response_err) {
 							$('#address_alert_upd').removeClass('d-none');
 							$('#address_alert_upd').removeClass('alert-success').addClass('alert-danger');
 							$('#address_alert_upd').html('There was a problem with updating your address. Please try again later');
 							setTimeout(function(){ $('#address_alert_upd').addClass('d-none'); }, 10000);
 						}

											
					},
					dataType: 'text'
				});
			});
		});
	</script>	
<?php require APPROOT . "/views/inc/footer.php"; ?>