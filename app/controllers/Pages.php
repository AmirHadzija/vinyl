<?php 	
	
	class Pages extends Controller{
		public function __construct(){
			$this->postModel = $this->model('Post');
			$this->errorHandlerModel = $this->model('ErrorHandler');

			$this->config = HTMLPurifier_Config::createDefault();
			$this->purifier = new HTMLPurifier($this->config);
		}

		public function index(){
	
			
			$data = [
				'products' =>$this->postModel->getProducts(),
				'products_genres' => $this->postModel->getProductGenres(),
				'populate_slider' => $this->postModel->populateSlider(),		
				'sales' => $this->postModel->getSales(),		
				];


				

			$this->view('pages/index', $data);
		}

		public function single(){
			if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){

			$product_id = test_input($_GET['id']);
			$prod_check = $this->postModel->getSingleProduct($product_id);

			if (!is_numeric($product_id)) {
				redirect('pages/index');
			} elseif (!$prod_check->id){
				redirect('pages/index');
			}

			$data = [
				'product_info' => $this->postModel->getSingleProduct($product_id),
				'product_genre' => $this->postModel->getProductGenresSingle($product_id),
				'sales' => $this->postModel->getSales(),
			];

							
			
			
			$this->view('pages/single', $data);
			} 
		}

		public function page_selector(){
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pg_slc']) && $_POST['pg_slc'] == 1){
				$data = [
					'nav_id' => test_input($_POST['nav_id']),
				];

				$data_split = explode('_', $data['nav_id']);

				$all_id = $this->postModel->getAllProductId();
				$processed = array();
				foreach($all_id as $subarr) {
				   foreach($subarr as $id => $value) {
				      if(!isset($processed[$id])) {
				         $processed[$id] = array();
				      }
				      $processed[$id][] = $value;
				   }
				}
				

				if ($data_split[0] == 'previous') {
					$id = $data_split[1];
					$position = array_search($id, $processed['id']);
					if ($position > 0) {
						$new_pos = $position - 1;
					} elseif ($position == 0){
						$new_pos = count($all_id) - 1;
					}					
					$prev_id = 	$all_id[$new_pos];	
					exit(json_encode($prev_id));					
				} elseif ($data_split[0] == 'next') {
					$id = $data_split[1];
					$position = array_search($id, $processed['id']);
					if ($position == count($all_id)-1) {
						$new_pos = 0;
					} elseif ($position >= 0){
						$new_pos = $position + 1;
					}					
					$next_id = 	$all_id[$new_pos];				
					exit(json_encode($next_id));
				}

			}
		}

		public function contact_form(){
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cont_form']) && $_POST['cont_form'] == 1){
				$data = [
					'name' => test_input($_POST['name']),
					'email' => test_input($_POST['email']),
					'subj' => test_input($_POST['subj']),
					'mess' => $this->purifier->purify($_POST['mess']),
				];

				//validate name
				$pattern = "/^(([A-za-z]+[\s]{1}[A-za-z]+)|([A-Za-z]+))$/";
				preg_match_all($pattern, $data['name'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['name'])) {
					$this->msg['name_err'] = 'Please enter your name';
				} elseif (empty($matches)) {
					$this->msg['name_err'] = 'Name you are submiting can not contain special characters or numbers';
				} else {
					$this->msg['name_ok'] = 'Looks good!';
				}


				//validate email			
				if (empty($data['email'])) {
					$this->msg['email_err'] = 'Please enter email';
				} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$this->msg['email_err'] = 'Email format not supported';
				} else {
					$this->msg['email_ok'] = 'Looks good!';
				}

				//validate subject
				$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
				preg_match_all($pattern, $data['subj'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['subj'])) {
					$this->msg['subj_err'] = 'Please enter message subject';
				} elseif (!empty($data['subj']) && empty($matches)) {
					$this->msg['subj_err'] = 'Your subject contains special characters!No special characters allowed';
				} else {
					$this->msg['subj_ok'] = 'Looks Good!';
				}

				//validate message
				if (empty($data['mess']) || !isset($data['mess'])) {
					$this->msg['mess_err'] = 'Message can not be empty';
				} else {
					$this->msg['mess_ok'] = 'Looks Good!';
				}

				if (!isset($this->msg['mess_err']) && !isset($this->msg['subj_err']) && !isset($this->msg['email_err']) && !isset($this->msg['name_err'])) {
					$res = $this->postModel->contact_form($data);
					if (isset($res['error'])) {
				 		$this->errorHandlerModel->error_log($res['error']);
				 		$this->msg['server_response_err'] = 'There was a problem submiting your contact form. Please try again later.';
				 	} else {
				 		flash('update_success', 'You have successfully updated a product');
						$this->msg['server_response_ok'] = $res;
				 	}

					
				}

				exit(json_encode($this->msg));
			}
		}

	}