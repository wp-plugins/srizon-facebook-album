<?php
//SrizonResourceLoader::load_mag_popup();
//SrizonResourceLoader::load_elastislide();
//SrizonResourceLoader::load_srizon_custom_css();
$data .= '<div class="loading-wrap"><ul class="elastislide-list jfbalbum"  id="' . $scroller_id . '">';
foreach ( $srz_images as $image ) {
	$caption = nl2br( $image['txt'] );
	$data .= <<<IMGLINK
	<li>
		<a href="{$image['src']}" title="{$caption}" {$lightbox_attribute}>
			<img src="{$image['thumb']}" alt="{$caption}" width="{$image['width']}" height="{$image['height']}" />
		</a>
	</li>
IMGLINK;
}
$data .= '</ul></div>';
$data .= <<<EOL
<script type="text/javascript">
	jQuery( '#{$scroller_id}' ).matchImgHeight({
		'height':{$srz_album['targetheight']}
	});
	jQuery(window).load(function(){
		jQuery( '#{$scroller_id}').unwrap().elastislide({
			speed: {$srz_album['animationspeed']}
		});
	});
</script>
EOL;
