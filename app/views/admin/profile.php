<?php require APPROOT . "/views/inc/header.php"; ?>
<?php require APPROOT . "/views/inc/navbar.php"; ?>
	<div class="admin_page">
		<div class="row">
			<div class="col-sm-2">
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
				<div class="row d-none" id="info_al_div">
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
			<div class="col-sm-2">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" id="v-pills-Dashboard-tab" data-toggle="pill" href="#v-pills-Dashboard" role="tab" aria-controls="v-pills-Dashboard" aria-selected="true">Dashboard</a>
					<a class="nav-link" id="v-pills-Mailbox-tab" data-toggle="pill" href="#v-pills-Mailbox" role="tab" aria-controls="v-pills-Mailbox" aria-selected="false">Mailbox</a>
					<a class="nav-link" id="v-pills-products-tab" data-toggle="pill" href="#v-pills-products" role="tab" aria-controls="v-pills-products" aria-selected="false">Products control panel</a>		
				</div>
			</div>
			<div class="col-sm-10">
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="v-pills-Dashboard" role="tabpanel" aria-labelledby="v-pills-Dashboard-tab">
						<div class="row">
							<div class="col-sm inner_nav">
								<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active text-center" id="pills-prod_overview-tab" data-toggle="pill" href="#pills-prod_overview" role="tab" aria-controls="pills-prod_overview" aria-selected="true">Product Overview</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-center" id="pills-users_overview-tab" data-toggle="pill" href="#pills-users_overview" role="tab" aria-controls="pills-users_overview" aria-selected="false">Users Overview</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-center" id="pills-sale_info-tab" data-toggle="pill" href="#pills-sale_info" role="tab" aria-controls="pills-sale_info" aria-selected="false">Sale Information</a>
									</li>
								</ul>
								<div class="tab-content" id="pills-tabContent">
									<div class="tab-pane fade show active" id="pills-prod_overview" role="tabpanel" aria-labelledby="pills-prod_overview-tab">
										<div class="row">
											<div class="col-sm table-responsive">
												<table class="table table-hover mt-3 product_overview">
													<thead>
														<tr>
															<th>#</th>
															<th>ID</th>
															<th>Title</th>
															<th>Inv. Total</th>
															<th>Inv. Presented</th>
															<th>On Sale</th>
															<th>Sale Expires</th>															
															<th>Price</th>
															<th>Date Created</th>															
														</tr>
													</thead>
													<tbody>
														<?php
															foreach ($data['all_products'] as $key => $value) {
																$counter = $key + 1;
																?>
																	<tr>
																		<td><?php echo $counter; ?></td>
																		<td><?php echo $value['id']; ?></td>
																		<td><?php echo $value['title']; ?></td>
																		<td><?php
																			if ($value['inventory_total'] < 5) {
																				?>
																					<i class="fas fa-exclamation-triangle" style="color: red;"></i>&nbsp;<?php echo $value['inventory_total'];?>
																				<?php
																			} elseif ($value['inventory_total'] > 5 && $value['inventory_total'] < 10){
																				?>
																					<i class="fas fa-exclamation-triangle" style="color: yellow;"></i>&nbsp;<?php echo $value['inventory_total'];?>
																				<?php
																			} else {
																				?>
																					<?php echo $value['inventory_total'];?>
																				<?php
																			}
																		

																		 ?></td>
																		<td><?php echo $value['inventory_presented']; ?></td>
																		<td><?php
																			if ($value['on_sale'] == 'yes') {
																				?>
																					<i class="far fa-check-square" style="color: green;"></i>&nbsp;
																					<?php
																						foreach ($data['get_sales'] as $sale) {
																							if ($sale['id_album'] == $value['id']) {
																								echo $sale['precentage'] . '%';											
																							}
																						}														
																					
																			} elseif ($value['on_sale'] == 'no') {
																				?>
																					<i class="far fa-times-circle" style="color: red;"></i>
																				<?php
																			}
																		  ?>
																		</td>
																		<td>
																			<?php
																				foreach ($data['get_sales'] as $time) {
																					if ($time['id_album'] == $value['id']) {
																						if ($time['id_album'] == $value['id']){
																							?>
																								 <p style="font-size: .7em; margin: 0;">
																								 	<?php
																								 		$start = intval($time['starting_point']);
																								 		$duration = intval($time['duration']);
																								 		$now = time();
																								 		$remaining = ($start + $duration) - $now;
																									  echo secondsToTime($remaining); 
																									?>														  	
																								  </p>
																							<?php
																						}
																					}
																				}
																			?>
																		</td>															
																		<td><?php echo $value['price']; ?></td>
																		<td><?php echo $value['date_created']; ?></td>															
																	</tr>
																<?php
															}

														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="pills-users_overview" role="tabpanel" aria-labelledby="pills-users_overview-tab">
										<div class="row" >
											<div class="col-sm table-responsive">
												<div class="row d-none" id="err_serv">
													<div class="col-sm">
														<div class="alert alert-danger err_serv text-center" role="alert">
														  
														</div>
													</div>
												</div>
												<table class="table table-hover mt-3 product_overview">
													<thead>
														<tr>
															<th>#</th>
															<th></th>
															<th>ID</th>
															<th></th>
															<th>Image</th>
															<th>First Name</th>
															<th>Last Name</th>
															<th>Username</th>
															<th>Email</th>
															<th>Address</th>
															<th>Permission</th>
															<th>Change Permission</th>
															<th>Online</th>
															<th>Create Date</th>															
														</tr>
													</thead>
													<tbody>
														<?php
															foreach ($data['get_users'] as $key => $value) {
																$counter = $key + 1;
																?>
																	<tr>
																		<td colspan="2"><?php echo $counter; ?></td>
																		
																		<td colspan="2"><?php echo $value->id; ?></td>
																		
																		<td class="tbl_img"><img src="<?php echo $value->img_url; ?>"></td>
																		<td><?php echo $value->first_name; ?></td>
																		<td><?php echo $value->last_name; ?></td>
																		<td><?php echo $value->username; ?></td>
																		<td><?php echo $value->email; ?></td>
																		<td><?php echo $value->address1; ?></td>
																		<td id="per_cell_<?php echo $value->id; ?>">
																			<?php echo $value->permission; ?>														
																		</td>
																		<td>
																			<div class="form-group">
																				<select class="form-control form-control-sm" id="per_sel_<?php echo $value->id; ?>">
																					<option value="/">New permission</option>
																					<option value="admin">Admin</option>
																					<option value="regular">Regular</option>
																				</select>																				
																			</div>
																			<div class="form-group">
																				<button type="button" class="btn btn-secondary btn-block spec_per_btn" id="per_btn_<?php echo $value->id; ?>" >Change</button>						
																			</div>
																		</td>
																		<td>
																			<?php 
																				if ($value->active == 1) {
																					?>
																						<i class="fas fa-circle" style="color: green;"></i>
																					<?php
																				} elseif ($value->active == 0){
																					?>
																						<i class="fas fa-circle" style="color: red;"></i>
																					<?php
																				}
																			?>
																				
																		</td>
																		<td><?php echo $value->create_date; ?></td>
																	</tr>
																<?php
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="pills-sale_info" role="tabpanel" aria-labelledby="pills-sale_info-tab">
										<div class="row p-2">
											<?php
											    $sum_items = 0;
											    $revenue = 0;											   
												foreach ($data['all_products'] as $key => $value) {
													$sum_items += intval($value['items_sold']);
													$revenue += floatval($value['items_sold']) * floatval($value['price']); 
												}												
											?>
											<div class="col-sm p-3 m-4 best_sell_frame">
												<h4>Sales overview</h4>
												<br>
												<h5>Items sold sum: <?php echo $sum_items; ?></h3>
												<h5>Revenue: <?php echo alternative_money($revenue); ?></h5>
											</div>
										</div>
										<div class="row">
											<div class="col-sm p-5" id="sale_info">												
												
											</div>												
										</div>										
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="v-pills-Mailbox" role="tabpanel" aria-labelledby="v-pills-Mailbox-tab">
						<div class="row">
							<div class="col-sm inner_nav">
								<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
									<li class="nav-item">										
										<a class="nav-link active text-center" id="pills-inbox-tab" data-toggle="pill" href="#pills-inbox" role="tab" aria-controls="pills-inbox" aria-selected="true"><i class="fas fa-inbox"></i>&nbsp;Inbox</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-center" id="pills-sent-tab" data-toggle="pill" href="#pills-sent" role="tab" aria-controls="pills-sent" aria-selected="false"><i class="fas fa-envelope"></i>&nbsp;Sent</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-center" id="pills-create_new-tab" data-toggle="pill" href="#pills-create_new" role="tab" aria-controls="pills-create_new" aria-selected="false"><i class="fas fa-comment"></i>&nbsp;Create New</a>
									</li>
								</ul>
								<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-inbox" role="tabpanel" aria-labelledby="pills-inbox-tab">
									<div class="row">
										<div class="col-sm p-5">
											<div class="row msg_inbox_head">
												<div class="col-sm-1 text-center p-2">
													<h6 class="m-0">Status</h6>
												</div>
												<div class="col-sm-1 p-2">
													<h6 class="m-0">Name</h6>
												</div>
												<div class="col-sm-2 p-2">
													<h6 class="m-0">Email</h6>
												</div>
												<div class="col-sm-5 p-2">
													<h6 class="m-0">Subject / Message</h6>
												</div>
												<div class="col-sm-2 p-2">
													<h6 class="m-0">Date</h6>
												</div>	
												<div class="col-sm-1 p-2 text-center">
													<h6>Remove</h6>
												</div>											
											</div>
											<?php
												foreach ($data['get_mail'] as $value) {
													if ($value['source'] == 'inbox') {
														?>
															<div class="row msg_inbox msg_inbox_hide_<?php echo $value['id'];?>" id="msg_inbox_show_<?php echo $value['id'];?>">
																<div class="col-sm-1 p-2 pt-3 text-center mail_icon_<?php echo $value['id'];?>">
																	<?php
																		if ($value['viewed'] == 0) {
																			?>
																				<i class="far fa-envelope fa-2x" style="color: white;"></i>
																			<?php
																		} else {
																			?>
																				<i class="far fa-envelope-open fa-2x" style="color: white;"></i>
																			<?php
																		}
																	?>
																</div>
																<div class="col-sm-1 p-2 pt-3">
																	<p class="m-0 p-1"><?php echo $value['name']; ?></p>
																</div>
																<div class="col-sm-2 p-2 pt-3">
																	<p class="m-0 p-1"><?php echo $value['email']; ?></p>
																</div>
																<div class="col-sm-5 p-2 pt-3">
																	<p class="m-0 p-1"><?php echo $value['subject']; ?> - <em class="msg_body"><?php echo shorten_text($value['message'], 60); ?></em></p>
																</div>
																<div class="col-sm-2 p-2 pt-3">
																	<p class="m-0 p-1"><?php echo $value['create_date']; ?></p>
																</div>
																<div class="col-sm-1 p-2 pt-3 text-center">
																	<i class="fas fa-trash fa-2x rmv_mail_btn"  style="color: white;" id="rmv_mail_btn_<?php echo $value['id']; ?>"></i>
																</div>
															</div>
															<div class="row msg_body" id="msg_body_<?php echo $value['id']; ?>" style="display: none;">
																<div class="col-sm p-3 msg_txt mb-2">
																	<p><?php echo $value['message']; ?></p>
																</div>
															</div>
														<?php													
													}
												}
											?>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-sent" role="tabpanel" aria-labelledby="pills-sent-tab">
									<div class="row">
										<div class="col-sm p-5">
											<div class="row msg_inbox_head">
												<div class="col-sm-1 text-center p-2">
													<h6 class="m-0">Status</h6>
												</div>
												<div class="col-sm-1 p-2">
													<h6 class="m-0">From</h6>
												</div>
												<div class="col-sm-2 p-2">
													<h6 class="m-0">To</h6>
												</div>
												<div class="col-sm-5 p-2">
													<h6 class="m-0">Subject / Message</h6>
												</div>
												<div class="col-sm-2 p-2">
													<h6 class="m-0">Date</h6>
												</div>	
												<div class="col-sm-1 p-2 text-center">
													<h6 class="m-0">Remove</h6>
												</div>											
											</div>
											<?php
												foreach ($data['get_sent_mail'] as $value) {
													if ($value['source'] == 'outbox') {
														?>
															<div class="row msg_outbox" id="msg_outbox_show_<?php echo $value['id'];?>">
																<div class="col-sm-1 p-2 pt-3 text-center">
																	<i class="fas fa-envelope-square fa-2x" style="color: white;"></i>
																</div>
																<div class="col-sm-1 p-2 pt-3">
																	<p class="m-0 p-1"><?php echo $value['name']; ?></p>
																</div>
																<div class="col-sm-2 p-2 pt-3">
																	<p class="m-0 p-1"><?php echo $value['email']; ?></p>
																</div>
																<div class="col-sm-5 p-2 pt-3">
																	<p class="m-0 p-1"><?php echo $value['subject']; ?> - <em class="msg_body"><?php echo shorten_text($value['message'], 60); ?></em></p>
																</div>
																<div class="col-sm-2 p-2 pt-3">
																	<p class="m-0 p-1"><?php echo $value['create_date']; ?></p>
																</div>
																<div class="col-sm-1 p-2 pt-3 text-center">
																	<i class="fas fa-trash fa-2x rmv_mail_btn"  style="color: white;" id="rmv_mail_btn_<?php echo $value['id']; ?>"></i>
																</div>
															</div>
															<div class="row msg_body" id="msg_bodyo_<?php echo $value['id']; ?>" style="display: none;">
																<div class="col-sm p-3 msg_txt mb-2">
																	<p><?php echo $value['message']; ?></p>
																</div>
															</div>
														<?php													
													}
												}
											?>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-create_new" role="tabpanel" aria-labelledby="pills-create_new-tab">
									<div class="row p-5">
										<div class="col-sm mailing_form text-center">
											<h1 class="pt-3">SEND NEW EMAIL</h1>
											<div class="alert alert-success d-none" role="alert" id="new_mail_msg">
											 
											</div>
											<form class="m-5">
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="to_mail_new" placeholder="To">
													<span id="to_mail_new_msg"></span>
												</div>
												<div class="form-group">
													<input class="form-control form-control-sm" type="text" id="subj_mail_new" placeholder="Subject">
													<span id="subj_mail_new_msg"></span>
												</div>
												<div class="form-group">
													<textarea class="tinymce form-control form-control-sm" id="body_mail_new"></textarea>
												</div>
												<div class="form-group">
													<input type="button" value="SEND" class="form-control form-control-sm log_reg_btn" id="btn_mail_new">
												</div>
											</form>
										</div>
									</div>
								</div>
								</div>
							</div>							
						</div>
					</div>
					<div class="tab-pane fade" id="v-pills-products" role="tabpanel" aria-labelledby="v-pills-products-tab">
						<div class="row">
							<div class="col-sm-6">
								<div class="row">
									<div class="col-sm inner_nav">
										<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
											<li class="nav-item">
												<a class="text-center nav-link active" id="pills-insert_update-tab" data-toggle="pill" href="#pills-insert_update" role="tab" aria-controls="pills-insert_update" aria-selected="true">Insert / Update Product</a>
											</li>
											<li class="nav-item">
												<a class="text-center nav-link" id="pills-remove_product-tab" data-toggle="pill" href="#pills-remove_product" role="tab" aria-controls="pills-remove_product" aria-selected="false">Remove Product</a>
											</li>
											<li class="nav-item">
												<a class="text-center nav-link" id="pills-artist_ctrl-tab" data-toggle="pill" href="#pills-artist_ctrl" role="tab" aria-controls="pills-artist_ctrl" aria-selected="false">Add/Remove Artist</a>
											</li>									
										</ul>
										<div class="tab-content" id="pills-tabContent">
											<div class="tab-pane fade show active" id="pills-insert_update" role="tabpanel" aria-labelledby="pills-insert_update-tab">
												<div class="row">
													<div class="col-sm p-5">
														<h3 class="text-center">Insert new or Update old Products</h3>
														<form enctype="multipart/form-data">
															<div class="form-group">
																<select class="form-control form-control-sm" id="action_select">
																	<option value="/">SELECT ACTION*</option>
																	<option value="insert">Insert a new Product</option>
																	<option value="update">Update Product</option>
																</select>
															</div>
														</form>														
														<div id="insert_toggle" class="hidden">												
															<div class="row hidden" id="server_err">
																<div class="col-sm">
																	<div class="" role="alert" id="server_err_msg">
															    		
																	</div>
																</div>
															</div>
															<div class="card mb-4 important_notice" id="scrool">
																<div class="card-body">
																	<h5 class="card-title">Important notice</h5>
																	<p class="card-text">Please make sure that the artist for the product you are inserting already exists.<br>If you proceede anyway than you should consider updating artist information as this way you only inserted their name.</p>			
																</div>
															</div>														
															<form novalidate id="clear_form">
																<div class="form-group">
																	<input type="text" name="ins_title" placeholder="Title *" class="form-control form-control-sm" id="ins_title">
																	<span id="ins_title_msg"></span>
																</div>
																<div class="form-group">
																	<input type="text" name="ins_artist" placeholder="Artist*" class="form-control form-control-sm" id="ins_artist">
																	<span id="ins_artist_msg"></span>
																</div>
																<div class="form-group">
																	<label for="description" class="boutique_form">Album Description:</label>
																	<textarea class="form-control form-control-sm tinymce" id="ins_description" name="ins_description"></textarea>
																</div>															
																<div class="form-group">
																	<div class="row">																
																		<div class="col-sm">
																			<div class="form-group">
																				<div class="input-group">
																					<div class="input-group-prepend">
																						<button class="btn btn-outline-secondary" type="button" name="ins_add_song" id="ins_add_song">Add song</button>												
																					</div>
																					<input type="text" class="form-control" placeholder="Add song name" id="ins_song_name" name="ins_song_name">
																					<span id="ins_song_name_msg"></span>	
																				</div>												
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm">
																			<ol class="list-group" id="songs">
																				
																			</ol>
																			
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<div class="row">
																		<div class="col-sm-6">
																			<div class="form-group">
																				<select class="form-control form-control-sm" id="ins_single" name="ins_single">
																					<option value="/">Is it a single?</option>
																					<?php
																						foreach ($data['single'] as $value) {
																							?><option value="<?php echo $value; ?>"><?php
																							echo $value;
																							?></option><?php
																						}
																					?>	
																				</select>
																				<span id="ins_single_msg"></span>
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group">											
																				<select class="form-control form-control-sm" id="ins_type" name="ins_type">
																					<option value="/">What type is it?</option>
																					<?php
																						foreach ($data['types'] as $value) {
																							?><option value="<?php echo $value; ?>"><?php
																							echo $value;
																							?></option><?php
																						}
																					?>																				
																				</select>
																				<span id="ins_type_msg"></span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<div class="row">
																		<div class="col-sm">
																			<div class="form-group">
																				<div class="input-group">
																					<div class="input-group-prepend">
																						<button class="btn btn-outline-secondary" type="button" name="ins_add_genre" id="ins_add_genre">Add genre</button>
																					</div>
																					<select class="custom-select" id="ins_select_genre" name="ins_select_genre">
																						<option value="/">Select genre</option>							
																							<?php
																								foreach ($data['genres'] as $value) {
																									?><option value="<?php echo $value['genre']; ?>"><?php
																									echo $value['genre'];
																									?></option><?php
																								}
																							?>
																						</option>
																					</select>
																					<span id="ins_select_genre_msg"></span>												
																				</div>																			
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm">
																			<ul class="list-group" id="genre">
																				
																			</ul>		
																		</div>
																	</div>																
																</div>
																<div class="form-group">
																	<label class="boutique_form">Release Date*</label>
																	<input class="form-control form-control-sm" type="date" name="ins_date_released" id="ins_date_released">
																	<span id="ins_date_released_msg"></span>
																</div>
																<div class="form-group">
																	<div class="row">
																		<div class="col-sm">
																			<div class="input-group mb-3">							
																				<div class="custom-file">
																					<input type="file" class="custom-file-input" id="ins_img" name="ins_img">
																					<label class="custom-file-label" for="inputGroupFile03" id="disp_img_name">Choose file</label>
																				</div>
																			</div>											
																		</div>																					
																	</div>
																	<div class="row">
																		<div class="col-sm">
																			<img src="" id="display_img">														
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<div class="row">
																		<div class="col-sm-6">
																			<div class="form-group">
																				<input class="form-control form-control-sm" type="text" name="ins_inventory_amount" placeholder="Inventory Amount*" id="ins_inventory_amount">
																				<span id="ins_inventory_amount_msg"></span>
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group">
																				<input class="form-control form-control-sm" type="text" name="ins_price" placeholder="Price*" id="ins_price">
																				<span id="ins_price_msg"></span>
																			</div>
																		</div>
																	</div>
																</div>	
																<div class="form-group">
																	<input class="form-control form-control-sm log_reg_btn" type="button" value="Submit" id="insert_product">
																</div>
															</form>
														</div>
														<div id="update_toggle" class="hidden">
															<div class="card mb-4 important_notice">
																<div class="card-body">
																	<h5 class="card-title">Important notice</h5>
																	<p class="card-text">You can search for the product you want to update 
																		by the Product Title.<br>Use the suggestion provided by your search to find the correct product.</p>			
																</div>
															</div>														
															<form>
																<div class="form-group">
																	<div class="row">
																		<div class="col-sm">
																			<div class="form-group">
																				<input class="form-control form-control-sm" type="text" name="product_search_upd" placeholder="Search by Product Title" id="product_search_upd">									
																			</div>															
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm">
																			<div class="row mt-3">
																				<div class="col-sm">
																					<p id="search_none" class="hidden"></p>
																					<table class="table table-hover table-sm table-dark hidden" id="search_table">					
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																	<div class="row hidden" id="upd_form">
																		<div class="col-sm">																		
																			<div class="form-group">
																				<div class="row">
																					<div class="col-sm">
																						<div class="form-group">										
																							<input class="form-control form-control-sm" type="hidden" name="product_id" placeholder="Product ID" id="product_id_upd" value="">
																						</div>
																					</div>
																				</div>	
																				<div class="row">
																					<div class="col-sm">
																						<div class="form-group">
																							<label for="product_title_upd" class="boutique_form">Product Title:</label>
																							<input class="form-control form-control-sm" type="text" name="product_title_upd" placeholder="Product Title" id="product_title_upd" value="">
																						</div>
																					</div>																
																				</div>																	
																			</div>															
																			<div class="form-group">
																				<label for="upd_artist" class="boutique_form">Artist:</label>
																				<input class="form-control form-control-sm" type="text" name="upd_artist" placeholder="Artist" id="upd_artist">
																			</div>
																			<div class="row">
																				<div class="col-sm-6">
																				<label class="boutique_form">Description:</label>
																				</div>
																				<div class="col-sm-6">										
																					<i class="far fa-edit fa-lg float-right" id="desc_edit"></i>
																					<i class="fas fa-times fa-lg float-right d-none" id="desc_exit"></i>
																					
																				</div>																			
																			</div>
																			<div class="row">
																				<div class="col-sm">
																					<hr>
																						<div class="hidden" id="desc_ta_div">
																							<textarea class="tinymce form-control form-control-sm" id="description_edit"></textarea>									
																						</div>
																						<div class="boutique_form"  id="upd_description">
																							
																						</div>	
																					<hr>														
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-sm">
																					<div class="form-group">
																						<div class="input-group">
																							<div class="input-group-prepend">
																								<button class="btn btn-outline-secondary" type="button" name="upd_add_song" id="upd_add_song">Add new song</button>												
																							</div>
																							<input type="text" class="form-control" placeholder="Add song name" id="upd_song_name" name="upd_song_name">
																							<span id="upd_song_name_msg"></span>	
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-sm">
																					<p>Product song list:</p>
																					<ol class="list-group" id="upd_list_songs"> 
																						
																					</ol>
																				</div>
																			</div>
																			<div class="form-group mt-3">
																				<div class="row">
																					<div class="col-sm-6">
																						<div class="form-group">
																							<label class="boutique_form" for="upd_single">Is it single?</label>
																							<select class="form-control form-control-sm" id="upd_single">
																								<option id="upd_inserted_val"></option>
																								<option id="upd_not_inserted_val"></option>
																							</select>
																						</div>
																					</div>
																					<div class="col-sm-6">
																						<div class="form-group">
																							<label class="boutique_form" for="upd_type">What type is it?</label>
																							<select class="form-control form-control-sm" id="type_select"></select>
																						</div>
																					</div>
																				</div>																
																			</div>
																			<div class="form-group">
																				<div class="row">
																					<div class="col-sm">
																						<div class="form-group">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<button class="btn btn-outline-secondary" type="button" name="upd_add_genre" id="upd_add_genre">Add genre</button>
																								</div>
																								<select class="custom-select" id="upd_select_genre" name="upd_select_genre">
																									<option value="/">Select genre</option>							
																										<?php
																											foreach ($data['genres'] as $value) {
																												?><option value="<?php echo $value['genre']; ?>"><?php
																												echo $value['genre'];
																												?></option><?php
																											}
																										?>
																									</option>
																								</select>
																								<span id="ins_select_genre_msg"></span>											
																							</div>	
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-sm">
																						<ol class="list-group" id="upd_genre_list"></ol>
																					</div>
																				</div>
																			</div>
																			<div class="form-group">
																				<div class="row">
																					<div class="col-sm">
																						<div class="form-group">
																							<label for="upd_date_released" class="boutique_form">Date released:</label>
																							<input class="form-control form-control-sm" type="date" id="upd_date_released">
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-sm" >
																					<img class="img-fluid" style="width: 100%; height: auto;" id="upd_image">
																				</div>
																			</div>
																			<div class="form-group">
																				<div class="row">
																					<div class="col-sm">
																						<div class="input-group mb-3 mt-3">							
																							<div class="custom-file">
																								<input type="file" class="custom-file-input" id="upd_img" name="upd_img">
																								<label class="custom-file-label" for="upd_img" id="upd_img_name">Choose replacemet image</label>
																							</div>
																						</div>	
																					</div>
																				</div>
																			</div>
																			<div class="form-group">
																				<div class="row">
																					<div class="col-sm-6">
																						<div class="form-group">
																							<label for="upd_inventory_amount" class="boutique_form">Inventory Amount:</label>
																							<input class="form-control form-control-sm" type="text" id="upd_inventory_amount">
																						</div>
																					</div>
																					<div class="col-sm-6">
																						<div class="form-group">
																							<label for="upd_price" class="boutique_form">Price:</label>
																							<input class="form-control form-control-sm" type="text" id="upd_price">
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="row hidden" id="upd_alert_div">
																				<div class="col-sm">
																					<div class="alert alert-danger" role="alert">
																					  <h4 class="alert_upd alert-heading">Ups! Something went wrong!</h4>
																					  <p class="alert_upd m-2" id="product_title_upd_msg"></p>
																					  <p class="alert_upd m-2" id="upd_songs_msg"></p>
																					  <p class="alert_upd m-2" id="upd_artist_msg"></p>
																					  <p class="alert_upd m-2" id="upd_date_released_msg"></p>
																					  <p class="alert_upd m-2" id="upd_img_msg"></p>
																					  <p class="alert_upd m-2" id="upd_inventory_amount_msg"></p>
																					  <p class="alert_upd m-2" id="upd_price_msg"></p>
																					  <p class="alert_upd m-2" id="upd_select_genre_msg"></p>																  
																					  <hr>
																					  <p class="alert_upd mb-0">Please make sure all errors are cleared!</p>
																					</div>
																				</div>
																			</div>
																			<div class="form-group">
																				<input class="form-control form-control-sm log_reg_btn" type="button" value="Submit" id="update_product">
																			</div>
																		</div>
																	</div>
															</form>
														</div>													
													</div>												
												</div>
											</div>
											<div class="tab-pane fade" id="pills-remove_product" role="tabpanel" aria-labelledby="pills-remove_product-tab">
												<div class="row">
													<div class="col-sm p-5">
														<h4 class="text-center">Remove Product</h4>
														<form>
															<div class="row">
																<div class="col-sm">
																	<div class="form-group">
																		<input class="form-control form-control-sm" type="text" name="srch_del" id="srch_del" placeholder="Find product by title">						
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-sm">																
																	<p id="srch_none" class="hidden"></p>
																	<table class="table table-hover table-sm table-dark hidden" id="srch_table">					
																	</table>																			
																</div>
															</div>
															<div class="row">
																<div class="col-sm">
																	<div class="alert alert-danger hidden" role="alert" id="prod_del_alert">
																	
																	</div>
																	<input class="form-control form-control-sm log_reg_btn hidden" type="button" name="srch_del_btn" value="Delete Product" id="srch_del_btn">
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="pills-artist_ctrl" role="tabpanel" aria-labelledby="pills-artist_ctrl-tab">
												<div class="row">
													<div class="col-sm pt-5">
														<h4 class="text-center">Add or Remove Product Artist</h4>
													</div>
												</div>
												<div class="row">
													<div class="col-sm pl-5 pr-5 pb-5">
														<form>														
															<div class="row">
																<div class="col-sm">
																	<div class="form-group">
																		<select class="form-control form-control-sm" id="artist_action">
																			<option value = "/">SELECT ACTION*</option>
																			<option value = "add">Add Artist</option>
																			<option value = "remove">Remove Artist</option>
																		</select>																		
																	</div>
																</div>
															</div>
															<div class="row hidden" id="add_artist_form">
																<div class="col-sm">
																	<div class="row">
																		<div class="col-sm">
																			<div class="form-group">
																				<input class="form-control form-control-sm" type="text" id="artist_name_ins" placeholder="Artist Name*">
																				<span id="artist_name_ins_msg"></span>
																			</div>
																		</div>
																	</div>	
																	<div class="row">
																		<div class="col-sm">
																			<div class="form-group">
																				<textarea class="tinymce form-control form-control-sm" wrap="hard" id="artist_ins_desc"></textarea>																			
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm">
																			<div class="form-group">
																				<div class="input-group mb-3 mt-3">							
																					<div class="custom-file">
																						<input type="file" class="custom-file-input" id="artist_ins_img" name="artist_ins_img">
																						<label class="custom-file-label" for="artist_ins_img" id="artist_img_name">Choose image</label>
																					</div>
																				</div>	
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm">
																			<div class="form-group">
																				<img src="" id="display_art_img" style="width: 100%;">
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm">
																			<div class="form-group">
																				<div class="alert alert-danger hidden" role="alert" id="ins_art_alert">
																				 
																				</div>
																				<input class="form-control form-control-sm log_reg_btn" type="button" value="Submit" id="artist_btn">
																			</div>
																		</div>
																	</div>													
																</div>
															</div>
															<div class="row hidden" id="remove_artist_form">
																<div class="col-sm">
																	<div class="row">
																		<div class="col-sm">
																			<div class="form-group">
																				<input class="form-control form-control-sm" type="text" id="artist_srch" placeholder="Find artist by name">
																			</div>																	
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm">
																			<p id="art_srch_none" class="hidden"></p>
																			<table class="table table-hover table-sm table-dark hidden" id="art_srch_table">					
																			</table>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm">
																			<div class="form-group">
																				<div class="alert alert-danger hidden" role="alert" id="art_rem_alert">																
																				</div>
																				<input class="form-control form-control-sm log_reg_btn hidden" type="button" value="Delete Artist" id="art_del_btn">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>								
								</div>
							</div>
							<div class="col-sm-6">
								<div class="row">
									<div class="col-sm inner_nav_r">
										<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active text-center" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Unprocessed Orders</a>
											</li>
											<li class="nav-item">
												<a class="nav-link text-center" id="pills-ord_compl-tab" data-toggle="pill" href="#pills-ord_compl" role="tab" aria-controls="pills-ord_compl" aria-selected="false">Processed Orders</a>
											</li>
											<li class="nav-item text-center">
												<a class="nav-link" id="pills-product_sale-tab" data-toggle="pill" href="#pills-product_sale" role="tab" aria-controls="pills-product_sale" aria-selected="false">Place product on Sale</a>
											</li>
										</ul>										
										<div class="tab-content" id="pills-tabContent">
											<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
												<div class="row p-3">
													<div class="col-sm pt-3">
														<h4 class="text-center">Unprocessed Orders Overview</h4>
														<div class="alert alert-danger hidden" role="alert" id="ord_processed_err">
														 
														</div>
														<?php
															foreach ($data['un_orders'] as $value) {
																if ($value['order_status'] == 'unprocessed') {
																	?>
																		<div class="card ord_view mb-3">
																			<h5 class="card-header">Order ID : <?php echo $value['id']; ?> &nbsp;&nbsp;&nbsp;Order date: <?php echo $value['create_date']; ?></h5>
																			<div class="card-body">
																				<h5>Order by:</h5>
																				<div class="card mb-3 prod_list">
																					<ul class="list-group list-group-flush">
																						<li class="list-group-item"> <?php echo $value['first_name'] .' ' . $value['last_name']; ?></li>
																						<li class="list-group-item"> 
																							Username: <?php echo $value['username'];?>
																						</li>
																						<li class="list-group-item"> 
																							Address: <?php echo $value['address1'];?>
																						</li>
																						<li class="list-group-item"> 
																							Postal Code: <?php echo $value['postal_code'];?>
																						</li>
																						<li class="list-group-item"> 
																							City: <?php echo $value['city'];?>
																						</li>
																						<li class="list-group-item"> 
																							Country: <?php echo $value['country'];?>
																						</li>
																					</ul>
																				</div>
																				<h6>Product List:</h6>
																				<?php 
																					$products_single = explode(',', $value['album_title']);
																					$unit_price = explode(',', $value['album_price']);	
																					$quantity = explode(',', $value['quantity']);										
																				?>
																				<div class="card prod_list mb-3">
																					<ul class="list-group list-group-flush">
																						<?php
																							for ($i=0; $i < count($products_single) ; $i++) { 
																								?>
																									<li class="list-group-item text-center"><span class="float-left" style="font-size: 1em;"><?php echo $products_single[$i]; ?></span><span class="float-none" style="font-size: 1em;">quantity: <?php echo $quantity[$i]; ?></span><span class="float-right" style="font-size: 1em;">$<?php echo $unit_price[$i]; ?></span></li>
																								<?php
																							}
																						?>																				
																					</ul>
																				</div>
																				<h6>Order note:</h6>
																				<div class="card mb-3 prod_list p-3">
																					<p><?php echo mysqli_echo($value['order_notes']); ?></p>
																				</div>
																				<div class="card mb-3 prod_list">
																					<ul class="list-group list-group-flush">
																						<li class="list-group-item">Total: $<?php echo $value['total']; ?></li>
																					</ul>
																				</div>
																				<i class="fas fa-ban float-left fa-3x" id="order_rmv_btn_<?php echo $value['id'];?>"></i>																				
																				<i class="fas fa-check float-right fa-3x" id="order_btn_<?php echo $value['id'];?>"></i>
																			</div>
																		</div>
																	<?php															
																}																	
															}
														?>													
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="pills-ord_compl" role="tabpanel" aria-labelledby="pills-ord_compl-tab">
												<div class="row">
													<div class="col-sm p-5">
														<h4 class="text-center">Order Archive Overview</h4>
														<div class="accordion" id="accordionExample">
															<div class="card compl_ord">
																<?php																	
																	foreach ($data['pr_orders'] as $value) {																
																		?>
																			<div class="card-header" id="heading<?php echo $value['id'];  ?>">
																			<h5 class="mb-0">
																				<button class="btn btn-link ord_comp_btn" type="button" data-toggle="collapse" data-target="#collapse<?php echo $value['id'];  ?>" aria-expanded="true" aria-controls="collapse<?php echo $value['id'];  ?>">
																				Order Archive ID: <?php echo $value['id']; ?> &nbsp;&nbsp;&nbsp;Date created: <?php echo $value['date_created']; ?>
																				</button>
																			</h5>
																			<div id="collapse<?php echo $value['id'];  ?>" class="collapse" aria-labelledby="heading<?php echo $value['id'];  ?>" data-parent="#accordionExample">
																				<div class="card-body p-3">
																					<div class="row">
																						<div class="col-sm">
																							<div class="card ord_view mb-3">
																								<h5 class="card-header">Order details <?php 

																								if ($value['order_end_status'] == 'canceled') {
																									echo "<em class='float-right' style='color:red;'>".$value['order_end_status']."</em>";
																								} else {
																									echo "<em class='float-right' style='color:green;'>".$value['order_end_status']."</em>";
																								}
																								  ?>
																								 	
																								 </h5>
																								<div class="card-body">
																									<h5>Order by:</h5>
																									<div class="card mb-3 prod_list">
																										<ul class="list-group list-group-flush">
																											<li class="list-group-item"> <?php echo $value['first_name'] .' ' . $value['last_name']; ?></li>
																											<li class="list-group-item">Username: <?php echo $value['username'];?></li>
																											<li class="list-group-item">Email: <?php echo $value['email'];?></li>
																										</ul>
																									</div>
																									<h6>Product List:</h6>
																									<?php
																										$products_single = explode(',', $value['product_titles']);
																										$unit_price = explode(',', $value['unit_price']);	
																										$quantity = explode(',', $value['quantity']);
																									?>
																									<div class="card prod_list mb-3">
																										<ul class="list-group list-group-flush">
																											<?php
																												for ($i=0; $i < count($products_single) ; $i++) { 
																													?>
																														<li class="list-group-item text-center"><span class="float-left" style="font-size: 1em;"><?php echo $products_single[$i]; ?></span><span class="float-none" style="font-size: 1em;">quantity: <?php echo $quantity[$i]; ?></span><span class="float-right" style="font-size: 1em;">$<?php echo $unit_price[$i]; ?></span></li>
																													<?php
																												}
																											?>
																										</ul>
																									</div>
																									<h6>Order note:</h6>
																									<div class="card mb-3 prod_list p-3">
																										<p><?php echo $value['order_notes']; ?></p>
																									</div>
																									<div class="card mb-3 prod_list">
																										<ul class="list-group list-group-flush">
																											<li class="list-group-item">Total: $<?php echo $value['total']; ?></li>
																										</ul>
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
														</div>														
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="pills-product_sale" role="tabpanel" aria-labelledby="pills-product_sale-tab">
												<div class="row p-5">
													<div class="col-sm">
														<h4 class="text-center">Place product on Sale</h4>
														<div class="alert alert-danger hidden" role="alert" id="sale_alert">
														 
														</div>
														<form>
															<div class="row">
																<div class="col-sm">
																	<div class="form-group">
																		<input class="form-control form-control-sm" type="text" id="prod_sale_srch" placeholder="Find product by title">
																	</div>																	
																</div>
															</div>
															<div class="row">
																<div class="col-sm">
																	<p id="sale_srch_none" class="hidden"></p>
																	<table class="table table-hover table-sm table-dark hidden" id="sale_srch_table">					
																	</table>
																</div>
															</div>
															<div class="row hidden" id="sale_form">
																<div class="col-sm">
																	<div class="form-group">
																		<label for="sale_precentage" class="boutique_form">Discount precentage*:</label>
																		<input class="form-control form-control-sm" type="text" id="sale_precentage" placeholder="Enter discount precentage*">
																		<span id="sale_precentage_msg"></span>
																	</div>
																	<div class="form-group">
																		<label for="sale_duration" class="boutique_form">Discount duration (presented in number of days)*:</label>
																		<input class="form-control form-control-sm" type="text" id="sale_duration" placeholder="Enter discount duration (presented in number of days)*">
																		<span id="sale_duration_msg"></span>
																	</div>
																	<div class="form-group">
																		<input class="form-control form-control-sm log_reg_btn" value="Submit" type="button" id="sale_btn">
																	</div>
																</div>
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
				</div>				
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			function li_value( element ) {
					  var a = [];
					  for ( var i = 0; i < element.length; i++ ) {
					    a.push( element[ i ].innerHTML );
					  }
					  return a;
					}	
			sessionStorage.clear();
			$(document).bind('keydown', function(event){ 
			  if(event.keyCode == 13){
			    event.preventDefault();		  
			    return false;
			  }
			});
			$("#srch_del").on('keyup', function(){
				var srch = $("#srch_del").val();			

				$.ajax({
					url: 'http://localhost/vinyl/admins/product_update',
					type: 'POST',
					data: {
						srch_del : 1,
						srch: srch					
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);
						if (resp.no_matches) {														
								$('#srch_table').addClass('hidden');
								$('#srch_none').removeClass('hidden');
								$('#srch_none').html(resp.no_matches);
						} else if (jQuery.type( resp ) === 'array') {								
							$('#srch_table').removeClass('hidden');
							var arr = resp;
							var html = '';
							var id_arr = [];
 							jQuery.each(arr, function(key, value){

 								id_arr.push(value.id);
     							
     							html += "<tbody><td scope='col'>"+value.id+"</td><td scope='col'>"+value.title+"</td><td scope='col'>"+value.inventory_total+"</td><td scope='col'>"+value.inventory_presented+"</td><td style='text-align: right;' scope='col'><input class='form-check-input float-right' type='radio' name='srch_radio' id='srch_radio_"+value.id+"' value="+value.id+"></td></tbody>";
 							});

 							var table = "<thead><tr><th scope='col'>ID</th><th scope='col'>Title</th><th scope='col'>Inventory Total</th><th scope='col'>Inventory Present</th><th scope='col'>Select</th></tr></thead>"+html;
 							$('#srch_table').html(table);
						} else if (resp == 'false'){						
							$('#srch_table').addClass('hidden');
							$('#srch_none').addClass('hidden');
						}

						jQuery.each(id_arr, function(key, value){
							$("#srch_radio_"+value).on('click', function(){
									var srch_radio = $("#srch_radio_"+value).val();
									console.log(srch_radio);
								$('#srch_del_btn').removeClass('hidden');
								$('#srch_del_btn').on('click', function(){
									$.ajax({
										url: 'http://localhost/vinyl/admins/product_update',
										type: 'POST',
										data: {
											product_delete: 1,
											srch_radio: srch_radio	
										},
										success: function(response){
											var resp = JSON.parse(response);
											console.log(resp);
											if (resp.serverError) {
												$('#prod_del_alert').removeClass('hidden');
												$('#prod_del_alert').html(resp.serverError);
											}
											if (resp.server_response_ok) {
												window.location = 'http://localhost/vinyl/admins/profile';
											}

										},
										dataType: 'text'
									});
								});							
							});
						});

					
							
					},
					dataType: 'text'
				});
			});
			$("#action_select").on('change', function(){				
				var action_select = $("#action_select").val();					
				$.ajax({
					url: 'http://localhost/vinyl/admins/profile',
					type: 'POST',
					data: {
						ins_upd_product : 1,
						action_select: action_select					
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);
						if (resp.action_select == 'insert') {
							$('#insert_toggle').removeClass('hidden');							
						} else {
							$('#insert_toggle').addClass('hidden');
						}
						if (resp.action_select == 'update') {
							$('#update_toggle').removeClass('hidden');							

						} else {
							$('#update_toggle').addClass('hidden');
						}			
							
					},
					dataType: 'text'						
				});


				$("#product_search_upd").on('keyup', function(){
					var product_search_upd = $('#product_search_upd').val();
					

					$.ajax({
						url: 'http://localhost/vinyl/admins/product_update',
						type: 'POST',
						data: {
							product_search: 1,
							product_search_upd: product_search_upd	
						},
						success: function(response){
							var resp = JSON.parse(response);

							console.log(resp);
							
							if (resp.no_matches) {
								$('#upd_form').addClass('hidden');							
								$('#search_table').addClass('hidden');
								$('#search_none').removeClass('hidden');
								$('#search_none').html(resp.no_matches);
							} else if (jQuery.type( resp ) === 'array') {								
								$('#search_table').removeClass('hidden');
								var arr = resp;
								var html = '';
								var id_arr = [];
     							jQuery.each(arr, function(key, value){
     								id_arr.push(value.id);
	     							
	     							html += "<tbody><td scope='col'>"+value.id+"</td><td scope='col'>"+value.title+"</td><td scope='col'>"+value.inventory_total+"</td><td scope='col'>"+value.inventory_presented+"</td><td style='text-align: right;' scope='col'><input class='form-check-input float-right' type='radio' name='table_radio' id='table_radio_"+value.id+"' value="+value.id+"></td></tbody>";
     							});

     							var table = "<thead><tr><th scope='col'>ID</th><th scope='col'>Title</th><th scope='col'>Inventory Total</th><th scope='col'>Inventory Present</th><th scope='col'>Select</th></tr></thead>"+html;
     							$('#search_table').html(table);
     							

							} else if (resp == 'false'){
								$('#upd_form').addClass('hidden');	
								$('#search_table').addClass('hidden');
								$('#search_none').addClass('hidden');
							}

							jQuery.each(id_arr, function(key,value){
	 							$("#table_radio_"+value).on('click', function(){
	 								$('#upd_form').removeClass('hidden');
									var radio = $("#table_radio_"+value).val();					
									
									$.ajax({
										url: 'http://localhost/vinyl/admins/product_update',
										type: 'POST',
										data: {
											table_radio: 1,
											table_radio_val: radio
										},
										success: function(response){
											var resp = JSON.parse(response);

											console.log(resp);
											

											if (resp.radio_selection) {												
												console.log(resp);
												
												
												$('#product_id_upd').val(resp.radio_selection.radio_btn_res.album_info.id);
												$("#product_title_upd").val(resp.radio_selection.radio_btn_res.album_info.title);
												$("#upd_artist").val(resp.radio_selection.radio_btn_res.artist_name);
												$("#upd_description").html(resp.radio_selection.radio_btn_res.album_info.description);
												var songs = resp.radio_selection.radio_btn_res.song_titles;
												var li_songs = '';
												var li_ids = [];
												jQuery.each(songs, function (key, value){													
													li_ids.push(key);
													li_songs += "<li class='list-group-item list-group-item-dark' id='"+key+"_song_li'><i class='fas fa-trash-alt fa-lg float-left song_del' id='song_del' style='cursor: pointer;'></i>"+"&nbsp; <em id='"+key+"_li_em_song'>"+value.title+"</em><i class='far fa-edit fa-lg float-right song_edit' id='"+key+"_edit_song'></i><i class='d-none fas fa-times fa-lg float-right d-none song_edit' id='"+key+"_exit_song' style='cursor: pointer;'></i><div class='input-group m-2'><input id='"+key+"_input' type='text' class='form-control form-control-sm d-none p-1' placeholder='Edit song name'><div class='input-group-append'><button class='btn btn-outline-secondary d-none' type='button' id='"+key+"_song_ed_btn'>Submit</button></div></div></li>";
												});


												$('#upd_list_songs').html(li_songs);
												var counter = 0;
												var new_song_id = [];												
												jQuery.each(li_ids, function(key, value){
													counter = key;
													$("#upd_add_song").on('click', function(){					
													counter++;

														var upd_song_name = $('#upd_song_name').val();														
														if (upd_song_name.length != 0) {															
															new_song_id.push(counter);															
															$('#upd_song_name').val(""); 
															$('#upd_list_songs').append("<li class='list-group-item list-group-item-dark' id='"+counter+"_song_li'><i class='fas fa-trash-alt fa-lg float-left song_del' id='song_del' style='cursor: pointer;'></i>"+"&nbsp; <em id='"+counter+"_li_em_song'>"+upd_song_name+"</em><i class='far fa-edit fa-lg float-right song_edit' id='"+counter+"_edit_song'></i><i class='d-none fas fa-times fa-lg float-right d-none song_edit' id='"+counter+"_exit_song' style='cursor: pointer;'></i><div class='input-group m-2'><input id='"+counter+"_input' type='text' class='form-control form-control-sm d-none p-1' placeholder='Edit song name'><div class='input-group-append'><button class='btn btn-outline-secondary d-none' type='button' id='"+counter+"_song_ed_btn'>Submit</button></div></div></li>");			

															jQuery.each(new_song_id, function(key, value){
																$("#"+value+"_edit_song").on('click', function(){
																	$("#"+value+"_edit_song").addClass('d-none');
																	$("#"+value+"_exit_song").removeClass('d-none');
																	$("#"+value+"_input").removeClass('d-none');
																	$("#"+value+"_song_ed_btn").removeClass('d-none');										
																});
																$("#"+value+"_exit_song").on('click', function(){
																	$("#"+value+"_edit_song").removeClass('d-none');
																	$("#"+value+"_exit_song").addClass('d-none');
																	$("#"+value+"_input").addClass('d-none');
																	$("#"+value+"_song_ed_btn").addClass('d-none');
																	$("#"+value+"_input").val('');
																});																
																$("#"+value+"_song_ed_btn").on('click', function(){
																	$("#"+value+"_li_em_song").text($("#"+value+"_input").val());
																	$("#"+value+"_exit_song").addClass('d-none');
																	$("#"+value+"_edit_song").removeClass('d-none');
																	$("#"+value+"_input").addClass('d-none');
																	$("#"+value+"_song_ed_btn").addClass('d-none');

																});
															});
														} else {
															var upd_song_name = $('#upd_song_name').attr('disabled');
														}					
													});												
													$("#"+value+"_edit_song").on('click', function(){
														$("#"+value+"_edit_song").addClass('d-none');
														$("#"+value+"_exit_song").removeClass('d-none');
														$("#"+value+"_input").removeClass('d-none');										
														$("#"+value+"_song_ed_btn").removeClass('d-none');										
													});

													$("#"+value+"_exit_song").on('click', function(){
														$("#"+value+"_edit_song").removeClass('d-none');
														$("#"+value+"_exit_song").addClass('d-none');
														$("#"+value+"_input").addClass('d-none');
														$("#"+value+"_song_ed_btn").addClass('d-none');
														$("#"+value+"_input").val('');
													});													
													$("#"+value+"_song_ed_btn").on('click', function(){
														$("#"+value+"_li_em_song").text($("#"+value+"_input").val());
														$("#"+value+"_exit_song").addClass('d-none');
														$("#"+value+"_edit_song").removeClass('d-none');
														$("#"+value+"_input").addClass('d-none');										
														$("#"+value+"_song_ed_btn").addClass('d-none');	 
													});
												});

												$("#upd_list_songs").on('click','li #song_del', function(e){
													$(this).parent().remove();	

												});
												var single = resp.radio_selection.single;
												var db_single = resp.radio_selection.radio_btn_res.album_info.single;
												jQuery.each(single, function(key, value){
													if (value == db_single) {
														$('#upd_inserted_val').val(value);
														$('#upd_inserted_val').text(value);
													} else {
														$('#upd_not_inserted_val').val(value);
														$('#upd_not_inserted_val').text(value);
													}
												});

												var type = resp.radio_selection.type;
												var db_type = resp.radio_selection.radio_btn_res.album_info.type;
												var arr_type = [];
												var set_type = '';
												jQuery.each(type, function(key, value){
													if (value == db_type) {
														set_type = value;
													} else {
														arr_type += "<option value = '"+value+"'>"+value+"</option>";
													}
												});
												var select_type = "<option value='"+set_type+"'>"+set_type+"</option>"+arr_type;
												$('#type_select').html(select_type);
												var genres = resp.radio_selection.radio_btn_res.genres;
												var li_genre = '';
												var genre_ids = [];
												jQuery.each(genres, function (key, value){													
													li_genre += "<li class='list-group-item list-group-item-dark'><i class='fas fa-trash-alt fa-lg float-left genre_edit' style='cursor: pointer;'></i>&nbsp;<em>"+value.genre+"</em></li>";											
												});
												$('#upd_genre_list').html(li_genre);
												$('#upd_add_genre').on('click', function(){
													var upd_genre = $('#upd_select_genre').val();													
													if(upd_genre !== '/'){
														$('#upd_select_genre').val('/');
														$('#upd_genre_list').append("<li class='list-group-item list-group-item-dark'><i class='fas fa-trash-alt fa-lg float-left genre_edit' style='cursor: pointer;'></i>&nbsp;<em>"+upd_genre+"</em></li>");
													} else {
														var upd_genre = $('#upd_genre').attr('disabled');
													}
												});
												$("#upd_genre_list").on('click','li .genre_edit', function(e){
													$(this).parent().remove();
												});

												var date_rel = resp.radio_selection.radio_btn_res.album_info.date_released;		
												$('#upd_date_released').val(date_rel);

												var upd_img = resp.radio_selection.radio_btn_res.image_url[0];
												
												$('#upd_image').attr("src", upd_img);

												var upd_db_inventory = resp.radio_selection.radio_btn_res.album_info.inventory_total;
												$('#upd_inventory_amount').val(upd_db_inventory);

												var upd_db_price = resp.radio_selection.radio_btn_res.album_info.price;
												$('#upd_price').val(upd_db_price);

												$('#desc_edit').on('click',function(){
													$('#desc_exit').removeClass('d-none');
													$('#desc_edit').addClass('d-none');
													$('#upd_description').addClass('hidden');
													$('#desc_ta_div').removeClass('hidden');													
												});
												$('#desc_exit').on('click',function(){
													$('#desc_exit').addClass('d-none');
													$('#desc_edit').removeClass('d-none');
													$('#upd_description').removeClass('hidden');
													$('#desc_ta_div').addClass('hidden');													
												});

												$("#upd_img").on('change', function(){													
													var upd_img = $("#upd_img").prop('files')[0];					
													var ext = upd_img.name.split('.').pop().toLowerCase();				
													

													var reader = new FileReader();
													reader.onload = function(e){
														$("#upd_image").attr('src', e.target.result);
														$("#upd_img_name").text(upd_img.name);						
													}
													reader.readAsDataURL(upd_img);
												});
												
												$("#update_product").on('click', function(){
													var upd_img = $("#upd_img").prop('files')[0];
													var form_data = new FormData();
													var product_id_upd = $("#product_id_upd").val();	
													var product_title_upd = $('#product_title_upd').val();					
													var upd_artist = $('#upd_artist').val();								
													var description_edit = tinyMCE.activeEditor.getContent();						
													var upd_songs = li_value($('#upd_list_songs li em').toArray());				
														upd_songs = JSON.stringify(upd_songs);
													var upd_single = $('#upd_single').val();
													var type_select = $('#type_select').val();								
													var upd_genre_list = li_value($('#upd_genre_list li em').toArray());	
														upd_genre_list = JSON.stringify(upd_genre_list);	
													var upd_date_released = $('#upd_date_released').val();
													var upd_inventory_amount = $('#upd_inventory_amount').val();					
													var upd_price = $('#upd_price').val();												

													form_data.append("product_update", 1);
													form_data.append("file", upd_img);
													form_data.append("product_id_upd", product_id_upd);
													form_data.append("product_title_upd", product_title_upd);
													form_data.append("upd_artist", upd_artist);
													form_data.append("description_edit", description_edit);
													form_data.append("upd_songs", upd_songs);
													form_data.append("upd_single", upd_single);
													form_data.append("type_select", type_select);
													form_data.append("upd_genre_list", upd_genre_list);
													form_data.append("upd_date_released", upd_date_released);
													form_data.append("upd_inventory_amount", upd_inventory_amount);
													form_data.append("upd_price", upd_price);
													
													

												$.ajax({
													url: 'http://localhost/vinyl/admins/product_update',
													type: 'POST',
													data: form_data,
													contentType: false,
							    					cache: false,
							    					processData: false,
													success:function(response){
														var resp = JSON.parse(response);
														console.log(resp);


														if (resp.product_title_upd_err || resp.upd_songs_err || resp.upd_artist_err || resp.upd_date_released_err || resp.upd_img_err || resp.upd_inventory_amount_err || resp.upd_price_err || resp.upd_genre_list_err) {
															$('#upd_alert_div').removeClass('hidden');														 	
														} else {
															$('#upd_alert_div').addClass('hidden');
														}

														if (resp.product_title_upd_err) {
															$('#product_title_upd_msg').html(resp.product_title_upd_err);
															$('#product_title_upd').removeClass("is-valid").addClass("is-invalid");							
														} else {
															$('#product_title_upd_msg').empty();
															$('#product_title_upd').removeClass("is-invalid").addClass("is-valid");	
														}														

														if(resp.upd_songs_err){
					     									$('#upd_song_name').removeClass("is-valid").addClass("is-invalid");					
					     									$('#upd_songs_msg').html(resp.upd_songs_err);
					     								} else {
			     											$('#upd_song_name').removeClass("is-invalid").addClass("is-valid");							
															$('#upd_songs_msg').empty(); 									
					     								}							
							     						
														if (resp.upd_artist_err) {
															$('#upd_artist_msg').html(resp.upd_artist_err);
															$('#upd_artist').removeClass("is-valid").addClass("is-invalid");	
														} else {
															$('#upd_artist_msg').empty();
															$('#upd_artist').removeClass("is-invalid").addClass("is-valid");	
														}

														if (resp.upd_date_released_err) {
															$('#upd_date_released_msg').html(resp.upd_date_released_err);
															$('#upd_date_released').removeClass("is-valid").addClass("is-invalid");
														} else {
															$('#upd_date_released_msg').empty();
															$('#upd_date_released').removeClass("is-invalid").addClass("is-valid");
														}

														if (resp.upd_img_err) {
															$('#upd_img_msg').html(resp.upd_img_err);
															$('#upd_img').removeClass("is-valid").addClass("is-invalid");
														} else {
															$('#upd_img_msg').empty();
															$('#upd_img').removeClass("is-invalid").addClass("is-valid");
														}

														if (resp.upd_inventory_amount_err) {
															$('#upd_inventory_amount_msg').html(resp.upd_inventory_amount_err);
															$('#upd_inventory_amount').removeClass("is-valid").addClass("is-invalid");
														} else {
															$('#upd_inventory_amount_msg').empty();
															$('#upd_inventory_amount').removeClass("is-invalid").addClass("is-valid");
														}

														if (resp.upd_price_err) {
															$('#upd_price_msg').html(resp.upd_price_err);
															$('#upd_price').removeClass("is-valid").addClass("is-invalid");
														} else {
															$('#upd_price_msg').empty();
															$('#upd_price').removeClass("is-invalid").addClass("is-valid");
														}

														if (resp.upd_genre_list_err) {
															$('#upd_select_genre_msg').html(resp.upd_genre_list_err);
															$('#upd_select_genre').removeClass("is-valid").addClass("is-invalid");
														} else {
															$('#upd_select_genre_msg').empty();
															$('#upd_select_genre').removeClass("is-invalid").addClass("is-valid");
														}

														if (resp.server_response_ok) {
							     							window.location = 'http://localhost/vinyl/admins/profile';							
							     						}

													},
													dataType: 'text'
												});
											});											
											}
										},
										dataType: 'text'
									});
								});
							});
						},
						dataType: 'text'					
					});
				});			

				$("#insert_product").on('click', function(){

					var ins_img = $("#ins_img").prop('files')[0];
					var form_data = new FormData();		

					var ins_title = $('#ins_title').val();
					var ins_artist = $('#ins_artist').val();
					var ins_description = tinyMCE.activeEditor.getContent();					
					var ins_song_name = li_value($( "#songs li em" ).toArray());
					var ins_song_json = JSON.stringify(ins_song_name);
					var ins_single = $('#ins_single').val();
					var ins_type = $('#ins_type').val();					
					var ins_select_genre = li_value($( "#genre li em" ).toArray());
					var ins_date_released = $('#ins_date_released').val();
					var ins_inventory_amount = $('#ins_inventory_amount').val();
					var ins_price = $('#ins_price').val();

					form_data.append("product_insert", 1);
					form_data.append("file", ins_img);
					form_data.append("ins_title", ins_title);
					form_data.append("ins_artist", ins_artist);
					form_data.append("ins_description", ins_description);					
					form_data.append("ins_song_name", ins_song_json);
					form_data.append("ins_single", ins_single);
					form_data.append("ins_type", ins_type);
					form_data.append("ins_select_genre", ins_select_genre);
					form_data.append("ins_date_released", ins_date_released);
					form_data.append("ins_inventory_amount", ins_inventory_amount);
					form_data.append("ins_price", ins_price);


					$.ajax({
   						url:"http://localhost/vinyl/admins/product_insert",
   						method:"POST",
   						data: form_data,

    					contentType: false,
    					cache: false,
    					processData: false,    					 
    					success:function(response){    						
    						var resp = JSON.parse(response);
     						console.log(resp);

     						if(resp.ins_title_err){
     							$('#ins_title').removeClass("is-valid").addClass("is-invalid");
     							$('#ins_title_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     							$('#ins_title_msg').html(resp.ins_title_err);
     						} else {
     							$('#ins_title').removeClass("is-invalid").addClass("is-valid");
								$('#ins_title_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#ins_title_msg').html(resp.ins_title_ok);
     						}

     						if(resp.ins_artist_err){
     							$('#ins_artist').removeClass("is-valid").addClass("is-invalid");
     							$('#ins_artist_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     							$('#ins_artist_msg').html(resp.ins_artist_err);
     						} else {
     							$('#ins_artist').removeClass("is-invalid").addClass("is-valid");
								$('#ins_artist_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#ins_artist_msg').html(resp.ins_artist_ok);
     						}


     						if(resp.ins_song_name_empty){
     							$('#ins_song_name').removeClass("is-valid").addClass("is-invalid");
     							$('#ins_song_name_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     							$('#ins_song_name_msg').html(resp.ins_song_name_empty);
     						} else {
     							$('#ins_song_name').removeClass("is-invalid").addClass("is-valid");
								$('#ins_song_name_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#ins_song_name_msg').html(resp.ins_song_name_ok);
     						}

     						if(resp.ins_song_name_check){
     							var arr = resp.ins_song_name_check;
     							jQuery.each(arr, function(key, value){
     								if (value == 'ok') {

     									$('#songs').find('li').eq(key).removeClass("list-group-item-danger").addClass("list-group-item-success"); 
     									$('#ins_song_name').removeClass("is-invalid").addClass("is-valid");
										$('#ins_song_name_msg').removeClass("invalid-feedback").addClass("valid-feedback");
										$('#ins_song_name_msg').html('Looks good!');    									
     									
     								} else if(value == 'not') {
     									$('#songs').find('li').eq(key).removeClass("list-group-item-success").addClass("list-group-item-danger");
     									$('#ins_song_name').removeClass("is-valid").addClass("is-invalid");
     									$('#ins_song_name_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     									$('#ins_song_name_msg').html('Special characters are not allowed');     									
     								}
     							});     							
     						}

     						if (resp.ins_single_err) {
     							$('#ins_single').removeClass("is-valid").addClass("is-invalid");
     							$('#ins_single_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     							$('#ins_single_msg').html(resp.ins_single_err);
     						} else {
     							$('#ins_single').removeClass("is-invalid").addClass("is-valid");
								$('#ins_single_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#ins_single_msg').html(resp.ins_single_ok);
     						}

     						if (resp.ins_type_err) {
     							$('#ins_type').removeClass("is-valid").addClass("is-invalid");
     							$('#ins_type_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     							$('#ins_type_msg').html(resp.ins_type_err);
     						} else {
     							$('#ins_type').removeClass("is-invalid").addClass("is-valid");
								$('#ins_type_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#ins_type_msg').html(resp.ins_type_ok);
     						}

     						if (resp.ins_select_genre_err) {
     							$('#ins_select_genre').removeClass("is-valid").addClass("is-invalid");
     							$('#ins_select_genre_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     							$('#ins_select_genre_msg').html(resp.ins_select_genre_err);
     						} else {
     							$('#ins_select_genre').removeClass("is-invalid").addClass("is-valid");
								$('#ins_select_genre_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#ins_select_genre_msg').html(resp.ins_select_genre_ok);
     						}

     						if (resp.ins_date_released_err) {
     							$('#ins_date_released').removeClass("is-valid").addClass("is-invalid");
     							$('#ins_date_released_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     							$('#ins_date_released_msg').html(resp.ins_date_released_err);
     						} else {
     							$('#ins_date_released').removeClass("is-invalid").addClass("is-valid");
								$('#ins_date_released_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#ins_date_released_msg').html(resp.ins_date_released_ok);
     						}

     						if (resp.ins_img_err) {
     							$('#ins_img').removeClass("is-valid").addClass("is-invalid");			
     							$('#disp_img_name').html(resp.ins_img_err);
     							$('#disp_img_name').css('color', 'red');
     						} else {
     							$('#ins_img').removeClass("is-invalid").addClass("is-valid");
     							$('#disp_img_name').html(resp.ins_img_ok);					
     							$('#disp_img_name').css('color', 'green');					
     						}

     						if (resp.ins_inventory_amount_err) {
     							$('#ins_inventory_amount').removeClass("is-valid").addClass("is-invalid");
     							$('#ins_inventory_amount_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     							$('#ins_inventory_amount_msg').html(resp.ins_inventory_amount_err);
     						} else {
     							$('#ins_inventory_amount').removeClass("is-invalid").addClass("is-valid");
								$('#ins_inventory_amount_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#ins_inventory_amount_msg').html(resp.ins_inventory_amount_ok);
     						}

     						if (resp.ins_price_err) {
     							$('#ins_price').removeClass("is-valid").addClass("is-invalid");
     							$('#ins_price_msg').removeClass("valid-feedback").addClass("invalid-feedback");
     							$('#ins_price_msg').html(resp.ins_price_err);
     						} else {
     							$('#ins_price').removeClass("is-invalid").addClass("is-valid");
								$('#ins_price_msg').removeClass("invalid-feedback").addClass("valid-feedback");
								$('#ins_price_msg').html(resp.ins_price_ok);
     						}

     						if (resp.server_response_err) {     							
     							$('#server_err').removeClass("hidden");
     							$('#server_err_msg').removeClass("alert alert-success").addClass("alert alert-danger");
     							$('#server_err_msg').html(resp.server_response_err);
     						}

     						if (resp.server_response_ok) {
     							window.location = 'http://localhost/vinyl/admins/profile';
     						}
    					}
					});					
				});				

				$("#ins_add_song").on('click', function(){					
					
					var ins_song_name = $('#ins_song_name').val();
					if (ins_song_name.length != 0) {
						$('#ins_song_name').val(""); 
						$('#songs').append("<li class='list-group-item d-flex justify-content-between align-items-center p-2' id='song_list'><em style='color:black;'>"+ins_song_name+"</em><span class='badge badge-primary badge-pill' style='background-color:rgb(67, 66, 66);'><i class='far fa-trash-alt'></i></span></li>");						
					} else {
						var ins_song_name = $('#ins_song_name').attr('disabled');
					}					
				});

				$("#songs").on('click','li', function(e){
					$(this).remove();	

				});

				$("#ins_add_genre").on('click', function(){
					var ins_select_genre = $("#ins_select_genre").val();
					if (ins_select_genre !== '/') {
						$("#ins_select_genre").val('/');
						$('#genre').append("<li class='list-group-item d-flex justify-content-between align-items-center p-2'><em style='color:black;'>"+ins_select_genre+"</em><span class='badge badge-primary badge-pill' style='background-color:rgb(67, 66, 66);'><i class='far fa-trash-alt'></i></span></li>");
					} else {
						var ins_select_genre = $("#ins_select_genre").attr('disabled');
					}
 				});
 				$("#genre").on('click','li', function(e){
					$(this).remove();	

				});

				$("#ins_img").on('change', function(){
					var ins_img = $("#ins_img").prop('files')[0];					
					var ext = ins_img.name.split('.').pop().toLowerCase();				

					var reader = new FileReader();
					reader.onload = function(e){
						$("#display_img").attr('src', e.target.result);
						$("#disp_img_name").text(ins_img.name);						
					}
					reader.readAsDataURL(ins_img);
				});


			});
			$("#artist_action").on('change', function(){
				var artist_action = $("#artist_action").val();
				if (artist_action == 'add') {
					$('#add_artist_form').removeClass('hidden');
				} else {
					$('#add_artist_form').addClass('hidden');
				}

				if (artist_action == 'remove') {
					$('#remove_artist_form').removeClass('hidden');
				} else {
					$('#remove_artist_form').addClass('hidden');
				}

			});

			$("#artist_ins_img").on('change', function(){
					var artist_ins_img = $("#artist_ins_img").prop('files')[0];					
					var ext = artist_ins_img.name.split('.').pop().toLowerCase();				

					var reader = new FileReader();
					reader.onload = function(e){
						$("#display_art_img").attr('src', e.target.result);
						$("#artist_img_name").text(artist_ins_img.name);						
					}
					reader.readAsDataURL(artist_ins_img);
				});

			$('#artist_btn').on('click', function(){

				var artist_ins_img = $("#artist_ins_img").prop('files')[0];
				var form_data = new FormData();	
				var artist_name_ins = $('#artist_name_ins').val();
				var artist_ins_desc = tinyMCE.activeEditor.getContent();
				console.log(artist_name_ins);

				form_data.append("artist_ins", 1);
				form_data.append("file", artist_ins_img);
				form_data.append("artist_name_ins", artist_name_ins);
				form_data.append("artist_ins_desc", artist_ins_desc);

				$.ajax({
					url:"http://localhost/vinyl/admins/add_remove_artist",
					method:"POST",
					data: form_data,
					contentType: false,
					cache: false,
					processData: false,    					 
					success:function(response){    						
						var resp = JSON.parse(response);
 						console.log(resp);

 						if(resp.ins_artist_err){
 							$('#artist_name_ins').removeClass("is-valid").addClass("is-invalid");
 							$('#artist_name_ins_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#artist_name_ins_msg').html(resp.ins_artist_err); 							
 						} else {
 							$('#artist_name_ins').removeClass("is-invalid").addClass("is-valid");
							$('#artist_name_ins_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#artist_name_ins_msg').html(resp.ins_art_img_ok); 
 						}

 						if (resp.ins_art_img_err) {
 							$('#artist_ins_img').removeClass("is-valid").addClass("is-invalid");
 							$('#artist_img_name').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#artist_img_name').html(resp.ins_art_img_err); 
 							$('#artist_img_name').css('color', 'red');
 						} else {
 							$('#artist_ins_img').removeClass("is-invalid").addClass("is-valid");
							$('#artist_img_name').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#artist_img_name').html(resp.ins_art_img_ok); 
							$('#artist_img_name').css('color', 'green');

 						}

 						if (resp.serverError) {
 							$('#ins_art_alert').removeClass('hidden');
 							$('#ins_art_alert').html(resp.serverError);
 						}

 						if (resp.server_response_ok) {
 							window.location = 'http://localhost/vinyl/admins/profile';	
 						}


 					},
 					dataType: 'text'
 				});
			});

			$("#artist_srch").on('keyup', function(){
				var artist_name = $('#artist_srch').val();
				console.log(artist_name);

				$.ajax({
					url: 'http://localhost/vinyl/admins/product_update',
					type: 'POST',
					data: {
						art_srch : 1,
						artist_name: artist_name					
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);
						if (resp.no_matches) {														
								$('#art_srch_table').addClass('hidden');
								$('#art_srch_none').removeClass('hidden');
								$('#art_srch_none').html(resp.no_matches);
						} else if (jQuery.type( resp ) === 'array') {								
							$('#art_srch_table').removeClass('hidden');
							var arr = resp;
							var html = '';
							var id_arr = [];
 							jQuery.each(arr, function(key, value){

 								id_arr.push(value.id);
     							
     							html += "<tbody><td scope='col'>"+value.id+"</td><td scope='col'>"+value.name+"</td><td scope='col'>"+value.date_created+"</td><td scope='col'>"+value.id_images+"</td><td style='text-align: right;' scope='col'><input class='form-check-input float-right' type='radio' name='srch_radio' id='art_srch_radio_"+value.id+"' value="+value.id+"></td></tbody>";
 							});

 							var table = "<thead><tr><th scope='col'>ID</th><th scope='col'>Name</th><th scope='col'>Create Date</th><th scope='col'>Image ID</th><th scope='col'>Select</th></tr></thead>"+html;
 							$('#art_srch_table').html(table);
						} else if (resp == 'false'){						
							$('#art_srch_table').addClass('hidden');
							$('#art_srch_none').addClass('hidden');
						}

						jQuery.each(id_arr, function(key, value){
							$("#art_srch_radio_"+value).on('click', function(){
								var art_srch_radio = $("#art_srch_radio_"+value).val();
								console.log(art_srch_radio);
								$('#art_del_btn').removeClass('hidden');
								$('#art_del_btn').on('click', function(){
									$.ajax({
										url: 'http://localhost/vinyl/admins/add_remove_artist',
										type: 'POST',
										data: {
											artist_delete: 1,
											art_srch_radio: art_srch_radio	
										},
										success: function(response){
											var resp = JSON.parse(response);
											console.log(resp);

											if (resp.serverError) {
												$('#art_rem_alert').removeClass('hidden');
												$('#art_rem_alert').html(resp.serverError);
											}

											if (resp.server_response_ok) {
												window.location = 'http://localhost/vinyl/admins/profile';	
											}
										},
										dataType: 'text'
									});
								});							
							});
						});				
								

					},
					dataType: 'text'
				});
			});
			
			var ord_btn = $("i[class = 'fas fa-check float-right fa-3x']").siblings();			
			jQuery.each(ord_btn.prevObject, function(key,value){
				var button = ord_btn.prevObject[key].id;				
				$("#"+button).on('click', function(){
					var btn_spl = button.split('_');
					var btn_inf = btn_spl[2];

					$.ajax({
						url: 'http://localhost/vinyl/admins/order_processing',
						type: 'POST',
						data: {
							ord_prcs: 1,
							btn_inf: btn_inf	
						},
						success: function(response){
							var resp = JSON.parse(response);
							console.log(resp);
							

							if (resp.serverError) {
								$('#ord_processed_err').removeClass('hidden');
								$('#ord_processed_err').html(resp.serverError);
							}

							if (resp.server_response_ok) {
								window.location = 'http://localhost/vinyl/admins/profile';	
							}
							
						},
						dataType: 'text'
					});					
				});
			});
			var ord_btn = $("i[class='fas fa-ban float-left fa-3x']").siblings();			
			jQuery.each(ord_btn.prevObject, function(key,value){
				var button = ord_btn.prevObject[key].id;				
				$("#"+button).on('click', function(){
					var btn_spl = button.split('_');
					var btn_inf = btn_spl[3];					
					$.ajax({
						url: 'http://localhost/vinyl/admins/order_processing',
						type: 'POST',
						data: {
							ord_prcs: 1,
							btn_rmv_inf: btn_inf	
						},
						success: function(response){
							var resp = JSON.parse(response);
							console.log(resp);
							

							if (resp.serverError) {
								$('#ord_processed_err').removeClass('hidden');
								$('#ord_processed_err').html(resp.serverError);
							}

							if (resp.server_response_ok) {
								window.location = 'http://localhost/vinyl/admins/profile';	
							}
							
						},
						dataType: 'text'
					});					
				});
			});

			$("#prod_sale_srch").on('keyup', function(){
				var srch_sale = $("#prod_sale_srch").val();			

				$.ajax({
					url: 'http://localhost/vinyl/admins/place_product_sale',
					type: 'POST',
					data: {
						prod_sale_srch : 1,
						srch_sale: srch_sale					
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp.no_matches) {
								$('#sale_form').addClass('hidden');							
								$('#sale_srch_table').addClass('hidden');
								$('#sale_srch_none').removeClass('hidden');
								$('#sale_srch_none').html(resp.no_matches);
							} else if (jQuery.type( resp ) === 'array') {								
								$('#sale_srch_table').removeClass('hidden');
								var arr = resp;
								var html = '';
								var id_arr = [];
     							jQuery.each(arr, function(key, value){
     								id_arr.push(value.id);
	     							
	     							html += "<tbody><td scope='col'>"+value.id+"</td><td scope='col'>"+value.title+"</td><td scope='col'>"+value.inventory_total+"</td><td scope='col'>"+value.inventory_presented+"</td><td style='text-align: right;' scope='col'><input class='form-check-input float-right' type='radio' name='table_radio' id='table_radio_"+value.id+"' value="+value.id+"></td></tbody>";
     							});

     							var table = "<thead><tr><th scope='col'>ID</th><th scope='col'>Title</th><th scope='col'>Inventory Total</th><th scope='col'>Inventory Present</th><th scope='col'>Select</th></tr></thead>"+html;
     							$('#sale_srch_table').html(table);
     							

							} else if (resp == 'false'){
								$('#sale_form').addClass('hidden');	
								$('#sale_srch_table').addClass('hidden');
								$('#sale_srch_none').addClass('hidden');
							}
							jQuery.each(id_arr, function(key,value){
	 							$("#table_radio_"+value).on('click', function(){
	 								$('#sale_form').removeClass('hidden');
									var radio = $("#table_radio_"+value).val();	

									$('#sale_btn').on('click', function(){
										var discount = $('#sale_precentage').val();
										var duration = $('#sale_duration').val();

										$.ajax({
											url: 'http://localhost/vinyl/admins/place_product_sale',
											type: 'POST',
											data: {
												sale_submit: 1,
												prod_id: radio,
												discount: discount,
												duration: duration
											},
											success: function(response){
												var resp = JSON.parse(response);
												console.log(resp);

												if(resp.discount_err){
					     							$('#sale_precentage').removeClass("is-valid").addClass("is-invalid");
					     							$('#sale_precentage_msg').removeClass("valid-feedback").addClass("invalid-feedback");
					     							$('#sale_precentage_msg').html(resp.discount_err);
					     						} else {
					     							$('#sale_precentage').removeClass("is-invalid").addClass("is-valid");
													$('#sale_precentage_msg').removeClass("invalid-feedback").addClass("valid-feedback");
													$('#sale_precentage_msg').html(resp.discount_ok);
					     						}

					     						if(resp.duration_err){
					     							$('#sale_duration').removeClass("is-valid").addClass("is-invalid");
					     							$('#sale_duration_msg').removeClass("valid-feedback").addClass("invalid-feedback");
					     							$('#sale_duration_msg').html(resp.duration_err);
					     						} else {
					     							$('#sale_duration').removeClass("is-invalid").addClass("is-valid");
													$('#sale_duration_msg').removeClass("invalid-feedback").addClass("valid-feedback");
													$('#sale_duration_msg').html(resp.duration_ok);
					     						}

					     						if (resp.serverError) {
					     							$('#sale_alert').removeClass('hidden');
					     							$('#sale_alert').html(resp.serverError);

					     						}

					     						if (resp.server_response_ok) {
					     							window.location = 'http://localhost/vinyl/admins/profile';
					     						}


											},
											dataType: 'text'
										});
									});									
								});
	 						});
					},
					dataType: 'text'
				});
			});
			var per_btn = $('.spec_per_btn').siblings();
			jQuery.each(per_btn.prevObject, function(key,value){
				var per_btn_id = per_btn.prevObject[key].id;
				var btns = per_btn_id.split('_');
				var id = btns[2];
				$('#per_btn_'+id).on('click', function(){					
					var per_sel = $('#per_sel_'+id).val();
					var td = $('#per_cell_'+id).attr('id');
					console.log(td);
					if (per_sel != '/') {
						$.ajax({
							url: 'http://localhost/vinyl/admins/permission_change',
							type: 'POST',
							data: {
								perm_chng: 1,
								per_sel: per_sel,
								id: id							
							},
							success: function(response){
								var resp = JSON.parse(response);
								console.log(resp);

								if (resp.server_response_ok) {
									$('#'+td).empty();
									$('#'+td).text(per_sel);
								}

								if (resp.serverError) {
									window.scrollTo(0, 0);
									$('#err_serv').removeClass('d-none');
									$('.err_serv').text(resp.serverError);
								} else {
									$('#err_serv').addClass('d-none');
									$('.err_serv').empty();
								}

							},
							dataType: 'text'
						});					
					}
				});
			});

			$('#pills-sale_info-tab').on('click', function(){
				$.ajax({
					url: 'http://localhost/vinyl/admins/best_seller',
					type: 'POST',
					data: {
						best_sell: 1,												
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if(resp){
							var html = '';
							var width = [];
							
							jQuery.each(resp, function(key, value){
								var inv = parseInt(value.inventory_total);
								var sold = parseInt(value.items_sold);
								var sum = inv + sold;
								var revenue = value.price * sold;
								console.log(inv + sold);
								
								
								width.push(sum);

								if(sold < 10 && sold > 5){
									html += "<div class='row mb-3 best_sell_frame'><div class='col-sm-3 p-0'><img src='"+value.img_url+"' class='best_sell_img'></div><div class='col-sm-9 p-3'><div class='row pb-3'><div class='col-sm'><div class='row'><div class='col-sm-6'><h4>"+value.title+"</h4><h4>Price: $"+value.price+"</h4></div><div class='col-sm-6'><h4>Inventory: "+value.inventory_total+"</h4><h4>Items Sold: "+value.items_sold+"</h4><h4>Revenue: $"+revenue+"</h4></div></div></div></div><div class='row'><div class='col-sm'><div class='progress m-5'><div class='progress-bar progress-bar-striped progress-bar-animated bg-warning' role='progressbar' aria-valuenow='"+sold+"' aria-valuemin='0' aria-valuemax='"+sum+"' style='width: "+sold+"%'></div></div></div></div></div></div></div>";
								} else if(sold < 5) {
									html += "<div class='row mb-3 best_sell_frame'><div class='col-sm-3 p-0'><img src='"+value.img_url+"' class='best_sell_img'></div><div class='col-sm-9 p-3'><div class='row pb-3'><div class='col-sm'><div class='row'><div class='col-sm-6'><h4>"+value.title+"</h4><h4>Price: $"+value.price+"</h4></div><div class='col-sm-6'><h4>Inventory: "+value.inventory_total+"</h4><h4>Items Sold: "+value.items_sold+"</h4><h4>Revenue: $"+revenue+"</h4></div></div></div></div><div class='row'><div class='col-sm'><div class='progress m-5'><div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar' aria-valuenow='"+sold+"' aria-valuemin='0' aria-valuemax='"+sum+"' style='width: "+sold+"%'></div></div></div></div></div></div></div>";
								} else {
									html += "<div class='row mb-3 best_sell_frame'><div class='col-sm-3 p-0'><img src='"+value.img_url+"' class='best_sell_img'></div><div class='col-sm-9 p-3'><div class='row pb-3'><div class='col-sm'><div class='row'><div class='col-sm-6'><h4>"+value.title+"</h4><h4>Price: $"+value.price+"</h4></div><div class='col-sm-6'><h4>Inventory: "+value.inventory_total+"</h4><h4>Items Sold: "+value.items_sold+"</h4><h4>Revenue: $"+revenue+"</h4></div></div></div></div><div class='row'><div class='col-sm'><div class='progress m-5'><div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-valuenow='"+sold+"' aria-valuemin='0' aria-valuemax='"+sum+"' style='width: "+sold+"%'></div></div></div></div></div></div></div>";
								}
							
							});
								$('#sale_info').append(html);							
						}
						
					},
					dataType: 'text'
				});		
			});
			var msg_outbox = $('.msg_outbox').siblings();
			jQuery.each(msg_outbox.prevObject, function(key,value){
				var msg_outbox_id = msg_outbox.prevObject[key].id;
				var msg_outbox_split = msg_outbox_id.split('_');
				var id = msg_outbox_split[3];
				$('#msg_outbox_show_'+id).on('click', function(){
					$('#msg_bodyo_'+id).toggle();
					
				});				
			});

			var mail_rmv = $('.rmv_mail_btn').siblings();
			jQuery.each(mail_rmv.prevObject, function(key,value){
				var mail_rmv_id = mail_rmv.prevObject[key].id;
				var mail_rmv_split = mail_rmv_id.split('_');
				var id =mail_rmv_split[3];
				$('#rmv_mail_btn_'+id).on('click', function(){								
					$.ajax({
						url: 'http://localhost/vinyl/admins/mailbox',
						type: 'POST',
						data: {
							rmv_mail: 1,
							id: id											
						},
						success: function(response){
							var resp = JSON.parse(response);
							console.log(resp);	

							if(resp.server_response_ok) {
								$('#msg_body_'+id).remove();
								$('#msg_bodyo_'+id).remove();
								$('#msg_inbox_show_'+id).remove();
								$('#msg_outbox_show_'+id).remove();		
							}										
							
							
							
						},
						dataType: 'text'
					});			

				});
			});

			var msg_inbox = $('.msg_inbox').siblings();
			jQuery.each(msg_inbox.prevObject, function(key,value){
				var msg_inbox_id = msg_inbox.prevObject[key].id;
				var msg_inbox_split = msg_inbox_id.split('_');
				var id = msg_inbox_split[3];
				$('#msg_inbox_show_'+id).on('click', function(){
					$('#msg_body_'+id).toggle();
					$.ajax({
						url: 'http://localhost/vinyl/admins/mailbox',
						type: 'POST',
						data: {
							mailbox: 1,
							id: id											
						},
						success: function(response){
							var resp = JSON.parse(response);
							console.log(resp);											
							
							if (resp.server_response_ok) {
								$('.mail_icon_'+id).empty();
								$('.mail_icon_'+id).html('<i class="far fa-envelope-open fa-2x" style="color: white;"></i>');

							}
							
						},
						dataType: 'text'
					});
				});				
			});	
			$('#btn_mail_new').on('click', function(){
				var to = $('#to_mail_new').val();
				var subject = $('#subj_mail_new').val();
				var message = tinyMCE.activeEditor.getContent();

				$.ajax({
					url: 'http://localhost/vinyl/admins/mailbox',
					type: 'POST',
					data: {
						outbox: 1,
						to: to,											
						subject: subject,											
						message: message											
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);											
						
						if (resp.to_err) {
							$('#to_mail_new').removeClass("is-valid").addClass("is-invalid");
 							$('#to_mail_new_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#to_mail_new_msg').html(resp.to_err);
 						} else {
 							$('#to_mail_new').removeClass("is-invalid").addClass("is-valid");
							$('#to_mail_new_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#to_mail_new_msg').html(resp.to_ok);
 						}

 						if (resp.subject_err) {
							$('#subj_mail_new').removeClass("is-valid").addClass("is-invalid");
 							$('#subj_mail_new_msg').removeClass("valid-feedback").addClass("invalid-feedback");
 							$('#subj_mail_new_msg').html(resp.subject_err);
 						} else {
 							$('#subj_mail_new').removeClass("is-invalid").addClass("is-valid");
							$('#subj_mail_new_msg').removeClass("invalid-feedback").addClass("valid-feedback");
							$('#subj_mail_new_msg').html(resp.subject_ok);							
 						}

 						if (resp.server_response_ok) {
 							$('#to_mail_new').val('');
 							$('#subj_mail_new').val('');
 							tinyMCE.activeEditor.setContent('');
 							$('#new_mail_msg').removeClass('d-none');
 							$('#new_mail_msg').html('Your email was successfully sent');
 							setTimeout(function(){ $('#new_mail_msg').addClass('d-none'); }, 10000);
 						} 
 						if (resp.server_response_err) {
 							$('#new_mail_msg').removeClass('d-none');
 							$('#new_mail_msg').removeClass('alert-success').addClass('alert-danger');
 							$('#new_mail_msg').html(resp.server_response_err);
 							setTimeout(function(){ $('#new_mail_msg').addClass('d-none'); }, 10000);
 						}
						
					},
					dataType: 'text'
				});				
			});
			
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

						if (resp.img_err) {
							$('#img_ch_div').removeClass('d-none');
 							$('#img_ch_alert').removeClass('alert-success').addClass('alert-danger');
 							$('#img_ch_alert').html(resp.img_err);
 							setTimeout(function(){ $('#img_ch_alert').addClass('d-none'); }, 10000);
						}										
						
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
		});
	</script>	
<?php require APPROOT . "/views/inc/footer.php"; ?>