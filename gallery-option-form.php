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
?>
	<em>Available in pro version only</em>
<?php
SrizonFBUI::BoxFooter();
SrizonFBUI::BoxHeader( 'box33', "Layout Related", true );
?>

<table>
	<tr>
		<td><label for="maxheight" class="label">Maximum height of the thumb</label></td>
		<td>
			<input id="maxheight" name="options[maxheight]"
			       type="text"
			       value="<?php echo $value_arr['maxheight']; ?>"
				/></td>
	</tr>
	<tr>
		<td><label for="collagepadding" class="label">Collage - Padding</label></td>
		<td>
			<input id="collagepadding" name="options[collagepadding]"
			       type="text"
			       value="<?php echo $value_arr['collagepadding']; ?>"
				/>


		</td>
	</tr>
	<tr>
		<td><label for="collagepartiallast" class="label">Collage - Fill Last Row</label></td>
		<td>
			<select id="collagepartiallast" name="options[collagepartiallast]"

			        class="btn-group btn-group-yesno"
				>
				<option value="true" <?php if ( $value_arr['collagepartiallast'] == 'true' ) {
					echo 'selected="selected"';
				} ?>>No</option>
				<option value="false" <?php if ( $value_arr['collagepartiallast'] == 'false' ) {
					echo 'selected="selected"';
				} ?>>Yes</option>
			</select>


		</td>
	</tr>
	<tr>
		<td><label for="hovercaption" class="label">Mouse Over Caption (only for album cover in free version)</label></td>
		<td>
			<select id="hovercaption" name="options[hovercaption]"

			        class="btn-group btn-group-yesno"
				>
				<option value="1" <?php if ( $value_arr['hovercaption'] == '1' ) {
					echo 'selected="selected"';
				} ?>>Yes</option>
				<option value="0" <?php if ( $value_arr['hovercaption'] == '0' ) {
					echo 'selected="selected"';
				} ?>>No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><label for="hovercaptiontype" class="label">Caption Behavior (only for album cover in free version)</label></td>
		<td>
			<select id="hovercaptiontype" name="options[hovercaptiontype]"
				>
				<option value="0" <?php if ( $value_arr['hovercaptiontype'] == '0' ) {
					echo 'selected="selected"';
				} ?>>Show On Hover - Hide On Leave</option>
				<option value="1" <?php if ( $value_arr['hovercaptiontype'] == '1' ) {
					echo 'selected="selected"';
				} ?>>Hide On Hover - Show On Leave</option>
				<option value="2" <?php if ( $value_arr['hovercaptiontype'] == '2' ) {
					echo 'selected="selected"';
				} ?>>Always Show</option>
			</select>


		</td>
	</tr>
	<tr>
		<td><label for="show_image_count" class="label">Show Image Count</label></td>
		<td>
			<select id="show_image_count" name="options[show_image_count]"

			        class="btn-group btn-group-yesno"
				>
				<option value="1" <?php if ( $value_arr['show_image_count'] == '1' ) {
					echo 'selected="selected"';
				} ?>>Yes</option>
				<option value="0" <?php if ( $value_arr['show_image_count'] == '0' ) {
					echo 'selected="selected"';
				} ?>>No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><label for="showhoverzoom" class="label">Animate Thumb on Hover</label></td>
		<td>
			<select id="showhoverzoom" name="options[showhoverzoom]"

			        class="btn-group btn-group-yesno"
				>
				<option value="1" <?php if ( $value_arr['showhoverzoom'] == '1' ) {
					echo 'selected="selected"';
				} ?>>Yes</option>
				<option value="0" <?php if ( $value_arr['showhoverzoom'] == '0' ) {
					echo 'selected="selected"';
				} ?>>No</option>
			</select>


		</td>
	</tr>

</table>
<?php
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
			<span class="label">Album (Cover) Sorting</span>
		</td>
		<td>
			<select name="options[album_sorting]">
				<option value="default" <?php if($value_arr['album_sorting'] == 'default') echo 'selected="selected"'?>>Default (As given by FB API)</option>
				<option value="defaultr" <?php if($value_arr['album_sorting'] == 'defaultr') echo 'selected="selected"'?>>Default Reversed</option>
				<option value="modified" <?php if($value_arr['album_sorting'] == 'modified') echo 'selected="selected"'?>>Modification Time</option>
				<option value="modifiedr" <?php if($value_arr['album_sorting'] == 'modifiedr') echo 'selected="selected"'?>>Modification Time Reversed</option>
				<option value="created" <?php if($value_arr['album_sorting'] == 'created') echo 'selected="selected"'?>>Creation Time</option>
				<option value="createdr" <?php if($value_arr['album_sorting'] == 'createdr') echo 'selected="selected"'?>>Creation Time Reversed</option>
				<option value="shuffle" <?php if($value_arr['album_sorting'] == 'shuffle') echo 'selected="selected"'?>>Shuffle on each load</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Images Sorting (Inside each Album)</span>
		</td>
		<td>
			<select name="options[image_sorting]">
				<option value="default" <?php if($value_arr['image_sorting'] == 'default') echo 'selected="selected"'?>>Default (As given by FB API)</option>
				<option value="defaultr" <?php if($value_arr['image_sorting'] == 'defaultr') echo 'selected="selected"'?>>Default Reversed</option>
				<option value="modified" <?php if($value_arr['image_sorting'] == 'modified') echo 'selected="selected"'?>>Modification Time</option>
				<option value="modifiedr" <?php if($value_arr['image_sorting'] == 'modifiedr') echo 'selected="selected"'?>>Modification Time Reversed</option>
				<option value="created" <?php if($value_arr['image_sorting'] == 'created') echo 'selected="selected"'?>>Creation Time</option>
				<option value="createdr" <?php if($value_arr['image_sorting'] == 'createdr') echo 'selected="selected"'?>>Creation Time Reversed</option>
				<option value="shuffle" <?php if($value_arr['image_sorting'] == 'shuffle') echo 'selected="selected"'?>>Shuffle on each load</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label class="label" for="totalimg">Total Number of Images</label>
		</td>
		<td>
			<input type="text" size="5" name="options[totalimg]" id="totalimg"
			       value="<?php echo $value_arr['totalimg']; ?>"/>
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
		<td colspan="2">
			<p></p><p></p>
			<strong>Advanced: On a shared server/hosting/IP syncing may fail sometimes. <br/>Creating an <a target="_blank" href="https://developers.facebook.com/">App on facebook</a> and providing the App ID and secret (both required) below should make it work.</strong>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Facebook App ID</span>
		</td>
		<td>
			<input type="text" size="25" name="options[app_id]" value="<?php echo $value_arr['app_id']; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">Facebook App Secret</span>
		</td>
		<td>
			<input type="text" size="25" name="options[app_secret]" value="<?php echo $value_arr['app_secret']; ?>"/>
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