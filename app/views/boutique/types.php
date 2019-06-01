<?php require APPROOT . "/views/inc/header.php"; ?>
<?php require APPROOT . "/views/inc/navbar.php"; ?>
	<div class="boutique">
		<main>
			<div class="row">
				<div class="col">
					<h1>NEW ARRIVALS</h1>
				</div>			
			</div>
			<div class="row">
				<div class="col">
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
											<div class="col-sm-4 p-0 box">
												<a href="http://localhost/vinyl/pages/single?id=<?php echo $data['populate_slider'][$i]['id']; ?>">
													<img class="d-block w-100 image" src="<?php echo $data['populate_slider'][$i]['img_url']; ?>">
												</a>
												<a href="#details" data-toggle="modal" data-target="#<?php echo $data['populate_slider'][$i]['id']; ?>">
													<div class="overlay">
														<div class="text"><span>QUICK VIEW</span></div>
													</div>	
												</a>
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
											<div class="col-sm-4 p-0 box">
												<a href="http://localhost/vinyl/pages/single?id=<?php echo $data['populate_slider'][$i]['id']; ?>">
													<img class="d-block w-100 image" src="<?php echo $data['populate_slider'][$i]['img_url']; ?>">
												</a>
												<a href="#details" data-toggle="modal" data-target="#<?php echo $data['populate_slider'][$i]['id']; ?>">
													<div class="overlay">
														<div class="text"><span>QUICK VIEW</span></div>
													</div>	
												</a>
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
											<div class="col-sm-4 p-0 box">
												<a href="http://localhost/vinyl/pages/single?id=<?php echo $data['populate_slider'][$i]['id']; ?>">
													<img class="d-block w-100 image" src="<?php echo $data['populate_slider'][$i]['img_url']; ?>">
												</a>
												<a href="#details" data-toggle="modal" data-target="#<?php echo $data['populate_slider'][$i]['id']; ?>">
													<div class="overlay">
														<div class="text"><span>QUICK VIEW</span></div>
													</div>	
												</a>
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
			</div>
			<div id="modal_app">
				<?php
					foreach ($data['get_all_prod'] as $value) {
						?>
							<div class="modal fade specModal" id="<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="show_detailsTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">			      
										<div class="modal-body">
											<div class="container-fluid">
												<div class="row">
													<div class="col-sm-7 popup_item">
														<img class="mod_img" src="<?php echo $value['img_url']; ?>">
													</div>
													<div class="col-sm-5 popup_item">
														<div class="row">
															<div class="col header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
																<h1><?php echo $value['title']; ?></h1>
																<h3><?php echo $value['id']; ?></h3><br>
																<h3><?php echo alternative_money($value['price']); ?>&nbsp;<span><sup><a href="http://localhost/vinyl/pages/single?id=<?php echo $value['id']; ?>">view full details</a></sup></span></h3>		
															</div>			        				
														</div>
														<div class="row">
															<div class="col footer">
																<form>
																	<div class="form-group">
																		<label for="quantity"><span>Quantity:</span></label>
																		<input class="form-control col-sm-3" type="text" name="<?php echo $value['id']; ?>" id="modal_quantity_<?php echo $value['id']; ?>"; maxlength="2">
																		<span id="quantity_msg_<?php echo $value['id']; ?>" class="hidden"></span>	
																	</div>
																	<div class="form-group">
																		<button type="button" class="btn btn-primary popup_btn" id="modal_btn_<?php echo $value['id']; ?>">Submit</button>					
																	</div>
																	<div class="form-group">
																		<p>Available items: <?php echo $value['inventory_presented']; ?></p>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>		        	
										</div>	      
									</div>
								</div>
							</div>
						<?php
					}
				?>				
			</div>
			<div class="row">
				<div class="col divider">
					<h1 class="divider-h">ALL RECORDS</h1>
				</div>
			</div>
			<div class="row" id="album_list">
				<?php					
					foreach ($data['get_all_prod'] as $key => $value) {
						?>
							<div class="col-sm-4 ar">						
								<div class="row">
									<div class="col ar_up">
										<?php 
											if ($value['on_sale'] == 'yes') {
												?>
													<div class="ribbon"><span>SALE&nbsp;<?php 

														foreach ($data['sales'] as $sales) {
															if ($sales['id_album'] == $value['id']) {
																echo $sales['precentage'];
															}
														}

													 ?>%</span></div>
												<?php
											}
										 ?>
										<a href="http://localhost/vinyl/pages/single?id=<?php echo $value['id']; ?>">
											<img src="<?php echo $value['img_url']; ?>">
										</a>
										<a href="#details" data-toggle="modal" data-target="#<?php echo $value['id']; ?>">
											<div class="overlay">
												<div class="text"><span>QUICK VIEW</span></div>
											</div>	
										</a>
									</div>
								</div>										
								<div class="row">
									<a href="http://localhost/vinyl/pages/single?id=<?php echo $value['id']; ?>">
										<div class="col ar_down">									
											<h1><?php echo $value['title']; ?></h1>
											<h3><?php echo alternative_money($value['price']); ?></h3>		
										</div>
									</a>
								</div>	
							</div>
						<?php
					}
					$div = count($data['get_all_prod']);
					if ($div % 3 == 1) {
						?>
							<div class="col-sm-4 ar">
								
							</div>
							<div class="col-sm-4 ar">
								
							</div>
						<?php
					} elseif ($div % 3 == 2){
						?>
							<div class="col-sm-4 ar">
								
							</div>							
						<?php
					}											
				?>
			</div>							
		</main>
	</div>
	
	<script type="text/javascript">
			$(document).ready(function(){
				var mod = $(".specModal").siblings();
				jQuery.each(mod.prevObject, function(key, value){
					var mod_id = mod.prevObject[key].id;
					
					
					$('#'+mod_id).on('shown.bs.modal', function (e) {
					  $('#modal_btn_'+mod_id).on('click', function(){
					  	var modal_quantity = $('#modal_quantity_'+mod_id).val();
					  	var modal_name = $('#modal_quantity_'+mod_id).attr('name');
					  	
					  	$.ajax({
							url: 'http://localhost/vinyl/orders/cart',
							type: 'POST',
							data: {
								single_cart: 1,
								single_quantity: modal_quantity,
								single_id: modal_name
							},
							success: function(response){
								var resp = JSON.parse(response);
							

								if (resp.single_quantity_err) {
									$('#modal_quantity_'+mod_id).removeClass("is-valid").addClass("is-invalid");
		 							$('#quantity_msg_'+mod_id).removeClass("valid-feedback").addClass("invalid-feedback");
		 							$('#quantity_msg_'+mod_id).html(resp.single_quantity_err);
		 						} else {
	 								$('#modal_quantity_'+mod_id).removeClass("is-invalid");
		 							$('#quantity_msg_'+mod_id).empty();
		 							$('#'+mod_id).modal('hide');
		 						}	

		 						if (resp.cart_info) {
		 							var html = '';
		 							jQuery.each(resp.cart_info, function(key, value){
	 								var counter = key + 1;
									$('#cart_body').empty();	 							
								
									html += "<tr><td>"+counter+"</td><td>"+value.product_title+"</td><td>"+value.unit_price+"</td><td>"+value.quantity+"</td><td>"+value.price+"</td><td><button type='button' class='btn btn-dark remove_btn' id='rmv_btn_"+value.id+"'>remove</button></td></tr>";				
	 								
	 								});										
									$('#cart_body').html(html);
 								} 

		 						if (resp.cart_total) {
		 							var cart_total = "<tr><th>Total:</th><th></th><th></th><th></th><th id='total'>$&nbsp;"+resp.cart_total+"</th><th></th></tr>";
		 							$('#cart_foot').html(cart_total);
		 						}	

		 						if (resp.cart_counter) {
		 							$('#cart_count').html(resp.cart_counter);
		 						}						
							},
							dataType: 'text'
						});
					  });
					});					
				});				
			});
	</script>
<?php require APPROOT . "/views/inc/footer.php"; ?>
