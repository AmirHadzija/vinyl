<?php 

	class Boutique extends Controller{
		public $msg = [];
		public function __construct(){
			$this->botiquesModel = $this->model('Boutiques');
			$this->postModel = $this->model('Post');
		}

		public function index(){

			$data = [
				'populate_slider' => $this->botiquesModel->getNewArrivals(),
				'get_all_prod' => $this->botiquesModel->getProducts(),
				'sales' => $this->postModel->getSales(),
			];			

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['load_more']) && $_POST['load_more'] == 1){

				if (!empty($_POST['count'])) {
					$limit = 12;
					$count = $_POST['count'];

					$this->msg['new_sales'] = $this->postModel->getSales();
					$this->msg['new_load'] = $this->botiquesModel->getProductsLoader($limit,$count);
					$this->msg['count'] = $count;
					$this->msg['limit'] = $limit;
					if ($this->msg['new_load'] && !empty($this->msg['new_load'])) {						
						exit(json_encode($this->msg));
					} else {
						$this->msg['end'] = 'no more';
						exit(json_encode($this->msg));
					}
				}
				
			}

			$this->view('boutique/index', $data);
		}

		public function types(){
			if (($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['type'])) || (isset($_GET['load_more']) && $_GET['load_more'] == 1)){

				if(isset($_GET['type'])){
					$type = test_input($_GET['type']);					
				}

				$data = [
					'populate_slider' => $this->botiquesModel->getNewArrivals(),
					'get_all_prod' => $this->botiquesModel->getProductsType($type),
					'sales' => $this->postModel->getSales(),
				];
			}

			$this->view('boutique/types', $data);
		}

		public function checkout(){
			if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
				$data = [
					'cart_items' => $this->botiquesModel->getCartProducts($_SESSION['cart']),	
				];
				$data['cart_sale'] = [];
				foreach ($data['cart_items'] as $value) {
					if ($value->on_sale == 'yes') {
						$res = $this->postModel->getSale($value->id);
						$data['cart_sale'][$value->id] = $res;
					}
				}				
				$this->view('boutique/checkout', $data);
			} else {
				redirect('pages/index');	
			}

		}
	}