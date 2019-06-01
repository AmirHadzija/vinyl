<?php 

	class Order{
		private $db;


		public function __construct(){
			$this->db = new Database;
		}

		public function cart_processing($data, $logged_in = false){
			if ($logged_in === false) {
				$first_name = $data['co_first_name'];
				$last_name = $data['co_last_name'];				
				$email = $data['co_email'];
				$address = $data['co_address'];
				$city = $data['co_city'];
				$sql = "SELECT id FROM city WHERE city = '$city'";
				$res = $this->db->get_row($sql, true);
				if ($res) {
					$city_id = $res->id;					
				} else {
					$city_id ='null';
				}
				$country = $data['co_country'];
				$sql = "SELECT id FROM country WHERE country = '$country'";
				$res = $this->db->get_row($sql, true);
				if ($res) {
					$country_id = $res->id;					
				} else {
					$country_id ='null';
				}
				$postal_code = $data['co_postal_code'];
				$phone = $data['co_phone_num'];
				$order_notes = $this->db->clear($data['co_remark']);
				$total = $_SESSION['cart_total'];

				$sql = "SELECT id FROM users WHERE email = '$email'";
				$res = $this->db->get_row($sql);
				$db_id = $res[0];
				if (!empty($db_id)) {
					$sql = "SELECT permission FROM users WHERE id = $db_id";
					$res = $this->db->get_row($sql, true);
					$permission = $res->permission;
					if (isset($permission) && $permission === 'not_registered') {

						$sql = "SELECT * FROM users WHERE id = $db_id";
						$user_info = $this->db->get_row($sql, true);
						$db_first_name = $user_info->first_name;
						$db_last_name = $user_info->last_name;
						$db_email = $user_info->email;
						$db_id_address = $user_info->id_address;

						$sql = "SELECT * FROM address WHERE id = $db_id_address";
						$res = $this->db->get_row($sql,true);
						$db_address = $res->address1;
						$db_postal_code = $res->postal_code;
						$db_phone = $res->phone;
						$db_id_city = $res->id_city;					

						
						if (($db_address != $address || $db_postal_code != $postal_code || $db_phone != $phone || $db_id_city != $city_id) && ($first_name == $db_first_name && $last_name == $db_last_name && $email == $db_email)) {

							$sql = "SELECT id FROM country WHERE country = '$country'";
							$country_id = $this->db->get_row($sql);
							if (!$country_id[0]) {		
								$sql = "INSERT INTO country (country) VALUES ('$country')";
								$this->db->query($sql);
								$sql = "SELECT id FROM country ORDER BY id DESC LIMIT 1";
								$country_id = $this->db->get_row($sql);								
							}

							
							$sql = "SELECT id FROM city WHERE city = '$city'";
							$res = $this->db->get_row($sql);

							if (!$res) {				
								$sql = "INSERT INTO city (city, id_country) VALUES ('$city',$country_id[0])";
								$this->db->query($sql);
								$sql = "SELECT id FROM city ORDER BY id DESC LIMIT 1";
								$res = $this->db->get_row($sql);
								$city_id = $res[0];
							} else {
								$city_id = $res[0];
							}
							
							$sql = "UPDATE address SET address1 = '$address', postal_code = '$postal_code', phone = '$phone', id_city = $city_id WHERE id = $db_id_address";
							$this->db->query($sql);
							$sql = "INSERT INTO orders (id_user, order_notes, total) VALUES ($db_id, '$order_notes', $total)";					
							$this->db->query($sql);
							$sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
							$res = $this->db->get_row($sql);
							$ord_id = $res[0];
							$cart_sql = [];
							foreach ($_SESSION['cart'] as $key => $value) {
								$quantity = intval($value['quantity']);
								$sql = "INSERT INTO orders_albums (id_orders, id_albums, quantity) VALUES ($ord_id, $key, $quantity)";
								$this->db->query($sql);
								$sql = "SELECT inventory_presented FROM albums WHERE id = $key";
								$inv_pres = $this->db->get_row($sql);				
								$new_inv_pres = $inv_pres[0] - $quantity;
								$sql = "UPDATE albums SET inventory_presented = $new_inv_pres WHERE id = $key";
								$cart_sql[] = $this->db->query($sql);
							}					
							return $cart_sql;	

									
						} elseif ($first_name != $db_first_name || $last_name != $db_last_name || $email != $db_email) {
							$first_name = time() . '_' . $data['co_first_name'];
							$last_name = time() . '_' . $data['co_last_name'];				
							$email = time() . '_' . $data['co_email'];
							$sql = "SELECT id FROM country WHERE country = '$country'";
							$country_id = $this->db->get_row($sql);
							if (!$country_id[0]) {		
								$sql = "INSERT INTO country (country) VALUES ('$country')";
								$this->db->query($sql);
								$sql = "SELECT id FROM country ORDER BY id DESC LIMIT 1";
								$country_id = $this->db->get_row($sql);								
							}

							
							$sql = "SELECT id FROM city WHERE city = '$city'";
							$res = $this->db->get_row($sql);

							if (!$res) {				
								$sql = "INSERT INTO city (city, id_country) VALUES ('$city',$country_id[0])";
								$this->db->query($sql);
								$sql = "SELECT id FROM city ORDER BY id DESC LIMIT 1";
								$res = $this->db->get_row($sql);
								$city_id = $res[0];
							} else {
								$city_id = $res[0];
							}

							$sql = "INSERT INTO address (address1, postal_code, phone, id_city) VALUES ('$address', '$postal_code', '$phone', $city_id)";
							$this->db->query($sql);
							$sql = "SELECT id FROM address ORDER BY id DESC LIMIT 1";
							$res = $this->db->get_row($sql);
							$address_id = $res[0];

							$sql = "INSERT INTO users (first_name, last_name, email, id_address) VALUES ('$first_name', '$last_name', '$email', $address_id)";
							$this->db->query($sql);
							$sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
							$res = $this->db->get_row($sql);
							$user_id = $res[0];

							$sql = "INSERT INTO orders (id_user, order_notes, total) VALUES ($user_id, '$order_notes', $total)";					
							$this->db->query($sql);
							$sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
							$res = $this->db->get_row($sql);
							$ord_id = $res[0];
							$cart_sql = [];
							foreach ($_SESSION['cart'] as $key => $value) {
								$quantity = intval($value['quantity']);
								$sql = "INSERT INTO orders_albums (id_orders, id_albums, quantity) VALUES ($ord_id, $key, $quantity)";
								$this->db->query($sql);
								$sql = "SELECT inventory_presented FROM albums WHERE id = $key";
								$inv_pres = $this->db->get_row($sql);				
								$new_inv_pres = $inv_pres[0] - $quantity;
								$sql = "UPDATE albums SET inventory_presented = $new_inv_pres WHERE id = $key";
								$cart_sql[] = $this->db->query($sql);
							}					
							return $cart_sql;
						}						
					} elseif(isset($permission) && ($permission === 'regular' || $permission === 'admin')) {
						$sql = "SELECT * FROM users WHERE id = $db_id";
						$user_info = $this->db->get_row($sql, true);
						$db_first_name = $user_info->first_name;
						$db_last_name = $user_info->last_name;
						$db_email = $user_info->email;
						$db_id_address = $user_info->id_address;

						$sql = "SELECT * FROM address WHERE id = $db_id_address";
						$res = $this->db->get_row($sql,true);
						$db_address = $res->address1;
						$db_postal_code = $res->postal_code;
						$db_phone = $res->phone;
						$db_id_city = $res->id_city;
						$sql = "SELECT id_country FROM city WHERE id = $db_id_city";
						$res = $this->db->get_row($sql,true);
						if ($res) {
							$db_country_id = $res->id_country;
						} else {
							$db_country_id = 'null';
						}
						
						
						if ($db_address == $address && $db_postal_code == $postal_code && $db_phone == $phone && $db_id_city == $city_id && $country_id == $db_country_id && $first_name == $db_first_name && $last_name == $db_last_name && $email == $db_email) {							
							$sql = "INSERT INTO orders (id_user, order_notes, total) VALUES ($db_id, '$order_notes', $total)";					
							$this->db->query($sql);
							$sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
							$res = $this->db->get_row($sql);
							$ord_id = $res[0];
							$cart_sql = [];
							foreach ($_SESSION['cart'] as $key => $value) {
								$quantity = intval($value['quantity']);
								$sql = "INSERT INTO orders_albums (id_orders, id_albums, quantity) VALUES ($ord_id, $key, $quantity)";
								$this->db->query($sql);
								$sql = "SELECT inventory_presented FROM albums WHERE id = $key";
								$inv_pres = $this->db->get_row($sql);				
								$new_inv_pres = $inv_pres[0] - $quantity;
								$sql = "UPDATE albums SET inventory_presented = $new_inv_pres WHERE id = $key";
								$cart_sql[] = $this->db->query($sql);
							}					
							return $cart_sql;
						} else {

							$first_name = time() . '_' . $data['co_first_name'];
							$last_name = time() . '_' . $data['co_last_name'];				
							$email = time() . '_' . $data['co_email'];
							$sql = "SELECT id FROM country WHERE country = '$country'";
							$country_id = $this->db->get_row($sql);
							if (!$country_id[0]) {		
								$sql = "INSERT INTO country (country) VALUES ('$country')";
								$this->db->query($sql);
								$sql = "SELECT id FROM country ORDER BY id DESC LIMIT 1";
								$country_id = $this->db->get_row($sql);								
							}

							
							$sql = "SELECT id FROM city WHERE city = '$city'";
							$res = $this->db->get_row($sql);

							if (!$res) {				
								$sql = "INSERT INTO city (city, id_country) VALUES ('$city',$country_id[0])";
								$this->db->query($sql);
								$sql = "SELECT id FROM city ORDER BY id DESC LIMIT 1";
								$res = $this->db->get_row($sql);
								$city_id = $res[0];
							} else {
								$city_id = $res[0];
							}

							$sql = "INSERT INTO address (address1, postal_code, phone, id_city) VALUES ('$address', '$postal_code', '$phone', $city_id)";
							$this->db->query($sql);
							$sql = "SELECT id FROM address ORDER BY id DESC LIMIT 1";
							$res = $this->db->get_row($sql);
							$address_id = $res[0];

							$sql = "INSERT INTO users (first_name, last_name, email, id_address) VALUES ('$first_name', '$last_name', '$email', $address_id)";
							$this->db->query($sql);
							$sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
							$res = $this->db->get_row($sql);
							$user_id = $res[0];

							$sql = "INSERT INTO orders (id_user, order_notes, total) VALUES ($user_id, '$order_notes', $total)";					
							$this->db->query($sql);
							$sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
							$res = $this->db->get_row($sql);
							$ord_id = $res[0];
							$cart_sql = [];
							foreach ($_SESSION['cart'] as $key => $value) {
								$quantity = intval($value['quantity']);
								$sql = "INSERT INTO orders_albums (id_orders, id_albums, quantity) VALUES ($ord_id, $key, $quantity)";
								$this->db->query($sql);
								$sql = "SELECT inventory_presented FROM albums WHERE id = $key";
								$inv_pres = $this->db->get_row($sql);				
								$new_inv_pres = $inv_pres[0] - $quantity;
								$sql = "UPDATE albums SET inventory_presented = $new_inv_pres WHERE id = $key";
								$cart_sql[] = $this->db->query($sql);
							}					
							return $cart_sql;
						}
						
					}
				} else {
					$sql = "SELECT id FROM country WHERE country = '$country'";
					$country_id = $this->db->get_row($sql);
					if (!$country_id[0]) {		
						$sql = "INSERT INTO country (country) VALUES ('$country')";
						$this->db->query($sql);
						$sql = "SELECT id FROM country ORDER BY id DESC LIMIT 1";
						$country_id = $this->db->get_row($sql);								
					}

					
					$sql = "SELECT id FROM city WHERE city = '$city'";
					$res = $this->db->get_row($sql);

					if (!$res) {				
						$sql = "INSERT INTO city (city, id_country) VALUES ('$city',$country_id[0])";
						$this->db->query($sql);
						$sql = "SELECT id FROM city ORDER BY id DESC LIMIT 1";
						$res = $this->db->get_row($sql);
						$city_id = $res[0];
					} else {
						$city_id = $res[0];
					}

					$sql = "INSERT INTO address (address1, postal_code, phone, id_city) VALUES ('$address', '$postal_code', '$phone', $city_id)";
					$this->db->query($sql);
					$sql = "SELECT id FROM address ORDER BY id DESC LIMIT 1";
					$res = $this->db->get_row($sql);
					$address_id = $res[0];

					$sql = "INSERT INTO users (first_name, last_name, email, id_address) VALUES ('$first_name', '$last_name', '$email', $address_id)";
					$this->db->query($sql);
					$sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
					$res = $this->db->get_row($sql);
					$user_id = $res[0];

					$sql = "INSERT INTO orders (id_user, order_notes, total) VALUES ($user_id, '$order_notes', $total)";					
					$this->db->query($sql);
					$sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
					$res = $this->db->get_row($sql);
					$ord_id = $res[0];
					$cart_sql = [];
					foreach ($_SESSION['cart'] as $key => $value) {
						$quantity = intval($value['quantity']);
						$sql = "INSERT INTO orders_albums (id_orders, id_albums, quantity) VALUES ($ord_id, $key, $quantity)";
						$this->db->query($sql);
						$sql = "SELECT inventory_presented FROM albums WHERE id = $key";
						$inv_pres = $this->db->get_row($sql);				
						$new_inv_pres = $inv_pres[0] - $quantity;
						$sql = "UPDATE albums SET inventory_presented = $new_inv_pres WHERE id = $key";
						$cart_sql[] = $this->db->query($sql);
					}					
					return $cart_sql;				
				}
			} elseif ($logged_in == true) {
				if (isset($data['new_address']) && $data['new_address'] == 1) {
					$id = $data['co_id'];
					$sql = "SELECT id_address FROM users WHERE id = $id";
					$res = $this->db->get_row($sql,true);
					$address_id = $res->id_address;
					$address = $data['co_address'];
					$postal_code = $data['co_postal_code'];
					$phone = $data['co_phone_num'];
					$city = $data['co_city'];
					$country = $data['co_country'];

					$sql = "SELECT id FROM country WHERE country = '$country'";
					$country_id = $this->db->get_row($sql);
					if (!$country_id[0]) {		
						$sql = "INSERT INTO country (country) VALUES ('$country')";
						$this->db->query($sql);
						$sql = "SELECT id FROM country ORDER BY id DESC LIMIT 1";
						$country_id = $this->db->get_row($sql);							
					}

					
					$sql = "SELECT id FROM city WHERE city = '$city'";
					$res = $this->db->get_row($sql);
					if (!$res) {				
						$sql = "INSERT INTO city (city, id_country) VALUES ('$city',$country_id[0])";
						$this->db->query($sql);
						$sql = "SELECT id FROM city ORDER BY id DESC LIMIT 1";
						$res = $this->db->get_row($sql);
						$city_id = $res[0];
					} else {
						$city_id = $res[0];
					}

					$sql = "UPDATE address SET address1 = '$address', postal_code = '$postal_code', phone = '$phone', id_city = '$city_id' WHERE id = $address_id";
					$this->db->query($sql);
					$order_notes = $this->db->clear($data['co_remark']);
					$total = $_SESSION['cart_total'];
					$sql = "INSERT INTO orders (id_user, order_notes, total) VALUES ($id, '$order_notes', $total)";					
					$this->db->query($sql);
					$sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
					$res = $this->db->get_row($sql);
					$ord_id = $res[0];
					$cart_sql = [];
					foreach ($_SESSION['cart'] as $key => $value) {
						$quantity = intval($value['quantity']);
						$sql = "INSERT INTO orders_albums (id_orders, id_albums, quantity) VALUES ($ord_id, $key, $quantity)";
						$this->db->query($sql);
						$sql = "SELECT inventory_presented FROM albums WHERE id = $key";
						$inv_pres = $this->db->get_row($sql);				
						$new_inv_pres = $inv_pres[0] - $quantity;
						$sql = "UPDATE albums SET inventory_presented = $new_inv_pres WHERE id = $key";
						$cart_sql[] = $this->db->query($sql);
					}
						return $cart_sql;
				} else {
					$id = $data['co_id'];
					$sql = "SELECT id_address FROM users WHERE id = $id";
					$res = $this->db->get_row($sql, true);
					$address_id = $res->id_address;
					$sql = "SELECT address1 FROM address WHERE id = $address_id";
					$res = $this->db->get_row($sql, true);
					$address = $res->address1;
					if ($address == 'not_registered') {
						return $address;
					} else {					
						$user_id = $data['co_id'];
						$order_notes = $data['reg_us_remark'];
						$total = $_SESSION['cart_total'];
						$sql = "INSERT INTO orders (id_user, order_notes, total) VALUES ($user_id, '$order_notes', $total)";					
						$this->db->query($sql);
						$sql = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
						$res = $this->db->get_row($sql);
						$ord_id = $res[0];
						$cart_sql = [];
						foreach ($_SESSION['cart'] as $key => $value) {
							$quantity = intval($value['quantity']);
							$sql = "INSERT INTO orders_albums (id_orders, id_albums, quantity) VALUES ($ord_id, $key, $quantity)";
							$this->db->query($sql);
							$sql = "SELECT inventory_presented FROM albums WHERE id = $key";
							$inv_pres = $this->db->get_row($sql);				
							$new_inv_pres = $inv_pres[0] - $quantity;
							$sql = "UPDATE albums SET inventory_presented = $new_inv_pres WHERE id = $key";
							$cart_sql[] = $this->db->query($sql);
						}
							return $cart_sql;
					}
					
				}
				
			}

		}
	}		