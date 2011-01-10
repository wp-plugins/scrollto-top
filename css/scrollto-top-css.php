<?php
require_once('../../../../wp-load.php');
$options = get_option( 'scrollto-top_options' );

header("Content-Type: text/css");
?>
#gototop {
   position:fixed;
   <?php print $options['location_y'] . ':' . $options['location_y_amt']; ?>px;
   <?php print $options['location_x'] . ':' . $options['location_x_amt']; ?>px;
   background:url("<?php print STT_IMAGES_URL . '/' . $options['image']; ?>") no-repeat top left;
   text-indent:-9999em;
   width:<?php print $options['image_width']; ?>px;
   height:<?php print $options['image_height']; ?>px;
   <?php if( $options['enable_scroll_event'] ) : ?>
   display:none;
   <?php endif; ?>
}
#gototop:hover,
#gototop:active,
#gototop:focus {
   outline:0;
}