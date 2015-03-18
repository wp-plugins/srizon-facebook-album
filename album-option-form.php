<form action="admin.php?page=SrzFb-Albums&srzf=save" method="post">
<?php SrizonFBUI::BoxHeader( 'box2', "Album Title", true ); ?>
<div><input type="text" name="title" size="50" value="<?php echo $value_arr['title']; ?>"/></div>
<?php
SrizonFBUI::BoxFooter();
SrizonFBUI::BoxHeader( 'box3', "Fanpage Album ID(s)", true );
?>
<div>
	<div><label for="albumid">If the album link(URL) is <span
			style="color:blue;">http://www.facebook.com/media/set/?set=a.<strong>number1</strong>.number2.number3...</span>
		then the ID is <strong>number1</strong> which should be put in this field</label>
	</div>
	<textarea name="albumid" id="albumid" rows="5" cols="50"><?php echo $value_arr['albumid']; ?></textarea>

	<div>Separate multiple IDs with newline or whitespace (They will be merged into a single album)</div>
</div>
<?php
SrizonFBUI::BoxFooter();
SrizonFBUI::BoxHeader( 'box33', "Layout Related", true );
?>

<table>
	<tr>
		<td>
			<label class="label" for="layout"><strong>Layout</strong></label>
		</td>
		<td>
			<select name="options[layout]" id="layout">
				<option value="collage_thumb" <?php if ( $value_arr['layout'] == 'collage_thumb' ) {
					echo 'selected="selected"';
				} ?>>1. Collage - Thumb
				</option>
				<option value="collage_full" <?php if ( $value_arr['layout'] == 'collage_full' ) {
					echo 'selected="selected"';
				} ?>>2. Collage - Full
				</option>
				<option value="slider_lightbox" <?php if ( $value_arr['layout'] == 'slider_lightbox' ) {
					echo 'selected="selected"';
				} ?>>3. Slider - Lightbox
				</option>
				<option value="slider_image_above" <?php if ( $value_arr['layout'] == 'slider_image_above' ) {
					echo 'selected="selected"';
				} ?>>4. Slider - Image Above
				</option>
				<option value="slider_image_below" <?php if ( $value_arr['layout'] == 'slider_image_below' ) {
					echo 'selected="selected"';
				} ?>>5. Slider - Image Below
				</option>
				<option value="single_image" <?php if ( $value_arr['layout'] == 'single_image' ) {
					echo 'selected="selected"';
				} ?>>6. Single Image
				</option>
				<option value="image_card" <?php if ( $value_arr['layout'] == 'image_card' ) {
					echo 'selected="selected"';
				} ?>>7. Image Card
				</option>
			</select>
		</td>
	</tr>

	<tr>
		<td><label for="targetheight" class="label">Target Thumb Height (Layout 1/3/4/5)</label></td>
		<td>
			<input id="targetheight" name="options[targetheight]"
			       type="text"
			       value="<?php echo $value_arr['targetheight']; ?>"
				/>


		</td>
	</tr>
	<tr>
		<td><label for="collagepadding" class="label">Collage - Padding (Layout 1/2)</label></td>
		<td>
			<input id="collagepadding" name="options[collagepadding]"
			       type="text"
			       value="<?php echo $value_arr['collagepadding']; ?>"
				/>


		</td>
	</tr>
	<tr>
		<td><label for="collagepartiallast" class="label">Collage - Fill Last Row (Layout 1/2)</label></td>
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
		<td><label for="hovercaption" class="label">Mouse Over Caption (Layout 1/2/4/5/6/7)</label></td>
		<td>
			<em>Available on pro version</em>
			<input name="options[hovercaption]" type="hidden" value="0"/>
		</td>
	</tr>
	<tr>
		<td><label for="hovercaptiontype" class="label">Caption Behavior (Layout 1/2 if yes above)</label></td>
		<td>
			<em>Available on pro version</em>
			<input name="options[hovercaptiontype]" type="hidden" value="0"/>
		</td>
	</tr>
	<tr>
		<td><label for="showhoverzoom" class="label">Animate Thumb on Hover (Layout 1)</label></td>
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
	<tr>
		<td><label for="animationspeed" class="label">Animation Time in MilliSecs (Layout 3/4/5/6)</label></td>
		<td>
			<input id="animationspeed" name="options[animationspeed]"
			       type="text"
			       value="<?php echo $value_arr['animationspeed']; ?>"
				/>


		</td>
	</tr>
	<tr>
		<td><label for="maxheight" class="label">Maximum height of the full image (Layout 2/4/5/6/7)</label></td>
		<td>
			<input id="maxheight" name="options[maxheight]"
			       type="text"
			       value="<?php echo $value_arr['maxheight']; ?>"
				/></td>
	</tr>

</table>
<?php
SrizonFBUI::BoxFooter();
SrizonFBUI::BoxHeader( 'box4', "Options", true );
?>
<table>
	<tr>
		<td>
			<label for="updatefeed" class="label">Sync After Every # minutes</label>
		</td>
		<td>
			<input type="text" size="5" name="options[updatefeed]" id="updatefeed"
			       value="<?php echo $value_arr['updatefeed']; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<label class="label" for="image_sorting">Images Sorting</label>
		</td>
		<td>
			<select name="options[image_sorting]" id="image_sorting">
				<option value="default" <?php if ( $value_arr['image_sorting'] == 'default' ) {
					echo 'selected="selected"';
				} ?>>Default (As given by FB API)
				</option>
				<option value="defaultr" <?php if ( $value_arr['image_sorting'] == 'defaultr' ) {
					echo 'selected="selected"';
				} ?>>Default Reversed
				</option>
				<option value="modified" <?php if ( $value_arr['image_sorting'] == 'modified' ) {
					echo 'selected="selected"';
				} ?>>Modification Time
				</option>
				<option value="modifiedr" <?php if ( $value_arr['image_sorting'] == 'modifiedr' ) {
					echo 'selected="selected"';
				} ?>>Modification Time Reversed
				</option>
				<option value="created" <?php if ( $value_arr['image_sorting'] == 'created' ) {
					echo 'selected="selected"';
				} ?>>Creation Time
				</option>
				<option value="createdr" <?php if ( $value_arr['image_sorting'] == 'createdr' ) {
					echo 'selected="selected"';
				} ?>>Creation Time Reversed
				</option>
				<option value="shuffle" <?php if ( $value_arr['image_sorting'] == 'shuffle' ) {
					echo 'selected="selected"';
				} ?>>Shuffle on each load
				</option>
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
			<label class="label" for="paginatenum">Paginate After # Thumbs</label>
		</td>
		<td>
			<input type="text" size="5" id="paginatenum" name="options[paginatenum]"
			       value="<?php echo $value_arr['paginatenum']; ?>"/>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p></p>

			<p></p>
			<strong>Advanced: On a shared server/hosting/IP syncing may fail sometimes. <br/>Creating an <a
					target="_blank" href="https://developers.facebook.com/">App on facebook</a> and providing the
				App ID and secret (both required) below should make it work.</strong>
		</td>
	</tr>
	<tr>
		<td>
			<label class="label" for="app_id">Facebook App ID</label>
		</td>
		<td>
			<input type="text" size="25" id="app_id" name="options[app_id]"
			       value="<?php echo $value_arr['app_id']; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<label class="label" for="app_secret">Facebook App Secret</label>
		</td>
		<td>
			<input type="text" size="25" id="app_secret" name="options[app_secret]"
			       value="<?php echo $value_arr['app_secret']; ?>"/>
		</td>
	</tr>
</table>
<div>
	<label class="label"><?php wp_nonce_field( 'srz_fb_albums', 'srjfb_submit' ); ?></label>
	<?php
	if ( isset( $value_arr['id'] ) ) {
		echo '<input type="hidden" name="id" value="' . $value_arr['id'] . '" />';
	}
	?>
	<input type="submit" class="button-primary" name="submit" value="Save Album"/>
</div>
</form>