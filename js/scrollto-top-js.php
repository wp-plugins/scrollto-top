<?php
require_once('../../../../wp-load.php');
$options = get_option( 'scrollto-top_options' );

header("Content-Type: application/javascript");
?>
jQuery(document).ready(function($) {
   var isTransitioned = true;
   var transparent = 0;
   var translucent = 0.3;
   var opaque = 1;
   $("body").prepend('<a id="top"></a>\n<a href="#top" id="gototop" class="gototop">Top of page</a>');
   $("#gototop")<?php if( !$options['enable_scroll_event'] ) : ?>.fadeTo(0,translucent)<?php endif; ?>.mouseover(function() {
      if(isTransitioned) {
         $(this).fadeTo("slow",opaque);
      }
   }).mouseout(function() {
      if(isTransitioned) {
         $(this).fadeTo("slow",translucent);
      }
   }).click(function() {
      $.scrollTo(0,500);
      <?php if( $options['enable_scroll_event'] ) : ?>
      $("#gototop").fadeOut();
      <?php endif; ?>
      return false;
   });
<?php if( $options['enable_scroll_event'] ) : ?>
   stt_fade();
   $(document).scroll(stt_fade);
<?php endif; ?>
   function stt_fade() {
      if(isTransitioned) {
         isTransitioned = false;
         if(1000 < $(document).scrollTop()) {
            $("#gototop").show().fadeTo("slow",translucent,function() {
               isTransitioned = true;
            });
         } else {
            $("#gototop").fadeTo("slow",transparent,function() {
               isTransitioned = true;
               $(this).hide();
            });
         }
      }
   }
});