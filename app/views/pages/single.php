<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/navbar.php" ?>
	 <div class="full_details">
	 	<div class="row">
	 		<div class="col-sm-6">

	 			<?php						
	 				if (isset($_SERVER['HTTP_REFERER'])) {
		 				$breadcrumb = explode('/', $_SERVER['HTTP_REFERER']);
		 				$crumb_count = count($breadcrumb) - 1;	 				
		 				if ($breadcrumb[$crumb_count] == 'boutique') {
		 					$link = "http://localhost/vinyl/boutique";
		 					$link_name = 'BOUTIQUE';
		 				} elseif($breadcrumb[$crumb_count] == 'checkout'){
		 					$link = "http://localhost/vinyl/boutique/checkout";
		 					$link_name = 'CHECKOUT';
		 				} elseif($breadcrumb[$crumb_count] == 'types?type=LP' || $breadcrumb[$crumb_count] == 'types?type=EP' || $breadcrumb[$crumb_count] == 'types?type=7' || $breadcrumb[$crumb_count] == 'types?type=10' || $breadcrumb[$crumb_count] == 'types?type=12' || $breadcrumb[$crumb_count] == 'types?type=45RPM' || $breadcrumb[$crumb_count] == 'types?type=78RPM'){
		 					$exp = explode('=', $breadcrumb[$crumb_count]);
		 					$link = 'http://localhost/vinyl/boutique/types?type='.$exp[1].'';
		 					$link_name = $exp[1];
		 				} else {
		 					$link = "http://localhost/vinyl";
		 					$link_name = 'HOME';
		 				}	 					
	 				} else {
	 					$link = "http://localhost/vinyl";
	 					$link_name = 'HOME';
	 				}
	 			?>
	 			<a href="<?php echo $link; ?>"><span><?php echo $link_name; ?></span></a><span>/</span><a href="http://localhost/vinyl/pages/single?id=<?php echo $data['product_info']->id; ?>"><span><?php echo strtoupper($data['product_info']->title); ?></span></a>
	 		</div>
	 		<div class="col-sm-6">
	 			<a id="previous_<?php echo $data['product_info']->id; ?>" class="nav_arr_prev"><span><i class="fas fa-angle-left"></i>&nbsp;PREV&nbsp;</span></a><span>&nbsp;|&nbsp;</span><a id="next_<?php echo $data['product_info']->id; ?>" class="nav_arr_next"><span>&nbsp;NEXT&nbsp;<i class="fas fa-angle-right"></i></span></a> 			
	 		</div>
	 	</div>
	 	<div class="row pt-5">
	 		<div class="col">
	 			<div class="row">
	 				<div class="col-sm-2">
	 					
	 				</div>
					<div class="col-sm-4 product">
	 				<?php
	 					if($data['product_info']->on_sale == 'yes'){
	 						foreach ($data['sales'] as $value) {
	 							if ($data['product_info']->id == $value['id_album']) {
			 						?>	
					 					<div class="ribbon"><span>SALE&nbsp;<?php echo $value['precentage']; ?>%</span></div> 						
			 						<?php	 								
	 							}
	 						}
	 					}
	 				?>
		 				<img src="<?php echo $data['product_info']->img_url; ?>">
	 					
	 				</div>
	 				<div class="col-sm-2">
	 					
	 				</div>
	 			</div>
	 		</div>
	 	</div>
	 	<div class="row"> 		
			<div class="col-sm-6 description">
				<h2><?php echo $data['product_info']->title; ?><br> by <?php echo  $data['product_info']->artist; ?></h2>
				<h4>ID: <?php echo $data['product_info']->id; ?></h4>
				<br>
				<h5>Genre:</h5>
				<ul class="list-group s_p_lists">
					<?php
						$genres = explode(',', $data['product_genre']->genre_name);
						foreach ($genres as $value) {
							echo "<li class='list-group-item list-group-item-dark'>".$value."</li>";
						}
					?>
				</ul>
				<br><br>
				<h5>Type:</h5>
				<ul class="list-group s_p_lists">					
					<li class='list-group-item list-group-item-dark'><?php echo $data['product_info']->type; ?></li>					
				</ul>
				<br><br>
				<h4>Release Date: <?php echo $data['product_info']->date_released; ?></h4>
				<br><br>
				<?php echo mysqli_echo($data['product_info']->description); ?>
				<br><br>
			</div>
	 		<div class="col-sm-6 cost">
	 			<h2><?php echo alternative_money($data['product_info']->price);	?></h2>
	 			<br>
	 			<div class="form-group">
					<label for="quantity"><h4>Quantity: </h4></label>
					<input class="form-control col-sm-2" type="text"  name="<?php echo $data['product_info']->id; ?>" id="single_quantity" placeholder="1" maxlength="2">
					<span id="quantity_msg" class="hidden"></span>	
				</div>
				<div class="form-group">
					<button type="button" class="btn cart_add" id="single_btn"><span>ADD TO CART</span></button>
				</div>
				<div class="row">
					<div class="col-sm">
						<p>Available items: <?php echo $data['product_info']->inventory_presented; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<br>
						<h5>Track List:</h5>
						<ul class="list-group s_p_lists">
							<?php
								$songs = explode(',', $data['product_info']->song_titles);
								foreach ($songs as $value) {
									echo "<li class='list-group-item list-group-item-dark'>".$value."</li>";
								}
							?>
						</ul>
					</div>
				</div>
	 		</div> 			
	 	</div>
	 </div>
	<script type="text/javascript">
		$(document).ready(function(){
			var nav_arrow = $("a[class = 'nav_arr_prev']").siblings();
			jQuery.each(nav_arrow.prevObject, function(key,value){
				var nav_id = nav_arrow.prevObject[key].id;
				console.log(nav_id);						
					$('#'+nav_id).on('mouseover', function(){
									
						console.log(nav_id);
						$.ajax({
							url: 'http://localhost/vinyl/pages/page_selector',
							type: 'POST',
							data: {
								pg_slc: 1,
								nav_id: nav_id	
							},
							success: function(response){
								var resp = JSON.parse(response);
								console.log(resp);
								if (resp.id) {
									$('#'+nav_id).attr('href', "http://localhost/vinyl/pages/single?id="+resp.id);
								}								
							},
							dataType: 'text'
						});
					});	

			});

			var nav_arrow = $("a[class = 'nav_arr_next']").siblings();
			jQuery.each(nav_arrow.prevObject, function(key,value){
				var nav_id = nav_arrow.prevObject[key].id;			
					$('#'+nav_id).on('mouseover', function(){
						
						console.log(nav_id);
						$.ajax({
							url: 'http://localhost/vinyl/pages/page_selector',
							type: 'POST',
							data: {
								pg_slc: 1,
								nav_id: nav_id	
							},
							success: function(response){
								var resp = JSON.parse(response);
								console.log(resp);
								if (resp.id) {
									$('#'+nav_id).attr('href', "http://localhost/vinyl/pages/single?id="+resp.id);
								}

								
								
							},
							dataType: 'text'
						});
					});	

			});

			$('#single_btn').on('click', function(){
				var quantity = $('#single_quantity').val();
				var name = $('#single_quantity').attr('name');

				$.ajax({
					url: 'http://localhost/vinyl/orders/cart',
					type: 'POST',
					data: {
						single_cart: 1,
						single_quantity: quantity,
						single_id: name
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.single_quantity_err) {
							$('#single_quantity').removeClass("is-valid").addClass("is-invalid");
 							$('#quantity_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#quantity_msg').html(resp.single_quantity_err);
 						} else {
 							$('#single_quantity').removeClass("is-invalid");
 							$('#quantity_msg').empty();
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
	</script>

<?php require APPROOT . "/views/inc/footer.php" ?>