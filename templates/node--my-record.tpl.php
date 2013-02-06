<?php if ($teaser): // START if teaser

global $user;
// content only visible if current user if node author or admin
if ($user->name == $name || in_array('administrator', $user->roles)) {
?>

<article<?php print $attributes; ?>>
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?>
  <div class="node-inner teaser">
    <?php if ($display_submitted): ?>
    <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
    <?php endif; ?>  
    
    <div<?php print $content_attributes; ?>>
      <?php
        // We hide the links now so that we can render them later.
        hide($content['links']);
        print render($content);
      ?>
    </div>
    
    <div class="clearfix">
      <?php if (!empty($content['links'])): ?>
        <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
      <?php endif; ?>
    </div>
    
  </div>
</article>

<?php }
else {
  // The other users should not find in the website any information about another user trip, so we show a fake title
  print "MyRecord";
}

// END if teaser ?>

<?php else: // START if full node

global $user;
// content only visible if current user if node author or admin
if ($user->name == $name || in_array('administrator', $user->roles)) {
?>

<article<?php print $attributes; ?>>
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?>
  <div class="node-inner full"> 
    
    <div class="clearfix">
      <?php if (!empty($content['links'])): ?>
        <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
      <?php endif; ?>
    </div>
    
    <div<?php print $content_attributes; ?>>
      <?php
        // We hide the links now so that we can render them later.
        hide($content['links']);
      ?>
      <div class="left">
        <?php
          print render($content['field_myr_sp'][0]);
        ?>
      </div>
      
      <div class="right">
        <div class="dialog-links edit-field-loc-sp-und-0-target-id"><ul class="references-dialog-links"><li><a href="/node/<?php print $node->nid ?>/edit" class="edit-dialog">Edit this record</a></li></ul></div>
        <div class="field_myr_nb"><?php print render($content['field_myr_nb'][0]); ?>
        <div class="field_myr_heard"><?php print render($content['field_myr_heard'][0]); ?>
        <div class="field_myr_captive"><?php print render($content['field_myr_captive'][0]); ?>
        <div class="field_myr_date"><?php print render($content['field_myr_date'][0]); ?>
      </div>
      
      <div class="bottom">
        <div class="body"><?php print render($content['body'][0]); ?>
        <div class="field_myr_map"><?php print render($content['field_myr_map'][0]); ?>
      </div>
      
      <?php print render($content); ?>
    </div>

  </div>
</article>

<?php }
else {
  // The other users should not find in the website any link to this full node, but just in case we do a redirect...
  drupal_goto('/my-record/list');
}
?>

<?php endif; // END if full node ?>
