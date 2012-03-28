<?php
require( '../../../../wp-load.php' );
header('Content-Type: text/javascript');
?>
(function($) {
   var isTransitioned = true;
   var transparent = 0;
   var translucent = 0.3;
   var opaque = 1;

<?php if( $ScrollToTop->options['enable_scroll_event'] ) : ?>
   var fade = function() {
      if(isTransitioned) {
         isTransitioned = false;
         if(<?php print $ScrollToTop->options['scroll_event_location']; ?> < $(document).scrollTop()) {
            $("#gototop").show().fadeTo("slow", translucent, function() {
               isTransitioned = true;
            });
         } else {
            $("#gototop").fadeTo("slow", transparent, function() {
               isTransitioned = true;
               $(this).hide();
            });
         }
      }
   }
<?php endif; ?>

   $(function() {
      $("<?php echo $ScrollToTop->options['icon_container_selector']; ?>").prepend('<a id="top"></a>\n<a href="#top" id="gototop" class="gototop">Top of page</a>');

<?php if( $ScrollToTop->options['enable_scroll_event'] ) : ?>
      fade();
      $(document).scroll(fade);
<?php endif; ?>

<?php if( !$ScrollToTop->options['enabled_scroll_event'] ) : ?>
      $("#gototop").fadeTo(0, translucent);
<?php endif; ?>

      $("#gototop").click(function() {
         $.scrollTo(0, <?php print $ScrollToTop->options['scroll_speed']; ?>);
<?php if( $ScrollToTop->options['enable_scroll_event'] ) : ?>
         $(this).fadeOut();
<?php endif; ?>
         return false;
      });

      $("#gototop").mouseover(function() {
         if(isTransitioned) {
            $(this).fadeTo("slow", opaque);
         }
      }).mouseout(function() {
         if(isTransitioned) {
            $(this).fadeTo("slow", translucent);
         }
      });
   });
})(jQuery);