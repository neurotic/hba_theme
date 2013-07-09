<?php if ($teaser): // START if teaser

global $user;
// content only visible if current user is node author or admin
if ($user->uid == $uid || in_array('administrator', $user->roles)) {
?>

<article<?php print $attributes; ?>>
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>

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
  print "Private birdlist";
}

// END if teaser ?>

<?php else: // START if full node

global $user;
// content only visible if current user is node author or admin
if ($user->uid == $uid || in_array('administrator', $user->roles)) {
?>

<article<?php print $attributes; ?>>
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>

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
      <?php
        // només mostrar contingut del node si no estem en la pàgina batch de views+vbo per crear uns my-records 
        //if (isset($node) && ($node->type == 'locality') && (arg(0) == 'node') && (is_numeric(arg(1)))) {
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
          // If the user gave an exact address (at least zipcode o street name), we show it in all case
          if ( (isset($content['field_loc_loc_addr']['#items'][0]['postal_code']) && $node->field_loc_loc_addr['und'][0]['postal_code'] > '') || (isset($content['field_loc_loc_addr']['#items'][0]['thoroughfare']) && $node->field_loc_loc_addr['und'][0]['thoroughfare'] > '') ) {
            print '<div class="field_loc_loc_addr">' . render($content['field_loc_loc_addr'][0]) . '</div>';
          }
        ?>
        <?php
          // If the user gave an exact address + didn't draw on the Bounding map + map2 has a latitud, then we show map2
          if ( (isset($node->field_loc_loc_addr['und'][0]['postal_code']) || isset($node->field_loc_loc_addr['und'][0]['thoroughfare'])) && !isset($node->field_loc_loc_map['und'][0]['lat']) && isset($node->field_loc_loc_addr_map['und'][0]['lat']) ) {
            print '<div class="field_loc_loc_addr_map">' . render($content['field_loc_loc_addr_map'][0]) . '</div>';
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
          // Mapa dels myr tot junts
          // si tenim al menys 1 my_record
          if (isset($node->field_loc_sp['und'][0]['target_id']) && $node->field_loc_sp['und'][0]['target_id'] > '') {
            //dpm($content['group_loc_group_myr']);
            // Mostrar el mapa dels myr, si al menys un d'ells té un mapa definit
            //if (isset($content['field_loc_loc_addr']['#items'][0]['postal_code']) && $node->field_loc_loc_addr['und'][0]['postal_code'] > '') {
            //if (isset($node->field_myr_map['und'][0]['lat'])) { ==> NO, es una view!!! aquest camp no está definit aqui... 
              $content['group_loc_group_myr']['#description'] = '<div class="map-records">' . views_embed_view('checklist_myr_map','block_1', $node->nid) . '</div>';
            //}
            // Llista dels myr (teaser/short list)
            print '<div class="group_loc_group_myr">' . render($content['group_loc_group_myr']) . '</div>';
            
            /*$max_delta = $content['group_loc_group_myr']['field_loc_sp']['#items'][3]['target_id'];
            for ($delta = 0; $delta <= $max_delta; $delta++) {
              print render($content['group_loc_group_myr']['field_loc_sp']['#items'][$delta]['target_id']);
            }*/
          }
          else {
            // Emular el fieldset que es genera quand l'usuari ja té un my-record creat
            $fieldset['element'] = array(
              '#title' => t('My records'),
              '#attributes' => array('class' => array('my-records', 'collapsible')),
              '#value' => 'No records created yet.',
              '#children' => '',
            );
            print theme('fieldset', $fieldset);
          }
        ?>
        
        <div class="field_myr_links"><?php print render($content['field_myr_links'][0]); ?></div>
        <div class="set-records">
          <?php
            /*
             * Set records WITH VBO (http://alive.hbw.com/admin/structure/views/view/set_records/edit)
             */
            // aqui veure si hi han records per aquest birdlist. Si es aixi, agafar els paisos, i proposar a l'usuari afegir-los via un botó
            $fieldset['element'] = array(
              '#title' => t('Set new records'),
              '#description' => '<p class="help">Here are the species present in ' . render($content['field_myr_country'][0]) . '. You can now proceed to add species to the birdlist. Note that those species you already added to the birdlist are not available in the following table (click <span class="add-record"><a title="Add a single record" href="/node/add/my-record?field_myr_checklist=' . render($content['field_myr_country'][0]) . '" class="add-dialog">here</a> to add a single species that is not officially classified in ' . render($content['field_myr_country'][0]) . '</span>).</p>',
              // $_SESSION['hbw_action']['checklist_nid'] ===> canviar per if (isset($_GET['field_myr_country']) { print $_GET['field_myr_country']; }
              '#attributes' => array('class' => array('set-records', 'collapsible', 'collapsed')),
              '#value' => views_embed_view('set_records','default'),
              '#children' => '',
            );
            print theme('fieldset', $fieldset);
            
            // Definir el birdlist nid com variable de sessió si l'usuari vol crear més nodes my-record + filtrar la view set-records
            //$_SESSION['hbw_action']['checklist_nid'] = arg(1);
          ?>
        </div>
        
        <div class="set-records-megarow">
          <?php
            /*
             * Set records WITH MEGAROW (http://alive.hbw.com/admin/structure/views/view/set_records/edit/block_1)
             */
            // aqui veure si hi han records per aquest birdlist. Si es aixi, agafar els paisos, i proposar a l'usuari afegir-los via un botó
            $fieldset2['element'] = array(
              '#title' => t('Set new records | megarow'),
              '#description' => '<p class="help">Here are the species present in ' . render($content['field_myr_country'][0]) . '. You can now proceed to add species to the birdlist. Note that those species you already added to the birdlist are not available in the following table. <br />Click <span class="add-record"><a title="Add a single record" href="/node/add/my-record?field_myr_checklist=' . render($content['field_myr_country'][0]) . '" class="add-dialog">here</a> to add a single species that is not officially classified in ' . render($content['field_myr_country'][0]) . '</span>).</p>',
              '#attributes' => array('class' => array('set-records', 'collapsible')),
              '#value' => views_embed_view('set_records','block_1'),
              '#children' => '',
            );
            print theme('fieldset', $fieldset2);
          ?>
        </div>
    </div>

  </div>
</article>

<?php
}
else {
  // The other users should not find in the website any link to this full node, so we inform them and do a redirect
  print '<div class="unauthorized">You are not authorized to see other people\'s birdlists.<p>You will be redirect to your birdlists overview page <span class="timer"></span></p></div>';
  //drupal_goto('birdlist');
}
?>

<?php endif; // END if full node ?>
