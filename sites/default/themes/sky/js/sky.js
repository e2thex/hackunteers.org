// $Id
$(document).ready(function(){
  // jQuery Suckerfish Script, Myles Angell
  // http://be.twixt.us/jquery/suckerFish.php
  // Tweaked by: Ethan Kent - http://www.ethanmultimedia.com/
    $("#navigation li").hover(
      function(){ $(this).find("ul").slideDown("fast"); }, 
      function(){ $(this).find("ul").slideUp("fast"); } 
    );
    if (document.all) {
      $("#navigation li").hoverClass("sfhover");
    }

  // Copy forum comment links
  $(".copy-comment").click( function() {
    prompt('Link to this comment:', this.href);
   });
   
}); // end doc ready

$.fn.hoverClass = function(c) {
  return this.each(function(){
    $(this).hover( 
      function() { $(this).addClass(c); },
      function() { $(this).removeClass(c); }
    );
  });
};