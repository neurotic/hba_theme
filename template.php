<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */

function hba_theme_menu_link__menu_sections(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  
  //dsm($element['#attributes']);
  $element['#attributes']['class'][] = 'clearfix';
  
  $output = l($element['#title'], $element['#href']);
  $description = '<p class="desc">' . $element['#localized_options']['attributes']['title'];   
  $element['#attributes']['class'][] = 'menu_' . strtolower(transliteration_clean_filename($element['#title']));
  return '<li' . drupal_attributes($element['#attributes']) . '><div class="wrapper clearfix"><span class="menu_image"></span>' . $output . $description . $sub_menu . "</div></li>\n";
}

// Crear un template per node add/edit
/*function hba_theme_theme() {
  return array(
    'my_record_node_form' => array(
      'arguments' => array(
          'form' => NULL,
      ),
      'template' => 'templates/my-record-node-form', // set the path here if not in root theme directory
      'render element' => 'form',
    ),
  );
}*/ // DO THE SAME FOR SEVEN THEME!!!

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal;
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */

function hba_theme_form_alter(&$form, &$form_state, $form_id) {
  switch($form_id) {
    /**
      * Make some adjustments to the login form to use HTML5 Placeholder values. 
      * They can be easily changed as they are wrapped in the t() function
      * or you can simply copy this function to your sub theme and change the values
      */
  
  case 'user_login_block':
    $form['name']['#attributes']['placeholder'] = t('Username');
    $form['pass']['#attributes']['placeholder'] = t('Password...');
    break;
    
  /*case 'search_block_form':
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');
    break;*/
  
  /*case 'views_exposed_form':
    // Redirect to /plate if user choose <All> figures, other redirect to /plate/all (if user choose 1 figure per species)
    //if (isset($form[$field_id .'_value']) && $form[$field_id .'_value'] == 1) { // isset imposible si <All>
    //if ($form[$field_id .'_value'] == 1) {
    //if( (isset($form_state['values']['field_figure_order_sp_value'])) && ($form_state['values']['field_figure_order_sp_value'] != '') ) {
    // http://eureka.ykyuen.info/2012/01/25/drupal-show-exposed-filter-value-in-views-headerfooter/
    $view = views_get_current_view();
    if($view->exposed_input['field_figure_order_sp_value'] == 1) {
      dpm($form);
      dpm($form_state);
      drupal_set_message('[hba_theme/template.tpl.php] Value for Figures per species is: ' . $view->exposed_input['field_figure_order_sp_value'] . '<br />#info: ' . $form['#info']['filter-field_figure_order_sp_value']['value'] . '<br />form_state: ' . $form_state['input']['field_figure_order_sp_value'], $type = 'status', $repeat = FALSE);
      //$form['#action'] = strtok($_SERVER['REQUEST_URI'], '?') . '/plate' . url($_GET['q']);
      //$form['#action'] = strtok($_SERVER['REQUEST_URI'], '?') . '/plate' . request_uri();
      //$form['#action'] = strtok($_SERVER['REQUEST_URI'], '?');
      //$form['#action'] = url($_GET['q']);
      //$form['#action'] = 'plate';
      //$form['#action'] = 'http://alive.hbw.com/plate';
      $form['#action'] = '/plate';
      //drupal_goto('checklist');
    }
    else {
      $form['#action'] = '/plate/all';
    }
    break;*/
  
  case 'global_filter_1':
    
    /*dsm(count($_SESSION['global_filter']['view_taxo_paisos']));
    dsm($_SESSION['global_filter']);*/

    $countries = array();
    
    if(!empty($_SESSION['global_filter']['view_taxo_paisos'])) {
      foreach($_SESSION['global_filter']['view_taxo_paisos'] as $country) {
        $continents = bird_taxonomies_continents();
        
        if(isset($continents[$country])) {
          $countries[] = $continents[$country]['name'];
        }
        else {
          $term = taxonomy_term_load($country);
          if(isset($term->name)) {
            $countries[] = $term->name;
          }
          else {
            $countries[] = t('All');
          }
        }
      }
//}
    
    $countries = implode(', ', $countries);
    $countries = truncate_utf8(ucfirst($countries),38,false,'...');
    $form['filter']['#markup'] = '<h3>' . t('<a href="#" class="change">Filter by: !countries</a>', array('!countries' => $countries)) . '</h3>';
      }
      else {
        $form['filter']['#markup'] = '<h3>No active filters</h3>';
        }
    $form['filter']['#weight'] = -10;
    $form['inputs']['view_taxo_paisos'] = $form['view_taxo_paisos'];
    unset($form['view_taxo_paisos']);
    $form['inputs']['submit'] = $form['submit'];
    unset($form['submit']);
    
    $form['inputs']['#type'] = 'fieldset';
    //}


    break;
  }
  

}

function hba_theme_preprocess_node(&$vars) {
  /**
    * if user pictures are enabled on nodes, inject them with the body field
    */
  if(isset($vars['user_picture']) && isset($vars['content']['body'][0]['#markup']) && !$vars['teaser']) {
    $vars['content']['body'][0]['#markup'] = $vars['user_picture'] . $vars['content']['body'][0]['#markup'];
  }
  // treure del camp Body els embeds videos, etc.
  /*if(isset($vars['content']['body'][0]['#markup']) && !$vars['teaser']) {
    $vars['content']['body'][0]['#markup'] = strip_only($vars['content']['body'][0]['#markup'], '<iframe> <embed>');
  }*/
}

/**
 * Implements theme_filter_tips_more_info().
 *
 * Open filter tips link in new page. Prevents data loss.
 * @see http_://drupal.org/node/87994#comment-4713488
 */
function hba_theme_filter_tips_more_info() {
  return '<p>' . l(t('More information about text formats'), 'filter/tips', array('attributes' => array('target' => '_blank'))) . '</p>';
}
/**
* Remove the comment filters' tips
* http://drupal.org/node/35122#comment-4513554
*/
/*
function hba_filter_tips($tips, $long = FALSE, $extra = '') {
  return '';
}*/
/**
* Remove the comment filter's more information tips link
*/
/*
function hba_filter_tips_more_info () {
  return '';
}*/

function hba_theme_process_page(&$variables) {
  // Add theme suggestion for all content types
  if (isset($variables['node'])) {
    if ($variables['node']->type != '') {
    $variables['theme_hook_suggestions'][] = 'page__node__' . $variables['node']->type;
    }
  }
}

/*
function hba_preprocess_views_view_list(&$vars) {
  hba_preprocess_views_view_unformatted($vars);
}
*/

/* Make page templates for specific content types. */
/* http://cheekymonkeymedia.ca/blog/brian-top-chimp/how-have-drupal-7-node-type-page-tpls */
function hba_theme_preprocess_page(&$variables, $hook) {
    // When this goes through the theme.inc some where it changes _ to - so the tpl name is actually page--type-typename.tpl
    if (isset($variables['node'])) {
        $variables['theme_hook_suggestions'][] = 'page__type__'. str_replace('_', '--', $variables['node']->type);  
    }
  
  // Move some variables to the top level for themer convenience and template cleanliness.
  if(drupal_is_front_page()) {
    $variables['title'] = '';
  }
  
  if( isset($variables['node']) && ($variables['node']->type == 'family' || $variables['node']->type == 'species') ) {
    $variables['title'] = '';
  }

  /*if(arg(0) == 'node' && arg(1) == '201985' && arg(2) == '') {
    $variables['title'] = '';
  }*/
  
  // El módulo Taxonomy Views Switcher hace desparecer el titulo de la página
  if ( (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) || (arg(0) == 'vid' && is_numeric(arg(1)) && is_numeric(arg(2))) ) {
    // el titol de la página en la regió $content
    $variables['title'] = db_query('SELECT name FROM {taxonomy_term_data} where tid = :tid limit 1',array(':tid' =>arg(2)))->fetchField();
    // el titol que mostra el navigador web
    drupal_set_title($variables['title']);
  }
  
  drupal_add_library('hoverintent', 'hoverintent', TRUE);
}

/*
function hba_theme_form_comment_form_alter(&$form, &$form_state, &$form_id) {
  $form['comment_body']['#after_build'][] = 'configure_comment_form';
}

function configure_comment_form(&$form) {
  $form['und'][0]['format']['guidelines']['#access'] = FALSE;
  return $form;
} 
*/

/**
 * http://drupal.org/node/796530#comment-5116106
 * Inconsistent behavior with exposed filter in block AJAX
 * Se usa para poder fer funcionar els exposed filters de la view incrustada en los nodes Locality (checklist)
 */
function seven_form_views_exposed_form_alter(&$form , &$form_state){
  // Overrides the views exposed form url to be the current one
  // Avoids odd views redirect to views page from an exposed form in block
  if($form_id == 'views-exposed-form-set-records-default') {
    $form['#action'] = request_uri();
  }
}

/*
CRS: Esto hace que salgan unos cuantos warnings

// drupal_valid_path check drupal path is exist, and if user have access to path, and if afirmative return true, and if negative return false. This functions is perfect for displaying only the links that the user can see
if(drupal_valid_path('node/add/story')) {
  $items_scape[] = l(t('Add scape'),'node/add/story');
}*/


/**
  * Devuelve el mismo string que contiene un nombre dentro de parentesis pero con <em> englobando al parentesis
  * Entrada Ostrich (Struthio camelus)
  * Salida Ostrich <em>(Struthio camelus)</em>
  */
function _hba_cursive($string) {
  $string = str_replace("(", "</strong><em>(", $string);
  $string = str_replace(")", ")</em>", $string);
  
  return $string;
}

function hba_theme_preprocess_html(&$variables) {

  // Miramos las columnas que hay
  if(isset($variables['page']['content']['content']['sidebar_third']) && hba_theme_region_not_empty($variables['page']['content']['content']['sidebar_third'])) {
    $variables['attributes_array']['class'][] = 'sidebar-third';
  }
  
  if(isset($variables['page']['content']['content']['sidebar_second']) && hba_theme_region_not_empty($variables['page']['content']['content']['sidebar_second'])) {
    $variables['attributes_array']['class'][] = 'sidebar-second';
  }
  
  if(isset($variables['page']['content']['content']['sidebar_first']) && hba_theme_region_not_empty($variables['page']['content']['content']['sidebar_first'])) {
    $variables['attributes_array']['class'][] = 'sidebar-first';
  }
}

function hba_theme_region_not_empty($region) {
  foreach($region as $name => $block) {
    if(substr($name,0,1) != '#' && substr($name,0,11) != 'alpha_debug') {
      //dsm("Bloque encontrado " . $name);
      return true;
    }
  }
  
  return false;
}

function hba_theme_preprocess_search_result(&$vars) {
  // http://eureka.ykyuen.info/2011/11/04/drupal-add-image-to-apache-solr-search-result/ D6
  // Add node object to search-result.tpl.php
  //$n = $result['fields']['nid']['value'];
  /*$n = node_load($vars['result']['node']->nid);
  $n && ($vars['node'] = $n);*/

  // http://stackoverflow.com/questions/996253/how-to-customise-search-results-of-apachesolr-drupal-6
  //$vars['solr_search'] = views_embed_view('solr_search', 'default', $vars['result']['node']->nid);
  
  // http://www.acquia.com/resources/acquia-tv/conference/apache-solr-search-mastery
  
}

/**
 * implements hook_css_alter()
 */
function hba_theme_css_alter(&$css) {
  // Override the jquery.ui.dialog.css default file with a custom one
  if (isset($css['misc/ui/jquery.ui.dialog.css'])) {
    $css['misc/ui/jquery.ui.dialog.css']['data'] = drupal_get_path('theme', 'hba_theme') . '/css/jquery.ui/jquery-ui.dialog-custom.css';
  }
}
