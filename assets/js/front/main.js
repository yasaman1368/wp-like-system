$(document).ready(function () {
  jQuery('body').on('click','a.like-button', function(e) {
    
      jQuery(this).addClass('liked');
      
      // setTimeout(() => {
      //   jQuery(e.target).removeClass('liked')
      // }, 1000)
    });
  jQuery('body').on('click','a.unlike-button', function(e) {
    
      jQuery(this).removeClass('liked');
      
      // setTimeout(() => {
      //   jQuery(e.target).removeClass('liked')
      // }, 1000)
    });
  
});
