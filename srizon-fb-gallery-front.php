<?php
function srz_fb_gallery_shortcode($atts) {
	if (!isset($atts['id'])) return 'Invalid shortcode... ID missing';
	$pageid = $atts['id'];
	$page = SrizonFBDB::GetGallery($pageid);
	$set = isset($_GET['id']) ? $_GET['id'] : '';
	if (!$page) return 'Page Not Found';
	if (isset($_GET['debugjfb'])) {
		echo 'Dumping Params<pre>';
		print_r($page);
		echo '</pre>';
	}
	if (!isset($GLOBALS['imggroup'])) $GLOBALS['imggroup'] = 1;
	else $GLOBALS['imggroup']++;
	if ($set == '') $images = srz_fb_get_fb_gallery($page['pageid'], $page['album_sorting'], $page['updatefeed'] * 60);
	else $images = srz_fb_get_album_api($set, $page['image_sorting'], $page['updatefeed'] * 60);
	//$images = array_slice($images_all,0,$page['totalimg']);
	$common_options = SrizonFBDB::GetCommonOpt();
	if ($common_options['loadlightbox'] != 'no') {
		$common_options['secondclass'] = ' mpjfb';
		$common_options['lightboxattrib'] = '';
	} else {
		$common_options['lightboxattrib'] = stripslashes($common_options['lightboxattrib']);
	}
	$output = srz_fb_render_fullpage_gallery($page, $images, $common_options);
	return $output;
}

function srz_fb_render_fullpage_gallery($page, $images, $common_options) {
	$set = isset($_GET['id']) ? $_GET['id'] : '';
	$data = '';
	if ($set) {
		$pagetitle = srz_fb_get_pagetitle($page['pageid'], $set, $page['updatefeed'] * 60);
		if (!$pagetitle) return '';
		$url = $_SERVER['REQUEST_URI'];//get_page_link();
		if ($pos1 = strpos($url, '?id=')) {
			$url = substr($url, 0, $pos1);
		} else if ($pos1 = strpos($url, '&amp;id=')) {
			$url = substr($url, 0, $pos1);
		} else if ($pos1 = strpos($url, '&id=')) {
			$url = substr($url, 0, $pos1);
		}
		$pagetitle .= ' - <a href="' . $url . '">'.$common_options['backtogallerytxt'].'</a>';
		$data .= '<h2 class="entry-title" style="font-size:18px;">' . $pagetitle . '</h2>';
	}
	if ($set) $data .= '<div class="jfbalbum' . $common_options['secondclass'] . '" id="jfbalbum-' . $GLOBALS['imggroup'] . '">';
	else $data .= '<div class="jfbgallery" id="jfbalbum-' . $GLOBALS['imggroup'] . '">';
	$totimg = count($images);
	$getjfpage = isset($_GET['jfpage']) ? $_GET['jfpage'] : 0;
	$jf_start = $getjfpage * $page['paginatenum'];
	$jf_end = min($totimg, ($jf_start + $page['paginatenum']));
	$imgboxclass = ($page['tpltheme'] == 'white') ? 'imgboxblack' : 'imgboxwhite';
	for ($j = $jf_start; $j < $jf_end; $j++) {
		$image = $images[$j];
		if ($set != '') {
			$link = '<a class="aimg" style="width:' . $page['thumbwidth'] . 'px; height:' . $page['thumbheight'] . 'px;" href="' . $image['src'] . '" title="' . nl2br($image['txt']) . '" ' . $common_options['lightboxattrib'] . '>';
		} else {
			$url = $_SERVER['REQUEST_URI'];//get_page_link();
			if (strpos($url, '&jfpage')) {
				$url = substr($url, 0, strpos($url, '&jfpage'));
			} else if (strpos($url, '&amp;jfpage')) {
				$url = substr($url, 0, strpos($url, '&amp;jfpage'));
			} else if (strpos($url, '?jfpage')) {
				$url = substr($url, 0, strpos($url, '?jfpage'));
			}
			if (strpos($url, '?')) $url .= '&amp;id=' . $image['id'];
			else $url .= '?id=' . $image['id'];
			$link = '<a style="width:' . $page['thumbwidth'] . 'px; height:' . $page['thumbheight'] . 'px;" href="' . $url . '">';
		}
		if ($page['showtitlethumb'] == 'yes' and $set == '') {
			$compheight = $page['thumbheight'] + $page['titlethumb_height'];
		} else {
			$compheight = $page['thumbheight'];
		}
		if ($set == '') $imgcode = 'style="position: absolute; top: 0; left: 0; width:' . $page['thumbwidth'] . 'px; height:' . $page['thumbheight'] . 'px; background-image: url(' . $image['src'] . '); background-size:150%;"';
		else {
			$imgcode = 'style="width:' . $page['thumbwidth'] . 'px; height:' . $page['thumbheight'] . 'px; background-image: url(' . $image['thumb'] . ');"';
		}
		$data .= '<div class="imgboxouter" style="position:relative; width:' . $page['thumbwidth'] . 'px; height:' . $compheight . 'px;">';
		if ($set == '') $data .= '<div class="imgboxgallery" style="width:' . $page['thumbwidth'] . 'px; height:' . $page['thumbheight'] . 'px;"></div>';
		$data .= $link . '<div class="' . $imgboxclass . '" ' . $imgcode . '></div></a>';
		if ($page['showtitlethumb'] == 'yes' && $set == '') {
			$title2 = $image['title'];
			if ($page['truncate_len'] != '' and strlen($title2) > $page['truncate_len']) {
				$title2 = substr($title2, 0, $page['truncate_len']) . '...';
			}
			$topheight = $page['thumbheight'] + 5;
			$data .= '<div class="titlebelow" style="width:' . $page['thumbwidth'] . 'px; top:' . $topheight . 'px; height:' . $page['titlethumb_height'] . 'px;">' . $link . $title2 . '</a></div>';
		}
		$data .= '</div>';
	}
	$totalpages = ceil($totimg / $page['paginatenum']);
	if ($totalpages > 1) {
		$url = $_SERVER['REQUEST_URI'];//get_page_link();
		if ($jfpos = strpos($url, 'jfpage')) {
			$url = substr($url, 0, $jfpos - 1);
		}
		$url = str_replace('&', '&amp;', $url);
		if (strpos($url, '?')) $url .= '&amp;';
		else $url .= '?';
		$id_in_url = strpos($url, 'id=');
		if (isset($_GET['id']) and !$id_in_url) $url .= 'id=' . $_GET['id'] . '&amp;';
		$data .= '<div id="tnt_pagination">';
		if ($getjfpage > 4) {
			$pgstart = $getjfpage - 4;
			$data .= '<a href="' . $url . 'jfpage=0">First</a>';
		} else $pgstart = 0;
		$pgend = min($totalpages, $pgstart + 10);
		for ($k = $pgstart; $k < $pgend; $k++) {
			if ($k == $getjfpage) {
				$data .= '<span class="active_tnt_link">' . ($k + 1) . '</span>';
			} else {
				$data .= '<a href="' . $url . 'jfpage=' . $k . '">' . ($k + 1) . '</a>';
			}
		}
		if ($totalpages > $pgend) {
			$data .= '<a href="' . $url . 'jfpage=' . ($totalpages - 1) . '">Last</a>';
		}
		$data .= '</div>';
	}
	$data .= '<div style="clear:both; height:1px;"></div> </div>';
	return $data;
}

function srz_fb_get_pagetitle($pageid, $set, $cachetime) {
	$srz_cache_dir = dirname(__FILE__) . '/cache/';
	$pageidback = $pageid . 'back';
	/* delete cached file if expired*/
	if (is_file($srz_cache_dir.md5($pageid))) {
		$utime = filemtime($srz_cache_dir.md5($pageid));
		$chtime = time() - $cachetime;
		if($utime < $chtime) unlink($srz_cache_dir.md5($pageid));
	}
	/* get cached content from file or db*/
	if (is_writable($srz_cache_dir)) {
		$contents = @file_get_contents($srz_cache_dir.md5($pageid));
	} else {
		$contents = get_transient(md5($pageid));
	}
	/* Cached content not found so re-sync*/
	if (!$contents or isset($_GET['forcesync'])) {
		$url = "http://graph.facebook.com/" . $pageid . "/albums?fields=name,id,count,cover_photo";
		$contents = srz_fb_remote_to_data($url);
		/* re-sync failed so load backup data*/
		if (strlen($contents) <= 150) {
			if (is_writable($srz_cache_dir)) {
				$contents = @file_get_contents($srz_cache_dir.md5($pageidback));
			} else {
				$contents = get_transient(md5($pageidback));
			}
		}
		/* cache the re-synced or backup data*/
		if (strlen($contents) > 150) {
			if (is_writable($srz_cache_dir)) {
				file_put_contents($srz_cache_dir.md5($pageid),$contents);
				file_put_contents($srz_cache_dir.md5($pageidback),$contents);
			}else {
				set_transient(md5($pageid), $contents, $cachetime);
				set_transient(md5($pageidback), $contents, 1000000);
			}
		}
	}
	$json = json_decode($contents);
	foreach ($json->data as $obj) {
		if ($obj->id == $set) return $obj->name;
	}
	return '';
}

function srz_fb_get_fb_gallery($pageid, $sorting_albums, $cachetime) {
	if (isset($_GET['debugjfb'])) {
		echo 'Dumping page ID<pre>';
		print_r($pageid);
		echo '</pre>';
	}
	$srz_cache_dir = dirname(__FILE__) . '/cache/';
	$pageidback = $pageid . 'back';
	/* delete cached file if expired*/
	if (is_file($srz_cache_dir.md5($pageid))) {
		$utime = filemtime($srz_cache_dir.md5($pageid));
		$chtime = time() - $cachetime;
		if($utime < $chtime) unlink($srz_cache_dir.md5($pageid));
	}
	/* get cached content from file or db*/
	if (is_writable($srz_cache_dir)) {
		$contents = @file_get_contents($srz_cache_dir.md5($pageid));
	} else {
		$contents = get_transient(md5($pageid));
	}
	/* Cached content not found so re-sync*/
	if (!$contents or isset($_GET['forcesync'])) {
		$url = "http://graph.facebook.com/" . $pageid . "/albums?fields=name,id,count,cover_photo";
		$contents = srz_fb_remote_to_data($url);
		/* re-sync failed so load backup data*/
		if (strlen($contents) <= 150) {
			if (is_writable($srz_cache_dir)) {
				$contents = @file_get_contents($srz_cache_dir.md5($pageidback));
			} else {
				$contents = get_transient(md5($pageidback));
			}
		}
		/* cache the re-synced or backup data*/
		if (strlen($contents) > 150) {
			if (is_writable($srz_cache_dir)) {
				file_put_contents($srz_cache_dir.md5($pageid),$contents);
				file_put_contents($srz_cache_dir.md5($pageidback),$contents);
			}else {
				set_transient(md5($pageid), $contents, $cachetime);
				set_transient(md5($pageidback), $contents, 1000000);
			}
		}
	}
	if (isset($_GET['debugjfb'])) {
		echo 'Dumping Contents<pre>';
		print_r($contents);
		echo '</pre>';
	}
	$json = json_decode($contents);
	$images = array();
	$i = 0;
	if (is_array($json->data)) {
		foreach ($json->data as $obj) {
			$count = isset($obj->count) ? $obj->count : '';
			if (!$count) continue;
			$images[$i]['src'] = 'http://graph.facebook.com/' . $obj->cover_photo . '/picture?type=normal';
			$images[$i]['title'] = isset($obj->name) ? $obj->name : 'Untitled Album';
			$images[$i]['title'] = htmlspecialchars($images[$i]['title']);
			$images[$i]['title'] .= ' [' . $count . ']';
			$images[$i]['id'] = $obj->id;
			$i++;
		}
	} else {
		if (isset($_GET['debugjfb'])) {
			echo "Got an empty response from Facebook. Either the pageID is invalid or your server has connectivity problem with facebook";
		}
	}
	/* + Sorting/Shuffling */
	if ($sorting_albums == 'modified' or $sorting_albums == 'modifiedr') {
		usort($images, 'srz_sort_updated_time');
	} else if ($sorting_albums == 'created' or $sorting_albums == 'createdr') {
		usort($images, 'srz_sort_created_time');
	}
	if($sorting_albums == 'defaultr' or $sorting_albums == 'modifiedr' or $sorting_albums == 'createdr') {
		$images = array_reverse($images);
	}
	if ($sorting_albums == 'shuffle') shuffle($images);
	/* - Sorting/Shuffling */
	if (isset($_GET['debugjfb'])) {
		echo 'Dumping Images<pre>';
		print_r($images);
		echo '</pre>';
	}
	return $images;
}