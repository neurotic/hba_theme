<?php
?>

  <div id="menu" class="main-nav-menu">
	  <?php print render($page['menu']); ?>
  </div>
  
  <div id="branding" class="clearfix">
	<?php // añadimos el menu horizontal de cabecera del tema hba_theme
	$block = module_invoke('system', 'block_view', 'main-menu');
    print '<div id="block-system-main-menu">' . render($block) . '</div>'; ?>
	
    <?php print $breadcrumb; ?>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h1 class="page-title"><?php print $title; ?></h1>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php print render($primary_local_tasks); ?>
    
  </div>

  <div id="page">
    <?php if ($secondary_local_tasks): ?>
      <div class="tabs-secondary clearfix"><ul class="tabs secondary"><?php print render($secondary_local_tasks); ?></ul></div>
    <?php endif; ?>

    <div id="content" class="clearfix">
      <div class="element-invisible"><a id="main-content"></a></div>
      <?php if ($messages): ?>
        <div id="console" class="clearfix"><?php print $messages; ?></div>
      <?php endif; ?>
      <?php if ($page['help']): ?>
        <div id="help">
          <?php print render($page['help']); ?>
        </div>
      <?php endif; ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php print render($page['content']); ?>
      <div class="lrdiscoverwidget" data-background="on" data-css="http://alive.hbw.com/sites/all/themes/hba_theme/css/ck2.css" data-logo="on" data-share-url="alive.hbw.com/signup" rel="M6JL4NGD">
	&nbsp;</div>
<script type="text/javascript" src="http://launchrock-ignition.s3.amazonaws.com/ignition.1.1.js"></script>

<?php
if (!in_array('Basic subscriptor', $user->roles) && !in_array('Supporting subscriptor', $user->roles) && !in_array('editor', $user->roles) && !in_array('administrator', $user->roles)) {
  $block = module_invoke('user', 'block_view', 'login');
  print render($block);
}
?>

    </div>

    <div id="footer">
      <?php print $feed_icons; ?>
    </div>

  </div>
