jQuery(function() {
   var isTransitioned = true;
   var transparent = 0;
   var translucent = 0.3;
   var opaque = 1;
   jQuery("body").prepend('<a id="top"></a>\n<a href="#top" id="gototop" class="gototop">Top of page</a>');
   jQuery("#gototop").fadeTo(0,translucent);
   jQuery("#gototop").mouseover(function() {
      if(isTransitioned) {
         jQuery(this).fadeTo("slow",opaque);
      }
   }).mouseout(function() {
      if(isTransitioned) {
         jQuery(this).fadeTo("slow",translucent);
      }
   });
   jQuery("#gototop").click(function() {
      jQuery.scrollTo(0,500);
      return false;
   });
});