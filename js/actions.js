(function ($) {

  Drupal.behaviors.hba_theme = {
    attach: function (context, settings) {
      /*$('#block-global-filter-global-filter-1 a.change').click(function() {
		    $(this).parent().parent().children('#edit-inputs').children('.fieldset-wrapper').toggleClass('visible');
		    return false;
    	});*/
    	
    	/*
    	$('#block-global-filter-global-filter-1').hover(
        function () {
          $(this).find('.fieldset-wrapper').toggleClass('visible');
        }, 
        function () {
          $(this).find('.fieldset-wrapper').toggleClass('visible');
        }
      );*/
      
      function toogleVisible() {
        $(this).find('.fieldset-wrapper, .content').toggleClass('visible');
      }
            
       var config = {    
           over: toogleVisible, // function = onMouseOver callback (REQUIRED)    
           timeout: 350, // number = milliseconds delay before onMouseOut    
           out: toogleVisible // function = onMouseOut callback (REQUIRED)    
      };    
      $('#block-global-filter-global-filter-1').hoverIntent(config);
      $('#block-views-flag-nodes-block-5').hoverIntent(config);
      $('#block-views-flag-nodes-block-6').hoverIntent(config);      
    }
  };

}(jQuery));

