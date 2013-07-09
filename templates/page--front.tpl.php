<?php
global $user;
// If user is not logged in
/*if (!$user->uid) {

  <div class="lynxeds-wrapper">
    <div class="lynxeds">Continue to <a title="Continue to Lynx Edicions website" href="http://lynxeds.com">Lynx Edicions</a> website<br />Continue to <a title="Continue to Internet Bird Collection website" href="http://ibc.lynxeds.com">Internet Bird Collection</a> website</div>
  </div>
  <div rel="M6JL4NGD" class="lrdiscoverwidget" data-logo="on" data-background="off" data-css="http://alive.hbw.com/sites/all/libraries/bigvideojs/css/style.css" data-share-url="alive.hbw.com/signup" data-css=""></div><script type="text/javascript" src="http://launchrock-ignition.s3.amazonaws.com/ignition.1.1.js"></script>

} */
// Usuari connectat pero només amb el rol FREE
//else if (!empty($user->roles[8]) && empty($user->roles[5]) && empty($user->roles[6]) && empty($user->roles[7])) {
if ( (!$user->uid) || (!empty($user->roles[8]) && empty($user->roles[5]) && empty($user->roles[6]) && empty($user->roles[7])) ) { ?>

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

    <?php print $messages; ?>

    <div id="main-wrapper"><div id="main" class="clearfix">

      <div id="content" class="column"><div class="section">
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php //print render($page['content']); ?>
        
        <div class="grid-21 region region-content" id="region-content free">
          <div class="region-inner region-content-inner contextual-links-region">
            <?php //print views_embed_view('homepage','page'); ?>
            
            <div class="content-inner">
              <div class="block block-system block-main block-system-main odd block-without-title" id="block-system-main">
                <div class="block-inner clearfix">
                  <div class="content clearfix">
                    <div class="view view-homepage view-id-homepage view-display-id-page view-dom-id-f68ac51c84bb012a6dfdb8ac162ca250">
                      <div class="view-content">
                        <div class="views-row views-row-1 views-row-odd views-row-first">
                          <div class="views-field views-field-field-homepage-link">
                            <div class="field-content">
                              <div class="row-content">
                                <div class="title">
                                  A revolution in ornithological reference works!</div>
            <!-- nou body-->
                                <div class="views-field views-field-body">
                                  <div class="field-content">
                                    <div class="marco-cristal">
                                      <div class="video-container">
                                  <iframe allowfullscreen="" frameborder="0" height="360" src="http://www.youtube.com/embed/3SwDtbQ0gTs?rel=0&amp;theme=light" width="640"></iframe>
                                      </div>
                                    </div>
                                    <div class="video-caption">
                                      Watch this video to find out more about this amazing and innovative project.</div>
                                    </div>
                                </div>
                                <div class="desc">
                                  <p>Why Subscribe?</p>
                                  <ul>
                                    <li>
                                      Access the most comprehensive online source of ornithological knowledge.</li>
                                    <li>
                                      Have all of the contents of the <em>Handbook of the Birds of the World</em> series, continuously updated by a professional team, at your fingertips.</li>
                                    <li>
                                      Customize to your personal needs.</li>
                                  </ul>
                                  <p>All for a fraction of the cost of one HBW Volume!</p>
                                  <div class="link">
                                    <a href="http://www.hbw.com/pricing">View subscription plans</a></div>
                                </div>
                              </div>
                            </div>
                          </div>
            <!-- antic body -->
                        </div>
                        <div class="views-row views-row-2 views-row-even views-row-last">
                          <div class="views-field views-field-field-homepage-link">
                            <div class="field-content">
                              <div class="row-content">
                                <div class="title">
                                  Explore some samples</div>
                                <div class="desc">
                                  <p>Browse these contents before you subscribe:</p>
                                  <div class="samples-links-home">
                                    <a href="family/home">Families</a><a href="species/home">Species</a><a href="plates/home">Plates</a></div>
                                </div>
                                <div class="image">
                                  <img alt="" height="120" src="http://www.hbw.com/sites/default/files/emberiza_citrinella_male_handbook_alive.png" typeof="foaf:Image" width="198" /></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <section class="block block-menu block-menu-sections block-menu-menu-sections even collapsiblock-processed" id="block-menu-menu-sections">
          <div class="block-inner clearfix">
                        <h2 class="block-title"><span>Features</span></h2>
              <div class="content clearfix">
                <ul class="menu"><li class="first leaf clearfix menu_contents"><div class="wrapper clearfix"><span class="menu_image"></span>Contents<p class="desc"><strong>Detailed information, illustrations, maps</strong> and more materials for all the species of birds of the world.</p></div></li>
          <li class="leaf clearfix menu_updating"><div class="wrapper clearfix"><span class="menu_image"></span>Updating<p class="desc"><strong>Contents constantly updated</strong> by professional editors and moderated user participation via “wikicontributions”.</p></div></li>
          <li class="leaf clearfix menu_customization"><div class="wrapper clearfix"><span class="menu_image"></span>Customization<p class="desc"><strong>Highly customizable format</strong> to meet every user’s needs and interests, geographical filtering and inclusion of personal notes.</p></div></li>
          <li class="leaf clearfix menu_multimedia"><div class="wrapper clearfix"><span class="menu_image"></span>Multimedia<p class="desc"><strong>Thousands of videos, photographs and sounds</strong> conveniently linked for quick and easy access. </p></div></li>
          <li class="leaf clearfix menu_bibliography"><div class="wrapper clearfix"><span class="menu_image"></span>Bibliography<p class="desc">Easily track the scientific references in the work.</p></div></li>
          <li class="last leaf clearfix menu_special_features"><div class="wrapper clearfix"><span class="menu_image"></span>Special Features<p class="desc"><strong>Google translator</strong> for 71 languages integrated in each page to aid comprehension for non-English speakers.</p></div></li>
          </ul>    </div>
            </div>
            </section>
          </div>
          
            </div>
        </div>
        
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

<?php }

// Rols de pagament, editors i admins
else { ?>

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

    <div id="main-wrapper"><div id="main" class="clearfix">

      <div id="content" class="column"><div class="section">
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php print render($page['content']); ?>
        <?php //drupal_set_message('test julien', $type = 'status', $repeat = FALSE); ?>
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
