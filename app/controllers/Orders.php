<?php 

	class Orders extends Controller{
		public $msg = [];
		public function __construct(){
			$this->postModel = $this->model('Post');			
			$this->orderModel = $this->model('Order');	
			$this->userModel = $this->model('User');	

			$this->config = HTMLPurifier_Config::createDefault();
			$this->purifier = new HTMLPurifier($this->config);		
		}

		public function cart(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['single_cart']) && $_POST['single_cart'] == 1){
				$data = [];

				if (isset($_POST['rmv_btn'])) {
					$data['rmv_btn'] = test_input(intval($_POST['rmv_btn']));
					if (!is_numeric($data['rmv_btn'])) {						
						unset($data['rmv_btn']);
					}					
				}

				if (isset($_POST['single_quantity'])  && isset($_POST['single_id'])) {
					$data['single_quantity'] = test_input($_POST['single_quantity']);
					$data['single_id'] = test_input($_POST['single_id']);

					$inventory_check = $this->postModel->getSingleProduct($data['single_id']);
					if (empty($data['single_quantity'])) {
						$this->msg['single_quantity_err'] = 'Quantity can not be left empty';
					} elseif (!is_numeric($data['single_quantity'])){
						$this->msg['single_quantity_err'] = 'Quantity must be expressed in numbers';
					} elseif ($data['single_quantity'] > $inventory_check->inventory_presented) {
						$this->msg['single_quantity_err'] = 'Unfortunately you are trying to order more items than we can offer at the moment';
					} elseif ($data['single_quantity'] == 0) {
						$this->msg['single_quantity_err'] = 'Quantity must be more than zero';
					}
					
					if (!isset($this->msg['single_quantity_err']) && empty($this->msg['single_quantity_err'])) {
					 	$prod_info = $this->postModel->getSingleProduct($data['single_id']);
					 	$key = $prod_info->id; 
					 	
					 	$_SESSION['cart'][$key] = [];
					 	$_SESSION['cart'][$key]['id'] = $key; 
					 	$_SESSION['cart'][$key]['product_title'] = $prod_info->title; 
					 	$_SESSION['cart'][$key]['unit_price'] = $prod_info->price;
					 	$unit_price = floatval($_SESSION['cart'][$key]['unit_price']); 
					 	$_SESSION['cart'][$key]['quantity'] = $data['single_quantity'];
					 	$quantity = floatval($_SESSION['cart'][$key]['quantity']);
					 	$_SESSION['cart'][$key]['price'] = $quantity * $unit_price;					 	
					 	$_SESSION['cart_count'] = '';


					 	$var = [];
					 	$this->msg['cart_info'] = [];
					 	$_SESSION['cart_total'] = 0;
					 	foreach ($_SESSION['cart'] as $key => $value) {
					 		$var[] = $value;
					 		$_SESSION['cart_count'] = count($var);
					 		$_SESSION['cart_total'] += $value['price'];
					 		$this->msg['cart_info'][] = $value;

					 	}


				 		$this->msg['cart_total'] = $_SESSION['cart_total'];
				 		$this->msg['cart_counter'] = $_SESSION['cart_count'];

					} 
					
				}
			 	if (isset($data['rmv_btn'])) {
			 		unset($_SESSION['cart'][$data['rmv_btn']]);
			 		$var = [];
				 	$this->msg['cart_info'] = [];
				 	$_SESSION['cart_total'] = 0;
				 	foreach ($_SESSION['cart'] as $key => $value) {
				 		$var[] = $value;
				 		$_SESSION['cart_count'] = count($var);
				 		$_SESSION['cart_total'] += $value['price'];
				 		$this->msg['cart_info'][] = $value;

				 	}
			 		$this->msg['cart_total'] = $_SESSION['cart_total'];
			 		$this->msg['cart_counter'] = $_SESSION['cart_count'];		 		
			 		if (empty($_SESSION['cart'])) {
			 			unset($_SESSION['cart_count']);
			 			unset($_SESSION['cart_total']);
			 			unset($this->msg['cart_counter']);
			 			unset($this->msg['cart_total']);
			 		}
			 	}
				exit(json_encode($this->msg));

			}


		}

		public function checkout_form(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout_form']) && $_POST['checkout_form'] == 1){


				$data = [
					'co_email' => test_input($_POST['co_email']),
					'co_first_name' => test_input($_POST['co_first_name']),
					'co_last_name' => test_input($_POST['co_last_name']),
					'co_address' => test_input($_POST['co_address']),
					'co_city' => test_input($_POST['co_city']),
					'co_postal_code' => test_input($_POST['co_postal_code']),
					'co_country' => test_input($_POST['co_country']),
					'co_phone_num' => test_input($_POST['co_phone_num']),
					'co_remark' => $this->purifier->purify($_POST['co_remark']),
				];			

				//validate email			
				if (empty($data['co_email'])) {
					$this->msg['co_email_err'] = 'Please enter email';
				} elseif (!filter_var($_POST['co_email'], FILTER_VALIDATE_EMAIL)) {
					$this->msg['co_email_err'] = 'Email format not supported';
				} else {
					$this->msg['co_email_ok'] = 'Looks good!';
				}

				//Validate first_name 
				$pattern = "/^(([A-za-z]+[\s]{1}[A-za-z]+)|([A-Za-z]+))$/";
				preg_match_all($pattern, $data['co_first_name'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['co_first_name'])) {
					$this->msg['co_first_name_err'] = 'Please enter your first name';
				} elseif (empty($matches)) {
					$this->msg['co_first_name_err'] = 'First name can not contain special characters or numbers';
				} else {
					$this->msg['co_first_name_ok'] = 'Looks good!';
				}

				//validate last name
				preg_match_all($pattern, $data['co_last_name'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['co_last_name'])) {
					$this->msg['co_last_name_err'] = 'Please enter your last name';
				} elseif (empty($matches)) {
					$this->msg['co_last_name_err'] = 'Last name can not contain special characters or numbers';
				} else {
					$this->msg['co_last_name_ok'] = 'Looks good!';
				}

				//validate address
				$pattern = '/^(([A-za-z0-9,\s]+[\s]{1}[A-za-z0-9]+)|([A-Za-z0-9]+))$/';
				preg_match_all($pattern, $data['co_address'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['co_address'])) {
					$this->msg['co_address_err'] = 'Please enter your address';
				} elseif (empty($matches)) {
					$this->msg['co_address_err'] = 'Address format not supported';
				} else {
					$this->msg['co_address_ok'] = 'Looks good!';
				}

				//validate city
				$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
				preg_match_all($pattern, $data['co_city'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['co_city'])) {
					$this->msg['co_city_err'] = 'Please enter a city name';
				} elseif (empty($matches)) {
					$this->msg['co_city_err'] = 'City name can not contain special characters';
				} else {
					$this->msg['co_city_ok'] = 'Looks good!';
				}

				//validate postal_code
				$pattern = '/^[0-9]{0,7}$/';
				preg_match_all($pattern, $data['co_postal_code'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['co_postal_code'])) {					
					$this->msg['co_postal_code_err'] = 'Please enter your postal code';
				} elseif (empty($matches)) {
					$this->msg['co_postal_code_err'] = 'Postal code format not supported';	
				} else {
					$this->msg['co_postal_code_ok'] = 'Looks good!';
				}

				//validate country
				$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
				preg_match_all($pattern, $data['co_country'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['co_country'])) {
					$this->msg['co_country_err'] = 'Please enter country name';
				} elseif (empty($matches)) {
					$this->msg['co_country_err'] = 'Country name can not contain special characters';
				} else {
					$this->msg['co_country_ok'] = 'Looks good!';
				}

				//validate phone
				$pattern = '/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/';
				preg_match_all($pattern, $data['co_phone_num'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['co_phone_num'])) {
					$this->msg['co_phone_num_err'] = 'Please enter your phone number';
				} elseif (empty($matches)) {
					$this->msg['co_phone_num_err'] = 'Phone number format not supported';
				} else {
					$this->msg['co_phone_num_ok'] = 'Looks good!';
				}

				if (!isset($this->msg['co_email_err']) && !isset($this->msg['co_first_name_err']) && !isset($this->msg['co_last_name_err']) && !isset($this->msg['co_address_err']) && !isset($this->msg['co_city_err']) && !isset($this->msg['co_postal_code_err']) && !isset($this->msg['co_country_err']) && !isset($this->msg['co_phone_num_err'])) {


					$res = $this->orderModel->cart_processing($data);					
					if (count(array_unique($res)) === 1){
						$res = current($res);
						if ($res) {
							unset($_SESSION['cart']);
							unset($_SESSION['cart_info']);
							unset($_SESSION['cart_total']);
							unset($_SESSION['cart_count']);
							$this->msg['cart_processed'] = 'Your order has been sent. Thank you for your purchase!';
						} else {
							$this->msg['cart_fail'] = 'Unfortunately your order failed to reach us. Please try again later';
						}
					} else {
						$this->msg['cart_fail'] = 'Unfortunately your order failed to reach us. Please try again later';
					}

					
				}

				exit(json_encode($this->msg));
			} 

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reg_us_btn']) && $_POST['reg_us_btn'] == 1 && isset($_POST['ses_check']) && $_POST['ses_check'] == 2) {
				
			
					$data = [
						'co_id' => $_SESSION['user']->id,					
						'co_first_name' => $_SESSION['user']->first_name,					
						'co_last_name' => $_SESSION['user']->last_name,					
						'co_email' => $_SESSION['user']->email,
						'co_id_address' => $_SESSION['user']->id_address,
						'reg_us_remark' => $this->purifier->purify($_POST['reg_us_remark']),
					];


					
					$res = $this->orderModel->cart_processing($data, true);
					if ($res == 'not_registered') {
						exit(json_encode('not_registered'));
					} else {						
						if (count(array_unique($res)) === 1){
							$res = current($res);					
							if ($res) {
								unset($_SESSION['cart']);
								unset($_SESSION['cart_info']);
								unset($_SESSION['cart_total']);
								unset($_SESSION['cart_count']);
								$this->msg['cart_processed'] = 'Your order has been sent. Thank you for your purchase!';
							} else {
								$this->msg['cart_fail'] = 'Unfortunately your order failed to reach us. Please try again later';
							}
						} else {
							$this->msg['cart_fail'] = 'Unfortunately your order failed to reach us. Please try again later';
						}												
					}							
				
				exit(json_encode($this->msg));
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout_form_na_user']) && $_POST['checkout_form_na_user'] == 1) {
				$data = [
					'new_address' => 1,
					'co_id' => $_SESSION['user']->id,
					'co_first_name' => $_SESSION['user']->first_name,									
					'co_address' => test_input($_POST['co_address']),
					'co_city' => test_input($_POST['co_city']),
					'co_postal_code' => test_input($_POST['co_postal_code']),
					'co_country' => test_input($_POST['co_country']),
					'co_phone_num' => test_input($_POST['co_phone_num']),
					'co_remark' => $this->purifier->purify($_POST['co_remark']),
				];

				//validate address
				$pattern = '/^(([A-za-z0-9,\s]+[\s]{1}[A-za-z0-9]+)|([A-Za-z0-9]+))$/';
				preg_match_all($pattern, $data['co_address'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['co_address'])) {
					$this->msg['co_address_err'] = 'Please enter your address';
				} elseif (empty($matches)) {
					$this->msg['co_address_err'] = 'Address format not supported';
				} else {
					$this->msg['co_address_ok'] = 'Looks good!';
				}

				//validate city
				$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
				preg_match_all($pattern, $data['co_city'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['co_city'])) {
					$this->msg['co_city_err'] = 'Please enter a city name';
				} elseif (empty($matches)) {
					$this->msg['co_city_err'] = 'City name can not contain special characters';
				} else {
					$this->msg['co_city_ok'] = 'Looks good!';
				}

				//validate postal_code
				$pattern = '/^[0-9]{0,7}$/';
				preg_match_all($pattern, $data['co_postal_code'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['co_postal_code'])) {					
					$this->msg['co_postal_code_err'] = 'Please enter your postal code';
				} elseif (empty($matches)) {
					$this->msg['co_postal_code_err'] = 'Postal code format not supported';	
				} else {
					$this->msg['co_postal_code_ok'] = 'Looks good!';
				}

				//validate country
				$pattern = "/^([a-zA-Z0-9_\s\-\']*)$/";
				preg_match_all($pattern, $data['co_country'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['co_country'])) {
					$this->msg['co_country_err'] = 'Please enter country name';
				} elseif (empty($matches)) {
					$this->msg['co_country_err'] = 'Country name can not contain special characters';
				} else {
					$this->msg['co_country_ok'] = 'Looks good!';
				}

				//validate phone
				$pattern = '/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/';
				preg_match_all($pattern, $data['co_phone_num'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['co_phone_num'])) {
					$this->msg['co_phone_num_err'] = 'Please enter your co_phone_num number';
				} elseif (empty($matches)) {
					$this->msg['co_phone_num_err'] = 'Phone number format not supported';
				} else {
					$this->msg['co_phone_num_ok'] = 'Looks good!';
				}

				if (!isset($this->msg['co_address_err']) && !isset($this->msg['co_city_err']) && !isset($this->msg['co_postal_code_err']) && !isset($this->msg['co_country_err']) && !isset($this->msg['co_phone_num_err'])) {

					$res = $this->orderModel->cart_processing($data,true);							
					if (count(array_unique($res)) === 1){
						$res = current($res);					
						if ($res) {
							unset($_SESSION['cart']);
							unset($_SESSION['cart_info']);
							unset($_SESSION['cart_total']);
							unset($_SESSION['cart_count']);
							$this->msg['cart_processed'] = 'Your order has been sent. Thank you for your purchase!';
						} else {
							$this->msg['cart_fail'] = 'Unfortunately your order failed to reach us. Please try again later';
						}
					} else {
						$this->msg['cart_fail'] = 'Unfortunately your order failed to reach us. Please try again later';
					}

				}

				exit(json_encode($this->msg));

			}
		}
	}