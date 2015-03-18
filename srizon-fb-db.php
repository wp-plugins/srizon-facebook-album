<?php

class SrizonFBDB {
	static function SaveCommonOpt() {
		$optvar = array();
		$optvar['loadlightbox'] = $_POST['loadlightbox'];
		$optvar['lightboxattrib'] = $_POST['lightboxattrib'];
		$optvar['backtogallerytxt'] = $_POST['backtogallerytxt'];
		update_option('srzfbcomm', $optvar);
		return $optvar;
	}

	static function GetCommonOpt() {
		$optvar = get_option('srzfbcomm');
		if (!empty($optvar)) {
			if(!isset($optvar['backtogallerytxt'])) $optvar['backtogallerytxt'] = '[Back To Gallery]';
			return $optvar;
		}
		else {
			$optvardef = array();
			$optvardef['loadlightbox'] = 'mp';
			$optvardef['backtogallerytxt'] = '[Back To Gallery]';
			$optvardef['lightboxattrib'] = 'class="lightbox" rel="lightbox"';
			add_option('srzfbcomm', $optvardef, '', true);
			return $optvardef;
		}
	}

	static function SaveAlbum($new = false) {
		global $wpdb;
		$table = $wpdb->base_prefix . 'srzfb_albums';
		$data['title'] = $_POST['title'];
		$data['albumid'] = $_POST['albumid'];
		$data['options'] = serialize($_POST['options']);
		if ($new) {
			$wpdb->insert($table, $data);
			return $wpdb->insert_id;
		} else {
			$wpdb->update($table, $data, array('id' => $_POST['id']));
			return $_POST['id'];
		}
	}

	static function SaveGallery($new = false) {
		global $wpdb;
		$table = $wpdb->base_prefix . 'srzfb_galleries';
		$data['title'] = $_POST['title'];
		$data['pageid'] = trim($_POST['pageid']);
		$data['options'] = serialize($_POST['options']);
		if ($new) {
			$wpdb->insert($table, $data);
			return $wpdb->insert_id;
		} else {
			$wpdb->update($table, $data, array('id' => $_POST['id']));
			return $_POST['id'];
		}
	}

	static function GetAlbum($id) {
		global $wpdb;
		$table = $wpdb->base_prefix . 'srzfb_albums';
		$q = $wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id);
		$album = $wpdb->get_row($q);
		if (!$album) return false;
		$ret = array();
		$ret['id'] = $id;
		$ret['title'] = $album->title;
		$ret['albumid'] = $album->albumid;
		$options = unserialize($album->options);
		foreach ($options as $key => $value) {
			$ret[$key] = $value;
		}

		$value_arr = array(
			'title' => '',
			'albumid' => '',
			'updatefeed' => '600',
			'image_sorting' => 'default',
			'totalimg' => '25',
			'layout' => 'collage_thumb',
			'tpltheme' => 'white',
			'paginatenum' => '18',
			'targetheight' => '200',
			'collagepadding' => '2',
			'collagepartiallast' =>  'false',
			'hovercaption' =>  '1',
			'hovercaptiontype' =>  '0',
			'showhoverzoom' =>  '1',
			'animationspeed' =>  '500',
			'maxheight' =>  '500',
			'app_id' => '',
			'app_secret' => '',
		);

		foreach ( $value_arr as $key => $value ) {
			if(!isset($ret[$key]) ) $ret[$key] = $value ;
		}
		return $ret;
	}

	static function GetGallery($id) {
		global $wpdb;
		$table = $wpdb->base_prefix . 'srzfb_galleries';
		$q = $wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id);
		$album = $wpdb->get_row($q);
		$ret = array();
		$ret['id'] = $id;
		$ret['title'] = $album->title;
		$ret['pageid'] = $album->pageid;
		$options = unserialize($album->options);
		foreach ($options as $key => $value) {
			$ret[$key] = $value;
		}

		$value_arr = array(
			'include_exclude'    => 'exclude',
			'excludeids'         => '',
			'updatefeed'         => '600',
			'image_sorting'      => 'default',
			'album_sorting'      => 'default',
			'liststyle'          => 'slidergridv',
			'totalimg'           => '25',
			'paginatenum'        => '18',
			'collagepadding'     => '2',
			'collagepartiallast' => '0',
			'hovercaption'       => '1',
			'hovercaptiontype'   => '0',
			'show_image_count'   => '1',
			'showhoverzoom'      => '1',
			'maxheight'          => '250',
			'app_id'             => '',
			'app_secret'         => '',
		);

		foreach ( $value_arr as $key => $value ) {
			if(!isset($ret[$key]) ) $ret[$key] = $value ;
		}

		return $ret;
	}

	static function GetAllAlbums() {
		global $wpdb;
		$table = $wpdb->base_prefix . 'srzfb_albums';
		$albums = $wpdb->get_results("SELECT id, title FROM $table");
		return $albums;
	}

	static function GetAllGalleries() {
		global $wpdb;
		$table = $wpdb->base_prefix . 'srzfb_galleries';
		$albums = $wpdb->get_results("SELECT id, title FROM $table");
		return $albums;
	}

	static function DeleteAlbum($id) {
		global $wpdb;
		$table = $wpdb->base_prefix . 'srzfb_albums';
		$q = $wpdb->prepare("delete from $table where id = %d", $id);
		$wpdb->query($q);
	}

	static function SyncAlbum($id) {
		$album = SrizonFBDB::GetAlbum($id);
		$ids = SrizonFBDB::srz_fb_extract_ids($album['albumid']);
		foreach ($ids as $albumid) {
			$filename = JPATH_CACHE . '/jfbalbum/' . md5($albumid);
			unlink($filename);
//			delete_transient($filename);
		}
	}

	static function SyncGallery($id) {
		$page = SrizonFBDB::GetGallery($id);
		$filename = JPATH_CACHE . '/jfbalbum/' . md5($page['pageid']);
		if(!is_file($filename)) return;
		$contents = file_get_contents($filename);
		$imgs = json_decode($contents);
		if (is_array($imgs)) {
			foreach ($imgs as $obj) {
				$filename = JPATH_CACHE . '/jfbalbum/' . md5($obj->id);
				if(is_file($filename)) unlink($filename);
//				delete_transient($filename);
			}
		}
		$filename = JPATH_CACHE . '/jfbalbum/' . md5($page['pageid']);
		unlink($filename);
//		delete_transient($filename);
	}

	static function srz_fb_extract_ids($lines) {
		$lines = str_replace(' ', "\n", $lines);
		$lines_arr = explode("\n", $lines);
		$id_arr = array();
		foreach ($lines_arr as $line) {
			if (strlen(trim($line)) < 5) continue;
			if (strpos($line, 'set=a.')) {
				$line = substr($line, strpos($line, 'set=a.') + 6);
				$line = substr($line, 0, strpos($line, '.'));
			}
			$id_arr[] = trim($line);
		}
		if (isset($_GET['debugjfb'])) {
			echo 'Dumping IDs<pre>';
			print_r($id_arr);
			echo '</pre>';
		}
		return $id_arr;
	}

	static function DeleteGallery($id) {
		global $wpdb;
		$table = $wpdb->base_prefix . 'srzfb_galleries';
		$q = $wpdb->prepare("delete from $table where id = %d", $id);
		$wpdb->query($q);
	}

	static function CreateDBTables() {
		global $wpdb;
		$t_albums = $wpdb->base_prefix . 'srzfb_albums';
		$t_galleries = $wpdb->base_prefix . 'srzfb_galleries';
		$sql = '
CREATE TABLE ' . $t_albums . ' (
  id int(11) NOT NULL AUTO_INCREMENT,
  title text CHARACTER SET utf8,
  albumid text CHARACTER SET utf8,
  options text CHARACTER SET utf8,
  PRIMARY KEY (id)
);
CREATE TABLE ' . $t_galleries . ' (
  id int(11) NOT NULL AUTO_INCREMENT,
  title text CHARACTER SET utf8,
  pageid varchar(512) DEFAULT NULL,
  options text CHARACTER SET utf8,
  PRIMARY KEY (id)
);	
';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

	static function DeleteDBTables() {
		global $wpdb;
		$t_albums = $wpdb->base_prefix . 'srzfb_albums';
		$t_galleries = $wpdb->base_prefix . 'srzfb_galleries';
		$sql = 'drop table ' . $t_albums . ', ' . $t_galleries . ';';
		$wpdb->query($sql);
	}
}
