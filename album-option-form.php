<form action="admin.php?page=SrzFb-Albums&srzf=save" method="post">
	<?php SrizonFBUI::BoxHeader('box2', "Album Title", true); ?>
	<div><input type="text" name="title" size="50" value="<?php echo $value_arr['title']; ?>"/></div>
	<?php
	SrizonFBUI::BoxFooter();
	SrizonFBUI::BoxHeader('box3', "Fanpage Album ID(s)", true);
	?>
	<div>
		<div>If the album link(URL) is <span
				style="color:blue;">http://www.facebook.com/media/set/?set=a.<strong>number1</strong>.number2.number3...</span>
			then the ID is <strong>number1</strong> which should be put in this field
		</div>
		<textarea name="albumid" rows="5" cols="50"><?php echo $value_arr['albumid']; ?></textarea>

		<div>Separate multiple IDs with newline or whitespace (They will be merged into a single album)</div>
	</div>
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
				<span class="label">Images Sorting</span>
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
				<span class="label">Thumbnail Size</span>
			</td>
			<td>
				<input type="text" size="3" name="options[thumbwidth]" value="<?php echo $value_arr['thumbwidth']; ?>"/>
				x
				<input type="text" size="3" name="options[thumbheight]"
					   value="<?php echo $value_arr['thumbheight']; ?>"/>
				px
			</td>
		</tr>
		<tr>
			<td>
				<span class="label">Paginate After # Thumbs</span>
			</td>
			<td>
				<input type="text" size="5" name="options[paginatenum]"
					   value="<?php echo $value_arr['paginatenum']; ?>"/>
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
		<span class="label"><?php wp_nonce_field('srz_fb_albums', 'srjfb_submit'); ?></span>
		<?php
		if (isset($value_arr['id'])) {
			echo '<input type="hidden" name="id" value="' . $value_arr['id'] . '" />';
		}
		?>
		<input type="submit" class="button-primary" name="submit" value="Save Album"/>
	</div>
</form>