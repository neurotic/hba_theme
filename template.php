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
  $output = l($element['#title'], $element['#href']);
  $description = '<p class="desc">' . $element['#localized_options']['attributes']['title'];   
  $element['#attributes']['class'][] = 'menu_' . strtolower(transliteration_clean_filename($element['#title']));
  return '<li' . drupal_attributes($element['#attributes']) . '><div class="wrapper"><span class="menu_image"></span>' . $output . $description . $sub_menu . "</div></li>\n";
}

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
    
  case 'search_block_form':
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');
    break;
    
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

/**
 * http://drupal.org/node/312220
 * Generates a node-flagged-FLAGNAME css class for every flag set on the node.
 *
 * In addition, if the flag is set by the current user, a
 * node-flagged-FLAGNAME-self class will be generated as well.
 *
 * The class names are accumulated in the $flag_classes variable and you must 
 * use it in your 'node.tpl.php', or else it will have no effect.
 */
/*function phptemplate_preprocess_node(&$vars) {
  $vars['flag_classes'] = implode(' ', _phptemplate_get_flag_classes('node', $vars['node']->nid));
}*/

/**
 * Returns a list of CSS classes for a flagged item.
 *
 * The classes are of the form "node-flagged-FLAGNAME" (where "node" would be
 * "user" or "comment": depending on the item type).
 *
 * Additionally, if the flag is set by the current user, a
 * "node-flagged-FLAGNAME-self" class will be generated as well.
 *
 * @param $content_type
 *   The item type: Either "node" or "user" or "comment" or whatever.
 * @param $content_id
 *   The item ID.
 */
/*function _phptemplate_get_flag_classes($content_type, $content_id) {
  static $flags = array();

  if (!module_exists('flag')) {
    return array();
  }

  if (!isset($flags[$content_type])) {
    $flags[$content_type] = flag_get_flags($content_type);
  }

  // Note: is_flagged() and get_count() use internal cache,
  // so using them won't result in issuing excessive SQL queries.

  $classes = array();
  foreach ($flags[$content_type] as $flag) {
    $css_name = str_replace('_', '-', $flag->name);
    if (!$flag->global && $flag->is_flagged($content_id)) {
      // The item is flagged by me.
      $classes[] = $content_type . '-flagged-' . $css_name;
      $classes[] = $content_type . '-flagged-' . $css_name . '-self';
    }
    elseif ($flag->get_count($content_id)) {
      // The item is flagged by anybody.
      $classes[] = $content_type . '-flagged-' . $css_name;
    }
  }
  return $classes;
}
*/

/**
 * http://drupal.org/node/312220 2a part
 * When your view is styled as a table, list or unformatted,
 * then 'node.tpl.php' isn't used and therefore the rows in the view won't carry our flag classes.
 * To fix this, add the following preprocess functions to your template.php. Rename garland to the actual name of your theme.
 */
/*
function hba_theme_preprocess_views_view_table(&$vars) {
  $view = $vars['view'];
  $rows = $vars['rows'];

  if ($view->base_table == 'node') {
    foreach ($rows as $id => $row) {
      $data = $view->result[$id];
      $flag_classes = implode(' ', _phptemplate_get_flag_classes('node', $data->nid));
      $vars['row_classes'][$id][] = $flag_classes;
      $vars['row_classes'][$id][] = 'views-row'; // For our JavaScript.
    }
  }
}

function hba_theme_preprocess_views_view_unformatted(&$vars) {
  $view = $vars['view'];
  $rows = $vars['rows'];

  if ($view->base_table == 'node'
       && $view->display_handler->get_option('row_plugin') != 'node'
       && empty($view->style_plugin->options['grouping'])) {  // Note: we don't support Grouping.
    foreach ($rows as $id => $row) {
      $data = $view->result[$id];
      $flag_classes = implode(' ', _phptemplate_get_flag_classes('node', $data->nid));
      $vars['classes'][$id] .= ' ' . $flag_classes;
    }
  }
}

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
  
  if(isset($variables['node']) && $variables['node']->type == 'species') {
    $variables['title'] = _hba_cursive(drupal_get_title());
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
 */
function hba_theme_form_views_exposed_form_alter(&$form , &$form_state){
  // Overrides the views exposed form url to be the current one
  // Avoids odd views redirect to views page from an exposed form in block
  $form['#action'] = request_uri();
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
  $string = str_replace("(", "(<em>", $string);
  $string = str_replace(")", "</em>)", $string);
  
  return $string;
}

