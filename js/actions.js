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

      // Miramos en qué estado está y lo ponemos
      var filter_visible = $.cookie('plates-filters-visible');
      if(filter_visible == 'false') {
        $('div.view.view-galley-fluid .view-filters').hide();
      }

      $('body.page-plate h1#page-title').unbind('click');
      $('body.page-plate h1#page-title').click(function() {
        //console.log("Poniendo la cookie");
        $.cookie('plates-filters-visible', $('body.page-plate .view-filters').is(":hidden"), {
          path: settings.basePath,
          expires: 365,
        });
        //$('body.page-plate #region-content .view-filters').show();
        $('div.view.view-galley-fluid .view-filters').slideToggle("slow");
      });

      $('.view.small table.views-table').hover(
        function () {
          //$(this).addClass("big");
          $(this).parents('.view').removeClass('small');
        },
        function () {
          $(this).parents('.view').addClass("small");
        }
      );
  }
 };

}(jQuery));

