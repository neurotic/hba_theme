<?php if ($teaser): // START if teaser ?>

<article<?php print $attributes; ?>>
  <div class="node-inner teaser">
  <?php if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
  <?php endif; ?>  
  <div<?php print $content_attributes; ?>>
 
  <div class="left">
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
    <?php
      //trim the text with http://api.drupalize.me/api/drupal/function/views_trim_text/7
      $alter_taxo_c = array('max_length' => 225, 'word_boundary' => TRUE, 'ellipsis' => TRUE, 'html' => TRUE);
      print '<div class="ds-taxonomy"><span class="label">Taxonomy: </span> <span class="name_desc">' . render($content['field_sp_name_desc'][0]) . '</span> <span class="descriptor">' . render($content['field_sp_descriptor'][0]) . ',</span> <span class="year">' . render($content['field_sp_year'][0]) . '</span>, <span class="type_locality">' . render($content['field_sp_type_locality'][0]) . ',</span><div class="taxo_comments">' . views_trim_text($alter_taxo_c, render($content['field_sp_taxo_comments'][0])) . '</div></div>';

      $alter_dn = array('max_length' => 225, 'word_boundary' => TRUE, 'ellipsis' => TRUE, 'html' => TRUE);
      print '<strong>Descriptive notes:</strong> ' . views_trim_text($alter_dn, render($content['field_sp_descr_notes'][0]));
      
      print '<div class="more"><a href="' . $node_url . '" title="' . $title . '">read more</a></div>';
    ?>
  </div>
  
  <div class="right">
  <?
  // si privileged user, mostrar la figure sense watermark
  if (in_array('Basic subscriptor', $user->roles) && in_array('Supporting subscriptor', $user->roles) && in_array('editor', $user->roles) && in_array('administrator', $user->roles)) {
    //print '<div class="thumbnail">' . views_embed_view('species_figure','block_4', $element['#object']->nid) . '</div>'; // l'argument ja està en la view
    print '<div class="thumbnail">' . views_embed_view('species_figure','block_5', $node->nid) . '</div>';
  }
  else {
    print '<div class="thumbnail">' . views_embed_view('species_figure','block_5', $node->nid) . '</div>'; // CANVIEM A UN FORMATTER AMB WATERMARK??
  }
  //print theme('image_style', array('style_name' => 'icon', 'path' => render($content['field_sp_map_jpg'][0]))) . '</div>';
  //print render(field_view_value('node', $node, 'field_sp_map_jpg', 0, array('settings' => array('image_style' => 'icon', 'label' => ''))));
  //print theme('image_style', array( 'path' => $content['field_sp_map_jpg'][0]['uri'], 'style_name' => 'icon'));
  //dpm($content['field_sp_map_jpg']);
  // seleccionant formatter uri en http://alive.hbw.com/admin/structure/types/manage/species/display/teaser
  print '<img class="sp-map" alt="distribution map" src="' . render($content['field_sp_map_jpg'][0]) . '" />';
  ?>
  </div>

  </div>
  </div>
</article>

<?php else: // START if full node
  //dpm($_SESSION);
  //if (isset($node) && ($node->type == 'species') && (is_numeric(arg(1))) && (!empty($_SESSION['views']['species_table_by_family']['page_2']['other']))) {
  //if (!empty($_SESSION['views']['species_table_by_family']['page_2']['other'])) {
  /*if (!empty($_SESSION['other_proves2']['other'])) {
    $message = 'Redirected from ' . $_SESSION['other_proves2']['other'] . ' (other common name for species ' . $title . ')';
    if (isset($node) && ($node->type == 'species') && (is_numeric(arg(1)))) {
      drupal_set_message($message, $type = 'status', $repeat = FALSE);
      //unset($_SESSION['views']['species_table_by_family']['page_2']['other']);
      unset($_SESSION['other_proves2']['other']);
    }
  }*/
?>

<article<?php print $attributes; ?>>
  <header>
    <?php print render($title_prefix); ?>
    <h2><?php print t('Species')?></h2>
    <h1<?php print $title_attributes; ?>><?php print _hba_cursive($title) ?></h1>
    <?php print render($title_suffix); ?>
  </header>

  <?php
    /*if (arg(0) == 'node' and is_numeric(arg(1)) and arg(2) != 'revisions') {
      print '<div class="sp-vol-page">' . views_embed_view('species_hbw_vol_page','block_1', $node->nid) . '</div>';
    }*/
  ?>
  
  <div class="node-inner full">
    
  <?php if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
  <?php endif; ?>

  <?php if (!empty($content['links'])): ?>
    <?php $content['links']['#attributes']['class'][] = 'clearfix'; ?>
    <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php print '<div id="status" class="ds-status">' . render($content['group_sp_tab_taxo']['field_sp_status']) . '</div>'; ?>
  <?php endif; ?> 
  
<!-- node/*/revisions
node/*/revisions/*/list
node/*/revisions/view/*
node/*/revisions/*/compare
node/*/revisions/list -->
  <?php if ((arg(0) == 'node' and is_numeric(arg(1)) and arg(2) == 'revisions') and (arg(3) == '' || arg(4) == 'list' || arg(3) == 'view' || arg(4) == 'compare' || arg(3) == 'list')) { ?>
  <div style="display: none;">no menu</div>
  <?php } else { ?>
    <div class="block block-block block-2 block-block-2" id="block-block-2">
      <!--<h1 class="title" id="menu-title">  print t('Sections') </h1>-->
      <div class="content-toc">
        <ul class="clearfix">
          <li class="column1"><a href="#Taxonomy">Taxonomy</a></li>
          <li class="column1"><a href="#Descriptive_notes">Descriptive notes</a></li>
          <?php if (!empty($content['group_sp_tab_voice']['field_sp_voice'])) { ?>
            <li class="column1"><a href="#Voice">Voice</a></li>
          <?php } ?>
          <li class="column1"><a href="#Habitat">Habitat</a></li>
          <li class="column1"><a href="#Food_and_feeding">Food and feeding</a></li>
          <li class="column2 reset"><a href="#Breeding">Breeding</a></li>
          <li class="column2"><a href="#Movements">Movements</a></li>
          <li class="column2"><a href="#Status_and_conservation">Status and conservation</a></li>
          <li class="column2"><a href="#Bibliography">Bibliography</a></li>
        </ul>
      </div>
       <?php print '<div class="thumbnail">' . views_embed_view('species_figure','block_10', $node->nid) . '</div>'; ?>
    </div>
  <?php } ?>

  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);

      global $user;
      
      /* CONTINGUT PER USUARIS ANONIMS O SENSE ROL DE PAGAMENT + nodes sense flag Highlighted */
      
      $flag = flag_get_flag('highlighted');
      //  or die('no "bookmarks" flag defined');
      /*if ($flag->is_flagged($node->nid)) {
        print 'This node is flagged with Highlighted';
      }*/
      
      if ((!in_array('Basic subscriptor', $user->roles) && !in_array('Supporting subscriptor', $user->roles) && !in_array('editor', $user->roles) && !in_array('administrator', $user->roles)) && ($flag->is_flagged($node->nid))) {
        print '<p class="avis">You are currently viewing an unrestricted species content. ... ...</p>';
      }
      
      //$allowed = array('Basic subscriptor','Supporting subscriptor','editor','administrator');
      //if ($user->uid != 1 && !in_array($allowed, $user->roles)) {
      //if ($user->uid != 1 && !in_array($allowed, $user->roles) && empty($user->roles[5]) && empty($user->roles[6])) {
      if ((!in_array('Basic subscriptor', $user->roles) && !in_array('Supporting subscriptor', $user->roles) && !in_array('editor', $user->roles) && !in_array('administrator', $user->roles)) && ($flag && !$flag->is_flagged($node->nid))) {
        if ((arg(0) == 'node' and arg(2) == 'revisions' and arg(4) == 'compare') and is_numeric(arg(1))) {
        //$url = request_uri();
        //if (strpos($url, "revisions")) {
          // si s'està comparant 2 revisions d'un mateix node, no mostrar el node per sota de la taula de comparació
          hide($content);
          hide($content['title']);
        }
        else {
        
          // GROUP admin
          hide($content['group_sp_admin_display']);
          
          // start GROUP Taxonomy
          hide($content['group_sp_tab_taxo']['field_sp_names_other']);
          hide($content['group_sp_tab_taxo']['field_sp_names_other_common']);
          hide($content['group_sp_tab_taxo']['field_sp_name_french']);
          hide($content['group_sp_tab_taxo']['field_sp_name_german']);
          hide($content['group_sp_tab_taxo']['field_sp_name_spanish']);
          hide($content['group_sp_tab_taxo']['field_sp_distrib']);
          hide($content['group_sp_tab_taxo']['field_sp_type_locality']);
          hide($content['group_sp_tab_taxo']['field_sp_year']);
          hide($content['group_sp_tab_taxo']['field_sp_name_desc']);
          hide($content['group_sp_tab_taxo']['field_sp_descriptor']);
          hide($content['group_sp_tab_taxo']['field_sp_taxo_comments']);
          hide($content['group_sp_tab_taxo']['field_sp_subspecies_comp']);
          hide($content['group_sp_tab_taxo']['field_sp_ssp_comments']);

          // START template for Taxonomy group fields

          /* Agafat i adaptat de: Custom field per la secció Taxonomy del tipus de contingut Species: http://localhost/drupal/admin/structure/ds/fields/manage_custom/sp_section_1_taxonomy */
          
          $tpl_taxo = '<div class="ds-names"><span class="label">French:</span> <span class="name">' . render($content['group_sp_tab_taxo']['field_sp_name_french'][0]) . '</span> <span class="label">German:</span> <span class="name">' . render($content['group_sp_tab_taxo']['field_sp_name_german'][0]) . '</span> <span class="label">Spanish:</span> <span class="name">' . render($content['group_sp_tab_taxo']['field_sp_name_spanish'][0]) . '</span></div>';
          
          if (!empty($content['group_sp_tab_taxo']['field_sp_names_other_common'])) {
            // ATENCIO, per aquest camp multiple utilitzem el template field--field-sp-names-other-common.tpl.php
            $tpl_taxo .= render($content['group_sp_tab_taxo']['field_sp_names_other_common']);
          } ?>
          <br />
          <?php
            if (!empty($content['group_sp_tab_taxo']['field_sp_taxo_comments'])) {
              $tpl_taxo .= '<div class="ds-taxonomy"><span class="label">Taxonomy: </span> <span class="name_desc">' . render($content['group_sp_tab_taxo']['field_sp_name_desc'][0]) . '</span> <span class="descriptor">' . render($content['group_sp_tab_taxo']['field_sp_descriptor'][0]) . '</span>, <span class="year">' . render($content['group_sp_tab_taxo']['field_sp_year'][0]) . '</span>, <span class="type_locality">' . render($content['group_sp_tab_taxo']['field_sp_type_locality'][0]) . '</span>.<div class="taxo_comments">' . render($content['group_sp_tab_taxo']['field_sp_taxo_comments'][0]) . '</div></div>';
            }
            // http://drupal.stackexchange.com/questions/28959/how-can-i-render-a-field-based-on-the-value-of-another-field
            if (isset($node->field_sp_monotypic['und'][0]['value']) && $node->field_sp_monotypic['und'][0]['value'] === '1') {
              //$tpl_taxo .= ' Monotypic.';
              $tpl_taxo .= '<div class="ds-distrib"><span class="label">Distribution:</span>' . render($content['group_sp_tab_taxo']['field_sp_distrib'][0]) . '</div>';
            }
            else {
              $tpl_taxo .= '<div class="ds-ssp_comp"><span class="label">Subspecies and Distribution</span>';
              $tpl_taxo .= render($content['group_sp_tab_taxo']['field_sp_subspecies_comp'][0]) . '</div>';
              // En el llibre es mostra sense label
              $tpl_taxo .= '<div class="ds-ssp_comments">' . render($content['group_sp_tab_taxo']['field_sp_ssp_comments'][0]) . '</div>';
            }
          
          $content['group_sp_tab_taxo']['#markup'] = $tpl_taxo;
          print render($content['group_sp_tab_taxo']);

        // END template for Taxonomy group fields

        // GROUP Descriptive notes
        // First hide the group fields
        hide($content['group_sp_tab_descr_notes']['field_sp_descr_notes']);
        // Change the content of the group
        $content['group_sp_tab_descr_notes']['#markup'] = '<p class="avis">Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
        // print the modified group
        print render($content['group_sp_tab_descr_notes']);
        
        // GROUP Voice
        if (!empty($content['group_sp_tab_voice']['field_sp_voice'])) {
          hide($content['group_sp_tab_voice']['field_sp_voice']);
          $content['group_sp_tab_voice']['#markup'] = '<p class="avis">Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
          print render($content['group_sp_tab_voice']);
        }

        // GROUP Habitat
        hide($content['group_sp_tab_habitat']['field_sp_habitat_text']);
        $content['group_sp_tab_habitat']['#markup'] = '<p style="border: 1px solid orange; background: #FCF8D1; padding: 10px; margin: 15px 0; clear: both;">Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
        print render($content['group_sp_tab_habitat']);

        // GROUP Food and feeding
        hide($content['group_sp_tab_food']['field_sp_food']);
        $content['group_sp_tab_food']['#markup'] = '<p class="avis">Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
        print render($content['group_sp_tab_food']);

        // GROUP Breeding
        hide($content['group_sp_tab_breeding']['field_sp_breeding']);
        $content['group_sp_tab_breeding']['#markup'] = '<p class="avis">Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
        print render($content['group_sp_tab_breeding']);

        // GROUP Movements
        hide($content['group_sp_tab_move']['field_sp_movements']);
        $content['group_sp_tab_move']['#markup'] = '<p class="avis">Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
        print render($content['group_sp_tab_move']);

        // GROUP Status and conservation
        hide($content['group_sp_tab_status']['field_sp_sta_conver']);
        $content['group_sp_tab_status']['#markup'] = '<p class="avis">Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
        print render($content['group_sp_tab_status']);

        // GROUP Bibliography
        hide($content['group_sp_tab_biblio']['field_sp_biblio_new']);
        $content['group_sp_tab_biblio']['#markup'] = '<p class="avis">Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
        print render($content['group_sp_tab_biblio']);

        //print render($content);
        
        } // END if page is not revision 

      } // END if user is not a subscriber
      
      /* CONTINGUT PER USUARIS DE PAGAMENT + ADMINS */
      
      // if user is subscriber
      else {
        if ((arg(0) == 'node' and arg(2) == 'revisions' and arg(4) == 'compare') and is_numeric(arg(1))) {
          // si s'està comparant 2 revisions d'un mateix node, no mostrar el node per sota de la taula de comparació
          hide($content);
          hide($content['title']);
        }
        // if page is NOT a revision
        else {
          // start GROUP Taxonomy
          hide($content['group_sp_tab_taxo']['field_sp_names_other']);
          hide($content['group_sp_tab_taxo']['field_sp_names_other_common']);
          hide($content['group_sp_tab_taxo']['field_sp_name_french']);
          hide($content['group_sp_tab_taxo']['field_sp_name_german']);
          hide($content['group_sp_tab_taxo']['field_sp_name_spanish']);
          hide($content['group_sp_tab_taxo']['field_sp_distrib']);
          hide($content['group_sp_tab_taxo']['field_sp_type_locality']);
          hide($content['group_sp_tab_taxo']['field_sp_year']);
          hide($content['group_sp_tab_taxo']['field_sp_name_desc']);
          hide($content['group_sp_tab_taxo']['field_sp_descriptor']);
          hide($content['group_sp_tab_taxo']['field_sp_taxo_comments']);
          hide($content['group_sp_tab_taxo']['field_sp_subspecies_comp']);
          hide($content['group_sp_tab_taxo']['field_sp_ssp_comments']);

          $tpl_taxo = '<div class="ds-names"><span class="label">French:</span> <span class="name">' . render($content['group_sp_tab_taxo']['field_sp_name_french'][0]) . '</span> <span class="label">German:</span> <span class="name">' . render($content['group_sp_tab_taxo']['field_sp_name_german'][0]) . '</span> <span class="label">Spanish:</span> <span class="name">' . render($content['group_sp_tab_taxo']['field_sp_name_spanish'][0]) . '</span></div>';
          
          if (!empty($content['group_sp_tab_taxo']['field_sp_names_other_common'])) {
            // ATENCIO, per aquest camp multiple utilitzem el template field--field-sp-names-other-common.tpl.php
            $tpl_taxo .= render($content['group_sp_tab_taxo']['field_sp_names_other_common']);
          } ?>
          <br />
          <?php
            if (!empty($content['group_sp_tab_taxo']['field_sp_taxo_comments'])) {
              $tpl_taxo .= '<div class="ds-taxonomy"><span class="label">Taxonomy: </span> <span class="name_desc">' . render($content['group_sp_tab_taxo']['field_sp_name_desc'][0]) . '</span> <span class="descriptor">' . trim(render($content['group_sp_tab_taxo']['field_sp_descriptor'][0])) . '</span>, <span class="year">' . render($content['group_sp_tab_taxo']['field_sp_year'][0]) . '</span>, <span class="type_locality">' . trim(render($content['group_sp_tab_taxo']['field_sp_type_locality'][0])) . '.</span><div class="taxo_comments">' . render($content['group_sp_tab_taxo']['field_sp_taxo_comments'][0]) . '</div></div>';
            }

            // http://drupal.stackexchange.com/questions/28959/how-can-i-render-a-field-based-on-the-value-of-another-field
            if (isset($node->field_sp_monotypic['und'][0]['value']) && $node->field_sp_monotypic['und'][0]['value'] === '1') {
              //$tpl_taxo .= ' Monotypic.';
              $tpl_taxo .= '<div class="ds-distrib"><span class="label">Distribution:</span>' . render($content['group_sp_tab_taxo']['field_sp_distrib'][0]) . '</div>';
            }
            else {
              $tpl_taxo .= '<div class="ds-ssp_comp"><span class="label">Subspecies and Distribution</span>';
              $tpl_taxo .= render($content['group_sp_tab_taxo']['field_sp_subspecies_comp'][0]) . '</div>';
              // En el llibre es mostra sense label
              $tpl_taxo .= '<div class="ds-ssp_comments">' . render($content['group_sp_tab_taxo']['field_sp_ssp_comments'][0]) . '</div>';
            }
          
          $content['group_sp_tab_taxo']['#markup'] = $tpl_taxo;
          print render($content['group_sp_tab_taxo']);
          // stop GROUP Taxonomy

          // GROUP Descriptive notes
          // Change the content of the group
          $content['group_sp_tab_descr_notes']['#markup'] = render($content['group_sp_tab_descr_notes']['field_sp_descr_notes'][0]);
          
          $viewName = 'plate_node_sp';
          $view = views_get_view($viewName);
          $view->execute();
          $viewCount = count($view->result);
          //$content['group_sp_tab_descr_notes']['#markup'] .= t("There are @viewCount figures", array('@viewCount' => $viewCount));
          $display_id = 'block_1';
          // si només un dibuix, mostrar-la centrada (faltaria condició de si només 1 dibuix per SSP)
          if ($viewCount < 3) { $content['group_sp_tab_descr_notes']['#markup'] .= '<center>'; }
          $content['group_sp_tab_descr_notes']['#markup'] .= views_embed_view($viewName, $display_id);
          if ($viewCount < 3) { $content['group_sp_tab_descr_notes']['#markup'] .= '</center>'; }
          /*$content['group_sp_tab_descr_notes']['#markup'] .= '<div class="footer">';
          if ($viewCount > 1) {
             $content['group_sp_tab_descr_notes']['#markup'] .= '<span class="info"></span>';
          }
          $content['group_sp_tab_descr_notes']['#markup'] .= '<span class="link">' . l(t('Search for more figures in plate view'), 'plate',array('attributes' => array('title' => 'Search for more figures in plate view'),'query' => array('sp' => $title, 'items_per_page' => '25','image_style' => 'small','image_mode' => 'p','field_figure_order_sp_value' => ''))) . '</span></div>';*/

          // print the modified group
          print render($content['group_sp_tab_descr_notes']);
          
          //TO-DO find a better way to include this embeded sound...
          if(isset($content['group_sp_tab_voice']['field_sp_voice'][0])){ //check if we have a voice section...
              $content['group_sp_tab_voice']['field_sp_voice'][0]['#markup'].='<iframe src="http://ibc.lynxeds.com/embed_best_sound_s.php?sp='.$node->field_sp_nid_ibc['und'][0]['value'].'" width="520" height="40" frameborder="0" scrolling="no"></iframe>';
          }
          
          //print the rest of the fields of the species.
          print render($content);

        } // END if page is NOT a revision
      } // END if user is subscriber
    ?>
  </div>
  
  <div class="clearfix bottom_links">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>    
  </div>
  
  </div><!-- END node-inner full -->
  
  <?php print render($content['comments']); ?>
</article>


<?php endif; // END if full node ?>
