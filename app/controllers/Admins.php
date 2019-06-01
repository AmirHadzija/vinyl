<?php 

	class Admins extends Controller{

		public $msg = [];

		public function __construct(){
			$this->adminModel = $this->model('Admin');
			$this->adminModel = $this->model('Admin');
			$this->postModel = $this->model('Post');
			$this->userModel = $this->model('User');
			$this->errorHandlerModel = $this->model('ErrorHandler');

			$this->config = HTMLPurifier_Config::createDefault();
			$this->purifier = new HTMLPurifier($this->config);
		}

		public function profile(){

			if (isLoggedIn() == 'admin') {
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['ins_upd_product'] == 1) {
					$form_data = [
						'action_select' => test_input($_POST['action_select']),						
					];

					$res = json_encode($form_data);
					exit($res);
				}

				$data = [					
					'genres' => $this->adminModel->select_genre(),
					'types' => $this->adminModel->get_types_get_single(true),			
					'single' => $this->adminModel->get_types_get_single(false),	
					'un_orders' => $this->adminModel->orders(false),
					'pr_orders' => $this->adminModel->orders(true),
					'all_products' => $this->postModel->getProducts(),
					'get_sales' => $this->postModel->getSales(),
					'get_users' => $this->adminModel->getUsersTable(),
					'get_mail' => $this->adminModel->getMail(true),
					'get_sent_mail' =>	$this->adminModel->getMail(false),			
				];

				$this->view('admin/profile', $data);
				
			} else {
				redirect('pages/index');
			}


		}

		public function user(){
			if (isLoggedIn() == 'regular') {
				$id = $_SESSION['user']->id;
				$data = [
					'get_u_orders' => $this->adminModel->get_u_orders($id),
					'get_u_archive' => $this->adminModel->get_u_archive($id),
					'get_u_address' => $this->adminModel->get_u_address($id),
				];

				$this->view('user/user', $data);
				
			}
		}

		public function product_update(){
			if (isLoggedIn() == 'admin') {
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_search']) && $_POST['product_search'] == 1){

					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'product_search_upd' => test_input($_POST['product_search_upd']),
												
					];

					if (!empty($data['product_search_upd']) || isset($data['product_search_upd'])) {
						$res = $this->adminModel->product_search_title($data['product_search_upd']);
						if ($res) {
							$arr = json_encode($res);
							exit($arr);
						} else if($res == false) {
							$this->msg['search_result'] = 'false';
							$result = json_encode($this->msg['search_result']);
							exit($result);
						}
					}				
				} 

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['srch_del']) && $_POST['srch_del'] == 1) {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'srch' => test_input($_POST['srch']),												
					];

					if (!empty($data['srch']) || isset($data['srch'])) {
						$res = $this->adminModel->product_search_title($data['srch']);
						if ($res) {
							$arr = json_encode($res);
							exit($arr);
						} else if($res == false) {
							$this->msg['search_result'] = 'false';
							$result = json_encode($this->msg['search_result']);
							exit($result);
						}
					}	
				}

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_delete']) && $_POST['product_delete'] == 1){
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					$data = [
						'srch_radio' => test_input($_POST['srch_radio']),											
					];

					$res = $this->adminModel->product_delete($data);
					
					if (isset($res['error'])) {
						$this->errorHandlerModel->error_log($res['error']);
						$this->msg['serverError'] = 'There was a problem with your attempt to delete a product. Please try again later';
					} else {
						flash('product_del_success', 'You have successfully removed a product');
						$this->msg['server_response_ok'] = 'ok';
					}
						exit(json_encode($this->msg));
				}

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['art_srch']) && $_POST['art_srch'] == 1){
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					$data = [
						'artist_name' => test_input($_POST['artist_name']),											
					];

					if (!empty($data['artist_name']) || isset($data['artist_name'])) {
						$res = $this->adminModel->artist_search($data['artist_name']);
						if ($res) {
							$arr = json_encode($res);
							exit($arr);
						} else if($res == false) {
							$this->msg['search_result'] = 'false';
							$result = json_encode($this->msg['search_result']);
							exit($result);
						}
					}	
				}

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_val']) && $_POST['product_val'] == 1) {

					
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'product_title' => test_input($_POST['product_title']),
						'product_id' => test_input($_POST['product_id']),
						'upd_artist' => test_input($_POST['upd_artist']),												
					];



					$res = json_encode($data);
					exit($res);
				}

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['table_radio']) && $_POST['table_radio'] == 1) {

					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'table_radio_val' => test_input($_POST['table_radio_val']),
					];
					$this->msg['radio_selection'] = $this->adminModel->product_search_title($data['table_radio_val'], true);
					$this->msg['radio_selection']['single'] = $this->adminModel->get_types_get_single(false);
					$this->msg['radio_selection']['type'] = $this->adminModel->get_types_get_single();					
					$res = $this->msg;
					$result = json_encode($res);
					exit($result);
				}

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_update']) && $_POST['product_update'] == 1){				
					
					$data = [
						'product_title_upd' => test_input($_POST['product_title_upd']),
						'product_id_upd' => test_input($_POST['product_id_upd']),
						'upd_artist' => test_input($_POST['upd_artist']),
						'description_edit' => $this->purifier->purify($_POST['description_edit']),
						'upd_songs' => json_decode($_POST['upd_songs']),
						'upd_single' => test_input($_POST['upd_single']),
						'type_select' => test_input($_POST['type_select']),
						'upd_genre_list' => json_decode($_POST['upd_genre_list']),
						'upd_date_released' => test_input($_POST['upd_date_released']),						
						'upd_inventory_amount' => test_input($_POST['upd_inventory_amount']),						
						'upd_price' => test_input($_POST['upd_price']),						
					];



					
					//VALIDATING TITLE UPDATE INPUT
					$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
					preg_match_all($pattern, $data['product_title_upd'], $matches, PREG_SET_ORDER, 0);
					if (!empty($data['product_title_upd']) && empty($matches)) {
						$this->msg['product_title_upd_err'] = 'Product title contains special characters!No special characters allowed';
					}

					//VALIDATING ARTIST NAME UPDATE INPUT
					preg_match_all($pattern, $data['upd_artist'], $matches, PREG_SET_ORDER, 0);
					if (!empty($data['upd_artist']) && empty($matches)){
						$this->msg['upd_artist_err'] = 'Artists name contains special characters!No special characters allowed';
					}

					//VALIDATING SONGS UPDATE INPUT 
					$upd_song_check = [];
					foreach ($data['upd_songs'] as $value) {
						$pattern = "/^([a-zA-Z0-9_\s\-\'\!\?\,\.\(\)]*)$/";
						preg_match_all($pattern, $value, $matches, PREG_SET_ORDER, 0);
						if (!empty($matches)) {
							array_push($upd_song_check, 'ok');
						} elseif (empty($matches)){
							array_push($upd_song_check, 'not');
						}							
					}

					//VALIDATING SONGS UPDATE INPUT  LVL 2					
					if (!empty($upd_song_check)){
						$this->msg['upd_songs_check'] = $upd_song_check;
						foreach ($upd_song_check as $value) {
							if ($value == 'not') {
								$this->msg['upd_songs_err'] = 'One of the songs contains special characters. No special characters allowed!';
							} else {
								$this->msg['upd_songs_ok'] = 'ok';
							}
						}							
					}

					//VALIDATING GENRE OPTIONS
					if (empty($data['upd_genre_list'])) {
							$this->msg['upd_genre_list_err'] = 'Product must contain at least 1 genre option';
						} 

					//VALIDATING UPDATE DATE RELEASED INPUT 
					if (empty($data['upd_date_released'])) {
						$this->msg['upd_date_released_err'] = 'Release date can not be left empty!';
					} else {
						$date = $data['upd_date_released'];
						$date_valid = explode('-',$date);
						if(count($date_valid) == 3){
							if(!checkdate($date_valid[1], $date_valid[2], $date_valid[0])){
								$this->msg['upd_date_released_err'] = 'Date format not supported';
							}
						}
					}

					//VALIDATING IMAGE FILE
					if (isset($_FILES['file']) || !empty($_FILES['file'])) {
						$image = $_FILES["file"];													
						$img_format = explode('/', $image['type']);										
						if ($img_format[1] != "jpeg" && $img_format[1] != "jpg" && $img_format[1] != "png" && $img_format[1] != "gif" && $img_format[1] != "bmp") {
							$this->msg['upd_img_err'] = 'Image format not supported';
						} elseif($image['size'] > 3000000){
							$this->msg['upd_img_err'] = 'Image size to big';
						}
					}

					//VALIDATING UPDATE INVENTORY AMOUNT INPUT
					if (!empty($data['upd_inventory_amount'])) {							
						if (!is_numeric($data['upd_inventory_amount'])){
							$this->msg['upd_inventory_amount_err'] = 'Inventory amount must be a number';
						}
					}

					//VALIDATING UPDATE PRICE INPUT
					if (!empty($data['upd_price'])) {
						if (!is_numeric($data['upd_price'])){
							$this->msg['upd_price_err'] = 'Price must be a number';
						} 
					}

					if (!isset($this->msg['product_title_upd_err']) && !isset($this->msg['upd_songs_err']) && !isset($this->msg['upd_artist_err']) && !isset($this->msg['upd_date_released_err']) && !isset($this->msg['upd_img_err']) && !isset($this->msg['upd_inventory_amount_err']) && !isset($this->msg['upd_price_err']) && !isset($this->msg['upd_genre_list_err'])) {
						 	if (isset($image) && !empty($image)) {
						 		$result = $this->adminModel->product_update($data, $image);						 	
						 	} else {
						 		$result = $this->adminModel->product_update($data);
						 	}
						 	

						 	if (isset($result['error'])) {
						 		$this->adminModel->error_log($result['error']);
						 		$this->msg['server_response_err'] = 'There was a problem with updating product. Please try again later.';
						 	} else {
						 		flash('update_success', 'You have successfully updated a product');
								$this->msg['server_response_ok'] = $result;
						 	}



						 	$res = json_encode($this->msg);
							exit($res);
						 }
					
					$res = json_encode($this->msg);
					exit($res);
				}
			} else {
				redirect('pages/index');
			}
		}

		public function product_insert(){
			if (isLoggedIn() == 'admin') {					
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_insert']) && $_POST['product_insert'] == 1){

									
						$data = [
							'ins_title' => test_input($_POST['ins_title']),
							'ins_artist' => test_input($_POST['ins_artist']),
							'ins_description' => $this->purifier->purify($_POST['ins_description']),
							'ins_song_name'	=> json_decode($_POST['ins_song_name']),				
							'ins_single' => test_input($_POST['ins_single']),
							'ins_type' => test_input($_POST['ins_type']),
							'ins_select_genre' =>$_POST['ins_select_genre'],
							'ins_date_released' => test_input($_POST['ins_date_released']),			
							'ins_inventory_amount' => test_input($_POST['ins_inventory_amount']),
							'ins_price' => test_input($_POST['ins_price']),						
						];	
												

						//VALIDATING PRODUCT TITLE INPUT
						$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
						preg_match_all($pattern, $data['ins_title'], $matches, PREG_SET_ORDER, 0);	

						if (empty($data['ins_title'])){
							$this->msg['ins_title_err'] = 'Please enter product title';
						} else if (empty($matches)){
							$this->msg['ins_title_err'] = 'No special characters allowed';
						} else {
							$this->msg['ins_title_ok'] = 'Looks good!';			
						}

						//VALIDATING ARTIST NAME INPUT
						preg_match_all($pattern, $data['ins_artist'], $matches, PREG_SET_ORDER, 0);
						if (empty($data['ins_artist'])) {
							$this->msg['ins_artist_err'] = 'Please enter artist name';
						} elseif (empty($matches)){
							$this->msg['ins_artist_err'] = 'No special characters allowed';
						} else {
							$this->msg['ins_artist_ok'] = 'Looks good!';			
						}

						//VALIDATING SONG NAMES
						$song_check = [];
						foreach ($data['ins_song_name'] as $value) {
							$pattern = "/^([a-zA-Z0-9_\s\-\'\!\?\,\.\(\)\#\&]*)$/";
							preg_match_all($pattern, $value, $matches, PREG_SET_ORDER, 0);
							if (!empty($matches)) {
								array_push($song_check, 'ok');
							} elseif (empty($matches)){
								array_push($song_check, 'not');
							}							
						}

						//VALIDATING SONG NAMES LVL 2
						if (empty($data['ins_song_name'])) {
							$this->msg['ins_song_name_empty'] = 'Please enter song names';
						} elseif (!empty($song_check)){
							$this->msg['ins_song_name_check'] = $song_check;
							foreach ($song_check as $value) {
								if ($value == 'not') {
									$this->msg['ins_song_name_err'] = 'No special characters allowed';
								}
							}							
						} else {
							$this->msg['ins_song_name_ok'] = 'Looks good!';
						}

						//VALIDATING SINGLE SELECT FIELD
						if ($data['ins_single'] == '/') {
							$this->msg['ins_single_err'] = 'Please choose an option';
						} else {
							$this->msg['ins_single_ok'] = 'Looks good!';
						}

						//VALIDATING TYPE SELECT FIELD
						if ($data['ins_type'] == '/') {
							$this->msg['ins_type_err'] = 'Please choose an option';
						} else {
							$this->msg['ins_type_ok'] = 'Looks good!';
						}

						//VALIDATING GENRE SELECT FIELD
						if ($data['ins_select_genre'] == '/' || empty($data['ins_select_genre'])) {
							$this->msg['ins_select_genre_err'] = 'Please choose an option';
						} else {
							$this->msg['ins_select_genre_ok'] = 'Looks good!';
						}

						//VALIDATING DATE RELEASED INPUT 
						if (empty($data['ins_date_released'])) {
							$this->msg['ins_date_released_err'] = 'Please enter release date';
						} else {
							$date = $data['ins_date_released'];
							$date_valid = explode('-',$date);
							if(count($date_valid) == 3){
								if(!checkdate($date_valid[1], $date_valid[2], $date_valid[0])){
									$this->msg['ins_date_released_err'] = 'Date format not supported';
								} else {
									$this->msg['ins_date_released_ok'] = 'Looks good!';
								}
							}
						}

						//VALIDATING IMAGE FILE
						if (isset($_FILES['file']) || !empty($_FILES['file'])) {
							$image = $_FILES["file"];													
							$img_format = explode('/', $image['type']);										
							if ($img_format[1] != "jpeg" && $img_format[1] != "jpg" && $img_format[1] != "png" && $img_format[1] != "gif" && $img_format[1] != "bmp") {
								$this->msg['ins_img_err'] = 'Image format not supported';
							} elseif($image['size'] > 3000000){
								$this->msg['ins_img_err'] = 'Image size to big';
							} else {
								$this->msg['ins_img_ok'] = 'Looks good!';
							}
						} else {
							$this->msg['ins_img_err'] = 'Please choose an image';
						} 			
						
						//VALIDATING INVENTORY AMOUNT INPUT
						if (empty($data['ins_inventory_amount'])) {
							$this->msg['ins_inventory_amount_err'] = 'Please enter inventory amount';
						} elseif (!is_numeric($data['ins_inventory_amount'])){
							$this->msg['ins_inventory_amount_err'] = 'Inventory amount must be a number';
						} else {
							$this->msg['ins_inventory_amount_ok'] = 'Looks good!';
						}

						//VALIDATING PRICE INPUT
						if (empty($data['ins_price'])) {
							$this->msg['ins_price_err'] = 'Please enter product price';
						} elseif (!is_numeric($data['ins_price'])){
							$this->msg['ins_price_err'] = 'Price must be a number';
						} else {
							$this->msg['ins_price_ok'] = 'Looks good!';
						}						

						//CHECKING IF ERROR MESSAGES ARE EMPTY AND IF SO SENDING DATA TO ADMIN MODEL, ALSO DELIVERING MODEL RESPONSE TO VIEW
						if (!isset($this->msg['ins_title_err']) && !isset($this->msg['ins_artist_err']) && !isset($this->msg['ins_description_err']) && !isset($this->msg['ins_song_name_err']) && !isset($this->msg['ins_song_name_empty']) && !isset($this->msg['ins_single_err']) && !isset($this->msg['ins_type_err']) && !isset($this->msg['ins_select_genre_err']) && !isset($this->msg['ins_date_released_err']) && !isset($this->msg['ins_inventory_amount_err']) && !isset($this->msg['ins_price_err']) && !isset($this->msg['ins_img_err'])) {
								$response = $this->adminModel->product_insert($data, $image);										
								if (isset($response['error'])) {
									$this->errorHandlerModel->error_log($response['error']);
									$this->msg['server_response_err'] = 'There was a problem with inserting new product. Please try again later.';
								} elseif(isset($response['ok'])) {
									flash('insert_success', 'You have successfully inserted a new product');
									$this->msg['server_response_ok'] = 'ok';
								}
								

								

								$res = json_encode($this->msg);
								exit($res);
						} else {
							$res = json_encode($this->msg);
							exit($res);
						}


						
				} 

			} else {
					redirect('pages/index');
				}
		}


		public function add_remove_artist(){
			if (isLoggedIn() == 'admin') {
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['artist_delete']) && $_POST['artist_delete'] == 1){
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'art_srch_radio' => test_input($_POST['art_srch_radio']),												
					];


					$res = $this->adminModel->artist_delete($data);


					if (isset($res['error'])) {
						$this->errorHandlerModel->error_log($res['error']);
						$this->msg['serverError'] = 'There was a problem with your attempt to delete an artist. Please try again later';
					} else {
						flash('artist_del_success', 'You have successfully removed an artist');
						$this->msg['server_response_ok'] = 'ok';
					}
				}

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['artist_ins']) && $_POST['artist_ins'] == 1){
					
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					

					$data = [
						'artist_name_ins' => $_POST['artist_name_ins'],												
						'artist_ins_desc' => $this->purifier->purify($_POST['artist_ins_desc']),												
					];
					//VALIDATING IMAGE FILE
					if (isset($_FILES['file']) || !empty($_FILES['file'])) {
						$image = $_FILES["file"];													
						$img_format = explode('/', $image['type']);										
						if ($img_format[1] != "jpeg" && $img_format[1] != "jpg" && $img_format[1] != "png" && $img_format[1] != "gif" && $img_format[1] != "bmp") {
							$this->msg['ins_art_img_err'] = 'Image format not supported';
						} elseif($image['size'] > 3000000){
							$this->msg['ins_art_img_err'] = 'Image size to big';
						} else {
							$this->msg['ins_art_img_ok'] = 'Looks good!';
						}
					} 
					
					if(!empty($data) && isset($data)){
						$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
						preg_match_all($pattern, $data['artist_name_ins'], $matches, PREG_SET_ORDER, 0);
						if (!empty($data['artist_name_ins']) && empty($matches)){
							$this->msg['ins_artist_err'] = 'Artists name contains special characters!No special characters allowed';
						} elseif (empty($data['artist_name_ins'])) {
							$this->msg['ins_artist_err'] = 'Artists name field can not be left empty';
						} else {
							$this->msg['ins_artist_ok'] = 'Looks good!';
						}


					if (!isset($this->msg['ins_artist_err']) && !isset($this->msg['ins_art_img_err'])) {
						$res = $this->adminModel->artist_insert($data,$image);
						if (isset($res['error'])) {
							$this->errorHandlerModel->error_log($res['error']);
							$this->msg['serverError'] = 'There was a problem with your attempt to delete an artist. Please try again later';
						} else {
							flash('artist_ins_success', 'You have successfully added a new artist');
							$this->msg['server_response_ok'] = 'ok';
						}
						
					}						
							
							
					}


					exit(json_encode($this->msg));
				}
				exit(json_encode($this->msg));
			} else {
				redirect('pages/index');
			}
		}

		public function order_processing(){
			if (isLoggedIn() == 'admin') {
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ord_prcs']) && $_POST['ord_prcs'] == 1){
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					if (isset($_POST['btn_inf']) && is_numeric($_POST['btn_inf'])) {
						$data['btn_inf'] = test_input(intval($_POST['btn_inf']));					

						if (!empty($data['btn_inf'])) {
							$res = $this->adminModel->processing_order($data);						
							if (isset($res['error'])) {
								$this->errorHandlerModel->error_log($res['error']);
								$this->msg['serverError'] = 'There was a problem with your attempt to insert this process order. Please try again later';
							} else {
								flash('ord_processed', 'You have successfully processed order');
								$this->msg['server_response_ok'] = 'ok';
							}
						}						
					}

					if (isset($_POST['btn_rmv_inf']) && is_numeric($_POST['btn_rmv_inf'])) {
						$data['btn_rmv_inf'] = test_input(intval($_POST['btn_rmv_inf']));
						if (!empty($data['btn_rmv_inf'])) {
							$res = $this->adminModel->processing_order($data, true);
							if (isset($res['error'])) {
								$this->errorHandlerModel->error_log($res['error']);
								$this->msg['serverError'] = 'There was a problem with your attempt to cancel this process order. Please try again later';
							} else {
								flash('ord_processed', 'You have successfully canceled order');
								$this->msg['server_response_ok'] = 'ok';
							}
						}
					}
				}

				$res = json_encode($this->msg);
				exit($res);
			} else {
				redirect('pages/index');
			}
		}

		public function place_product_sale(){
			if (isLoggedIn() == 'admin') {
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['prod_sale_srch']) && $_POST['prod_sale_srch'] == 1){

					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'srch_sale' => test_input($_POST['srch_sale']),
												
					];

					if (!empty($data['srch_sale']) || isset($data['srch_sale'])) {
						$res = $this->adminModel->product_search_title($data['srch_sale']);
						if ($res) {
							$arr = json_encode($res);
							exit($arr);
						} else if($res == false) {
							$this->msg['search_result'] = 'false';
							$result = json_encode($this->msg['search_result']);
							exit($result);
						}
					}

				}			

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sale_submit']) && $_POST['sale_submit'] == 1) {

					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'prod_id' => test_input($_POST['prod_id']),
						'discount' => test_input($_POST['discount']),
						'duration' => test_input($_POST['duration']),
						'duration_db' => test_input($_POST['duration'])  * 86400,
						'starting_point' => time(),
					];

					if (empty($data['discount'])) {
						$this->msg['discount_err'] = 'Please enter discount precentage';
					} elseif (!is_numeric($data['discount'])){
						$this->msg['discount_err'] = 'Discount precentage must be a number';
					} else {
						$this->msg['discount_ok'] = 'Looks good!';
					}

					if (empty($data['duration'])) {
						$this->msg['duration_err'] = 'Please enter discount duration';
					} elseif (!is_numeric($data['duration'])){
						$this->msg['duration_err'] = 'Duration input must be a number';
					} else {
						$this->msg['duration_ok'] = 'Looks good!';
					}
					
					if (!isset($this->msg['discount_err']) && !isset($this->msg['duration_err'])) {
						$res = $this->adminModel->product_sale($data);
						if (isset($res['error'])) {
							$this->errorHandlerModel->error_log($res['error']);
							$this->msg['serverError'] = 'There was a problem with your attempt to create a new product sale. Please try again later';
						} else {
							flash('sale_success', 'You have successfully created a new product sale');
							$this->msg['server_response_ok'] = 'ok';
						}					
					}					
					exit(json_encode($this->msg));
				}				
				
			}
		}

		public function permission_change(){
			if (isLoggedIn() == 'admin') {
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['perm_chng']) && $_POST['perm_chng'] == 1){
					$data = [
						'per_sel' => test_input($_POST['per_sel']),
						'id' => test_input($_POST['id']),
					];

					$res = $this->adminModel->change_permission($data['id'], $data['per_sel']);
					if (isset($res['error'])) {
						$this->errorHandlerModel->error_log($res['error']);
						$this->msg['serverError'] = 'There was a problem with your attempt to update user permission. Please try again later';
					} else {
						$this->msg['server_response_ok'] = 'ok';
					}
					exit(json_encode($this->msg));
				}				
			}
		}

		public function best_seller(){
			if (isLoggedIn() == 'admin') {
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['best_sell']) && $_POST['best_sell'] == 1){
					$res = $this->postModel->getProductsBestSell();
					exit(json_encode($res));
				}				
			}
		}

		public function mailbox(){
			if (isLoggedIn() == 'admin') {
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rmv_mail']) && $_POST['rmv_mail'] == 1){
					$data['id'] = test_input($_POST['id']);

					if (isset($data['id'])) {
						$res = $this->adminModel->removeMail($data['id']);
						if (isset($res['error'])) {
							$this->errorHandlerModel->error_log($res['error']);
							$this->msg['serverError'] = 'not';
						} else {
							$this->msg['server_response_ok'] = 'ok';
						}
					}
						exit(json_encode($this->msg));
				}
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mailbox']) && $_POST['mailbox'] == 1){
					$data['id'] = test_input($_POST['id']);

					$res = $this->adminModel->changeMailStatus($data['id']);
					if (isset($res['error'])) {
						$this->errorHandlerModel->error_log($res['error']);
						$this->msg['serverError'] = 'not';
					} else {
						$this->msg['server_response_ok'] = 'ok';
					}
					exit(json_encode($this->msg));
				}

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['outbox']) && $_POST['outbox'] == 1){
					$data = [
						'to' => test_input($_POST['to']),
						'subject' => test_input($_POST['subject']),
						'message' => $this->purifier->purify($_POST['message']),
					];

					if (empty($data['to'])) {
						$this->msg['to_err'] = 'Please enter email';
					} elseif (!filter_var($_POST['to'], FILTER_VALIDATE_EMAIL)) {
						$this->msg['to_err'] = 'Email format not supported';
					} else {
						$this->msg['to_ok'] = 'Looks good!';
					}

					$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
					preg_match_all($pattern, $data['subject'], $matches, PREG_SET_ORDER, 0);
					if (empty($data['subject'])) {
						$this->msg['subject_err'] = 'Please enter message subject';
					} elseif (!empty($data['subject']) && empty($matches)) {
						$this->msg['subject_err'] = 'Your subject contains special characters!No special characters allowed';
					} else {
						$this->msg['subject_ok'] = 'Looks Good!';
					}

					if (!isset($this->msg['to_err']) && !isset($this->msg['subject_err'])) {
						$res = $this->adminModel->sentMail($data);
						if (isset($res['error'])) {
							$this->errorHandlerModel->error_log($res['error']);
							$this->msg['server_response_err'] = 'not';
						} else {
							//$to = $data['to'];
							//$subject = $data['subject'];
							//$message = $data['message'];
							// $res = mail($to, $subject, $message);
							$this->msg['server_response_ok'] = 'ok';
						}
					}



					exit(json_encode($this->msg));
				}				
			}
		}

		public function user_img_edit(){			
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['img_change']) && $_POST['img_change'] == 1){
				//VALIDATING IMAGE FILE
				if (isset($_FILES['file']) || !empty($_FILES['file'])) {
					$image = $_FILES["file"];													
					$img_format = explode('/', $image['type']);		
					if (!empty($img_format[1])) {
						if ($img_format[1] != "jpeg" && $img_format[1] != "jpg" && $img_format[1] != "png" && $img_format[1] != "gif" && $img_format[1] != "bmp") {
							$this->msg['img_err'] = 'Image format not supported';
						} elseif($image['size'] > 3000000){
							$this->msg['img_err'] = 'Image size to big';
						} else {
							$this->msg['img_ok'] = 'Looks good!';
						}						
					} else {
						$this->msg['img_err'] = 'Image format not supported';
					}							
				} else {
					$this->msg['img_err'] = 'Please choose an image';
				} 

				if (!isset($this->msg['img_err'])) {
					$res = $this->adminModel->change_user_img($image);
					if (isset($res['error'])) {
						$this->errorHandlerModel->error_log($res['error']);
						$this->msg['server_response_err'] = 'not';
					} else {
						$_SESSION['user']->img_url = $res['img_url'];						
						$this->msg['server_response_ok'] = 'ok';
					}

				}
				exit(json_encode($this->msg));
			}			
		}

		public function user_info_change(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fn_change']) && $_POST['fn_change'] == 1){
				$data['new_fn'] = test_input($_POST['new_fn']);
				//Validate first_name 
				$pattern = "/^(([A-za-z]+[\s]{1}[A-za-z]+)|([A-Za-z]+))$/";
				preg_match_all($pattern, $data['new_fn'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['new_fn'])) {
					$this->msg['new_fn_err'] = 'Please enter your first name';
				} elseif (empty($matches)) {
					$this->msg['new_fn_err'] = 'First name can not contain special characters or numbers';
				} else {
					$this->msg['new_fn_ok'] = 'Looks good!';
				}

				if (!isset($this->msg['new_fn_err'])) {
					if ($data['new_fn'] != $_SESSION['user']->first_name) {
						$res = $this->adminModel->user_info_change($data);
						if (isset($res['error'])) {
							$this->errorHandlerModel->error_log($res['error']);
							$this->msg['server_response_err'] = 'not';
						} else {
							$_SESSION['user']->first_name = $res['first_name'];						
							$this->msg['server_response_ok'] = 'ok';
						}						
					} else {
						$this->msg['new_fn_err'] = 'First name can not stay the same';
					}
				}
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ln_change']) && $_POST['ln_change'] == 1){
				$data['new_ln'] = test_input($_POST['new_ln']);
				//Validate first_name 
				$pattern = "/^(([A-za-z]+[\s]{1}[A-za-z]+)|([A-Za-z]+))$/";
				preg_match_all($pattern, $data['new_ln'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['new_ln'])) {
					$this->msg['new_ln_err'] = 'Please enter your last name';
				} elseif (empty($matches)) {
					$this->msg['new_ln_err'] = 'Last name can not contain special characters or numbers';
				} else {
					$this->msg['new_ln_ok'] = 'Looks good!';
				}

				if (!isset($this->msg['new_ln_err'])) {
					if ($data['new_ln'] != $_SESSION['user']->last_name) {
						$res = $this->adminModel->user_info_change($data);
						if (isset($res['error'])) {
							$this->errorHandlerModel->error_log($res['error']);
							$this->msg['server_response_err'] = 'not';
						} else {
							$_SESSION['user']->last_name = $res['last_name'];						
							$this->msg['server_response_ok'] = 'ok';
						}						
					} else {
						$this->msg['new_ln_err'] = 'Last name can not stay the same';
					}
				}
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['us_change']) && $_POST['us_change'] == 1){
				$data['new_us'] = test_input($_POST['new_us']);
				//Validate username
				$new_us = $this->userModel->findUserByUsername($data['new_us']);
				$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/';
				preg_match_all($pattern, $data['new_us'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['new_us'])) {
					$this->msg['new_us_err'] = 'Please enter new_us';
				} elseif (empty($matches)) {
					$this->msg['new_us_err'] = 'Username format not supported';
				} elseif ($new_us === $data['new_us']){				
						$this->msg['new_us_err'] = 'Username is already being used';				
				} else {
					$this->msg['new_us_ok'] = 'Looks good!';
				}

				if (!isset($this->msg['new_us_err'])) {
					if ($data['new_us'] != $_SESSION['user']->username) {
						$res = $this->adminModel->user_info_change($data);
						if (isset($res['error'])) {
							$this->errorHandlerModel->error_log($res['error']);
							$this->msg['server_response_err'] = 'not';
						} else {
							$_SESSION['user']->username = $res['username'];						
							$this->msg['server_response_ok'] = 'ok';
						}						
					} else {
						$this->msg['new_us_err'] = 'Username can not stay the same';
					}
				}
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['em_change']) && $_POST['em_change'] == 1){
				$data['new_em'] = test_input($_POST['new_em']);
				//validate email			
				if (empty($data['new_em'])) {
					$this->msg['new_em_err'] = 'Please enter Email';
				} elseif (!filter_var($_POST['new_em'], FILTER_VALIDATE_EMAIL)) {
					$this->msg['new_em_err'] = 'Email format not supported';
				} elseif($this->userModel->findUserByEmailRegistration($data['new_em'])) {				
						$this->msg['new_em_err'] = 'Email is already being used';				
				} else {
					$this->msg['new_em_ok'] = 'Looks good!';
				}

				if (!isset($this->msg['new_em_err'])) {
					if ($data['new_em'] != $_SESSION['user']->email) {
						$res = $this->adminModel->user_info_change($data);
						if (isset($res['error'])) {
							$this->errorHandlerModel->error_log($res['error']);
							$this->msg['server_response_err'] = 'not';
						} else {
							$_SESSION['user']->email = $res['email'];						
							$this->msg['server_response_ok'] = 'ok';
						}						
					} else {
						$this->msg['new_us_err'] = 'Email can not stay the same';
					}
				}
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pass_change']) && $_POST['pass_change'] == 1){
				$data = [
					'old_pass' => test_input($_POST['old_pass']),
					'old_pass_r' => test_input($_POST['old_pass_r']),
					'new_pass' => test_input($_POST['new_pass'])
				];

				//validate password
				$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/';
				preg_match_all($pattern, $data['old_pass'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['old_pass'])) {
					$this->msg['old_pass_err'] = 'Please enter password';
				} elseif (empty($matches)) {
					$this->msg['old_pass_err'] = 'Password format not supported';
				} else {
					$this->msg['old_pass_ok'] = 'Looks good!';
				}

				preg_match_all($pattern, $data['old_pass_r'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['old_pass_r'])) {
					$this->msg['old_pass_r_err'] = 'Please confirm password';
				} elseif ($data['old_pass'] != $data['old_pass_r']){			
						$this->msg['old_pass_r_err'] = 'Passwords do not match';				
						$this->msg['old_pass_err'] = 'Passwords do not match';				
				} elseif(empty($matches)) {
					$this->msg['old_pass_r_err'] = 'Password format not supported';				
				} else {
					$this->msg['old_pass_r_ok'] = 'Looks good!';
				}

				preg_match_all($pattern, $data['new_pass'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['new_pass'])) {
					$this->msg['new_pass_err'] = 'Please enter password';
				} elseif (empty($matches)) {
					$this->msg['new_pass_err'] = 'Password format not supported';
				} else {
					$this->msg['new_pass_ok'] = 'Looks good!';
				}

				if (!isset($this->msg['old_pass_err']) && !isset($this->msg['old_pass_r_err']) && !isset($this->msg['new_pass_err'])) {
					if ($data['old_pass'] != $data['new_pass']) {
						$res = $this->adminModel->password_check($data['old_pass']);
						if ($res) {
							$data['new_pass'] = password_hash($data['new_pass'], PASSWORD_DEFAULT);

							$res = $this->adminModel->user_info_change($data);							
							if (isset($res['error'])) {
								$this->errorHandlerModel->error_log($res['error']);
								$this->msg['server_response_err'] = 'not';
							} else {													
								$this->msg['server_response_ok'] = 'ok';
							}
						} else {
							$this->msg['old_pass_err'] = 'Invalid Password';
							$this->msg['old_pass_r_err'] = 'Invalid Password';
						}						
					} else {
						$this->msg['new_pass_err'] = 'You must choose a new password to change the old one';
					} 
				}

			}

			exit(json_encode($this->msg));
		}

		public function user_address_update(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_upd']) && $_POST['add_upd'] == 1){
				$data = [
					'address' => test_input($_POST['address']),
					'postal_code' => test_input($_POST['postal_code']),
					'city' => test_input($_POST['city']),
					'country' => test_input($_POST['country']),
					'phone' => test_input($_POST['phone']),
				];

				//validate address
				$pattern = '/^(([A-za-z0-9,\s]+[\s]{1}[A-za-z0-9]+)|([A-Za-z0-9]+))$/';
				preg_match_all($pattern, $data['address'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['address'])) {
					$this->msg['address_err'] = 'Please enter your address';
				} elseif (empty($matches)) {
					$this->msg['address_err'] = 'Address format not supported';
				} else {
					$this->msg['address_ok'] = 'Looks good!';
				}

				//validate city
				$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
				preg_match_all($pattern, $data['city'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['city'])) {
					$this->msg['city_err'] = 'Please enter a city name';
				} elseif (empty($matches)) {
					$this->msg['city_err'] = 'City name can not contain special characters';
				} else {
					$this->msg['city_ok'] = 'Looks good!';
				}

				//validate postal_code
				$pattern = '/^[0-9]{0,7}$/';
				preg_match_all($pattern, $data['postal_code'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['postal_code'])) {					
					$this->msg['postal_code_err'] = 'Please enter your postal code';
				} elseif (empty($matches)) {
					$this->msg['postal_code_err'] = 'Postal code format not supported';	
				} else {
					$this->msg['postal_code_ok'] = 'Looks good!';
				}

				//validate country
				$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
				preg_match_all($pattern, $data['country'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['country'])) {
					$this->msg['country_err'] = 'Please enter country name';
				} elseif (empty($matches)) {
					$this->msg['country_err'] = 'Country name can not contain special characters';
				} else {
					$this->msg['country_ok'] = 'Looks good!';
				}

				//validate phone
				$pattern = '/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/';
				preg_match_all($pattern, $data['phone'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['phone'])) {
					$this->msg['phone_err'] = 'Please enter your phone number';
				} elseif (empty($matches)) {
					$this->msg['phone_err'] = 'Phone number format not supported';
				} else {
					$this->msg['phone_ok'] = 'Looks good!';
				}

				if (!isset($this->msg['address_err']) && !isset($this->msg['postal_code_err']) && !isset($this->msg['city_err']) && !isset($this->msg['country_err']) && !isset($this->msg['phone_err'])) {
					$id = $_SESSION['user']->id;
					$res = $this->adminModel->user_address_upd($id, $data);

					if (isset($res['error'])) {
						$this->errorHandlerModel->error_log($res['error']);
						$this->msg['server_response_err'] = 'not';
					} else {						
						$this->msg['server_response_ok'] = 'ok';
					}	
				}

				exit(json_encode($this->msg));
			}
		}


	}