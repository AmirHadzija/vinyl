<?php

	cLass Admin{
		private $db;
		public $err_msg = [];

		public function __construct(){
			$this->db = new Database;			
		}

		public function select_genre(){
			$sql = "SELECT genre FROM genres ORDER BY genre";

			$res = $this->db->get_results($sql);

			return $res;
		}

		public function get_types_get_single($type = true){

			if ($type === true) {
				$sql = "SHOW COLUMNS FROM albums LIKE 'type'";				
			} elseif ($type === false) {
				$sql = "SHOW COLUMNS FROM albums LIKE 'single'";
			}

			$data = $this->db->get_row($sql);

			preg_match("/^enum\(\'(.*)\'\)$/", $data[1], $matches);
		    $enum = explode("','", $matches[1]);
		    return $enum;
		}

		public function product_search_title($data, $single = false){

			if ($single == false) {
				if (!empty($data)) {
					$sql = "SELECT * FROM albums WHERE title LIKE '$data%' ORDER BY title";
					$res = $this->db->get_results($sql,true);
					if(count($res) > 0){
						return $res;
					} else {
						$this->err_msg['no_matches'] = 'No Matches!';
						return $this->err_msg;
					}				
				} else {
					return false;
				}				
			} else {
				$result = [];

				$id = intval($data);
				$sql = "SELECT * FROM albums WHERE id = $id";
				$album_info = $this->db->get_row($sql,true);				
				$result['radio_btn_res']['album_info'] = $album_info;					
						

				$id_album = $album_info->id;
				$sql = "SELECT id_artists FROM artists_albums WHERE id_albums = $id_album";
				$ar_id = $this->db->get_row($sql, true);				
				$artist_id = $ar_id->id_artists;

				$sql = "SELECT name FROM artists WHERE id = $artist_id";
				$ar_name = $this->db->get_row($sql,true);
				$artist_name = $ar_name->name;
				$result['radio_btn_res']['artist_name'] = $artist_name;

				$sql = "SELECT id_songs FROM albums_songs WHERE id_albums = $id_album";				
				$id_songs = $this->db->get_results($sql);
				$song_id = [];
				foreach ($id_songs as $value) {
					$song_id[] = "id = '".$value['id_songs']."' OR ";
				}
				$sql_data = implode('', $song_id);
				$sql_len = strlen($sql_data) - 3;
				$sql_rtrim = substr($sql_data, 0, -3);
				$sql = "SELECT title FROM songs WHERE $sql_rtrim";
				$song_titles = $this->db->get_results($sql);
				if (is_array($song_titles)) {
					$result['radio_btn_res']['song_titles'] = $song_titles;
				} else {
					$result['radio_btn_res']['msg'] = 'There are no songs listed for this product!';
				}

				$sql = "SELECT id_genres FROM album_genres WHERE id_album = $id_album";
				$genres_id = $this->db->get_results($sql);
				$genre_id = [];
				foreach ($genres_id as $value) {
					$genre_id[] = "id = '".$value['id_genres']."' OR ";
				}
				$sql_data = implode('', $genre_id);
				$sql_len = strlen($sql_data) - 3;
				$sql_rtrim = substr($sql_data, 0, -3);
				$sql = "SELECT genre FROM genres WHERE $sql_rtrim";
				$result['radio_btn_res']['genres'] = $this->db->get_results($sql);

				$img_id = $album_info->id_images;
				$sql = "SELECT img_url FROM images WHERE id = $img_id";
				$image = $this->db->get_row($sql);
				$result['radio_btn_res']['image_url'] = $image;

				return $result;		
			}

		}

		public function artist_search($data){
			if (!empty($data)) {
			$sql = "SELECT * FROM artists WHERE name LIKE '$data%' ORDER BY name";
				$res = $this->db->get_results($sql,true);
				if(count($res) > 0){
					return $res;
				} else {
					$this->err_msg['no_matches'] = 'No Matches!';
					return $this->err_msg;
				}				
			} else {
				return false;
			}	
		}

		public function artist_delete($data) {
			if (!empty($data['art_srch_radio'])) {
				$id = intval($data['art_srch_radio']);

				$sql = "SELECT id_images FROM artists WHERE id = $id";
				$res = $this->db->get_row($sql);
				$img_id = intval($res[0]);

				$sql = "SELECT FROM artists_albums WHERE id_artists = $id";
				$res = $this->db->get_row($sql);
				
				if ($res != false) {
					$sql = "DELETE FROM artists_albums WHERE id_artists = $id";
					$this->db->query($sql);

				}
				if ($img_id == 76) {
					$sql = "DELETE FROM artists WHERE id = $id";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['ok'] = 'ok';
					} else {
						$this->err_msg['error'] = 'Error : There was a problem with artist removal on ' . date('d.m.Y  H:i:s');
					}
				} else {
					$sql = "DELETE FROM artists WHERE id = $id";
					$this->db->query($sql);

					$sql = "SELECT img_root FROM images WHERE id = $img_id";
					$img_root = $this->db->get_row($sql);
					$img_dir = dirname($img_root[0]);
					

					$sql = "DELETE FROM albums WHERE id = $id";
					$this->db->query($sql);

					$sql = "DELETE FROM images WHERE id = $img_id";
					$res = $this->db->query($sql);
					
					unlink($img_root[0]);
					if (dir_is_empty($img_dir)) {
						rmdir($img_dir);						
					}

					$sql = "DELETE FROM images WHERE id = $img_id";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['server_response_ok'] = 'ok';
					} else {
						$this->err_msg['error'] = 'Error : There was a problem with artist removal on ' . date('d.m.Y  H:i:s');
					}
				}
			}
			return $this->err_msg;
		}

		public function product_insert($data, $file){		
			
			$artist = $data['ins_artist'];
			$img_tmp = $file['tmp_name'];
			$img_format = explode('/', $file['type']);
			$img_ext = '.'. $img_format[1];
			$img_name = img_name_dir($data['ins_title']) . $img_ext;
			$dir = PUBROOT . '\images\albums';
			$album_dir = $dir . '\\' . img_name_dir($artist, true);
			if (!file_exists($album_dir)) {							
				if (mkdir($album_dir, 0777, true)) {
					move_uploaded_file($img_tmp, $album_dir . '\\' . $img_name);
					$img_url = URLROOT . "/images/albums/" . $artist . "/" . $img_name;							
				}
			} elseif (file_exists($album_dir)) {				
				move_uploaded_file($img_tmp, $album_dir . '\\' . $img_name);
				$img_url = URLROOT . "/images/albums/" . img_name_dir($artist, true) . "/" . $img_name;						
			} else {
				$this->err_msg['error'] = 'Error : There was a problem with image uploading on ' . date('d.m.Y  H:i:s');	
				return $this->err_msg;
			}
			$img_url = URLROOT . "/images/albums/" . img_name_dir($artist, true) . "/" . $img_name;		
			$img_root = $album_dir . '\\' . $img_name;
			$sql_img_root = addslashes($img_root);
			$sql = "INSERT INTO images (img_url, img_root) VALUES ('$img_url', '$sql_img_root')";
			if ($this->db->query($sql)) {
				$this->err_msg['ok'] = 'ok';				
			} else {				
				$this->err_msg['error'] = 'There was a problem with inserting a new product on '. date('d.m.Y  H:i:s');		
			}

			$title = $data['ins_title'];			
			$description = $this->db->clear($data['ins_description']);
			$single = $data['ins_single'];

			$release_date = explode('-', $data['ins_date_released']);
			$date_released = $release_date[0] . '-' . $release_date[1] . '-' . $release_date[2];
			
			$price = $data['ins_price'];
			
			$type = $data['ins_type'];
			$inventory = intval($data['ins_inventory_amount']);

			$sql = "INSERT INTO albums (title, description, single, id_images, date_released, price, type, inventory_total, inventory_presented) VALUES ('$title', '$description', '$single', last_insert_id(), '$date_released', '$price', '$type', '$inventory', '$inventory')";
			if ($this->db->query($sql)) {
				$this->err_msg['ok'] = 'ok';				
			} else {				
				$this->err_msg['error'] = 'There was a problem with inserting a new product on '. date('d.m.Y  H:i:s');	
			}

			$sql = "SELECT id FROM artists WHERE name = '$artist'";
			$res = $this->db->get_row($sql,true);

			if (!empty($res)) {
				$sql = "INSERT INTO artists_albums (id_artists, id_albums) VALUES ('$res->id', last_insert_id())";
				if ($this->db->query($sql)) {
					$this->err_msg['ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'There was a problem with inserting a new product on '. date('d.m.Y  H:i:s');
				}
				
			} else {
				$sql = "SELECT id FROM albums ORDER BY id DESC LIMIT 1";
				$res = $this->db->get_row($sql,true);				
				$sql = "INSERT INTO artists (name, description, id_images) VALUES ('$artist', NULL, 76)";				
				$rez=$this->db->query($sql);				
				$sql = "INSERT INTO artists_albums (id_artists, id_albums) VALUES (last_insert_id(), '$res->id')";
				if ($this->db->query($sql)) {
					$this->err_msg['ok'] = 'ok';					
				} else {
					$this->err_msg['error'] = 'There was a problem with inserting a new product on '. date('d.m.Y  H:i:s');
				}
				
			}

			$songs = $data['ins_song_name'];
			$sql_data_arr = array();
			foreach ($songs as $value) {
				$sql_data_arr[] = "('".addslashes($value)."')";
			}
			$sql_count = count($sql_data_arr);
			$sql_data = implode(',', $sql_data_arr);

			$sql = "INSERT INTO songs (title) VALUES $sql_data";
			if ($this->db->query($sql)) {
				$this->err_msg['ok'] = 'ok';
			} else {
				$this->err_msg['error'] = 'There was a problem with inserting a new product on '. date('d.m.Y  H:i:s');
			}
			$sql = "SELECT id FROM albums ORDER BY id DESC LIMIT 1";
			$album_id = $this->db->get_row($sql);			
			$sql = "SELECT id FROM songs ORDER BY id DESC LIMIT $sql_count";
			$songs_id = $this->db->get_results($sql);
			$songs_id_arr = array();
			$album_id_arr = array();
			foreach ($songs_id as $value) {
				$songs_id_arr[] = "(".intval($album_id[0]).",".intval($value['id']).")";
				
			}
			$songs_imp = implode(',', $songs_id_arr);			
			$sql = "INSERT INTO albums_songs (id_albums, id_songs) VALUES $songs_imp";
			if ($this->db->query($sql)) {
				$this->err_msg['ok'] = 'ok';
			} else {
				$this->err_msg['error'] = 'There was a problem with inserting a new product on '. date('d.m.Y  H:i:s');
			}

			$genres = $data['ins_select_genre'];
			$genre = explode(',', $genres);
			
			$sql_data_arr = array();
			foreach ($genre as $value) {
				$sql_data_arr[] = "genre = '".$value."' or ";
			}			
			$sql_data = implode('', $sql_data_arr);
			$sql_len = strlen($sql_data) - 3;
			$sql_rtrim = substr($sql_data, 0, -3);
			$sql = "SELECT id FROM genres WHERE $sql_rtrim";			
			$genre_id = $this->db->get_results($sql);

			$sql = "SELECT id FROM albums ORDER BY id DESC LIMIT 1";
			$album_id = $this->db->get_row($sql);
			$gen_alb_arr = array();
			foreach ($genre_id as $value) {
				$gen_alb_arr[] = "(".intval($album_id[0]).",".intval($value['id']).")";
			}
			$gen_alb = implode(',', $gen_alb_arr);
			$sql = "INSERT INTO album_genres (id_album, id_genres) VALUES $gen_alb";
			if ($this->db->query($sql)) {
				$this->err_msg['ok'] = 'ok';				
			} else {
				$sql = "DELETE FROM images WHERE id = last_insert_id()";
				$this->db->query($sql);
				$this->err_msg['error'] = 'There was a problem with inserting a new product on '. date('d.m.Y  H:i:s');				
			}


			if (!empty($this->err_msg)) {
				$res = $this->err_msg;
				return $res;
			}
		}

		public function product_update($data, $file = false){
			$id = $data['product_id_upd'];
			
				$title = $data['product_title_upd'];
				$sql = "SELECT title FROM albums WHERE id = $id";
				$db_title = $this->db->get_row($sql);

				$artist = $data['upd_artist'];
				$sql = "SELECT id_artists FROM artists_albums WHERE id_albums = $id";
				$db_artist_id = $this->db->get_row($sql);

				$sql = "SELECT name FROM artists WHERE id = $db_artist_id[0]";
				$db_artist = $this->db->get_row($sql);

				$sql = "SELECT id_images FROM albums WHERE id = $id";
				$img_id = $this->db->get_row($sql);

				if ($title !== $db_title[0]) {
					$sql = "SELECT img_url FROM images WHERE id = $img_id[0]";
					$db_img_url = $this->db->get_row($sql);
					$db_img_name_exp = explode('/', $db_img_url[0]);
					$key = count($db_img_name_exp) - 1;
					$db_img_name = $db_img_name_exp[$key];
					$img_exs = explode( '.', $db_img_name);
					$exs_key = count($img_exs) - 1;
					$extension = '.'.$img_exs[$exs_key];
					$dir = PUBROOT . '\images\albums';					
					$old_img = addslashes($dir . '\\' . img_name_dir($db_artist[0], true) . '\\' . $db_img_name);
					$new_img = addslashes($dir . '\\' . img_name_dir($db_artist[0], true) . '\\' . img_name_dir($title) . $extension);
				
					
					$sql = "SELECT id_images FROM albums WHERE id = $id";
					$db_img_id = $this->db->get_row($sql);

					$new_img_url = URLROOT . '/images/albums/' . img_name_dir($db_artist[0], true) . '/' . img_name_dir($title) . $extension;
					
					$sql = "UPDATE images SET img_url = '$new_img_url' WHERE id = $db_img_id[0]";					
					$this->db->query($sql);	


					$sql = "UPDATE albums SET title = '$title' WHERE id = $id";
					$exec = $this->db->query($sql);
					if ($exec) {
						rename($old_img, $new_img);
						$this->err_msg['title_upd_msg'] = 'You have successfully updated product title';
					} else {
						$this->err_msg['error'] = 'There was a problem with updating product title on '. date('d.m.Y  H:i:s');
					}			
											
				}

				if ($artist !== $db_artist[0]) {
					$dir = PUBROOT . '\images\albums';
					$db_dir_name = $dir . '\\' . img_name_dir($db_artist[0], true);
					$new_name = $dir . '\\' . img_name_dir($artist, true);
							

					$sql = "SELECT id_images FROM albums WHERE id = $id";
					$db_img_id = $this->db->get_row($sql);

					$sql = "SELECT img_url FROM images WHERE id = $db_img_id[0]";
					$db_img_url = $this->db->get_row($sql);

					$explode_img_url = explode('/', $db_img_url[0]);
					$exp_key = count($explode_img_url) - 2;
					$explode_img_url[$exp_key] = img_name_dir($artist, true);

					$new_dir_name = implode('/', $explode_img_url);

					$sql = "SELECT id_images FROM albums WHERE id = $id";
					$db_img_id = $this->db->get_row($sql);

					$sql = "UPDATE images SET img_url = '$new_dir_name' WHERE id = $db_img_id[0]";
					$this->db->query($sql);

					$sql = "UPDATE artists SET name = '$artist' WHERE id = $db_artist_id[0]";
					
					$res = $this->db->query($sql);
					if ($res) {
						rename($db_dir_name, $new_name);
						$this->err_msg['upd_artist_msg'] = 'You have successfully updated artist name for product';
					} else {
						$this->err_msg['error'] = 'There was a problem with updating artist name for product on '. date('d.m.Y  H:i:s');
					}
				}

				if ($file == true) {
					$sql = "SELECT id_images FROM albums WHERE id = $id";
					$db_img_id = $this->db->get_row($sql);

					$sql = "SELECT img_url FROM images WHERE id = $db_img_id[0]";
					$db_img_url = $this->db->get_row($sql);

					$explode = explode('/', $db_img_url[0]);
					$img_name = $explode[count($explode) - 1];
					$dir_name = $explode[count($explode) - 2];
					$album_sys_dir = PUBROOT . '\images\albums' . '\\' . $dir_name . '\\' . $img_name;
					$img_tmp = $file['tmp_name'];
					if (move_uploaded_file($img_tmp, $album_sys_dir)) {
						$this->err_msg['upd_img_msg'] = 'You have successfully updated image for product';
					} else {
						$this->err_msg['error'] = 'There was a problem with updating an image for product on '. date('d.m.Y  H:i:s');
					}
					
					
				}

				$description = $this->db->clear($data['description_edit']);
				if (!empty($description)) {
					$sql = "SELECT description FROM albums where id = $id";
					$db_description = $this->db->get_row($sql);

					if ($description !== $db_description[0]) {
						$sql = "UPDATE albums SET description = '$description' WHERE id = $id";
						$exec = $this->db->query($sql);
						if ($exec) {
							$this->err_msg['upd_desc_edit'] = 'You have successfully updated product description';
						} else {
							$this->err_msg['error'] = 'There was a problem with updating product description on '. date('d.m.Y  H:i:s');
						}
					}					
				}


				$songs = $data['upd_songs'];
				$sql = "SELECT id_songs FROM albums_songs WHERE id_albums = $id";
				$db_songs_id = $this->db->get_results($sql);
				$sql_data_arr = [];
				foreach ($db_songs_id as $value) {
					$sql_data_arr[] = "id = ".$value['id_songs']." or ";
				}
				$sql_data = implode('', $sql_data_arr);
				$sql_len = strlen($sql_data) - 3;
				$sql_rtrim = substr($sql_data, 0, -3);
				$sql = "SELECT title FROM songs WHERE $sql_rtrim";
				$db_songs_multi = $this->db->get_results($sql);
				$db_songs_s = array_map('array_values', $db_songs_multi);
				$db_songs = [];
				foreach ($db_songs_s as $value) {
					array_push($db_songs, $value[0]);
				}
				$to_delete = array_diff($db_songs, $songs);
				$to_insert = array_diff($songs, $db_songs);
				if (!empty($to_delete)) {
					$sql_del = [];
					foreach ($to_delete as $value) {
						$sql_del[] = "title = '".addslashes($value)."' or ";
					}
					$sql_data = implode('', $sql_del);
					$sql_len = strlen($sql_data) - 3;
					$sql_rtrim = substr($sql_data, 0, -3);

					$sql = "SELECT id FROM songs WHERE $sql_rtrim";
					$song_del_id = $this->db->get_results($sql);

					$sql_del = [];
					foreach ($song_del_id as $value) {
						$sql_del[] = "id_songs = '".$value['id']."' OR ";
					}
					$sql_data = implode('', $sql_del);
					$sql_len = strlen($sql_data) - 3;
					$sql_rtrim = substr($sql_data, 0, -3);
					$sql = "DELETE FROM albums_songs WHERE $sql_rtrim";
					$this->db->query($sql);
					$sql_del = [];
					foreach ($song_del_id as $value) {
						$sql_del[] = "id = '".$value['id']."' OR ";
					}
					$sql_data = implode('', $sql_del);
					$sql_len = strlen($sql_data) - 3;
					$sql_rtrim = substr($sql_data, 0, -3);
					$sql = "DELETE FROM songs WHERE $sql_rtrim";
				
					$res = $this->db->query($sql);
					
					if($res) {
						$this->err_msg['upd_song_list_msg'] = 'You have successfully updated song list for this product';
					} else {
						$this->err_msg['error'] = 'There was a problem with updating song list on '. date('d.m.Y  H:i:s');
					}
				} 

				if (!empty($to_insert)) {
					$id_count = count($to_insert);
					$sql_ins = [];
					foreach ($to_insert as $value) {
						$sql_ins[] = "('".$value."')";
					}

					$new_song = implode(',', $sql_ins);
					$sql = "INSERT INTO songs (title) VALUES $new_song";
					$this->db->query($sql);
					$sql = "SELECT id FROM songs ORDER BY id DESC LIMIT $id_count";
					$song_del_id = $this->db->get_results($sql);
					$sql_ins = [];
					foreach ($song_del_id as $value) {
						$sql_ins[] = "(".intval($id).",".intval($value['id']).")";
					}
					$sql_data = implode(',', $sql_ins);
					$sql = "INSERT INTO albums_songs (id_albums,id_songs) VALUES $sql_data";
					$res = $this->db->query($sql);

					if($res) {
						$this->err_msg['upd_song_list_msg'] = 'You have successfully updated song list for this product';
					} else {
						$this->err_msg['error'] = 'There was a problem with updating song list on '. date('d.m.Y  H:i:s');
					}
				}

				$single = $data['upd_single'];
				$sql = "SELECT single FROM albums WHERE id = $id";
				$db_single = $this->db->get_row($sql);

				if ($single !== $db_single[0]) {
					$sql = "UPDATE albums SET single = '$single' WHERE id = $id";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['upd_single'] = 'You have successfully updated if product is a single or not';				
					} else {
						$this->err_msg['error'] = 'There was a problem with updating if product is a single or not on '. date('d.m.Y  H:i:s');
					}
				}

				$type = $data['type_select'];
				$sql = "SELECT type FROM albums WHERE id = $id";
				$db_type = $this->db->get_row($sql);

				if ($type !== $db_type[0]) {
					$sql = "UPDATE albums SET type = '$type' WHERE id = $id";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['upd_type'] = 'You have successfully updated product type';				
					} else {
						$this->err_msg['error'] = 'There was a problem with updating product type on '. date('d.m.Y  H:i:s');
					}
				}

				$genre_name = $data['upd_genre_list'];
				$genre_id = [];
				foreach ($genre_name as $value) {
					$genre_id[] = "genre = '".$value."' OR ";
				}
				$sql_data = implode('', $genre_id);
				$sql_len = strlen($sql_data) - 3;
				$sql_rtrim = substr($sql_data, 0, -3);
				$sql = "SELECT id FROM genres WHERE $sql_rtrim";
				$genre_id_multi = $this->db->get_results($sql);
				$genre_id_s = array_map('array_values', $genre_id_multi);
				$id_genre = [];
				foreach ($genre_id_s as $value) {
					array_push($id_genre, $value[0]);
				}


				$sql = "SELECT id_genres FROM album_genres WHERE id_album = $id";
				$db_genre_multi = $this->db->get_results($sql);
				$db_genre_s = array_map('array_values', $db_genre_multi);
				$db_genre = [];
				foreach ($db_genre_s as $value) {
					array_push($db_genre, $value[0]);
				}

				$to_insert = array_diff($id_genre, $db_genre);
				$to_delete = array_diff($db_genre, $id_genre);

				if (!empty($to_insert)) {
					$sql_ins_data = [];
					foreach ($to_insert as $value) {
						$sql_ins_data[] = "(".intval($id).",".intval($value).")";
					}
					$sql_data = implode(',', $sql_ins_data);
					$sql = "INSERT INTO album_genres (id_album, id_genres) VALUES $sql_data";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['upd_genre_msg'] = 'You have successfully updated product genre';
					} else {
						$this->err_msg['error'] = 'There was a problem with updating product genre on '. date('d.m.Y  H:i:s');
					}
				}

				if (!empty($to_delete)) {
					$sql_del_data = [];
					foreach ($to_delete as $value) {
						$sql = "DELETE FROM album_genres WHERE id_album = $id AND id_genres = $value";
						$res = $this->db->query($sql);
						if ($res) {
							$this->err_msg['upd_genre_msg'] = 'You have successfully updated product genre';
						} else {
							$this->err_msg['error'] = 'There was a problem with updating product genre on '. date('d.m.Y  H:i:s');
						}
					}					
				}

				$date = $data['upd_date_released'];
				$sql = "SELECT date_released FROM albums WHERE id = $id";
				$db_date = $this->db->get_row($sql);

				if ($date !== $db_date[0]) {
					$sql = "UPDATE albums SET date_released = '$date' WHERE id = $id";					
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['upd_release_date_msg'] = 'You have successfully updated product release date';
					} else {
						$this->err_msg['error'] = 'There was a problem with updating product release date on '. date('d.m.Y  H:i:s');
					}
				}

				$inventory = $data['upd_inventory_amount'];

				$sql = "SELECT inventory_total FROM albums WHERE id = $id";
				$db_inventory = $this->db->get_row($sql);

				if ($inventory !== $db_inventory) {
					$sql = "UPDATE albums SET inventory_total = $inventory WHERE id = $id";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['upd_inventory_msg'] = 'You have successfully updated inventory amount for product';
					} else {
						$this->err_msg['error'] = 'There was a problem with updating product inventory amount on '. date('d.m.Y  H:i:s');
					}
				}

				$price = $data['upd_price'];
				$sql = "SELECT price FROM albums WHERE id = $id";
				$db_price = $this->db->get_row($sql);

				if ($price !== $db_price) {
					$sql = "UPDATE albums SET price = $price WHERE id = $id";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['upd_price_msg'] = 'You have successfully updated a price for product';
					} else {
						$this->err_msg['error'] = 'There was a problem with updating product price on '. date('d.m.Y  H:i:s');
					}
				}			
			return $this->err_msg;		
			
		}


		public function product_delete($data){


			$id = intval($data['srch_radio']);

			$sql = "SELECT id_songs FROM albums_songs WHERE id_albums = $id";
			$songs_id = $this->db->get_results($sql);

			$sql_data = [];
			foreach ($songs_id as $value) {
				$sql_data[] = "id = " . $value['id_songs'] . " OR ";
			}
			$sql_data = implode('', $sql_data);
			$sql_len = strlen($sql_data) - 3;
			$sql_rtrim = substr($sql_data, 0, -3);

			$sql = "DELETE FROM albums_songs WHERE id_albums = $id";
			$this->db->query($sql);

			$sql = "DELETE FROM songs WHERE $sql_rtrim";
			$this->db->query($sql);

			$sql = "DELETE FROM albums_songs WHERE id_albums = $id";
			$this->db->query($sql);
			
			$sql = "DELETE FROM album_genres WHERE id_album = $id";
			$this->db->query($sql);

			$sql = "DELETE FROM artists_albums WHERE id_albums = $id";
			$this->db->query($sql);

			$sql = "SELECT id_images FROM albums WHERE id = $id";
			$res = $this->db->get_row($sql);
			$id_img = intval($res[0]);

			$sql = "SELECT img_root FROM images WHERE id = $id_img";
			$img_root = $this->db->get_row($sql);
			$img_dir = dirname($img_root[0]);

			$sql = "DELETE FROM albums WHERE id = $id";
			$this->db->query($sql);

			$sql = "DELETE FROM images WHERE id = $id_img";
			$res = $this->db->query($sql);
			
			unlink($img_root[0]);
			if (dir_is_empty($img_dir)) {
				rmdir($img_dir);				
			}

			if ($res) {
				$this->err_msg['product_delete_success'] = 'You have successfully deleted a product';
			} else {
				$this->err_msg['error'] = 'There was a problem with deleting a product on '. date('d.m.Y  H:i:s');
			}





			return $this->err_msg;

		}

		public function artist_insert($data, $file = false) {

			if ($file == true && !empty($file)) {
				$artist = $data['artist_name_ins'];
				$img_tmp = $file['tmp_name'];
				$img_format = explode('/', $file['type']);
				$img_ext = '.'. $img_format[1];
				$img_name = img_name_dir($artist) . $img_ext;
				$dir = PUBROOT . '\images\artists';
				$album_dir = $dir . '\\' . img_name_dir($artist, true);
				if (!file_exists($album_dir)) {							
					if (mkdir($album_dir, 0777, true)) {
						move_uploaded_file($img_tmp, $album_dir . '\\' . $img_name);
						$img_url = URLROOT . "/images/artists/" . $artist . "/" . $img_name;							
					}
				} elseif (file_exists($album_dir)) {				
					move_uploaded_file($img_tmp, $album_dir . '\\' . $img_name);
					$img_url = URLROOT . "/images/artists/" . img_name_dir($artist, true) . "/" . $img_name;						
				} else {
					$this->err_msg['error'] = 'Error : There was a problem with image uploading from artist insert form on ' . date('d.m.Y  H:i:s');	
					return $this->err_msg;
				}
				$img_root = $album_dir . '\\' . $img_name;
				$sql_root = addslashes($img_root);
				$sql = "INSERT INTO images (img_url,img_root) VALUES ('$img_url', '$sql_root')";
				if ($this->db->query($sql)) {
					$this->err_msg['ok'] = 'ok';				
				} else {
					$sql = "DELETE FROM images WHERE id = last_insert_id()";
					$this->db->query($sql);
					$this->err_msg['error'] = 'There was a problem with inserting a new product on '. date('d.m.Y  H:i:s');				
				}	
			}


			if (!empty($data['artist_name_ins'])) {

				$name = $data['artist_name_ins'];
				$desc = $this->db->clear($data['artist_ins_desc']);


				if (!empty($file)) {
					$sql = "INSERT INTO artists (name, description,id_images) VALUES ('$name', '$desc', last_insert_id())";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['ok'] = 'ok';	
					} else {
						$this->err_msg['error'] = 'Error : There was a problem with image inserting new artist on ' . date('d.m.Y  H:i:s');
					}				
				} elseif (empty($file)) {
					$sql = "INSERT iNTO artists (name, description, id_images) VALUES ('$name', '$desc', 128)";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['ok'] = 'ok';	
					} else {
						$this->err_msg['error'] = 'Error : There was a problem with image inserting new artist on ' . date('d.m.Y  H:i:s');
					}	
				} elseif (empty($desc)) {
					$sql = "INSERT INTO artists (name, description, id_images) VALUES ('$name', NULL, last_insert_id())";
					$res = $this->db->query($sql);
					if ($res) {
						$this->err_msg['ok'] = 'ok';	
					} else {
						$this->err_msg['error'] = 'Error : There was a problem with image inserting new artist on ' . date('d.m.Y  H:i:s');
					}				
				}
			}

			return $this->err_msg;			
		}

		public function orders($processed = true){
			if ($processed == false) {
				$sql = "SELECT orders.id, orders.create_date, orders.order_notes, orders.order_status, users.first_name, users.last_name, users.username, address.address1, address.postal_code, city.city, country.country, address.phone, group_concat(orders_albums.id_albums) AS 'album_id',group_concat(albums.title) AS 'album_title', group_concat(albums.price) AS 'album_price', group_concat(orders_albums.quantity) AS 'quantity', orders.total FROM orders INNER JOIN users ON orders.id_user=users.id INNER JOIN orders_albums ON orders.id=orders_albums.id_orders INNER JOIN albums ON orders_albums.id_albums=albums.id JOIN address ON address.id = users.id_address JOIN city ON city.id = address.id_city JOIN country ON country.id = city.id_country GROUP BY orders.id";
				$res = $this->db->get_results($sql);
				return $res;
				
			} else {
				$sql = "SELECT orders_archive.id, orders_archive.id_user, orders_archive.order_date, orders_archive.order_notes, orders_archive.product_titles, orders_archive.quantity, orders_archive.total, orders_archive.unit_price, orders_archive.date_created, orders_archive.order_end_status, users.first_name, users.last_name, users.username, users.email FROM orders_archive INNER JOIN users ON orders_archive.id_user = users.id ORDER BY orders_archive.date_created DESC";
				$res = $this->db->get_results($sql);
				return $res;				
			}
		}

		public function processing_order($data, $remove = false){
			if ($remove === false) {
				$ord_id = intval($data['btn_inf']);

				$sql = "UPDATE orders SET order_status = 'processed' WHERE id = $ord_id";
				$this->db->query($sql);

				$sql = "SELECT orders.id_user, orders.id, orders.create_date, orders.order_notes, orders.order_status, users.first_name, users.last_name, users.username, group_concat(orders_albums.id_albums) AS 'album_id',group_concat(albums.title) AS 'album_title', group_concat(albums.price) AS 'album_price', group_concat(orders_albums.quantity) AS 'quantity', orders.total FROM orders INNER JOIN users ON orders.id_user=users.id INNER JOIN orders_albums ON orders.id=orders_albums.id_orders INNER JOIN albums ON orders_albums.id_albums=albums.id WHERE orders.id = $ord_id";
				$ord_info = $this->db->get_row($sql);
				

				$ord_user = intval($ord_info[0]);
				$order_date = $ord_info[2];
				$order_note = $ord_info[3];
				$order_prod_titles = $ord_info[9];
				$order_quantity = $ord_info[11];
				$order_total = $ord_info[12];
				$order_u_price = $ord_info[10];

				$prod_array = explode(',', $order_prod_titles);
				$inv_array = explode(',', $order_quantity);									
				foreach ($prod_array as $key => $value) {
					$sql = "SELECT inventory_total FROM albums WHERE title = '$value'";
					$db_inv = $this->db->get_row($sql);
					$new_inv = $db_inv[0] - $inv_array[$key];
					$sql = "SELECT items_sold FROM albums WHERE title = '$value'";
					$sold = $this->db->get_row($sql);
					$new_sold = $sold[0] + $inv_array[$key];
					$sql = "UPDATE albums SET inventory_total = $new_inv, items_sold = $new_sold WHERE title = '$value'";
					$this->db->query($sql);
				}
				


				$sql = "INSERT INTO orders_archive (id_user, order_date, order_notes, product_titles, quantity, total, unit_price) VALUES ($ord_user, '$order_date', '$order_note', '$order_prod_titles', '$order_quantity', '$order_total', '$order_u_price')";				
				$this->db->query($sql);
				
				$ord_ord_id = intval($ord_info[1]);
				$sql = "DELETE FROM orders_albums WHERE id_orders = $ord_ord_id";
				$this->db->query($sql);
				$sql = "DELETE FROM orders WHERE id = $ord_ord_id";
				$res = $this->db->query($sql);
				if ($res) {
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem inserting new processed order on ' . date('d.m.Y  H:i:s');
				}
				return $this->err_msg;

			} elseif ($remove === true) {
				$ord_id = intval($data['btn_rmv_inf']);
				
				$sql = "UPDATE orders SET order_status = 'processed' WHERE id = $ord_id";
				$this->db->query($sql);

				$sql = "SELECT orders.id_user, orders.id, orders.create_date, orders.order_notes, orders.order_status, users.first_name, users.last_name, users.username, group_concat(orders_albums.id_albums) AS 'album_id',group_concat(albums.title) AS 'album_title', group_concat(albums.price) AS 'album_price', group_concat(orders_albums.quantity) AS 'quantity', orders.total FROM orders INNER JOIN users ON orders.id_user=users.id INNER JOIN orders_albums ON orders.id=orders_albums.id_orders INNER JOIN albums ON orders_albums.id_albums=albums.id WHERE orders.id = $ord_id";
				$ord_info = $this->db->get_row($sql);

				$ord_user = intval($ord_info[0]);
				$order_date = $ord_info[2];
				$order_note = $ord_info[3];
				$order_prod_titles = $ord_info[9];
				$order_quantity = $ord_info[11];
				$order_total = $ord_info[12];
				$order_u_price = $ord_info[10];

				$prod_array = explode(',', $order_prod_titles);
				$inv_array = explode(',', $order_quantity);						
				foreach ($prod_array as $key => $value) {
					$sql = "SELECT inventory_presented FROM albums WHERE title = '$value'";
					$db_inv = $this->db->get_row($sql);
					$new_inv = $db_inv[0] + $inv_array[$key];
					$sql = "UPDATE albums SET inventory_presented = $new_inv WHERE title = '$value'";
					$this->db->query($sql);
				}
				

				$sql = "INSERT INTO orders_archive (id_user, order_date, order_notes, product_titles, quantity, total, unit_price, order_end_status) VALUES ($ord_user, '$order_date', '$order_note', '$order_prod_titles', '$order_quantity', '$order_total', '$order_u_price', 'canceled')";
				$this->db->query($sql);
				$ord_ord_id = intval($ord_info[1]);
				$sql = "DELETE FROM orders_albums WHERE id_orders = $ord_ord_id";
				$this->db->query($sql);
				$sql = "DELETE FROM orders WHERE id = $ord_ord_id";
				$res = $this->db->query($sql);
				if ($res) {
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem order canceling on ' . date('d.m.Y  H:i:s');
				}
				return $this->err_msg;
			}
		}

		public function product_sale($data){

			$id_album = intval($data['prod_id']);
			$precentage = intval($data['discount']);
			$starting_point = intval($data['starting_point']);
			$duration = intval($data['duration_db']);


			$sql = "INSERT INTO sales (id_album, precentage, starting_point, duration) VALUES ($id_album, $precentage, $starting_point, $duration)";
			$res = $this->db->query($sql);

			$sql = "SELECT id_album FROM sales WHERE expired = 'no' ORDER BY id DESC LIMIT 1";
			$res = $this->db->get_row($sql);
			$sale_id = $res[0];
			$sql = "SELECT price FROM albums WHERE id = $sale_id";
			$old_price = $this->db->get_row($sql);
			$old_price = $old_price[0];
			$new_price = $old_price - ($old_price * ($precentage/100));
			$sql = "UPDATE albums SET price = $new_price, on_sale = 'yes' WHERE id = $sale_id";
			$res = $this->db->query($sql);
			if ($res) {
				$this->err_msg['server_response_ok'] = 'ok';
			} else {
				$this->err_msg['error'] = 'Error : There was a problem with inserting a product sale on ' . date('d.m.Y  H:i:s');
			}

			return $this->err_msg;
		}

		public function getUsersTable(){
			$sql = "SELECT users.id, users.first_name, users.last_name, users.username, users.email, users.permission, users.active, users.create_date, images.img_url, address.address1 FROM users JOIN images ON images.id = users.id_img JOIN address ON address.id = users.id_address WHERE users.permission = 'admin' OR users.permission = 'regular' ORDER BY users.id ASC";

			$res = $this->db->get_results($sql, true);
			return $res;
		}

		public function change_permission($id, $admin){
			
			if ($admin == 'admin') {
				$sql = "UPDATE users SET permission = 'admin' WHERE id = $id";	
				$res = $this->db->query($sql);
				if ($res) {
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem with updating user permission on ' . date('d.m.Y  H:i:s');
				}		
			} elseif($admin == 'regular') {
				$sql = "UPDATE users SET permission = 'regular' WHERE id = $id";
				$res = $this->db->query($sql);
				if ($res) {
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem with updating user permission on ' . date('d.m.Y  H:i:s');
				}	
			}
			return $this->err_msg;
		}

		public function getMail($inbox = true){
			if ($inbox == true) {
				$sql = "SELECT * FROM contact_us WHERE source = 'inbox' ORDER BY create_date DESC";

				$res = $this->db->get_results($sql);

				return $res;				
			} elseif ($inbox == false){
				$sql = "SELECT * FROM contact_us WHERE source = 'outbox' ORDER BY create_date DESC";

				$res = $this->db->get_results($sql);

				return $res;
			}
		}

		public function removeMail($id){
			$sql = "DELETE FROM contact_us WHERE id = $id";

			$res = $this->db->query($sql);

			if ($res) {
				$this->err_msg['server_response_ok'] = 'ok';
			} else {
				$this->err_msg['error'] = 'Error : There was a problem with removing mail on ' . date('d.m.Y  H:i:s');
			}


		}

		public function sentMail($data){
			$to = $data['to'];
			$subject = $data['subject'];
			$message = $this->db->clear($data['message']);
			$sql = "INSERT INTO contact_us (name, email, subject, message, source) VALUES ('vinyl.com', '$to', '$subject', '$message', 'outbox')";
			if ($this->db->query($sql)) {
				$this->err_msg['server_response_ok'] = 'ok'; 
			} else {
				$this->err_msg['error'] = 'Error : There was a problem with inserting sent email on ' . date('d.m.Y  H:i:s');
			}

			return $this->err_msg;
		}

		public function changeMailStatus($id){
			$sql = "UPDATE contact_us SET viewed = '1' WHERE id = $id";

			$res = $this->db->query($sql);
			if ($res) {
				$this->err_msg['server_response_ok'] = 'ok';
			} else {
				$this->err_msg['error'] = 'Error : There was a problem with updating mail status on ' . date('d.m.Y  H:i:s');
			}	
		}

		public function change_user_img($file){
			$id = $_SESSION['user']->id;
			$sql = "SELECT username FROM users WHERE id = $id";
			$res = $this->db->get_row($sql);
			$username = $res[0];
			$img_tmp = $file['tmp_name'];
			$img_format = explode('/', $file['type']);
			$img_ext = '.'. $img_format[1];
			$img_name = time().'_user_' . $username . $img_ext;			
			$img_dir_name = '_userdir_' . $username;			
			$dir = PUBROOT . '\images\users';
			$user_dir = $dir . '\\' . img_name_dir($img_dir_name, true);
		
			if (!file_exists($user_dir)) {							
				if (mkdir($user_dir, 0777, true)) {
					move_uploaded_file($img_tmp, $user_dir . '\\' . $img_name);
					$img_url = URLROOT . "/images/users/" . $img_dir_name . "/" . $img_name;			
				}
			} elseif (file_exists($user_dir)) {	
				$files = glob($user_dir . '/*');
				foreach($files as $file){ 
				  if(is_file($file))
				    unlink($file);
				}			
				move_uploaded_file($img_tmp, $user_dir . '\\' . $img_name);
				$img_url = URLROOT . "/images/users/" . $img_dir_name . "/" . $img_name;

			} else {
				$this->err_msg['error'] = 'Error : There was a problem with image uploading on ' . date('d.m.Y  H:i:s');	
				return $this->err_msg;
			}
			$user_id = $_SESSION['user']->id;
			$img_url = URLROOT . "/images/users/" . $img_dir_name . "/" . $img_name;		
			$img_root = $user_dir . '\\' . $img_name;
			$sql_img_root = addslashes($img_root);
			$sql = "SELECT id_img FROM users WHERE id = $user_id";
			$res = $this->db->get_row($sql);
			$db_img_id = $res[0];
			if ($db_img_id == 143) {
				$sql = "INSERT INTO images (img_url, img_root) VALUES ('$img_url', '$sql_img_root')";
				$this->db->query($sql);
				$sql = "SELECT id FROM images ORDER BY id DESC LIMIT 1";
				$res = $this->db->get_row($sql);
				$img_id = $res[0];
				$sql = "UPDATE users SET id_img = $img_id WHERE id = $user_id";
				if($this->db->query($sql)){
					$this->err_msg['img_url'] = $img_url;
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem with inserting new user image on ' . date('d.m.Y  H:i:s');
				}				
			} else {
				$sql = "UPDATE images SET img_url = '$img_url', img_root = '$img_root' WHERE id = $db_img_id";
							
				if($this->db->query($sql)){
					$this->err_msg['img_url'] = $img_url;
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem with inserting new user image on ' . date('d.m.Y  H:i:s');
				}
			}

			return $this->err_msg;
		}

		public function user_info_change($data){
			$id = $_SESSION['user']->id;
			if (isset($data['new_fn'])) {
				$first_name = $data['new_fn'];
				$sql = "UPDATE users SET first_name = '$first_name' WHERE id = $id";
				if($this->db->query($sql)){
					$this->err_msg['first_name'] = $first_name;
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem with inserting new user first name on ' . date('d.m.Y  H:i:s');
				}
			}

			if (isset($data['new_ln'])) {
				$last_name = $data['new_ln'];
				$sql = "UPDATE users SET last_name = '$last_name' WHERE id = $id";
				if($this->db->query($sql)){
					$this->err_msg['last_name'] = $last_name;
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem with inserting new user last name on ' . date('d.m.Y  H:i:s');
				}
			}

			if (isset($data['new_us'])) {
				$username = $data['new_us'];
				$sql = "UPDATE users SET username = '$username' WHERE id = $id";
				if($this->db->query($sql)){
					$this->err_msg['username'] = $username;
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem with inserting new user username on ' . date('d.m.Y  H:i:s');
				}
			}

			if (isset($data['new_em'])) {
				$email = $data['new_em'];

				$sql = "SELECT permission FROM users WHERE email = '$email'";
				$res = $this->db->get_row($sql);
				$permission = $res[0];

				if ($permission == 'not_registered') {
					$new_email = time() . $email;
					$sql = "UPDATE users SET email = '$new_email' WHERE email = '$email'";
					$this->db->query($sql);
					$sql = "UPDATE users SET email = '$email' WHERE id = $id";
					if($this->db->query($sql)){
						$this->err_msg['email'] = $email;
						$this->err_msg['server_response_ok'] = 'ok';
					} else {
						$this->err_msg['error'] = 'Error : There was a problem with inserting new user email on ' . date('d.m.Y  H:i:s');
					}
				} else {
					$sql = "UPDATE users SET email = '$email' WHERE id = $id";
					if($this->db->query($sql)){
						$this->err_msg['email'] = $email;
						$this->err_msg['server_response_ok'] = 'ok';
					} else {
						$this->err_msg['error'] = 'Error : There was a problem with inserting new email name on ' . date('d.m.Y  H:i:s');
					}
				}
			}

			if (isset($data['new_pass'])) {
				$password = $data['new_pass'];				
				$sql = "UPDATE users SET password = '$password' WHERE id = $id";
				if($this->db->query($sql)){					
					$this->err_msg['server_response_ok'] = 'ok';
				} else {
					$this->err_msg['error'] = 'Error : There was a problem with inserting new user password on ' . date('d.m.Y  H:i:s');
				}

			}
			return $this->err_msg;
		}

		public function password_check($password){
			$id = $_SESSION['user']->id;
			$sql = "SELECT password FROM users WHERE id = $id";
			$res = $this->db->get_row($sql);
			$pass = $res[0];

			if (password_verify($password, $pass)) {
				return true;
			} else {
				return false;
			}
		}

		public function get_u_orders($id){
			$sql = "SELECT orders_albums.id_orders, group_concat(orders_albums.id_albums) AS albums, group_concat(orders_albums.quantity) AS quantity, group_concat(albums.title) AS titles, group_concat(albums.price) AS album_price, group_concat(albums.id_images) AS id_images, group_concat(images.img_url) AS img_url, orders.id_user, orders.order_notes, orders.create_date, orders.total FROM orders_albums JOIN orders ON orders.id = orders_albums.id_orders JOIN albums ON orders_albums.id_albums = albums.id JOIN images ON images.id = albums.id_images WHERE orders.id_user = $id GROUP BY orders.id";

			$res = $this->db->get_results($sql, true);

			return $res;
		}

		public function get_u_archive($id){
			$sql = "SELECT * FROM orders_archive WHERE id_user = $id ORDER BY id DESC";

			$res = $this->db->get_results($sql, true);

			return $res;
		}

		public function get_u_address($id){
			$sql = "SELECT users.id_address, address.address1, address.postal_code, address.phone, city.city, country.country FROM users JOIN address ON address.id = users.id_address JOIN city ON city.id = address.id_city JOIN country ON country.id = city.id_country WHERE users.id = $id";

			$res = $this->db->get_row($sql, true);

			return $res;
		}

		public function user_address_upd($id, $data){
			$address = $this->db->clear($data['address']);
			$postal_code = $data['postal_code'];
			$city = $data['city'];
			$country = $data['country'];
			$phone = $data['phone'];

			$sql = "SELECT id_address FROM users WHERE id = $id";
			$res = $this->db->get_row($sql);
			$id_address = $res[0];

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


			$sql = "UPDATE address SET address1 = '$address', postal_code = '$postal_code', phone = '$phone', id_city = $city_id WHERE id = $id_address";

			if($this->db->query($sql)){					
				$this->err_msg['server_response_ok'] = 'ok';
			} else {
				$this->err_msg['error'] = 'Error : There was a problem with updating user address on ' . date('d.m.Y  H:i:s');
			}


		}
	}

	