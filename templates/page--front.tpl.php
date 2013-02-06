<?php
global $user;
// If user is not logged in
if (!$user->uid) {
?>

  <!--<div class="lrdiscoverwidget" data-background="on" data-css="http://alive.hbw.com/sites/all/libraries/bigvideojs/css/style.css" data-logo="on" data-share-url="alive.hbw.com/signup" rel="M6JL4NGD">
	&nbsp;</div>
  <script type="text/javascript" src="http://launchrock-ignition.s3.amazonaws.com/ignition.1.1.js"></script>-->
  
  <div rel="M6JL4NGD" class="lrdiscoverwidget" data-logo="on" data-background="off" data-css="http://alive.hbw.com/sites/all/libraries/bigvideojs/css/style.css" data-share-url="alive.hbw.com/signup" data-css=""></div><script type="text/javascript" src="http://launchrock-ignition.s3.amazonaws.com/ignition.1.1.js"></script>
  
  <!--https://github.com/dfcb/BigVideo.js -->
	<!-- BigVideo Dependencies -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  	<script>window.jQuery || document.write('<script src="sites/all/libraries/bigvideojs/js/jquery-1.7.2.min.js"><\/script>')</script>
    <script src="sites/all/libraries/bigvideojs/js/jquery-ui-1.8.22.custom.min.js"></script>
    <script src="sites/all/libraries/bigvideojs/js/jquery.imagesloaded.min.js"></script>
    <script src="http://vjs.zencdn.net/c/video.js"></script>

    <!-- BigVideo -->
    <script src="sites/all/libraries/bigvideojs/js/bigvideo.js"></script>
    
    <!-- Demo -->
    <script src="sites/all/libraries/bigvideojs/js/jquery.scrollTo.js"></script>
    <script>
        var BV;
	    $(function() {
            
            // initialize BigVideo
            BV = new $.BigVideo();
			BV.init();
			//BV.show('http://video-js.zencoder.com/oceans-clip.mp4',{ambient:true});
			//BV.show('http://alive.hbw.com/HBWalive_MarcaAgua_BR.mp4',{ambient:true});
      BV.show('http://alive.hbw.com/promo_hbw.mov',{ambient:true});
      //BV.show('promo_hbw.mov',{ambient:true});

            // Playlist button click starts video
            $('.playlist-btn').on('click', function(e) {
                e.preventDefault();
                BV.show($(this).attr('href'));
            })

            // Video Play/Pause toggle
            $('#video-toggle').on('click', function(e) {
                if (this.checked)   BV.getPlayer().play();
                else                BV.getPlayer().pause();
            })

            // set up navigation
            $('.nav-link').on('click',function(e){
                e.preventDefault();
                scrollToSection($(this).attr('href'));
            })

            function scrollToSection(id) {
                $(window)._scrollable().stop();
                $(window).scrollTo(id, {
                    duration: 300,
                    offset: -50,
                    // easeInOutQuad
                    easing: function(x,t,b,c,d){if((t/=d/2)<1) return c/2*t*t+b;return -c/2*((--t)*(t-2)-1)+b;}
                });
            }
	    });
    </script>

<?php } else { ?>

<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 */
?>

  <div id="page-wrapper"><div id="page">

    <div id="header"><div class="section clearfix">

      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          
        </a>
      <?php endif; ?>

      <?php if ($site_name || $site_slogan): ?>
        <div id="name-and-slogan">
          <?php if ($site_name): ?>
            <?php if ($title): ?>
              <div id="site-name"><strong>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </strong></div>
            <?php else: /* Use h1 when the content title is empty */ ?>
              <h1 id="site-name">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </h1>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>
        </div> <!-- /#name-and-slogan -->
      <?php endif; ?>

      <?php print render($page['header']); ?>

    </div></div> <!-- /.section, /#header -->

    <?php if ($breadcrumb): ?>
      <div id="breadcrumb"><?php print $breadcrumb; ?></div>
    <?php endif; ?>

    <?php print $messages; ?>

    <div id="main-wrapper"><div id="main" class="clearfix">

      <div id="content" class="column"><div class="section">
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
      </div></div> <!-- /.section, /#content -->

      <?php if ($page['sidebar_first']): ?>
        <div id="sidebar-first" class="column sidebar"><div class="section">
          <?php print render($page['sidebar_first']); ?>
        </div></div> <!-- /.section, /#sidebar-first -->
      <?php endif; ?>

      <?php if ($page['sidebar_second']): ?>
        <div id="sidebar-second" class="column sidebar"><div class="section">
          <?php print render($page['sidebar_second']); ?>
        </div></div> <!-- /.section, /#sidebar-second -->
      <?php endif; ?>

    </div></div> <!-- /#main, /#main-wrapper -->

    <div id="footer"><div class="section">
      <?php print render($page['footer']); ?>
    </div></div> <!-- /.section, /#footer -->

  </div></div> <!-- /#page, /#page-wrapper -->

<?php } ?>
