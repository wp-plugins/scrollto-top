<?php
/**
 * ScrollTo Top plugin options page. Included by ScrollToTop::options_page()
 *
 * @author Daniel Imhoff
 * @package WordPress
 * @subpackage ScrollToTop
 * @since 1.0

   Copyright 2011  Daniel Imhoff  (email : dwieeb@gmail.com)

   This file is part of ScrollTo Top

   ScrollTo Top is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   ScrollTo Top is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with ScrollTo Top. If not, see <http://www.gnu.org/licenses/>.
 */

if( !function_exists( 'add_action' ) ) {
   die( __( 'You are not allowed to access this file outside of WordPress.', 'scrollto-top' ) );
}
?>
<style type="text/css">
.no-padding td {
   padding:0 10px 0 0;
}
#stt-image-list {
   list-style:none;
   margin:0;
}
#stt-image-list li {
   display:inline-block;
   width:100px;
   text-align:center;
}
</style>
<div id="scrollto-top" class="wrap">
<?php screen_icon('options-general'); ?>
<h2><?php _e( 'ScrollTo Top', 'scrollto-top' ); ?></h2>
<br class="clear" />
<?php if( $error = $this->errors->get_error_message( 'scrollto-top_nodir' ) ) : ?>
<div id="message" class="error fade"><p><?php echo $error; ?></p></div>
<?php endif; ?>
<?php if( $error = $this->errors->get_error_message( 'scrollto-top_renamedir' ) ) : ?>
<div id="message" class="error fade"><p><?php echo $error; ?></p></div>
<?php endif; ?>
<?php if( $file_error_size ) : ?>
<div id="message" class="error fade"><p><?php _e( 'There was an error while uploading your image. The maximum width and height allowed for icons is 100x100px. Please try again.', 'scrollto-top' ); ?></p></div>
<?php endif; ?>
<?php if( $file_error && !$file_error_size ) : ?>
<div id="message" class="error fade"><p><?php _e( 'There was an error while uploading your image. Remember, only JPG, GIF, and PNG files are allowed. Please try again.', 'scrollto-top' ); ?></p></div>
<?php endif; ?>
<?php if( !$is_dir || !$is_writable ) : ?>
<div id="message" class="error fade"><p><?php printf( __( 'The file directory is either missing or has incorrect permissions and I can\'t fix it! Please chmod %s to 755 for this plugin to work correctly.', 'scrollto-top' ), '<code>' . STT_IMAGES_DIR . '</code>' ); ?></p></div>
<?php endif; ?>
<?php $nonce = wp_create_nonce( 'scrollto-top' ); ?>
<form method="post" id="scrollto-top_options" name="scrollto-top_options" action="<?php print STT_OPTIONS_URL . '&amp;_wpnonce=' . $nonce; ?>" enctype="multipart/form-data">
<h3><?php _e( 'Settings', 'scrollto-top' ); ?></h3>
<table class="form-table">
<tr>
<th scope="row"><?php _e( 'Icon location on page', 'scrollto-top' ); ?></th>
<td>
<table class="no-padding">
<tr>
<td><label><input type="radio" <?php if($this->options['location_y'] == 'top' && $this->options['location_x'] == 'left') print 'checked="checked" '; ?>value="0" name="location" /> <?php _e( 'Top left', 'scrollto-top' ); ?></label></td>
<td><label><input type="radio" <?php if($this->options['location_y'] == 'top' && $this->options['location_x'] == 'right') print 'checked="checked" '; ?>value="1" name="location" /> <?php _e( 'Top right', 'scrollto-top' ); ?></label></td>
</tr><tr>
<td><label><input type="radio" <?php if($this->options['location_y'] == 'bottom' && $this->options['location_x'] == 'left') print 'checked="checked" '; ?>value="2" name="location" /> <?php _e( 'Bottom left', 'scrollto-top' ); ?></label></td>
<td><label><input type="radio" <?php if($this->options['location_y'] == 'bottom' && $this->options['location_x'] == 'right') print 'checked="checked" '; ?>value="3" name="location" /> <?php _e( 'Bottom right', 'scrollto-top' ); ?></label></td>
</tr>
</table>
</td>
</tr><tr>
<th scope="row"><?php _e( 'Distance from left/right side', 'scrollto-top' ); ?></th>
<td>
<input type="text" name="location_x_amt" value="<?php print $this->options['location_x_amt']; ?>" size="5" />px
</td>
</tr><tr>
<th scope="row"><?php _e( 'Distance from top/bottom', 'scrollto-top' ); ?></th>
<td>
<input type="text" name="location_y_amt" value="<?php print $this->options['location_y_amt']; ?>" size="5" />px
</td>
</tr><tr>
<th scope="row"><?php _e( 'Hide image until needed?', 'scrollto-top' ); ?></th>
<td>
<label><input type="radio" <?php if(!isset($this->options['enable_scroll_event']) || $this->options['enable_scroll_event']) print 'checked="checked" '; ?>value="1" name="enable_scroll_event" /> <?php _e( 'Yes', 'scrollto-top' ); ?></label>
<label><input type="radio" <?php if(isset($this->options['enable_scroll_event']) && !$this->options['enable_scroll_event']) print 'checked="checked" '; ?>value="0" name="enable_scroll_event" /><?php _e( 'No', 'scrollto-top' ); ?></label>
<p><?php _e( 'If checked, then whenever the user scrolls down the page to a certain point, the go-to-top icon will appear. Yes: More style. No: Better preformance.', 'scrollto-top' ); ?></p>
</td>
</tr>
</table>
<h3><?php _e( 'Select an icon', 'scrollto-top' ); ?></h3>
<p><?php printf( __( 'To remove pictures, navigate to %s and remove them manually.', 'scrollto-top' ), '<code>' . STT_IMAGES_DIR . '</code>' ); ?></p>
<?php if( empty( $image_array ) ) : ?>
<p><?php _e( 'There are no images in the image directory. Please upload some.', 'scrollto-top' ); ?></p>
<?php else : ?>
<ul id="stt-image-list">
<?php foreach($image_array as $image) : ?>
<li>
   <label><img src="<?php print STT_IMAGES_URL . '/' . $image; ?>" title="<?php print $image; ?>" alt="<?php print $image; ?>" /><br />
   <input type="radio" <?php if($this->options['image'] == $image) print 'checked="checked" '; ?>value="<?php print $image; ?>" name="image" /></label>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<h3><?php _e( 'Upload your own icon', 'scrollto-top' ); ?></h3>
<table cellspacing="2" cellpadding="0" border="0">
<tr>
<td>
<input type="file" id="icon_upload" name="icon_upload" />
</td>
<td>
<input type="submit" class="button" value="<?php _e('Upload file', 'specific-files' ); ?>" name="submit" />
</td>
</tr>
</table>
<br class="clear" /><br />
<input type="submit" class="button-primary" value="<?php _e('Update Options', 'scrollto-top' ); ?>" name="submit" />
</form>
<div class="clear">
<p><?php _e( 'ScrollTo Top Wordpress Plugin', 'scrollto-top' ); echo ' ' . STT_VERSION; ?> &copy; 2011 - <a href="http://www.danielimhoff.com/">Daniel Imhoff</a></p>
<p><?php _e( 'ScrollTo jQuery Plugin', 'scrollto-top' ); ?> &copy; 2007-2009 <a href="http://flesler.blogspot.com">Ariel Flesler</a></p>
</div>