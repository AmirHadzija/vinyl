<?php 

	class Boutiques{
		private $db;


		public function __construct(){
			$this->db = new Database;
		}

		public function getNewArrivals(){
			$sql = "SELECT albums.id, albums.title, albums.description, albums.single, albums.type, albums.price, albums.inventory_presented, albums.id_images, images.img_url, albums_songs.id_songs, group_concat(songs.title) AS song_titles FROM albums INNER JOIN images ON albums.id_images = images.id INNER JOIN albums_songs ON albums.id = albums_songs.id_albums INNER JOIN songs ON albums_songs.id_songs = songs.id GROUP BY albums.id ORDER BY albums.id DESC LIMIT 9";
			$res = $this->db->get_results($sql);
			return $res;
		}

		public function getProducts(){			
				$sql = 'SELECT albums.id, albums.title, albums.description, albums.single, albums.type, albums.price, albums.inventory_presented, albums.id_images, images.img_url, albums_songs.id_songs, group_concat(songs.title) AS song_titles, albums.on_sale FROM albums INNER JOIN images ON albums.id_images = images.id INNER JOIN albums_songs ON albums.id = albums_songs.id_albums INNER JOIN songs ON albums_songs.id_songs = songs.id GROUP BY albums.id ORDER BY albums.id DESC LIMIT 12';
				$res = $this->db->get_results($sql);
				if ($res) {
					return $res;					
				}

		}
		public function getProductsType($data){			
				$sql = "SELECT albums.id, albums.title, albums.description, albums.single, albums.type, albums.price, albums.inventory_presented, albums.id_images, images.img_url, albums_songs.id_songs, group_concat(songs.title) AS song_titles, albums.on_sale FROM albums INNER JOIN images ON albums.id_images = images.id INNER JOIN albums_songs ON albums.id = albums_songs.id_albums INNER JOIN songs ON albums_songs.id_songs = songs.id WHERE albums.type = '$data' GROUP BY albums.id ORDER BY albums.id ASC";
				$res = $this->db->get_results($sql);
				if ($res) {
					return $res;					
				}

		}
		public function getProductsLoader($limit, $amount){
			$sql = "SELECT albums.id, albums.title, albums.description, albums.single, albums.type, albums.price, albums.inventory_presented, albums.id_images, albums.on_sale, images.img_url, albums_songs.id_songs, group_concat(songs.title) AS song_titles FROM albums INNER JOIN images ON albums.id_images = images.id INNER JOIN albums_songs ON albums.id = albums_songs.id_albums INNER JOIN songs ON albums_songs.id_songs = songs.id GROUP BY albums.id ORDER BY albums.id DESC LIMIT $limit OFFSET $amount";
				$res = $this->db->get_results($sql);
				if (!empty($res)) {
					return $res;					
				} else {
					return false;
				}
		}	

		public function getCartProducts($session){
			$items = [];
			foreach ($session as $key => $value) {
				$sql = "SELECT albums.id, albums.title, albums.description, albums.single, albums.type, albums.price, albums.inventory_presented, albums.id_images, date_format(albums.date_released, '%d %M.%Y') AS date_released, albums.on_sale, images.img_url, albums_songs.id_songs, group_concat(songs.title) AS song_titles, artists_albums.id_artists, artists.name AS artist FROM albums INNER JOIN images ON albums.id_images = images.id INNER JOIN albums_songs ON albums.id = albums_songs.id_albums INNER JOIN songs ON albums_songs.id_songs = songs.id INNER JOIN artists_albums ON artists_albums.id_albums = albums.id INNER JOIN artists ON artists_albums.id_artists = artists.id WHERE albums.id = $key";

					$res = $this->db->get_row($sql, true);
				$items[] = $res;
			}

			return $items;
		}

		


	}