jQuery.noConflict();
jQuery(function() {
   var isTransitioned = true;
   var transparent = 0;
   var translucent = 0.3;
   var opaque = 1;
   jQuery("body").prepend('<a id="top"></a>\n<a href="#top" id="gototop" class="gototop">Top of page</a>');
   jQuery("#gototop").mouseover(function() {
      if(isTransitioned) {
         jQuery(this).fadeTo("slow",opaque);
      }
   }).mouseout(function() {
      if(isTransitioned) {
         jQuery(this).fadeTo("slow",translucent);
      }
   })
   jQuery("#gototop").click(function() {
      jQuery.scrollTo(0,500);
      jQuery(this).fadeOut();
      return false;
   });
   stt_fade();
   jQuery(document).scroll(stt_fade);
   function stt_fade() {
      if(isTransitioned) {
         isTransitioned = false;
         if(1000 < jQuery(document).scrollTop()) {
            jQuery("#gototop").show().fadeTo("slow",translucent,function() {
               isTransitioned = true;
            });
         } else {
            jQuery("#gototop").fadeTo("slow",transparent,function() {
               isTransitioned = true;
               jQuery(this).hide();
            });
         }
      }
   }
});