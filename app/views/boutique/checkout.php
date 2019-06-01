<?php require APPROOT . "/views/inc/header.php"; ?>
<?php require APPROOT . "/views/inc/navbar.php"; ?>
	<div class="checkout_page">
		<div class="row">
			<div class="col-sm">
				<div  id="cart_resp" class="text-center d-none">
					<div>
						<h2 id="cart_resp_msg"></h2>
					</div>
				</div>
			</div>
		</div>
		<div class="row pb-5">
			<div class="col-sm p-1 mt-3 ml-3 mr-3 frame">	
			<h1 class="pl-3 check_heading">Your Cart (<samp id="co_count">
				<?php 
					if (isset($_SESSION['cart_count'])) {
						echo $_SESSION['cart_count']; 						
					} else {
						echo '0';
					}
				?>
					
				</samp>)
			</h1>			
				<?php
					foreach ($data['cart_items'] as $key => $value) {
						?>								
							<div class="row shopping_list mt-3 ml-3 mr-3" id="div_<?php echo $value->id; ?>">
								<div class="col-sm-2 p-0">
									<?php 
										if ($value->on_sale == 'yes') {
											?>
												<div class="ribbon"><span>SALE&nbsp;<?php echo $data['cart_sale'][$value->id][0]['precentage']; ?>%</span></div>
											<?php
										}
									 ?>
									<a href="http://localhost/vinyl/pages/single?id=<?php echo $value->id; ?>">
										<img class="img_checkout" src="<?php echo $value->img_url; ?>">
									</a>
								</div>
								<div class="col-sm-6">
									<h3 class="pt-2"><?php echo $value->title; ?></h3>
									<h4>By <?php echo $value->artist; ?></h4>
									<br><br>
									<h5>Product ID:<?php echo $value->id; ?></h5>
								</div>
								<div class="col-sm-4">
									<h4 class="pt-2">Price: $<?php echo $_SESSION['cart'][$value->id]['unit_price']; ?></h4>
									<br>
									<h4>Quantity: <?php echo $_SESSION['cart'][$value->id]['quantity']; ?></h4>
									<br>
									<i class="fas fa-trash-alt fa-3x checkout_rmv" id="co_rmv_btn_<?php echo $value->id; ?>"></i>									
								</div>
							</div>									
						<?php
					}
				?>
				<div class="row m-3">
					<div class="col-sm-2 p-0">
						
					</div>
					<div class="col-sm-6">
						
					</div>					
						<?php
							if (isset($_SESSION['cart_total'])) {
						 		?>
						 		<div class="col-sm-4 co_form_div p-3 text-center co_total_div">
						 			<h4>Total: $<samp id="co_total"><?php echo $_SESSION['cart_total']; ?></samp></h4>
						 		</div>
						 		<?php								
							}
						?>				
				</div>
				<div class="row">
					<div class="col-sm check_heading text-center">						
						<div class="row">
							<?php
								if (!isset($_SESSION['user'])) {
									?>
										<div class="col-sm-3">
											 
										</div>
										<div class="col-sm-6 m-3 co_form_div">
											<h2 class="p-2 check_heading">Please fill out this form to complete your order</h2>
											<form class="co_form">
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="co_email" placeholder="Email*">
													<span class="hidden" id="co_email_msg"></span>
												</div>
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="co_first_name" placeholder="First Name*">
													<span class="hidden" id="co_first_name_msg"></span>
												</div>
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="co_last_name" placeholder="Last Name*">
													<span class="hidden" id="co_last_name_msg"></span>
												</div>
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="co_address" placeholder="Address*">
													<span class="hidden" id="co_address_msg"></span>
												</div>
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="co_city" placeholder="City*">
													<span class="hidden" id="co_city_msg"></span>
												</div>
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="co_postal_code" placeholder="Postal Code*">
													<span class="hidden" id="co_postal_code_msg"></span>
												</div>
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="co_country" placeholder="Country*">
													<span class="hidden" id="co_country_msg"></span>
												</div>
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="co_phone_num" placeholder="Phone Number*">
													<span class="hidden" id="co_phone_num_msg"></span>
												</div>
												<div class="form-group">
													<textarea class="form-control form-control-sm" wrap="hard" cols="10" rows="5" placeholder="Leave a remark" id="co_remark"></textarea>
												</div>
												<div class="form-group">
													<input class="form-control form-control-sm log_reg_btn" type="button" id="co_sub_btn" value="COMPLETE ORDER">
													<span class="hidden" id="co_sub_btn_msg"></span>
												</div>
											</form>								
										</div>
										<div class="col-sm-3">
											
										</div>
									<?php
								} else {
									?>
										<div class="col-sm-3">
											
										</div>
										<div class="col-sm-6 m-3">
											<div class="row m-3 d-none co_form_div" id="reg_user_form">
												<div class="col-sm">
													<h4 class="p-3 check_heading">Dear user, you need to register your address with us first</h4>
													<div class="form-group">
														<input class="form-control form-control-sm" type="text" id="co_address" placeholder="Address*">
														<span class="hidden" id="co_address_msg"></span>
													</div>
													<div class="form-group">
														<input class="form-control form-control-sm" type="text" id="co_city" placeholder="City*">
														<span class="hidden" id="co_city_msg"></span>
													</div>
													<div class="form-group">
														<input class="form-control form-control-sm" type="text" id="co_postal_code" placeholder="Postal Code*">
														<span class="hidden" id="co_postal_code_msg"></span>
													</div>
													<div class="form-group">
														<input class="form-control form-control-sm" type="text" id="co_country" placeholder="Country*">
														<span class="hidden" id="co_country_msg"></span>
													</div>
													<div class="form-group">
														<input class="form-control form-control-sm" type="text" id="co_phone_num" placeholder="Phone Number*">
														<span class="hidden" id="co_phone_num_msg"></span>
													</div>
													<div class="form-group">
														<textarea class="form-control form-control-sm" wrap="hard" cols="10" rows="5" placeholder="Leave a remark" id="co_remark"></textarea>
													</div>
													<div class="form-group">
														<input type="button" value="COMPLETE ORDER" class="form-control form-control-sm log_reg_btn" id="na_us_btn">													
													</div>
												</div>
											</div>
											<div class="p-3 co_form_div" id="reg_div">
												<div class="form-group">
													<textarea class="form-control form-control-sm" wrap="hard" cols="10" rows="5" placeholder="Leave a remark" id="reg_us_remark"></textarea>
												</div>
												<div class="form-group">
													<input type="button" value="COMPLETE ORDER" class="form-control form-control-sm log_reg_btn" id="reg_us_btn">												
												</div>												
											</div>
										</div>
										<div class="col-sm-3">
											
										</div>
									<?php
								}
							?>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){			
			var rmv_btn = $('.checkout_rmv').siblings();
			var rmv_btn_id = rmv_btn.prevObject;
			jQuery.each(rmv_btn_id, function(key, value){
				var rmv_id = rmv_btn_id[key].id;
				var rmv_split_id = rmv_id.split('_');
				var id = rmv_split_id[3];
				$('#co_rmv_btn_'+id).on('click', function(){
					var parent = $('#rmv_btn_'+id).parents();
					parent[1].remove();			
					$('#div_'+id).remove();
					$.ajax({
						url: 'http://localhost/vinyl/orders/cart',
						type: 'POST',
						data: {
							single_cart: 1,
							rmv_btn: id								
						},
						success: function(response){
							var resp = JSON.parse(response);
							console.log(resp);
							var a = $('#cart_body').children().length;
							$('#co_count').text(a);
							$('#cart_count').text(a);


							console.log(a);

							if (resp.cart_total) {
								$('#co_total').text(resp.cart_total);

								$('#cart_foot').children().remove();
								var cart_total = "<tr><th>Total:</th><th></th><th></th><th></th><th id='total'>$&nbsp;"+resp.cart_total+"</th><th></th></tr>";
								$('#cart_foot').html(cart_total);
							} else {
								$('#total').remove();
							}
							if (!resp.cart_info.length) {
								$('.co_total_div').remove();
								$("#co_sub_btn").attr("disabled","disabled");
								$(".frame").html("<h1 class='text-center p-5 check_heading'>Your cart is empty, please continue browsing trough our boutique</h1>");
								$(".frame").removeClass('mt-3');
								$(".frame").css({"margin-top": "250px", "margin-bottom": "400px"});
								
							}
										
						},
						dataType: 'text'
					});
				});
			});
			
			$('#co_sub_btn').on('click', function(){
				var	co_email = $('#co_email').val();
				var	co_first_name = $('#co_first_name').val();
				var	co_last_name = $('#co_last_name').val();
				var	co_address = $('#co_address').val();
				var	co_city = $('#co_city').val();
				var	co_postal_code = $('#co_postal_code').val();
				var	co_country = $('#co_country').val();
				var	co_phone_num = $('#co_phone_num').val();
				var	co_remark = $('#co_remark').val();
				
				$.ajax({
					url: 'http://localhost/vinyl/orders/checkout_form',
					type: 'POST',
					data: {
						checkout_form: 1,
						co_email: co_email,								
						co_first_name: co_first_name,								
						co_last_name: co_last_name,								
						co_address: co_address,								
						co_city: co_city,								
						co_postal_code: co_postal_code,								
						co_country: co_country,								
						co_phone_num: co_phone_num,
						co_remark: co_remark							
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.co_email_err) {
							$('#co_email').removeClass("is-valid").addClass("is-invalid");
							$('#co_email_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_email_msg').html(resp.co_email_err);
						} else if(resp.co_email_ok) {
							$('#co_email').removeClass("is-invalid").addClass("is-valid");
							$('#co_email_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_email_msg').html(resp.co_email_ok);
						}

						if (resp.co_first_name_err) {
							$('#co_first_name').removeClass("is-valid").addClass("is-invalid");
							$('#co_first_name_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_first_name_msg').html(resp.co_first_name_err);
						} else if(resp.co_first_name_ok) {
							$('#co_first_name').removeClass("is-invalid").addClass("is-valid");
							$('#co_first_name_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_first_name_msg').html(resp.co_first_name_ok);
						}

						if (resp.co_last_name_err) {
							$('#co_last_name').removeClass("is-valid").addClass("is-invalid");
							$('#co_last_name_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_last_name_msg').html(resp.co_last_name_err);
						} else if(resp.co_last_name_ok) {
							$('#co_last_name').removeClass("is-invalid").addClass("is-valid");
							$('#co_last_name_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_last_name_msg').html(resp.co_last_name_ok);
						}

						if (resp.co_address_err) {
							$('#co_address').removeClass("is-valid").addClass("is-invalid");
							$('#co_address_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_address_msg').html(resp.co_address_err);
						} else if(resp.co_address_ok) {
							$('#co_address').removeClass("is-invalid").addClass("is-valid");
							$('#co_address_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_address_msg').html(resp.co_address_ok);
						}

						if (resp.co_city_err) {
							$('#co_city').removeClass("is-valid").addClass("is-invalid");
							$('#co_city_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_city_msg').html(resp.co_city_err);
						} else if(resp.co_city_ok) {
							$('#co_city').removeClass("is-invalid").addClass("is-valid");
							$('#co_city_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_city_msg').html(resp.co_city_ok);
						}
						
						if (resp.co_postal_code_err) {
							$('#co_postal_code').removeClass("is-valid").addClass("is-invalid");
							$('#co_postal_code_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_postal_code_msg').html(resp.co_postal_code_err);
						} else if(resp.co_postal_code_ok) {
							$('#co_postal_code').removeClass("is-invalid").addClass("is-valid");
							$('#co_postal_code_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_postal_code_msg').html(resp.co_postal_code_ok);
						}

						if (resp.co_country_err) {
							$('#co_country').removeClass("is-valid").addClass("is-invalid");
							$('#co_country_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_country_msg').html(resp.co_country_err);
						} else if(resp.co_country_ok) {
							$('#co_country').removeClass("is-invalid").addClass("is-valid");
							$('#co_country_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_country_msg').html(resp.co_country_ok);
						}

						if (resp.co_phone_num_err) {
							$('#co_phone_num').removeClass("is-valid").addClass("is-invalid");
							$('#co_phone_num_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_phone_num_msg').html(resp.co_phone_num_err);
						} else if(resp.co_phone_num_ok) {
							$('#co_phone_num').removeClass("is-invalid").addClass("is-valid");
							$('#co_phone_num_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_phone_num_msg').html(resp.co_phone_num_ok);
						}

						if (resp.cart_processed) {
							$(window).scrollTop(0);
							$('#cart_icon').remove();
							$('#cart_resp').removeClass('d-none');
							$('#cart_resp_msg').html(resp.cart_processed);
							$('.frame').remove();
						}
									
					},
					dataType: 'text'
				});
			});
			$('#reg_us_btn').on('click', function(){
				var reg_us_remark = $('#reg_us_remark').val();
				$.ajax({
					url: 'http://localhost/vinyl/orders/checkout_form',
					type: 'POST',
					data: {
						reg_us_btn: 1,
						ses_check: 2,
						reg_us_remark: reg_us_remark						
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);
						if (resp === 'not_registered') {
							$('#reg_user_form').removeClass('d-none');
							$('#reg_div').addClass('d-none');
							
						}

						if (resp.cart_processed) {
							$(window).scrollTop(0);
							$('#cart_icon').remove();
							$('#cart_resp').removeClass('d-none');
							$('#cart_resp_msg').html(resp.cart_processed);
							$('.frame').remove();
						}
						
									
					},
					dataType: 'text'
				});
			});
			$('#na_us_btn').on('click', function(){				
				var	co_address = $('#co_address').val();
				var	co_city = $('#co_city').val();
				var	co_postal_code = $('#co_postal_code').val();
				var	co_country = $('#co_country').val();
				var	co_phone_num = $('#co_phone_num').val();
				var	co_remark = $('#co_remark').val();
				
				$.ajax({
					url: 'http://localhost/vinyl/orders/checkout_form',
					type: 'POST',
					data: {
						checkout_form_na_user: 1,												
						co_address: co_address,								
						co_city: co_city,								
						co_postal_code: co_postal_code,								
						co_country: co_country,								
						co_phone_num: co_phone_num,
						co_remark: co_remark							
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);					

						if (resp.co_address_err) {
							$('#co_address').removeClass("is-valid").addClass("is-invalid");
							$('#co_address_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_address_msg').html(resp.co_address_err);
						} else if(resp.co_address_ok) {
							$('#co_address').removeClass("is-invalid").addClass("is-valid");
							$('#co_address_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_address_msg').html(resp.co_address_ok);
						}

						if (resp.co_city_err) {
							$('#co_city').removeClass("is-valid").addClass("is-invalid");
							$('#co_city_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_city_msg').html(resp.co_city_err);
						} else if(resp.co_city_ok) {
							$('#co_city').removeClass("is-invalid").addClass("is-valid");
							$('#co_city_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_city_msg').html(resp.co_city_ok);
						}
						
						if (resp.co_postal_code_err) {
							$('#co_postal_code').removeClass("is-valid").addClass("is-invalid");
							$('#co_postal_code_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_postal_code_msg').html(resp.co_postal_code_err);
						} else if(resp.co_postal_code_ok) {
							$('#co_postal_code').removeClass("is-invalid").addClass("is-valid");
							$('#co_postal_code_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_postal_code_msg').html(resp.co_postal_code_ok);
						}

						if (resp.co_country_err) {
							$('#co_country').removeClass("is-valid").addClass("is-invalid");
							$('#co_country_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_country_msg').html(resp.co_country_err);
						} else if(resp.co_country_ok) {
							$('#co_country').removeClass("is-invalid").addClass("is-valid");
							$('#co_country_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_country_msg').html(resp.co_country_ok);
						}

						if (resp.co_phone_num_err) {
							$('#co_phone_num').removeClass("is-valid").addClass("is-invalid");
							$('#co_phone_num_msg').removeClass("valid-feedback").addClass("invalid-feedback");
							$('#co_phone_num_msg').html(resp.co_phone_num_err);
						} else if(resp.co_phone_num_ok) {
							$('#co_phone_num').removeClass("is-invalid").addClass("is-valid");
							$('#co_phone_num_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#co_phone_num_msg').html(resp.co_phone_num_ok);
						}

						if (resp.cart_processed) {
							$(window).scrollTop(0);
							$('#cart_icon').remove();
							$('#cart_resp').removeClass('d-none');
							$('#cart_resp_msg').html(resp.cart_processed);
							$('.frame').remove();
						}
									
					},
					dataType: 'text'
				});
			});
		});
	</script>
<?php require APPROOT . "/views/inc/footer.php"; ?>