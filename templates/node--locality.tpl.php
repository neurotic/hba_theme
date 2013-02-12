<?php if ($teaser): // START if teaser

global $user;
// content only visible if current user if node author or admin
if ($user->uid = $uid || in_array('administrator', $user->roles)) {
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
  print "Checklist";
}

// END if teaser ?>

<?php else: // START if full node

global $user;
// content only visible if current user if node author or admin
if ($user->uid = $uid || in_array('administrator', $user->roles)) {
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
        
        //dsm($node);
      ?>
      <?php
        // Trip
        if (isset($node->field_myr_trip['und'][0]['target_id'])) {
          print '<div class="field-name-field-myr-trip"><span class="field-label">Trip</span>' . render($content['field_myr_trip'][0]) . '</div>';
        }
        else {
          print '<div class="field-name-field-myr-trip"><span class="field-label">Trip</span>- No trip attached -</div>';
        }
      ?>
      <?php
        // Date
        if (isset($node->field_loc_date['und'][0]['value'])) {
          print '<div class="field_loc_date">' . render($content['field_loc_date'][0]) . '</div>';
        }
      ?>
      <?php
        // If the user gave an exact address, we show it in all case
        if (isset($node->field_loc_loc_addr['und'][0]['value'])) {
          print '<div class="field_loc_loc_addr">' . render($content['field_loc_loc_addr'][0]) . '</div>';
        }
      ?>
      <?php
        // We show the map wether the user gave an exact address or not
        if (isset($node->field_loc_loc_map['und'][0]['lat'])) {
          // si no esta definida la latitud, no mostrem el mapa
          print '<div class="field_loc_loc_map">' . render($content['field_loc_loc_map'][0]) . '</div>';
        }
      ?>
      <div class="body"><?php print render($content['body'][0]); ?></div>
      <?php
        print '<div class="group_loc_group_myr">' . render($content['group_loc_group_myr']) . '</div>';
      ?>
      
      <div class="field_myr_links"><?php print render($content['field_myr_links'][0]); ?></div>
      
    </div>

  </div>
</article>

<?php }
else {
  // The other users should not find in the website any link to this full node, but just in case we do a redirect...
  drupal_goto('checklist');
}
?>

<?php endif; // END if full node ?>
