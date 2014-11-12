<form action="admin.php?page=SrzFb-Galleries&srzf=save" method="post">
<?php SrizonFBUI::BoxHeader('box1', "Gallery Title", true); ?>
<div><input type="text" name="title" size="50" value="<?php echo $value_arr['title']; ?>"/></div>
<?php
SrizonFBUI::BoxFooter();
SrizonFBUI::BoxHeader('box2', "Fanpage ID", true);
?>
<div>
	<div>If the fanpage link(URL) is <span style="color:blue;">http://www.facebook.com/<strong>pagename</strong></span>
		then the ID is <strong>pagename</strong> which should be put in this field. <br/>
		If the fanpage link(URL) is <span style="color:blue;">http://www.facebook.com/pages/name/<strong>number</strong></span>
		then the ID is the <strong>number</strong> which should be put in this field.
	</div>
	<input type="text" name="pageid" size="25" value="<?php echo $value_arr['pageid']; ?>"/></div>
<?php
SrizonFBUI::BoxFooter();
SrizonFBUI::BoxHeader('box3', "Albums to include/exclude: Put Album ID(s)", true);
if (!file_exists(dirname(__FILE__) . '/srizon-fb-album-front-pro.php')) {
	echo '<em>Only in pro version</em>';
} else {
	?>
	<div>
		<div>If the album link(URL) is <span style="color:blue;">http://www.facebook.com/media/set/?set=a.<strong>number1</strong>.number2.number3...</span>
			then the ID is <strong>number1</strong> which should be put in this field.
		</div>
		<textarea name="options[excludeids]" rows="5"
				  cols="20"><?php if (isset($value_arr['excludeids'])) echo $value_arr['excludeids']; ?></textarea>

		<div>Separate multiple IDs with newline or whitespace</div>
	</div>

	<?php
	$chk1 = $chk2 = '';
	if ($value_arr['include_exclude'] == 'include') {
		$chk2 = ' checked="checked"';
	} else {
		$chk1 = ' checked="checked"';
	}
	?>
	<br/>
	<input type="radio" name="options[include_exclude]" value="exclude"<?php echo $chk1; ?> />Exclude These Albums
	<br/>
	<input type="radio" name="options[include_exclude]" value="include"<?php echo $chk2; ?> />Show Only These Albums

<?php
}
SrizonFBUI::BoxFooter();
SrizonFBUI::BoxHeader('box4', "Options", true);
?>
<table>
	<tr>
		<td>
			<span class="label">Sync After Every # minutes</span>
		</td>
		<td>
			<input type="text" size="5" name="options[updatefeed]" value="<?php echo $value_arr['updatefeed']; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Shuffle Photos inside albums?</span>
		</td>
		<td>
			<?php
			$chk1 = $chk2 = '';
			if ($value_arr['shuffle_images'] == 'no') {
				$chk2 = ' checked="checked"';
			} else {
				$chk1 = ' checked="checked"';
			}
			?>
			<input type="radio" name="options[shuffle_images]" value="yes"<?php echo $chk1; ?> />Yes
			<input type="radio" name="options[shuffle_images]" value="no"<?php echo $chk2; ?> />No
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Shuffle Album List?</span>
		</td>
		<td>
			<?php
			$chk1 = $chk2 = '';
			if ($value_arr['shuffle_albums'] == 'no') {
				$chk2 = ' checked="checked"';
			} else {
				$chk1 = ' checked="checked"';
			}
			?>
			<input type="radio" name="options[shuffle_albums]" value="yes"<?php echo $chk1; ?> />Yes
			<input type="radio" name="options[shuffle_albums]" value="no"<?php echo $chk2; ?> />No
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Thumbnail Size</span>
		</td>
		<td>
			<input type="text" size="3" name="options[thumbwidth]" value="<?php echo $value_arr['thumbwidth']; ?>"/> x
			<input type="text" size="3" name="options[thumbheight]" value="<?php echo $value_arr['thumbheight']; ?>"/>
			px
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Paginate After # Images</span>
		</td>
		<td>
			<input type="text" size="5" name="options[paginatenum]" value="<?php echo $value_arr['paginatenum']; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Show title under thumb? (Gallery Page)</span>
		</td>
		<td>
			<?php
			$chk1 = $chk2 = '';
			if ($value_arr['showtitlethumb'] == 'no') {
				$chk2 = ' checked="checked"';
			} else {
				$chk1 = ' checked="checked"';
			}
			?>
			<input type="radio" name="options[showtitlethumb]" value="yes"<?php echo $chk1; ?> />Yes
			<input type="radio" name="options[showtitlethumb]" value="no"<?php echo $chk2; ?> />No
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Truncate title under thumb after X character <br/>(if the selection above is Yes)</span>
		</td>
		<td>
			<input type="text" size="5" name="options[truncate_len]" value="<?php echo $value_arr['truncate_len']; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Height of the title under thumb</span>
		</td>
		<td>
			<input type="text" size="5" name="options[titlethumb_height]"
				   value="<?php echo $value_arr['titlethumb_height']; ?>"/>
		</td>
	</tr>

	<tr>
		<td>
			<span class="label">Shadow color</span>
		</td>
		<td>
			<?php
			$chk1 = $chk2 = '';
			if ($value_arr['tpltheme'] == 'black') {
				$chk2 = ' checked="checked"';
			} else {
				$chk1 = ' checked="checked"';
			}
			?>
			<input type="radio" name="options[tpltheme]" value="white"<?php echo $chk1; ?> />Dark Gray
			<input type="radio" name="options[tpltheme]" value="black"<?php echo $chk2; ?> />Light Gray
		</td>
	</tr>
</table>
<div>
	<span class="label"><?php wp_nonce_field('SrzFbGalleries', 'srjfb_submit'); ?></span>
	<?php
	if (isset($value_arr['id'])) {
		echo '<input type="hidden" name="id" value="' . $value_arr['id'] . '" />';
	}
	?>
	<input type="submit" class="button-primary" name="submit" value="Save Gallery"/>
</div>
</form>