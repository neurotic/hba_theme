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

function hba_theme_preprocess_page(&$variables) {
  // Move some variables to the top level for themer convenience and template cleanliness.
  if(drupal_is_front_page()) {
    $variables['title'] = '';
  }
}