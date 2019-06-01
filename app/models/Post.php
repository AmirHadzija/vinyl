<?php 
	
	class Post{
		private $db;


		public function __construct(){
			$this->db = new Database;
		}

		public function getProducts(){
			$sql = 'SELECT albums.id, albums.title, albums.description, albums.single, albums.type, albums.price, albums.inventory_presented, albums.inventory_total, albums.id_images, albums.date_created, albums.items_sold, images.img_url, albums_songs.id_songs, group_concat(songs.title) AS song_titles, albums.on_sale FROM albums INNER JOIN images ON albums.id_images = images.id INNER JOIN albums_songs ON albums.id = albums_songs.id_albums INNER JOIN songs ON albums_songs.id_songs = songs.id GROUP BY albums.id';
			$res = $this->db->get_results($sql);
			

			return $res;

		}

		public function getProductsBestSell(){
			$sql = 'SELECT albums.id, albums.title, albums.description, albums.single, albums.type, albums.price, albums.inventory_presented, albums.inventory_total, albums.id_images, albums.date_created, albums.items_sold, images.img_url, albums_songs.id_songs, group_concat(songs.title) AS song_titles, albums.on_sale FROM albums INNER JOIN images ON albums.id_images = images.id INNER JOIN albums_songs ON albums.id = albums_songs.id_albums INNER JOIN songs ON albums_songs.id_songs = songs.id GROUP BY albums.id ORDER BY albums.items_sold DESC';
			$res = $this->db->get_results($sql);
			

			return $res;

		}

		public function getProductGenres(){
			$sql = "SELECT albums.id, album_genres.id_genres, group_concat(genres.genre) AS genre_name FROM albums INNER JOIN album_genres ON albums.id = album_genres.id_album INNER JOIN genres ON album_genres.id_genres = genres.id GROUP BY albums.id";

			$res = $this->db->get_results($sql);
			return $res;
		}

		public function populateSlider(){
			$sql = "SELECT albums.id, albums.title, albums.description, albums.single, albums.type, albums.price, albums.inventory_presented, albums.id_images, images.img_url, albums_songs.id_songs, group_concat(songs.title) AS song_titles FROM albums INNER JOIN images ON albums.id_images = images.id INNER JOIN albums_songs ON albums.id = albums_songs.id_albums INNER JOIN songs ON albums_songs.id_songs = songs.id GROUP BY albums.id ORDER BY rand() LIMIT 9";
			$res = $this->db->get_results($sql);
			return $res;
		}

		public function getSingleProduct($data){

			$sql = "SELECT albums.id, albums.title, albums.description, albums.single, albums.type, albums.price, albums.inventory_presented, albums.id_images, date_format(albums.date_released, '%d %M.%Y') AS date_released, albums.on_sale, images.img_url, albums_songs.id_songs, group_concat(songs.title) AS song_titles, artists_albums.id_artists, artists.name AS artist FROM albums INNER JOIN images ON albums.id_images = images.id INNER JOIN albums_songs ON albums.id = albums_songs.id_albums INNER JOIN songs ON albums_songs.id_songs = songs.id INNER JOIN artists_albums ON artists_albums.id_albums = albums.id INNER JOIN artists ON artists_albums.id_artists = artists.id WHERE albums.id = $data";

			$res = $this->db->get_row($sql,true);
			if ($res) {
				return $res;
			} else {
				return false;
			}
		}

		public function getProductGenresSingle($data){
			$sql = "SELECT albums.id, album_genres.id_genres, group_concat(genres.genre) AS genre_name FROM albums INNER JOIN album_genres ON albums.id = album_genres.id_album INNER JOIN genres ON album_genres.id_genres = genres.id WHERE albums.id = $data";

			$res = $this->db->get_row($sql,true);
			return $res;
		}

		public function getAllProductId(){
			$sql = "SELECT id FROM albums ORDER BY id";
			$res = $this->db->get_results($sql,true);
			return $res;
		}

		public function getSales(){
			$sql = "SELECT * FROM sales ORDER BY id";
			$sales = $this->db->get_results($sql);
			$s = [];
			foreach ($sales as $key => $value) {
				$exp_check = $value['starting_point'] + $value['duration'];
				$id = $value['id'];
				$id_album = $value['id_album'];	

				if ($exp_check <= time() && $value['expired'] == 'no') {
					$new_price = $price[0] + ($price[0] * ($value['precentage']/100));
					$sql = "UPDATE albums SET price = $new_price, on_sale = 'no' WHERE id = $id_album";
					$this->db->query($sql);
					$sql = "DELETE FROM sales WHERE id_album = $id_album";
					$this->db->query($sql);

				}			
			}		
			$sql = "SELECT * FROM sales AS s JOIN albums AS a ON a.id = s.id_album JOIN images AS i ON i.id = a.id_images WHERE expired = 'no'  ORDER BY rand() LIMIT 3;";
			$res = $this->db->get_results($sql);
			return $res;			
			
		}

		public function getSale($id){

			$id = intval($id);

			$sql = "SELECT * FROM sales AS s JOIN albums AS a ON a.id = s.id_album JOIN images AS i ON i.id = a.id_images WHERE expired = 'no'  AND s.id_album = $id";
			$res = $this->db->get_results($sql);
			if ($res) {
				return $res;				
			} else {
				return false;
			}
		}

		public function contact_form($data){
			$name = $data['name'];
			$email = $data['email'];
			$subj = $data['subj'];
			$mess = $this->db->clear($data['mess']);

			$sql = "INSERT INTO contact_us (name, email, subject, message, source) VALUES ('$name', '$email', '$subj', '$mess', 'inbox')";
			if ($this->db->query($sql)) {
				$this->err_msg['server_response_ok'] = 'ok'; 
			} else {
				$this->err_msg['error'] = 'Error : There was a problem with inserting contact form data on ' . date('d.m.Y  H:i:s');
			}

			return $this->err_msg;
		}	
	}