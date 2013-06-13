<?php if ($teaser): // START if teaser ?>

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
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print '<div class="left">' . render($content) . '</div>';
      print '<div class="right">';
      // si privileged user, mostrar slideshow de figures
      if (!empty($account->roles[5]) || !empty($account->roles[6]) || !empty($account->roles[7]) || !empty($account->roles[4]) || !empty($account->roles[3])) {
        //print '<div class="thumbnail">' . views_embed_view('species_figure','block_4', $element['#object']->nid) . '</div>'; // l'argument ja està en la view
        print '<div class="thumbnail">' . views_embed_view('species_figure','block_3', $node->nid) . '</div>'; // provisional
      }
      else {
        //print '<div class="thumbnail">' . views_embed_view('species_figure','block_9', $node->nid) . '</div>'; // provisional
        print '<div class="thumbnail">' . views_embed_view('species_figure','block_3', $node->nid) . '</div>';
      }
      print '</div>';
    ?>
  </div>

  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>
  </div>
  
  </div>
  <?php print render($content['comments']); ?>
</article>

<?php // END if teaser ?>

<?php else: // START if full node ?>

<article<?php print $attributes; ?>>

  <h1 id="page-title" class="title"><?php print render($content['group_fam_view_vt']['group_fam_view_vt_general']['field_fam_sci'][0]); ?></h1>
  <div class="title-sec"><?php print render($content['group_fam_view_vt']['group_fam_view_vt_general']['field_fam_eng'][0]); ?></div>
      
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?>
  
  <div class="node-inner full">
    
  <?php if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
  <?php endif; ?>  
  
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>
  </div>
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);

      if ( arg(0) == 'node' && is_numeric(arg(1)) ) {
        $node = node_load(arg(1));
        $flag = flag_get_flag('highlighted');
      }
      global $user;

      /* CONTINGUT PER USUARIS ANONIMS O SENSE ROL DE PAGAMENT + nodes sense flag Highlighted */
      
      if ( (empty($user->roles[5]) && empty($user->roles[6]) && empty($user->roles[7]) && empty($user->roles[4]) && empty($user->roles[3])) && ($flag && !$flag->is_flagged($node->nid)) ) {
      
          // GROUP General
          $content['group_fam_view_vt_general']['#markup'] = '<p class="avis">You are currently viewing a restricted family content...</p>';
          
          // Altres grups
          /*hide($content['group_fam_view_vt']['group_fam_view_vt_syst']['field_fam_systematics']);
          hide($content['group_fam_view_vt']['group_fam_view_vt_morpho']['field_fam_mor_asp']);
          hide($content['group_fam_view_vt']['group_fam_view_vt_hab']['field_fam_habitat']);
          hide($content['group_fam_view_vt']['group_fam_view_vt_habits']['field_fam_gen_hab']);
          hide($content['group_fam_view_vt']['group_fam_view_vt_voice']['field_fam_voice']);
          hide($content['group_fam_view_vt']['group_fam_view_vt_foof']['field_fam_food_feeding']);
          hide($content['group_fam_view_vt']['group_fam_view_vt_breeding']['field_fam_breeding']);
          hide($content['group_fam_view_vt']['group_fam_view_vt_mov']['field_fam_movements']);
          hide($content['group_fam_view_vt']['group_fam_view_vt_relation']['field_fam_relationship']);
          hide($content['group_fam_view_vt']['group_fam_view_vt_status']['field_fam_status_cons']); */
          hide($content['group_fam_view_vt']['group_fam_view_vt_biblio']['field_fam_bibliography']); // old one
          hide($content['group_fam_view_vt']['group_fam_view_vt_biblio']['field_fam_biblio']); // new one
          //hide($content['group_fam_view_vt']['group_fam_view_vt_sp_table']['field_fam_ordenacio']); // només està present per a que es pugui general el group
          
          //print render($content['group_fam_view_vt']);
          print render($content);
          //print '<p class="avis">Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
          
          //print render($content['group_fam_view_vt']['group_fam_view_vt_general']); // no s'imprimeix
          //print render($content['group_fam_view_vt_general']); // s'imprimeix sense estil i amb els camps fora
          //print render($content['group_fam_view_vt']); // ok pero no toca aqui encara

        // http://drupal.org/node/870742
        //print '<div class="family_nav_tab"><a href="#" class="prev_tab" id="family_prev_tab">< Previous</a> <a href="#" class="next_tab" id="family_next_tab">Next ></a></div>';
        
        //drupal_add_js(drupal_get_path('module', 'sidebar') . '/js/vertical_steps.js'); // js afegit a http://localhost/drupal/admin/config/development/js-injector/edit/5

      }
      
      /* CONTINGUT PER USUARIS DE PAGAMENT + ADMINS */
      
      else {
        
        //hide($content['group_fam_view_vt']['group_fam_view_vt_sp_table']['field_fam_ordenacio']); // ho ocultem via el template field--field-fam-ordenacio.tpl.php
        // Informar als usuaris no han pagat que estan veient un contingut gratis
        if ( (empty($user->roles[5]) && empty($user->roles[6]) && empty($user->roles[7]) && empty($user->roles[4]) && empty($user->roles[3])) && ($flag && $flag->is_flagged($node->nid)) ) {
          $content['group_fam_view_vt_general']['#markup'] = '<p class="avis">You are currently viewing a free sample family text... ... ...</p>';
        }
        print render($content);
        print '<div class="family_nav_tab"><a href="#" class="prev_tab" id="family_prev_tab">← </a> <a href="#" class="next_tab" id="family_next_tab"> →</a></div>';
      }
    ?>
  </div>
  
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>
  </div>
  
  </div><!-- END node-inner full -->
  
  <?php print render($content['comments']); ?>
</article>

<?php endif; // END if full node ?>
