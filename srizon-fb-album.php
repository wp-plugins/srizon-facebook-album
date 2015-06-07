<?php
/*
Plugin Name: Srizon Facebook Album
Plugin URI: http://www.srizon.com/srizon-facebook-album
Description: Show your Facebook Albums/Galleries on your WordPress Site
Version: 2.2
Author: Afzal
Author URI: http://www.srizon.com/contact
*/
// libraries
require_once 'lib/srizon_functions.php';
require_once 'lib/srizon_fb_album.php';
require_once 'lib/srizon_pagination.php';
require_once 'srizon-fb-ui.php';
require_once 'srizon-fb-db.php';

// font end files
require_once 'srizon-fb-front.php';
require_once 'srizon-fb-album-front.php';
require_once 'srizon-fb-gallery-front.php';

// backend files
require_once 'srizon-fb-back.php';
require_once 'srizon-fb-album-back.php';
require_once 'srizon-fb-gallery-back.php';

register_activation_hook( __FILE__, 'srz_fb_install' );
register_uninstall_hook( __FILE__, 'srz_fb_uninstall' );
function srz_fb_install() {
	SrizonFBDB::CreateDBTables();
}

function srz_fb_uninstall() {
	//SrizonFBDB::DeleteDBTables();
	//delete_option('srzfbcomm');
}


add_shortcode( 'srizonfbalbum', 'srz_fb_album_shortcode' );
add_shortcode( 'srizonfbgallery', 'srz_fb_gallery_shortcode' );


function srz_fb_get_resource_url( $relativePath ) {
	return plugins_url( $relativePath, plugin_basename( __FILE__ ) );
}
